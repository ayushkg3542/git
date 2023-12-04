<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\MedicineSaleInvoice;
use Illuminate\Http\Request;

class MedicineSaleReportController extends Controller
{
    public function index() {
        $saleInvoices = MedicineSaleInvoice::orderBy('id','desc')->get();
        return view('admin.report.MedicineSaleReport', compact('saleInvoices'));
    }

    public function print(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $saleInvoices = MedicineSaleInvoice::where('invoice_date','>=',$start_date)
                            ->where('invoice_date','<=',$end_date)
                            ->orderBy('id')->get();
        return view('admin.report.MedicineSalePrint', compact('saleInvoices'))->withInput($request->all());
    }
}
