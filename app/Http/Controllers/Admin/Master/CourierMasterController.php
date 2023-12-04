<?php

namespace App\Http\Controllers\admin\Master;

use App\Http\Controllers\Controller;
use App\Models\CourierMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CourierMasterController extends Controller
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

        $couriers = CourierMaster::orderBy('id', 'desc')->get();
        return view('admin.master.CourierMaster', compact('couriers', 'countries', 'auth_token'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'company'=> 'required',
            'address'=> 'required',
            'phone'=> 'required | min:10 | max:10',
            'country'=> 'required',
            'state'=> 'required',
            'price' => 'required',
            'effective_from'=> 'required'
        ]);
        if ($validator->passes()) {
            $courierMaster = new CourierMaster();
            $courierMaster->company = $request->company;
            $courierMaster->address = $request->address;
            $courierMaster->phone = $request->phone;
            $courierMaster->country = $request->country;
            $courierMaster->state = $request->state;
            $courierMaster->price = $request->price;
            $courierMaster->effective_from = $request->effective_from;
            $courierMaster->save();
            return redirect()->route('courierMaster.index')->with('success','Courier Details Inserted Successfully');
        } else {
            return redirect()->route('courierMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'Please Check All Input Fields');
        }
    }

    public function edit(Request $request, $modifyId) {
        $courierMaster = CourierMaster::findOrFail($modifyId);
        return response([
            'status' => true,
            'data' => $courierMaster
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'modifyId'=> 'required',
            'modifiedCompany'=> 'required',
            'modifiedAddress'=> 'required',
            'modifiedPhone'=> 'required | min:10 | max:10',
            'modifiedCountry'=> 'required',
            'modifiedState'=> 'required',
            'modifiedPrice' => 'required',
            'modifiedEffectiveFrom'=> 'required'
        ]);
        if ($validator->passes()) {
            $courierMaster = CourierMaster::findOrFail($request->modifyId);
            $courierMaster->company = $request->modifiedCompany;
            $courierMaster->address = $request->modifiedAddress;
            $courierMaster->phone = $request->modifiedPhone;
            $courierMaster->country = $request->modifiedCountry;
            $courierMaster->state = $request->modifiedState;
            $courierMaster->price = $request->modifiedPrice;
            $courierMaster->effective_from = $request->modifiedEffectiveFrom;
            $courierMaster->save();
            return redirect()->route('courierMaster.index')->with('success','Courier Details Modified Successfully');
        } else {
            return redirect()->route('courierMaster.index')->with('error', 'Please Check All Input Fields');
        }
    }

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'deleteId'=> 'required'
        ]);
        if ($validator->passes()) {
            $courierMaster = CourierMaster::findOrFail($request->deleteId);
            $courierMaster->delete();
            return redirect()->route('courierMaster.index')->with('success','Courier Details Deleted Successfully');
        } else {
            return redirect()->route('courierMaster.index')->withErrors($validator)->withInput($request->all())->with('error', 'No Record Found');
        }
    }
}
