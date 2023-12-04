<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\BankMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankMasterController extends Controller
{
    public function index() {
        $banks = BankMaster::orderBy('id', 'desc')->get();
        return view('admin.master.BankMaster', compact('banks'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=> 'required | unique:bank_masters,name'
        ]);
        if ($validator->passes()) {
            $bankMaster = new BankMaster();
            $bankMaster->name = $request->name;
            $bankMaster->ifsc = $request->ifsc;
            $bankMaster->account = $request->account;
            $bankMaster->phone = $request->phone;
            $bankMaster->address = $request->address;
            $bankMaster->save();
            return redirect()->route('bankMaster.index')->with('success','Bank Details Inserted Successfully');
        } else {
            return redirect()->route('bankMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $bank = BankMaster::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $bank
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            'modifiedName'=> 'required |unique:bank_masters,name,' . $request->modifyId
        ]);
        if ($validator->passes()) {
            $bankMaster = BankMaster::findOrfail($request->modifyId);
            $bankMaster->name = $request->modifiedName;
            $bankMaster->ifsc = $request->modifiedIfsc;
            $bankMaster->account = $request->modifiedAccount;
            $bankMaster->phone = $request->modifiedPhone;
            $bankMaster->address = $request->modifiedAddress;
            $bankMaster->save();
            return redirect()->route('bankMaster.index')->with('success','Bank Details Modified Successfully');
        } else {
            return redirect()->route('bankMaster.index')->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $bankMaster = BankMaster::findOrfail($request->deleteId);
            $bankMaster->delete();
            return redirect()->route('bankMaster.index')->with('success','Bank Details Deleted Successfully');
        } else {
            return redirect()->route('bankMaster.index')->with('error', 'No Record Found');
        }
    }
}
