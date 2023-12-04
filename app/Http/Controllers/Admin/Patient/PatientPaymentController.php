<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientPaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientPaymentController extends Controller
{
    public function store(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            "billing_date"=> "required",
            "current_amount"=> "required",
            "total_amount"=> "required",
            "received_amount"=> "required",
            "balance_amount"=> "required",
            "payment_method"=> "required",
        ]);
        if ($validator->passes()) {
            $patientPayment = new PatientPaymentDetail();
            $patientPayment->patient_id = $patientId;
            $patientPayment->billing_date = $request->billing_date;
            $patientPayment->previous_amount = $request->previous_amount;
            $patientPayment->current_amount = $request->current_amount;
            $patientPayment->total_amount = $request->total_amount;
            $patientPayment->received_amount = $request->received_amount;
            $patientPayment->balance_amount = $request->balance_amount;
            $patientPayment->payment_method = $request->payment_method;
            $patientPayment->reference_number = $request->reference_number;
            $patientPayment->save();
            return redirect()->route('patient.view', $patientId)->with('success','Payment Details Inserted Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function edit(Request $request, $modifyId) {
        $patientPayment = PatientPaymentDetail::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $patientPayment
        ]);
    }

    public function update(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            "modifyId"=> "required",
            "modified_billing_date"=> "required",
            "modified_current_amount"=> "required",
            "modified_total_amount"=> "required",
            "modified_received_amount"=> "required",
            "modified_balance_amount"=> "required",
            "modified_payment_method"=> "required",
        ]);
        if ($validator->passes()) {
            $patientPayment = PatientPaymentDetail::findOrfail($request->modifyId);
            $patientPayment->patient_id = $patientId;
            $patientPayment->billing_date = $request->modified_billing_date;
            $patientPayment->previous_amount = $request->modified_previous_amount;
            $patientPayment->current_amount = $request->modified_current_amount;
            $patientPayment->total_amount = $request->modified_total_amount;
            $patientPayment->received_amount = $request->modified_received_amount;
            $patientPayment->balance_amount = $request->modified_balance_amount;
            $patientPayment->payment_method = $request->modified_payment_method;
            $patientPayment->reference_number = $request->modified_reference_number;
            $patientPayment->save();
            return redirect()->route('patient.view', $patientId)->with('success','Payment Details Modified Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function destroy(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $patientPayment = PatientPaymentDetail::findOrfail($request->deleteId);
            $patientPayment->delete();
            return redirect()->route('patient.view', $patientId)->with('success','Record Deleted Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }
}
