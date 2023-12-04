<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\LedgerGroupMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LedgerGroupMasterController extends Controller
{
    public function index() {
        $groups = LedgerGroupMaster::orderBy('id', 'desc')->get();
        return view('admin.master.LedgerGroupMaster', compact('groups'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'group_name'=> 'required | unique:ledger_group_masters,group_name'
        ]);
        if ($validator->passes()) {
            $ledgerGroupMaster = new LedgerGroupMaster();
            $ledgerGroupMaster->group_name = $request->group_name;
            $ledgerGroupMaster->save();
            return redirect()->route('ledgerGroupMaster.index')->with('success','Group Details Inserted Successfully');
        } else {
            return redirect()->route('ledgerGroupMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $ledgerGroupMaster = LedgerGroupMaster::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $ledgerGroupMaster
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId' => 'required',
            'modifiedGroupName' => 'required |unique:ledger_group_masters,group_name,' . $request->modifyId,
        ]);
        if ($validator->passes()) {
            $ledgerGroupMaster = LedgerGroupMaster::findOrfail($request->modifyId);
            $ledgerGroupMaster->group_name = $request->modifiedGroupName;
            $ledgerGroupMaster->save();
            return redirect()->route('ledgerGroupMaster.index')->with('success','Group Details Updated Successfully');
        } else {
            return redirect()->route('ledgerGroupMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $ledgerGroupMaster = LedgerGroupMaster::findOrfail($request->deleteId);
            $ledgerGroupMaster->delete();
            return redirect()->route('ledgerGroupMaster.index')->with('success','Group Details Deleted Successfully');
        } else {
            return redirect()->route('ledgerGroupMaster.index')->with('error', 'No Record Forund');
        }
    }

}
