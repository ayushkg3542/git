<?php

namespace App\Http\Controllers\admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\PatientPrescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientPrescriptionController extends Controller
{
    public function store(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            "prescription"=> "required",
            "next_visit"=> "required",
        ]);
        if ($validator->passes()) {
            $patientPrescription = new PatientPrescription();
            $patientPrescription->patient_id = $patientId;
            $patientPrescription->prescription = $request->prescription;
            $patientPrescription->next_visit = $request->next_visit;
            $patientPrescription->save();
            return redirect()->route('patient.view', $patientId)->with('success','Prescription Details Inserted Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function view(Request $request, $viewId) {
        $patientPrescription = PatientPrescription::findOrfail($viewId);
        return response([
            'status' => true,
            'data' => $patientPrescription
        ]);
    }

    public function edit(Request $request, $modifyId) {
        $patientPrescription = PatientPrescription::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $patientPrescription
        ]);
    }

    public function update(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            "modified_prescription"=> "required",
            "modified_next_visit"=> "required",
        ]);
        if ($validator->passes()) {
            $patientPrescription = PatientPrescription::findOrfail($request->modifyId);
            $patientPrescription->prescription = $request->modified_prescription;
            $patientPrescription->next_visit = $request->modified_next_visit;
            $patientPrescription->save();
            return redirect()->route('patient.view', $patientId)->with('success','Record Updated Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function repeat(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'repeatId'=> 'required',
            "repeat_prescription"=> "required",
            "repeat_next_visit"=> "required",
        ]);
        if ($validator->passes()) {
            $patientPrescription = new PatientPrescription();
            $patientPrescription->patient_id = $patientId;
            $patientPrescription->prescription = $request->repeat_prescription;
            $patientPrescription->next_visit = $request->repeat_next_visit;
            $patientPrescription->save();
            return redirect()->route('patient.view', $patientId)->with('success','Prescription Repeated Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function destroy(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $patientPrescription = PatientPrescription::findOrfail($request->deleteId);
            $patientPrescription->delete();
            return redirect()->route('patient.view', $patientId)->with('success','Record Deleted Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }
}
