<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\MedicineStock;
use Illuminate\Http\Request;

class MedicineStockReportController extends Controller
{
    public function index() {
        $medicineStocks = MedicineStock::get();
        return view('admin.report.MedicineStockReport', compact('medicineStocks'));
    }

    public function print(Request $request) {
        $level = $request->level;
        if ($level) {
            $medicineStocks = MedicineStock::join('medicine_masters', 'medicine_stocks.medicine', '=', 'medicine_masters.id')
                        ->where('medicine_stocks.stock','<', $level)
                        ->get();
            return view('admin.report.MedicineStockPrint', compact('medicineStocks'));
        } else {
            return redirect()->route('medicineStockReport.index')->with('error', 'Enter Reorder Level');
        }
    }

    public function reorderList() {
        $medicineStocks = MedicineStock::join('medicine_masters', 'medicine_stocks.medicine', '=', 'medicine_masters.id')
                        ->whereRaw('medicine_stocks.stock < medicine_masters.reorder_level')
                        ->get();
        return view('admin.report.MedicineStockPrint', compact('medicineStocks'));
    }
}
