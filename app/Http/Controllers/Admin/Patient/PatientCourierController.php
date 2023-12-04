<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\CourierMaster;
use App\Models\PatientCourierDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientCourierController extends Controller
{

    public function getPrice($companyId) {
        $courierCompany = CourierMaster::findOrfail($companyId);
        return response([
            'status' => true,
            'data' => $courierCompany
        ]);
    }

    public function store(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            "company"=> "required",
            "weight"=> "required",
            "price"=> "required"
        ]);
        if ($validator->passes()) {
            $patientCourier = new PatientCourierDetail();
            $patientCourier->patient_id = $patientId;
            $patientCourier->courier_company = $request->company;
            $patientCourier->weight = $request->weight;
            $patientCourier->price = $request->price;
            $patientCourier->save();
            return redirect()->route('patient.view', $patientId)->with('success','Record Inserted Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function updateStatus(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'statusId'=> 'required'
        ]);
        if ($validator->passes()) {
            $patientCourier = PatientCourierDetail::findOrfail($request->statusId);
            if ($patientCourier->status == '1') {
                $patientCourier->status = 2;
            } else {
                $patientCourier->status = 1;
            }
            $patientCourier->save();
            return redirect()->route('patient.view', $patientId)->with('success','Courier Status Changed');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function edit(Request $request, $modifyId) {
        $patientCourier = PatientCourierDetail::findOrfail($request->modifyId);
        return response([
            'status' => true,
            'data' => $patientCourier
        ]);
    }

    public function update(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            'modified_weight'=> 'required',
            'modified_price'=> 'required'
        ]);
        if ($validator->passes()) {
            $patientCourier = PatientCourierDetail::findOrfail($request->modifyId);
            $patientCourier->weight = $request->modified_weight;
            $patientCourier->price = $request->modified_price;
            $patientCourier->save();
            return redirect()->route('patient.view', $patientId)->with('success','Courier Details Modified successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }

    public function destroy(Request $request, $patientId) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $patientCourier = PatientCourierDetail::findOrfail($request->deleteId);
            $patientCourier->delete();
            return redirect()->route('patient.view', $patientId)->with('success','Record Deleted Successfully');
        } else {
            return redirect()->route('patient.view', $patientId)->with('error', 'No Data Forund');
        }
    }
}
