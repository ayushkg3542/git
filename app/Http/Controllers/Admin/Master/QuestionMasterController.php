<?php

namespace App\Http\Controllers\admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DoctorQuestionMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class QuestionMasterController extends Controller
{
    public function index() {
        $questions = DoctorQuestionMaster::orderBy('id', 'desc')->get();
        return view('admin.master.QuestionMaster', compact('questions'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'question'=> 'required | min:20 | unique:doctor_question_masters,question'
        ]);
        if ($validator->passes()) {
            $doctorQuestionMaster = new DoctorQuestionMaster();
            $doctorQuestionMaster->question = $request->question;
            $doctorQuestionMaster->save();
            return redirect()->route('questionMaster.index')->with('success','Question Inserted Successfully');
        } else {
            return redirect()->route('questionMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $doctorQuestionMaster = DoctorQuestionMaster::findOrFail($modifyId);
        return response([
            'status' => true,
            'data' => $doctorQuestionMaster
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            'modifiedQuestion'=> 'required | min:20 |unique:doctor_question_masters,question,' . $request->modifyId
        ]);
        if ($validator->passes()) {
            $doctorQuestionMaster = DoctorQuestionMaster::findOrFail($request->modifyId);
            $doctorQuestionMaster->question = $request->modifiedQuestion;
            $doctorQuestionMaster->save();
            return redirect()->route('questionMaster.index')->with('success','Question Modified Successfully');
        } else {
            return redirect()->route('questionMaster.index')->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $doctorQuestionMaster = DoctorQuestionMaster::findOrFail($request->deleteId);
            $doctorQuestionMaster->delete();
            return redirect()->route('questionMaster.index')->with('success','Question Deleted Successfully');
        } else {
            return redirect()->route('questionMaster.index')->with('error', 'No Record Found');
        }
    }
}
