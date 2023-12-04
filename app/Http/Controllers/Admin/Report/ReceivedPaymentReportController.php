<?php

namespace App\Http\Controllers\admin\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceivedPaymentReportController extends Controller
{
    public function index() {
        $paymentDetails = DB::table('patient_payment_details')
        ->join('patient_personal_details', 'patient_payment_details.patient_id', '=', 'patient_personal_details.id')
        ->join('patient_contact_details', 'patient_payment_details.patient_id', '=', 'patient_contact_details.patient_id')
        ->whereIn('patient_payment_details.id', function ($query) {
            $query->selectRaw('id')->from('patient_payment_details');
        })
        ->select('patient_payment_details.*', 'patient_personal_details.first_name', 'patient_contact_details.phone')
        ->get();
        
        return view('admin.report.ReceivedPaymentReport', compact('paymentDetails'));
    }

    public function print(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $paymentDetails = DB::table('patient_payment_details')
        ->join('patient_personal_details', 'patient_payment_details.patient_id', '=', 'patient_personal_details.id')
        ->join('patient_contact_details', 'patient_payment_details.patient_id', '=', 'patient_contact_details.patient_id')
        ->whereIn('patient_payment_details.id', function ($query) {
            $query->selectRaw('id')->from('patient_payment_details');
        })
        ->where('billing_date','>=',$start_date)
        ->where('billing_date','<=',$end_date)
        ->select('patient_payment_details.*', 'patient_personal_details.first_name', 'patient_contact_details.phone')
        ->get();
        
        return view('admin.report.ReceivedPaymentPrint', compact('paymentDetails'));
    }
}
