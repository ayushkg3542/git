<?php

namespace App\Http\Controllers\Admin\Medicine;

use App\Http\Controllers\Controller;
use App\Models\BankMaster;
use App\Models\GeneralLedger;
use App\Models\MedicineInvoiceDetail;
use App\Models\MedicineMaster;
use App\Models\MedicinePurchaseDetail;
use App\Models\MedicineStock;
use App\Models\MedicineSupplierMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicinePurchaseController extends Controller
{
    public function index() {
        $suppliers = MedicineSupplierMaster::get();
        $banks = BankMaster::get();
        $medicines = MedicineMaster::get();
        return view('admin.medicine.purchase', compact('suppliers', 'medicines', 'banks'));
    }

    public function storeData(Request $request)
    {

        $medicineStock = MedicineStock::where('medicine', $request->medicine)->first();
        if($medicineStock) {
            $previousStock = $medicineStock->stock;
            $newStock = $request->quantity;
            $updatedStock = $previousStock + $newStock;
        } else {
            $medicineStock = new MedicineStock();
            $medicineStock->medicine = $request->medicine;
            $updatedStock = $request->quantity;
        }
        $medicineStock->stock = $updatedStock;
        $medicineStock->status = 1;
        $medicineStock->save();
        
        $medicinePurchase = new MedicinePurchaseDetail();
        $medicinePurchase->invoice_number = $request->invoice_number;
        $medicinePurchase->medicine = $request->medicine;
        $medicinePurchase->quantity = $request->quantity;
        $medicinePurchase->rate = $request->rate;
        $medicinePurchase->total_amount = $request->total_amount;
        $medicinePurchase->tax = $request->tax;
        $medicinePurchase->net_amount = $request->net_amount;
        $medicinePurchase->save();

        return response()->json([
            'status' => true,
            'message' => 'Data saved successfully'
        ]);
    }

    public function fetchData(Request $request) {
        $invoiceNumber = $request->invoiceNumber;
        $invoiceDetail = MedicineInvoiceDetail::where('invoice_number', $invoiceNumber)->get();
        $purchaseDetail = MedicinePurchaseDetail::with('Medicine')->where('invoice_number', $invoiceNumber)->get();
        $data = [
            'invoiceDetail' => $invoiceDetail,
            'purchaseDetail' => $purchaseDetail
        ];
        return response()->json(['data' => $data]);
    }

    public function editData(Request $request, $modifyId) {
        $medicinePurchaseDetail = MedicinePurchaseDetail::findOrFail($modifyId);
        return response([
            'status' => true,
            'data' => $medicinePurchaseDetail
        ]);
    }

    public function updateData(Request $request)
    {
        $medicinePurchase = MedicinePurchaseDetail::findOrFail($request->modifyId);
        if ($request->modifiedMedicine == $medicinePurchase->medicine) {
            $medicineChanged = false;
            $newStock = $request->modifiedQuantity - $medicinePurchase->quantity;
        } else {
            $medicineChanged = true;
            $previousMedicine = $medicinePurchase->medicine;
            $oldStock = $medicinePurchase->quantity;
            $newStock = $request->modifiedQuantity;
        }

        $invoiceNo = $medicinePurchase->invoice_number;
        $oldAmount = $medicinePurchase->net_amount;
        $newAmount = $request->modifiedNetAmount;
        $updatedAmount = $newAmount - $oldAmount;
        $invoice = MedicineInvoiceDetail::where('invoice_number', $invoiceNo)->first();
        $oldTotal = $invoice->invoice_total;
        $oldNet = $invoice->invoice_net;
        $invoice->invoice_total = $oldTotal + $updatedAmount;
        $invoice->invoice_net = $oldNet + $updatedAmount;
        $invoice->save();

        $medicinePurchase->medicine = $request->modifiedMedicine;
        $medicinePurchase->quantity = $request->modifiedQuantity;
        $medicinePurchase->rate = $request->modifiedRate;
        $medicinePurchase->total_amount = $request->modifiedTotalAmount;
        $medicinePurchase->tax = $request->modifiedTax;
        $medicinePurchase->net_amount = $request->modifiedNetAmount;
        $medicinePurchase->save();

        if ($medicineChanged) {
            $medicineStock = MedicineStock::where('medicine', $previousMedicine)->first();
            $previousStock = $medicineStock->stock;
            $updatedStock = $previousStock - $oldStock;
            $medicineStock->stock = $updatedStock;
            $medicineStock->save();

            $medicineStock = MedicineStock::where('medicine', $request->modifiedMedicine)->first();
            if($medicineStock) {
                $previousStock = $medicineStock->stock;
                $updatedStock = $previousStock + $newStock;
            } else {
                $medicineStock = new MedicineStock();
                $medicineStock->medicine = $request->modifiedMedicine;
                $updatedStock = $newStock;
            }
        } else {
            $medicineStock = MedicineStock::where('medicine', $request->modifiedMedicine)->first();
            $previousStock = $medicineStock->stock;
            $updatedStock = $previousStock + $newStock;
        }
        $medicineStock->stock = $updatedStock;
        $medicineStock->status = 1;
        $medicineStock->save();

        $request->session()->flash('success','Purchase Details Inserted Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Data Updated successfully'
        ]);
    }

    public function deleteData(Request $request)
    {
        $medicinePurchase = MedicinePurchaseDetail::findOrFail($request->deleteId);

        $invoiceNo = $medicinePurchase->invoice_number;
        $oldAmount = $medicinePurchase->net_amount;
        $invoice = MedicineInvoiceDetail::where('invoice_number', $invoiceNo)->first();
        $oldTotal = $invoice->invoice_total;
        $oldNet = $invoice->invoice_net;
        $invoice->invoice_total = $oldTotal - $oldAmount;
        $invoice->invoice_net = $oldNet - $oldAmount;
        $invoice->save();

        $deletedMedicine = $medicinePurchase->medicine;
        $deletedStock = $medicinePurchase->quantity;
        $invoiceNo = $medicinePurchase->invoice_number;
        $medicinePurchase->delete();

        $medicineStock = MedicineStock::where('medicine', $deletedMedicine)->first();
        $previousStock = $medicineStock->stock;
        $updatedStock = $previousStock - $deletedStock;
        $medicineStock->stock = $updatedStock;
        $medicineStock->save();

        $exists = MedicinePurchaseDetail::where('invoice_number', $invoiceNo)->exists();
        if (!$exists) {
            $invoice = MedicineInvoiceDetail::where('invoice_number', $invoiceNo)->first();
            $invoice->delete();
        }

        $request->session()->flash('success','Purchase Details Deleted Successfully');
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
            'supplier'=> 'required',
            'payment_method'=> 'required',
            'invoice_total'=> 'required',
            'invoice_net'=> 'required'
        ]);
        if ($validator->passes()) {
            $invoice = MedicineInvoiceDetail::where('invoice_number', $request->invoice_number)->first();
            if (!$invoice) {
                $invoice = new MedicineInvoiceDetail();
            }
            $invoice->invoice_number = $request->invoice_number;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->supplier = $request->supplier;
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
            if ($invoice->invoice_total == 0) {
                $invoice->delete();
            } else {
                $invoice->save();
            }

            return redirect()->route('medicinePurchase.index', ['invoiceNo' => $invoice->invoice_number])->with('success', 'Invoice Details Inserted Successfully');

        } else {
            return redirect()->route('medicinePurchase.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
        
    }
}
