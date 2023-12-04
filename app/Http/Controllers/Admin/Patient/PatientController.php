<?php

namespace App\Http\Controllers\admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\CourierMaster;
use App\Models\DoctorQuestionMaster;
use App\Models\PatientContactDetail;
use App\Models\PatientDoctorQuestion;
use App\Models\PatientMedicalDetail;
use App\Models\PatientPersonalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    public function index() {
        $patients = PatientPersonalDetail::orderBy("status_id")->orderByDesc("id")->get();
        return view('admin.patient.list', compact('patients'));
    }

    public function view($patientId) {
        $patient = PatientPersonalDetail::findOrfail($patientId);
        $courierMaster = CourierMaster::where('state', $patient->ContactDetail->state)->orderBy('company')->get();
        return view('admin.patient.view', compact('patient', 'courierMaster'));
    }

    public function edit($patientId) {
        $patient = PatientPersonalDetail::findOrfail($patientId);
        $questions = DoctorQuestionMaster::get();
        return view('admin.patient.edit', compact('patient', 'questions'));
    }

    public function update(Request $request, $patientId) {
        $validator = Validator::make($request->all(),[
            'file_number'=> 'required',
            'first_name'=> 'required',
            'gender'=> 'required',
            'nationality'=> 'required',

            'phone'=> 'required | numeric',

            'present_disease'=> 'required',
        ]);

        if ($validator->passes()) {

            $patientPersonalDetail = PatientPersonalDetail::findOrfail($patientId);
            $patientPersonalDetail->first_name = $request->first_name;
            $patientPersonalDetail->last_name = $request->last_name;
            $patientPersonalDetail->date_of_birth = $request->date_of_birth;
            $patientPersonalDetail->gender = $request->gender;
            $patientPersonalDetail->father_name = $request->father_name;
            $patientPersonalDetail->mother_name = $request->mother_name;
            $patientPersonalDetail->nationality = $request->nationality;
            $patientPersonalDetail->passport = $request->passport;
            $patientPersonalDetail->status_id = 2;
            if ($request->file('photo')) {
                $photo = $request->file('photo');
                $photo_name = time() . '-gc.' . $photo->getClientOriginalExtension();
                $photo->move(public_path('uploads/PatientPhotos'), $photo_name);
                $patientPersonalDetail->photo = $photo_name;
            }
            $patientPersonalDetail->save();

            $patientContactDetail = PatientContactDetail::where('patient_id', $patientId)->first();
            $patientContactDetail->address = $request->address;
            $patientContactDetail->country = $request->country;
            $patientContactDetail->state = $request->state;
            $patientContactDetail->city = $request->city;
            $patientContactDetail->pincode = $request->pincode;
            $patientContactDetail->email = $request->email;
            $patientContactDetail->phone = $request->phone;
            $patientContactDetail->save();

            if (PatientMedicalDetail::where('patient_id', $patientId)->exists()) {
                $patientMedicalDetail = PatientMedicalDetail::where('patient_id', $patientId)->first();
            } else {
                $patientMedicalDetail = new PatientMedicalDetail();
                $patientMedicalDetail->patient_id = $patientId;
            }
            $patientMedicalDetail->height = $request->height;
            $patientMedicalDetail->weight = $request->weight;
            $patientMedicalDetail->blood_group = $request->blood_group;
            $patientMedicalDetail->blood_pressure = $request->blood_pressure;
            $patientMedicalDetail->present_disease = $request->present_disease;
            $patientMedicalDetail->past_history = $request->past_history;
            $patientMedicalDetail->family_history = $request->family_history;
            $patientMedicalDetail->save();
            
            if (PatientDoctorQuestion::where('patient_id', $patientId)->exists()) {
                $questions_id = $request->question_id;
                $answers = $request->answer;
                $id = 0;
                foreach ($questions_id as $index => $question_id) {
                    $answer = $answers[$index];
                    if ($answer) {
                        $patientDoctorQuestions = PatientDoctorQuestion::findOrfail($question_id);
                        $patientDoctorQuestions->answer = $answer;
                        $patientDoctorQuestions->save();
                    }
                }
            } else {
                $questions_id = $request->question_id;
                $answers = $request->answer;
                $id = 0;
                if ($questions_id) {
                    foreach ($questions_id as $index => $question_id) {
                        $answer = $answers[$index];
                        if ($answer) {
                            $patientDoctorQuestions = new PatientDoctorQuestion();
                            $patientDoctorQuestions->question_id = $question_id;
                            $patientDoctorQuestions->answer = $answer;
                            $patientDoctorQuestions->patient_id = $patientId;
                            $patientDoctorQuestions->save();
                        }
                    }
                }
            }
            return redirect() -> route('patient.view', ['patientId'=>$patientId]) -> with('success', 'Details Modified Successfully');
        } else {
            return redirect() -> route('patient.view', ['patientId'=>$patientId]) -> withErrors($validator) -> withInput($request->all()) -> with('error', 'Please Check All Inputs');
        }
    }
}
