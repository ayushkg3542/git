<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\LedgerGroupMaster;
use App\Models\LedgerSubGroupMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LedgerSubGroupMasterController extends Controller
{
    public function index() {
        $groups = LedgerGroupMaster::where("id",">",4)->orderBy('group_name')->get();
        $subGroups = LedgerSubGroupMaster::orderBy('id', 'desc')->get();
        return view('admin.master.LedgerSubGroupMaster', compact('groups', 'subGroups'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'group_id'=> 'required',
            'sub_group_name'=> 'required | unique:ledger_sub_group_masters,sub_group_name',
        ]);
        if ($validator->passes()) {
            $ledgerSubGroupMaster = new LedgerSubGroupMaster();
            $ledgerSubGroupMaster->group_id = $request->group_id;
            $ledgerSubGroupMaster->sub_group_name = $request->sub_group_name;
            $ledgerSubGroupMaster->opening_balance = $request->opening_balance;
            $ledgerSubGroupMaster->balance_type = $request->balance_type;
            $ledgerSubGroupMaster->save();
            return redirect()->route('ledgerSubGroupMaster.index')->with('success','Sub Group Details Inserted Successfully');
        } else {
            return redirect()->route('ledgerSubGroupMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $ledgerSubGroupMaster = LedgerSubGroupMaster::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $ledgerSubGroupMaster
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            'modified_group_id'=> 'required',
            'modified_sub_group_name'=> 'required |unique:ledger_sub_group_masters,sub_group_name,' . $request->modifyId,
        ]);
        if ($validator->passes()) {
            $ledgerSubGroupMaster = LedgerSubGroupMaster::findOrfail($request->modifyId);
            $ledgerSubGroupMaster->group_id = $request->modified_group_id;
            $ledgerSubGroupMaster->sub_group_name = $request->modified_sub_group_name;
            $ledgerSubGroupMaster->opening_balance = $request->modified_opening_balance;
            $ledgerSubGroupMaster->balance_type = $request->modified_balance_type;
            $ledgerSubGroupMaster->save();
            return redirect()->route('ledgerSubGroupMaster.index')->with('success','Sub Group Details Modified Successfully');
        } else {
            return redirect()->route('ledgerSubGroupMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $ledgerSubGroupMaster = LedgerSubGroupMaster::findOrfail($request->deleteId);
            $ledgerSubGroupMaster->delete();
            return redirect()->route('ledgerSubGroupMaster.index')->with('success','Sub Group Details Deleted Successfully');
        } else {
            return redirect()->route('ledgerSubGroupMaster.index')->with('error', 'No Record Forund');
        }
    }
}
