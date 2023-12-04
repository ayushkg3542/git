<?php

namespace App\Http\Controllers\admin\Master;

use App\Http\Controllers\Controller;
use App\Models\MedicineMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineMasterController extends Controller
{
    public function index() {
        $medicines = MedicineMaster::orderBy('id', 'desc')->get();
        return view('admin.master.MedicineMaster', compact('medicines'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'medicine'=> 'required | unique:medicine_masters,medicine',
            'reorder_level'=> 'required',
            'unit'=> 'required'
        ]);
        if ($validator->passes()) {
            $medicineMaster = new MedicineMaster();
            $medicineMaster->medicine = $request->medicine;
            $medicineMaster->reorder_level = $request->reorder_level;
            $medicineMaster->unit = $request->unit;
            $medicineMaster->save();
            return redirect()->route('medicineMaster.index')->with('success','Medicine Details Inserted Successfully');
        } else {
            return redirect()->route('medicineMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $medicineMaster = MedicineMaster::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $medicineMaster
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId' => 'required',
            'modifiedMedicine' => 'required|unique:medicine_masters,medicine,' . $request->modifyId,
            'modified_reorder_level' => 'required',
            'modifiedUnit' => 'required',
        ]);
        
        if ($validator->passes()) {
            $medicineMaster = MedicineMaster::findOrfail($request->modifyId);
            $medicineMaster->medicine = $request->modifiedMedicine;
            $medicineMaster->reorder_level = $request->modified_reorder_level;
            $medicineMaster->unit = $request->modifiedUnit;
            $medicineMaster->save();
            return redirect()->route('medicineMaster.index')->with('success','Medicine Details Updated Successfully');
        } else {
            return redirect()->route('medicineMaster.index')->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $medicineMaster = MedicineMaster::findOrfail($request->deleteId);
            $medicineMaster->delete();
            return redirect()->route('medicineMaster.index')->with('success','Medicine Details Deleted Successfully');
        } else {
            return redirect()->route('medicineMaster.index')->with('error', 'No Record Forund');
        }
    }
}
