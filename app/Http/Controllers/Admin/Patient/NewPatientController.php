<?php

namespace App\Http\Controllers\admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\DoctorQuestionMaster;
use App\Models\PatientContactDetail;
use App\Models\PatientDoctorQuestion;
use App\Models\PatientMedicalDetail;
use App\Models\PatientPersonalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class NewPatientController extends Controller
{
    public function index() {

        $response = Http::withHeaders([
            "Accept"=> "application/json",
            "api-token"=> "WlaY888SlrT4951gAv8SQE_R7neWYSCwByqAWr56X7xW5VLIQ6cNX9e1u2WxjsH-2kU",
            "user-email"=> "dhyanish.khanna@gmail.com",
        ])->get("https://www.universal-tutorial.com/api/getaccesstoken");
        $data = (array)json_decode($response->body());
        $auth_token = $data['auth_token'];
        
        $country_response = Http::withHeaders([
            "Authorization" => "Bearer ".$auth_token
        ])->get('https://www.universal-tutorial.com/api/countries');
        $countries = (array)json_decode($country_response->body());

        $questions = DoctorQuestionMaster::get();
        
        return view('admin.patient.create', compact('auth_token', 'countries', 'questions'));
    }

    public function getStates(Request $request) {
        
        $state_response = Http::withHeaders([
            "Authorization" => "Bearer ".$request->auth_token
        ])->get('https://www.universal-tutorial.com/api/states/'.$request->country);
        $states = $state_response->body();
        
        return $states;
    }

    public function getCities(Request $request) {
        
        $city_response = Http::withHeaders([
            "Authorization" => "Bearer ".$request->auth_token
        ])->get('https://www.universal-tutorial.com/api/cities/'.$request->state);
        $cities = $city_response->body();
        
        return $cities;
    }

    public function checkDuplicate ($fileNo) {
        $isPresent = PatientPersonalDetail::where('file_number', $fileNo)->exists();

        return response()->json([
            'status' => $isPresent,
        ]);

    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'file_number'=> 'required |unique:patient_personal_details,file_number',
            'first_name'=> 'required',
            'gender'=> 'required',
            'nationality'=> 'required',

            'phone'=> 'required | numeric',

            'present_disease'=> 'required',
        ]);

        if ($validator->passes()) {

            $patientPersonalDetail = new PatientPersonalDetail();
            $patientPersonalDetail->file_number = $request->file_number;
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
            $patient_id = $patientPersonalDetail->id;

            $patientContactDetail = new PatientContactDetail();
            $patientContactDetail->patient_id = $patient_id;
            $patientContactDetail->address = $request->address;
            $patientContactDetail->country = $request->country;
            $patientContactDetail->state = $request->state;
            $patientContactDetail->city = $request->city;
            $patientContactDetail->pincode = $request->pincode;
            $patientContactDetail->email = $request->email;
            $patientContactDetail->phone = $request->phone;
            $patientContactDetail->save();

            $patientMedicalDetail = new PatientMedicalDetail();
            $patientMedicalDetail->patient_id = $patient_id;
            $patientMedicalDetail->height = $request->height;
            $patientMedicalDetail->weight = $request->weight;
            $patientMedicalDetail->blood_group = $request->blood_group;
            $patientMedicalDetail->blood_pressure = $request->blood_pressure;
            $patientMedicalDetail->present_disease = $request->present_disease;
            $patientMedicalDetail->past_history = $request->past_history;
            $patientMedicalDetail->family_history = $request->family_history;
            $patientMedicalDetail->save();
            
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
                        $patientDoctorQuestions->patient_id = $patient_id;
                        $patientDoctorQuestions->save();
                    }
                }
            }
            
            return redirect() -> route('patient.view', ['patientId'=>$patient_id]) -> with('success', 'Patient Details Inserted Successfully');
        } else {
            return redirect() -> route('patient.create') -> withErrors($validator) -> withInput($request->all()) -> with('error', 'Please Check All Inputs');
        }
        
    }
}
