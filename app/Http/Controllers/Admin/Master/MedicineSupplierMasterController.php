<?php

namespace App\Http\Controllers\admin\Master;

use App\Http\Controllers\Controller;
use App\Models\MedicineSupplierMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MedicineSupplierMasterController extends Controller
{
    public function index() {
        $medicineSuppliers = MedicineSupplierMaster::orderBy('id', 'desc')->get();
        return view('admin.master.MedicineSupplierMaster', compact('medicineSuppliers'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'supplier'=> 'required |unique:medicine_supplier_masters,supplier',
            'address'=> 'required',
            'phone'=> 'required | size:10'
        ]);
        if ($validator->passes()) {
            $medicineSupplierMaster = new MedicineSupplierMaster();
            $medicineSupplierMaster->supplier = $request->supplier;
            $medicineSupplierMaster->address = $request->address;
            $medicineSupplierMaster->phone = $request->phone;
            $medicineSupplierMaster->gst = $request->gst;
            $medicineSupplierMaster->save();
            return redirect()->route('medicineSupplierMaster.index')->with('success','Supplier Details Inserted Successfully');
        } else {
            return redirect()->route('medicineSupplierMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $medicineSupplierMaster = MedicineSupplierMaster::findOrfail($modifyId);
        return response([
            'status' => true,
            'data' => $medicineSupplierMaster
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            'modifiedSupplier'=> 'required |unique:medicine_supplier_masters,supplier,' . $request->modifyId,
            'modifiedAddress'=> 'required',
            'modifiedPhone'=> 'required | size:10'
        ]);
        if ($validator->passes()) {
            $medicineSupplierMaster = MedicineSupplierMaster::findOrfail($request->modifyId);
            $medicineSupplierMaster->supplier = $request->modifiedSupplier;
            $medicineSupplierMaster->address = $request->modifiedAddress;
            $medicineSupplierMaster->phone = $request->modifiedPhone;
            $medicineSupplierMaster->gst = $request->modifiedGst;
            $medicineSupplierMaster->save();
            return redirect()->route('medicineSupplierMaster.index')->with('success','Supplier Details Modified Successfully');
        } else {
            return redirect()->route('medicineSupplierMaster.index')->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $medicineSupplierMaster = MedicineSupplierMaster::findOrfail($request->deleteId);
            $medicineSupplierMaster->delete();
            return redirect()->route('medicineSupplierMaster.index')->with('success','Supplier Details Deleted Successfully');
        } else {
            return redirect()->route('medicineSupplierMaster.index')->with('error', 'No Record Found');
        }
    }
}
