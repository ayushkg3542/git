<?php

namespace App\Http\Controllers\Admin\Medicine;

use App\Http\Controllers\Controller;
use App\Models\BankMaster;
use App\Models\GeneralLedger;
use App\Models\MedicineMaster;
use App\Models\MedicineSaleDetail;
use App\Models\MedicineSaleInvoice;
use App\Models\MedicineStock;
use App\Models\PatientPersonalDetail;
use Illuminate\Http\Request;
use Validator;

class MedicineSaleController extends Controller
{
    public function index() {
        $patients = PatientPersonalDetail::get();
        $banks = BankMaster::get();
        $medicines = MedicineStock::where('stock', '>=', 1)->get();
        $invoiceNo = MedicineSaleInvoice::latest('invoice_number')->value('invoice_number');
        if ($invoiceNo) {
            $invoiceNo = $invoiceNo + 1;
        } else {
            $invoiceNo = 1;
        }
        return view('admin.medicine.sale', compact('patients', 'medicines', 'banks', 'invoiceNo'));
    }

    public function checkStock ($medicine, $quantity) {
        $isPresent = MedicineStock::where('medicine', $medicine)->where('stock','>=',$quantity)->exists();

        return response()->json([
            'status' => $isPresent,
        ]);

    }

    public function storeData(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'invoice_number'=> 'required',
            'medicine'=> 'required',
            'quantity'=> 'required',
            'rate'=> 'required',
            'total_amount'=> 'required',
            'net_amount'=> 'required',
        ]);
        if ($validator->passes()) {
            $medicineStock = MedicineStock::where('medicine', $request->medicine)->first();
            $availableStock = $medicineStock->stock;
            $saleStock = $request->quantity;
            if($saleStock <= $availableStock) {
                $medicineStock->stock = $availableStock - $saleStock;
                $medicineStock->save();
                
                $medicineSale = new MedicineSaleDetail();
                $medicineSale->invoice_number = $request->invoice_number;
                $medicineSale->medicine = $request->medicine;
                $medicineSale->quantity = $request->quantity;
                $medicineSale->rate = $request->rate;
                $medicineSale->total_amount = $request->total_amount;
                $medicineSale->tax = $request->tax;
                $medicineSale->net_amount = $request->net_amount;
                $medicineSale->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Medicine Added Successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Please Check Your Stock'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please Check All Inputs'
            ]);
        }
    }

    public function fetchData(Request $request) {
        $invoiceNumber = $request->invoiceNumber;
        $invoiceDetail = MedicineSaleInvoice::where('invoice_number', $invoiceNumber)->get();
        $saleDetail = MedicineSaleDetail::with('Medicine')->where('invoice_number', $invoiceNumber)->get();
        $data = [
            'invoiceDetail' => $invoiceDetail,
            'purchaseDetail' => $saleDetail
        ];
        return response()->json(['data' => $data]);
    }

    public function editData(Request $request, $modifyId) {
        $medicineSaleDetail = MedicineSaleDetail::findOrFail($modifyId);
        return response([
            'status' => true,
            'data' => $medicineSaleDetail
        ]);
    }

    public function updateData(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'modifyId'=> 'required',
            'modifiedMedicine'=> 'required',
            'modifiedQuantity'=> 'required',
            'modifiedRate'=> 'required',
            'modifiedTotalAmount'=> 'required',
            'modifiedNetAmount'=> 'required',
        ]);
        if ($validator->passes()) {
            $medicineSale = MedicineSaleDetail::findOrFail($request->modifyId);
            if ($request->modifiedMedicine == $medicineSale->medicine) {
                $medicineChanged = false;
                $newStock = $request->modifiedQuantity - $medicineSale->quantity;
            } else {
                $medicineChanged = true;
                $previousMedicine = $medicineSale->medicine;
                $oldStock = $medicineSale->quantity;
                $newStock = $request->modifiedQuantity;
            }

            $invoiceNo = $medicineSale->invoice_number;
            $oldAmount = $medicineSale->net_amount;
            $newAmount = $request->modifiedNetAmount;
            $updatedAmount = $newAmount - $oldAmount;
            $invoice = MedicineSaleInvoice::where('invoice_number', $invoiceNo)->first();
            $oldTotal = $invoice->invoice_total;
            $oldNet = $invoice->invoice_net;
            $invoice->invoice_total = $oldTotal + $updatedAmount;
            $invoice->invoice_net = $oldNet + $updatedAmount;
            $invoice->save();

            $medicineStock = MedicineStock::where('medicine', $request->modifiedMedicine)->first();
            $availableStock = $medicineStock->stock;
            $saleStock = $newStock;
            if($saleStock <= $availableStock) {
                $inStock = true;
                $updatedStock = $availableStock - $saleStock;
                $medicineStock->stock = $updatedStock;
                $medicineStock->save();

                if ($medicineChanged) {
                    $medicineStock = MedicineStock::where('medicine', $previousMedicine)->first();
                    $previousStock = $medicineStock->stock;
                    $updatedStock = $previousStock + $oldStock;
                    $medicineStock->stock = $updatedStock;
                    $medicineStock->save();
                }
                $medicineSale->medicine = $request->modifiedMedicine;
                $medicineSale->quantity = $request->modifiedQuantity;
                $medicineSale->rate = $request->modifiedRate;
                $medicineSale->total_amount = $request->modifiedTotalAmount;
                $medicineSale->tax = $request->modifiedTax;
                $medicineSale->net_amount = $request->modifiedNetAmount;
                $medicineSale->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Medicine Modified Successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Please Check Your Stock'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Please Check All Inputs'
            ]);
        }
    }

    public function deleteData(Request $request)
    {
        $medicineSale = MedicineSaleDetail::findOrFail($request->deleteId);

        $invoiceNo = $medicineSale->invoice_number;
        $oldAmount = $medicineSale->net_amount;
        $invoice = MedicineSaleInvoice::where('invoice_number', $invoiceNo)->first();
        $oldTotal = $invoice->invoice_total;
        $oldNet = $invoice->invoice_net;
        $invoice->invoice_total = $oldTotal - $oldAmount;
        $invoice->invoice_net = $oldNet - $oldAmount;
        $invoice->save();

        $deletedMedicine = $medicineSale->medicine;
        $deletedStock = $medicineSale->quantity;
        $invoiceNo = $medicineSale->invoice_number;
        $medicineSale->delete();

        $medicineStock = MedicineStock::where('medicine', $deletedMedicine)->first();
        $availableStock = $medicineStock->stock;
        $updatedStock = $availableStock + $deletedStock;
        $medicineStock->stock = $updatedStock;
        $medicineStock->save();

        $exists = MedicineSaleDetail::where('invoice_number', $invoiceNo)->exists();
        if (!$exists) {
            $invoice = MedicineSaleInvoice::where('invoice_number', $invoiceNo)->first();
            $invoice->delete();
        }

        $request->session()->flash('success','Sale Details Deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Data Deleted successfully'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_number'=> 'required',
            'invoice_date'=> 'required',
            'patient'=> 'required',
            'payment_method'=> 'required',
            'invoice_total'=> 'required',
            'invoice_net'=> 'required'
        ]);
        if ($validator->passes()) {
            $invoice = MedicineSaleInvoice::where('invoice_number', $request->invoice_number)->first();
            if (!$invoice) {
                $invoice = new MedicineSaleInvoice();
            }
            $invoice->invoice_number = $request->invoice_number;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->patient = $request->patient;
            $invoice->payment_method = $request->payment_method;
            $invoice->bank = $request->bank;
            $invoice->narration = $request->narration;
            $invoice->invoice_total = $request->invoice_total;
            $invoice->cgst = $request->cgst;
            $invoice->sgst = $request->sgst;
            $invoice->gst = $request->gst;
            $invoice->labour = $request->labour;
            $invoice->freight = $request->freight;
            $invoice->invoice_net = $request->invoice_net;
            $invoice->save();
            $invoice_id = $invoice->id;
            if ($invoice->invoice_total == 0) {
                $invoice->delete();
            } else {
                $invoice->save();
            }

            return redirect() -> route('medicineSale.index', ['invoiceNo' => $invoice->invoice_number]) -> with('success', 'Invoice Details Inserted Successfully');
        } else {
            return redirect()->route('medicineSale.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }   
    }

    public function patientName($patientId) {
        $patient = PatientPersonalDetail::findOrfail($patientId);
        $patientName = strtoupper($patient->first_name . " " . $patient->last_name);
        return response()->json([
            'status' => true,
            'data' => $patientName
        ]);
    }
}
