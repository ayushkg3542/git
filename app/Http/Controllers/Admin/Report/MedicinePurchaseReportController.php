<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\MedicineInvoiceDetail;
use App\Models\MedicineSupplierMaster;
use Illuminate\Http\Request;

class MedicinePurchaseReportController extends Controller
{
    public function index() {
        $purchaseInvoices = MedicineInvoiceDetail::orderBy("id","desc")->get();
        $suppliers = MedicineSupplierMaster::orderBy("supplier")->get();
        return view('admin.report.MedicinePurchaseReport', compact('purchaseInvoices', 'suppliers'));
    }

    public function print(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $supplier = $request->supplier;
        if ($supplier) {
            $purchaseInvoices = MedicineInvoiceDetail::where('invoice_date','>=',$start_date)
                                ->where('supplier',$supplier)
                                ->where('invoice_date','<=',$end_date)
                                ->orderBy('id')->get();
        } else {
            $purchaseInvoices = MedicineInvoiceDetail::where('invoice_date','>=',$start_date)
                                ->where('invoice_date','<=',$end_date)
                                ->orderBy('id')->get();
        }
        return view('admin.report.MedicinePurchasePrint', compact('purchaseInvoices'))->withInput($request->all());
    }
}
