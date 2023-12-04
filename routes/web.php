<?php

use App\Http\Controllers\Admin\Master\BankMasterController;
use App\Http\Controllers\Admin\Master\CourierMasterController;
use App\Http\Controllers\Admin\Master\LedgerGroupMasterController;
use App\Http\Controllers\Admin\Master\LedgerSubGroupMasterController;
use App\Http\Controllers\Admin\Master\MedicineMasterController;
use App\Http\Controllers\Admin\Master\QuestionMasterController;
use App\Http\Controllers\Admin\Master\MedicineSupplierMasterController;
use App\Http\Controllers\Admin\Medicine\MedicinePurchaseController;
use App\Http\Controllers\Admin\Medicine\MedicineSaleController;
use App\Http\Controllers\Admin\Patient\NewPatientController;
use App\Http\Controllers\Admin\Patient\PatientController;
use App\Http\Controllers\Admin\Patient\PatientCourierController;
use App\Http\Controllers\Admin\Patient\PatientPaymentController;
use App\Http\Controllers\Admin\Patient\PatientPrescriptionController;
use App\Http\Controllers\Admin\Patient\PatientRegistrationController;
use App\Http\Controllers\Admin\Report\CourierReportController;
use App\Http\Controllers\Admin\Report\MedicinePurchaseReportController;
use App\Http\Controllers\Admin\Report\MedicineSaleReportController;
use App\Http\Controllers\Admin\Report\MedicineStockReportController;
use App\Http\Controllers\Admin\Report\PaymentReportController;
use App\Http\Controllers\Admin\Report\ReceivedPaymentReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// Admin Routes
Route::group(['prefix' => 'admin'], function () {

    // Patient Routes
    Route::get('/getStatesR', [PatientRegistrationController::class,'getStates']) -> name('getStatesR');
    Route::get('/getCitiesR', [PatientRegistrationController::class,'getCities']) -> name('getCitiesR');
    Route::get('/checkDuplicateR/{fileNo}', [PatientRegistrationController::class,'checkDuplicate'])->name('registerPatient.checkDuplicate');
    Route::get('/registerPatient', [PatientRegistrationController::class,'index'])->name('registerPatient.create');
    Route::post('/registerPatient', [PatientRegistrationController::class,'store'])->name('registerPatient.store');
    
    // Admin Authenticated Routes
    Route::group(['middleware' => 'auth:admin', 'verified'], function () {

        // Dashboard Route
        Route::view('/dashboard', 'admin.dashboard') -> name('admin.dashboard');

        // Question Master Routes
        Route::get('/master/question', [QuestionMasterController::class,'index'])->name('questionMaster.index');
        Route::post('/master/question', [QuestionMasterController::class,'store'])->name('questionMaster.store');
        Route::get('/master/question/edit/{modifyId}', [QuestionMasterController::class,'edit'])->name('questionMaster.edit');
        Route::put('/master/question', [QuestionMasterController::class,'update'])->name('questionMaster.update');
        Route::delete('/master/question', [QuestionMasterController::class,'destroy'])->name('questionMaster.destroy');

        // Courier Master Routes
        Route::get('/master/courier', [CourierMasterController::class,'index'])->name('courierMaster.index');
        Route::post('/master/courier', [CourierMasterController::class,'store'])->name('courierMaster.store');
        Route::get('/master/courier/edit/{modifyId}', [CourierMasterController::class,'edit'])->name('courierMaster.edit');
        Route::put('/master/courier', [CourierMasterController::class,'update'])->name('courierMaster.update');
        Route::delete('/master/courier', [CourierMasterController::class,'destroy'])->name('courierMaster.destroy');

        // Medicine Master Routes
        Route::get('/master/medicine', [MedicineMasterController::class,'index'])->name('medicineMaster.index');
        Route::post('/master/medicine', [MedicineMasterController::class,'store'])->name('medicineMaster.store');
        Route::get('/master/medicine/edit/{modifyId}', [MedicineMasterController::class,'edit'])->name('medicineMaster.edit');
        Route::put('/master/medicine', [MedicineMasterController::class,'update'])->name('medicineMaster.update');
        Route::delete('/master/medicine', [MedicineMasterController::class,'destroy'])->name('medicineMaster.destroy');

        // Medicine Supplier Master Routes
        Route::get('/master/medicineSupplier', [MedicineSupplierMasterController::class,'index'])->name('medicineSupplierMaster.index');
        Route::post('/master/medicineSupplier', [MedicineSupplierMasterController::class,'store'])->name('medicineSupplierMaster.store');
        Route::get('/master/medicineSupplier/edit/{modifyId}', [MedicineSupplierMasterController::class,'edit'])->name('medicineSupplierMaster.edit');
        Route::put('/master/medicineSupplier', [MedicineSupplierMasterController::class,'update'])->name('medicineSupplierMaster.update');
        Route::delete('/master/medicineSupplier', [MedicineSupplierMasterController::class,'destroy'])->name('medicineSupplierMaster.destroy');

        // Bank Master Routes
        Route::get('/master/bank', [BankMasterController::class,'index'])->name('bankMaster.index');
        Route::post('/master/bank', [BankMasterController::class,'store'])->name('bankMaster.store');
        Route::get('/master/bank/edit/{modifyId}', [BankMasterController::class,'edit'])->name('bankMaster.edit');
        Route::put('/master/bank', [BankMasterController::class,'update'])->name('bankMaster.update');
        Route::delete('/master/bank', [BankMasterController::class,'destroy'])->name('bankMaster.destroy');

        // Ledger Group Master Routes
        Route::get('/master/ledgerGroup', [LedgerGroupMasterController::class,'index'])->name('ledgerGroupMaster.index');
        Route::post('/master/ledgerGroup', [LedgerGroupMasterController::class,'store'])->name('ledgerGroupMaster.store');
        Route::get('/master/ledgerGroup/edit/{modifyId}', [LedgerGroupMasterController::class,'edit'])->name('ledgerGroupMaster.edit');
        Route::put('/master/ledgerGroup', [LedgerGroupMasterController::class,'update'])->name('ledgerGroupMaster.update');
        Route::delete('/master/ledgerGroup', [LedgerGroupMasterController::class,'destroy'])->name('ledgerGroupMaster.destroy');

        // Ledger SubGroup Master Routes
        Route::get('/master/ledgerSubGroup', [LedgerSubGroupMasterController::class,'index'])->name('ledgerSubGroupMaster.index');
        Route::post('/master/ledgerSubGroup', [LedgerSubGroupMasterController::class,'store'])->name('ledgerSubGroupMaster.store');
        Route::get('/master/ledgerSubGroup/edit/{modifyId}', [LedgerSubGroupMasterController::class,'edit'])->name('ledgerSubGroupMaster.edit');
        Route::put('/master/ledgerSubGroup', [LedgerSubGroupMasterController::class,'update'])->name('ledgerSubGroupMaster.update');
        Route::delete('/master/ledgerSubGroup', [LedgerSubGroupMasterController::class,'destroy'])->name('ledgerSubGroupMaster.destroy');
        
        // Patient Routes
        Route::get('/getStates', [NewPatientController::class,'getStates']) -> name('getStates');
        Route::get('/getCities', [NewPatientController::class,'getCities']) -> name('getCities');
        Route::get('/checkDuplicate/{fileNo}', [NewPatientController::class,'checkDuplicate'])->name('patient.checkDuplicate');
        Route::get('/newPatient', [NewPatientController::class,'index'])->name('patient.create');
        Route::post('/newPatient', [NewPatientController::class,'store'])->name('patient.store');
        
        Route::get('/patient/list', [PatientController::class,'index'])->name('patient.list');
        Route::get('/patient/{patientId}', [PatientController::class,'view'])->name('patient.view');
        Route::get('/patient/edit/{patientId}', [PatientController::class,'edit'])->name('patient.edit');
        Route::put('/patient/{patientId}', [PatientController::class,'update'])->name('patient.update');
        
        // Patient Prescription Routes
        Route::post('/patient/prescription/{patientId}', [PatientPrescriptionController::class,'store'])->name('patient.prescription.store');
        Route::get('/patient/prescription/edit/{modifyId}', [PatientPrescriptionController::class,'edit'])->name('patient.prescription.edit');
        Route::put('/patient/prescription/{patientId}', [PatientPrescriptionController::class,'update'])->name('patient.prescription.update');
        Route::post('/patient/prescription/repeat/{patientId}', [PatientPrescriptionController::class,'repeat'])->name('patient.prescription.repeat');
        Route::delete('/patient/prescription/{patientId}', [PatientPrescriptionController::class,'destroy'])->name('patient.prescription.destroy');
        
        // Patient Courier Routes
        Route::post('/patient/courier/{patientId}', [PatientCourierController::class,'store'])->name('patient.courier.store');
        Route::put('/patient/courier/status/{patientId}', [PatientCourierController::class,'updateStatus'])->name('patient.courier.updateStatus');
        Route::get('/patient/courier/edit/{modifyId}', [PatientCourierController::class,'edit'])->name('patient.courier.edit');
        Route::put('/patient/courier/{patientId}', [PatientCourierController::class,'update'])->name('patient.courier.update');
        Route::delete('/patient/courier/{patientId}', [PatientCourierController::class,'destroy'])->name('patient.courier.destroy');
        Route::get('/patient/courier/{companyId}', [PatientCourierController::class,'getPrice'])->name('patient.courier.getPrice');
        
        // Patient Payment Routes
        Route::post('/patient/payment/{patientId}', [PatientPaymentController::class,'store'])->name('patient.payment.store');
        Route::get('/patient/payment/edit/{modifyId}', [PatientPaymentController::class,'edit'])->name('patient.payment.edit');
        Route::put('/patient/payment/{patientId}', [PatientPaymentController::class,'update'])->name('patient.payment.update');
        Route::delete('/patient/payment/{patientId}', [PatientPaymentController::class,'destroy'])->name('patient.payment.destroy');
        
        // Medicine Purchase Routes
        Route::get('/medicine/purchase', [MedicinePurchaseController::class,'index'])->name('medicinePurchase.index');
        Route::post('/medicine/purchase', [MedicinePurchaseController::class,'store'])->name('medicinePurchase.store');
        Route::post('/medicine/purchase/data', [MedicinePurchaseController::class,'storeData'])->name('medicinePurchase.storeData');
        Route::get('/medicine/purchase/data', [MedicinePurchaseController::class, 'fetchData'])->name('medicinePurchase.fetchData');
        Route::get('/medicine/purchase/edit/{modifyId}', [MedicinePurchaseController::class,'editData'])->name('medicinePurchase.editData');
        Route::put('/medicine/purchase', [MedicinePurchaseController::class,'updateData'])->name('medicinePurchase.updateData');
        Route::delete('/medicine/purchase', [MedicinePurchaseController::class,'deleteData'])->name('medicinePurchase.deleteData');
        
        // Medicine Sale Routes
        Route::get('/medicine/sale', [MedicineSaleController::class,'index'])->name('medicineSale.index');
        Route::post('/medicine/sale', [MedicineSaleController::class,'store'])->name('medicineSale.store');
        Route::post('/medicine/sale/data', [MedicineSaleController::class,'storeData'])->name('medicineSale.storeData');
        Route::get('/medicine/sale/data', [MedicineSaleController::class, 'fetchData'])->name('medicineSale.fetchData');
        Route::get('/medicine/sale/edit/{modifyId}', [MedicineSaleController::class,'editData'])->name('medicineSale.editData');
        Route::put('/medicine/sale', [MedicineSaleController::class,'updateData'])->name('medicineSale.updateData');
        Route::delete('/medicine/sale', [MedicineSaleController::class,'deleteData'])->name('medicineSale.deleteData');
        Route::get('/medicine/sale/patientName/{patientId}', [MedicineSaleController::class,'patientName'])->name('medicineSale.patientName');
        Route::get('/checkStock/{medicine}/{quantity}', [MedicineSaleController::class,'checkStock'])->name('medicineSale.checkStock');
        
        // Report Routes
        Route::get('report/medicinePurchaseReport', [MedicinePurchaseReportController::class,'index'])->name('medicinePurchaseReport.index');
        Route::post('report/medicinePurchaseReport', [MedicinePurchaseReportController::class,'print'])->name('medicinePurchaseReport.print');
        Route::get('report/medicineSaleReport', [MedicineSaleReportController::class,'index'])->name('medicineSaleReport.index');
        Route::post('report/medicineSaleReport', [MedicineSaleReportController::class,'print'])->name('medicineSaleReport.print');
        Route::get('report/medicineStockReport', [MedicineStockReportController::class,'index'])->name('medicineStockReport.index');
        Route::post('report/medicineStockReport', [MedicineStockReportController::class,'print'])->name('medicineStockReport.print');
        Route::get('report/medicineStockReport/reorderList', [MedicineStockReportController::class,'reorderList'])->name('medicineStockReport.reorderList');
        Route::get('report/paymentReport', [PaymentReportController::class,'index'])->name('paymentReport.index');
        Route::post('report/paymentReport', [PaymentReportController::class,'print'])->name('paymentReport.print');
        Route::get('report/receivedPaymentReport', [ReceivedPaymentReportController::class,'index'])->name('receivedPaymentReport.index');
        Route::post('report/receivedPaymentReport', [ReceivedPaymentReportController::class,'print'])->name('receivedPaymentReport.print');
        Route::get('report/courierReport', [CourierReportController::class,'index'])->name('courierReport.index');
        Route::post('report/courierReport', [CourierReportController::class,'print'])->name('courierReport.print');
    });

});

require __DIR__.'/adminAuth.php';

Route::fallback(function () {
    return view('error');
});