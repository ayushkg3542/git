<?php

namespace App\Http\Controllers\admin\report;

use App\Http\Controllers\Controller;
use App\Models\CourierMaster;
use App\Models\CourierStatusMaster;
use App\Models\PatientCourierDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CourierReportController extends Controller
{
    public function index() {
        $couriers = PatientCourierDetail::orderBy("id","desc")->get();
        // $companies = CourierMaster::orderBy("company")->get();
        $companies = CourierMaster::select('company', DB::raw('MAX(id) as id'))
            ->groupBy('company')
            ->orderBy('company')
            ->get();
        $statuses = CourierStatusMaster::orderBy("status")->get();
        return view('admin.report.CourierReport', compact('couriers', 'companies', 'statuses'));
    }

    public function print(Request $request) {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $end_date = Carbon::parse($end_date)->addDay();
        $companyy = $request->company;
        $status = $request->status;
        if ($companyy && $status) {
            $companies = CourierMaster::where('company', $companyy)->get();
            $couriers = "";
            foreach ($companies as $company) {
                $couriers = $couriers . PatientCourierDetail::where('created_at','>=',$start_date)
                                    ->where('created_at','<=',$end_date)
                                    ->where('courier_company',$company)
                                    ->where('status',$status)
                                    ->orderBy('id')->get();
            }
        } else if ($companyy) {
            $companies = CourierMaster::where('company', $companyy)->get();
            $couriers = "";
            foreach ($companies as $company) {
                $couriers = $couriers . PatientCourierDetail::where('created_at','>=',$start_date)
                                    ->where('created_at','<=',$end_date)
                                    ->where('courier_company',$company)
                                    ->orderBy('id')->get();
            }
        } else if ($status) {
            $couriers = PatientCourierDetail::where('created_at','>=',$start_date)
                                ->where('created_at','<=',$end_date)
                                ->where('status',$status)
                                ->orderBy('id')->get();
        } else {
            $couriers = PatientCourierDetail::where('created_at','>=',$start_date)
                                ->where('created_at','<=',$end_date)
                                ->orderBy('id')->get();
        }
        return view('admin.report.CourierPrint', compact('couriers'))->withInput($request->all());
    }
}
