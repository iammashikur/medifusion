<?php

use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\AgentPayController;
use App\Http\Controllers\Admin\AgentSettingsController;
use App\Http\Controllers\Admin\AgentWithdrawController;
use App\Http\Controllers\Admin\ClientPayController;
use App\Http\Controllers\Admin\CompounderController;
use App\Http\Controllers\Admin\DoctorLocationController;
use App\Http\Controllers\Admin\DoctorReceiveController;
use App\Http\Controllers\Admin\HospitalReceiveController;
use App\Http\Controllers\Admin\PushNotificationController;
use App\Http\Controllers\Admin\TestCommDiscController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AgentAppointmentController;
use App\Http\Controllers\AgentTestController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientTestController;
use App\Http\Controllers\ReferredPatientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\TestCategoryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestPriceController;
use App\Http\Controllers\TestSubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\Agent;
use App\Models\District;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\PoliceStation;
use App\Models\TestSubcategory;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('thana-by-district/{id}', function (Request $request) {
    return District::find($request->id)->policeStations;
});
Route::get('test-by-category/{id}', function (Request $request) {
    return TestSubcategory::where(['category_id' => $request->id])->get();
});
Route::get('user-by-type/{type}', function (Request $request) {

    switch ($request->type) {
        case 'medic':
            return response()->json([
                [
                    'name' => 'Medic',
                    'id' =>   0
                ]
            ]);
            break;
        case 'hospital':
            return @Hospital::all();
            break;
        case 'patient':
            return @Patient::all();
            break;
        case 'agent':
            return @Agent::all();
            break;
        case 'doctor':
            return @Doctor::all();
            break;

        default:
            # code...
            break;
    }
});



Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [AdminController::class, 'index']);
    Route::resource('specialization', SpecializationController::class);
    Route::resource('patient', PatientController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('doctor-location', DoctorLocationController::class);
    Route::resource('appointment', AppointmentController::class);
    Route::resource('agent-appointment', AgentAppointmentController::class);
    Route::resource('patient-test', PatientTestController::class);
    Route::resource('agent-test', AgentTestController::class);
    Route::resource('hospital', HospitalController::class);
    Route::resource('test', TestController::class);
    Route::resource('test-category', TestCategoryController::class);
    Route::resource('test-subcategory', TestSubCategoryController::class);
    Route::resource('test-price', TestPriceController::class);
    Route::resource('referred-patient', ReferredPatientController::class);
    Route::resource('admin-and-role', AdminRoleController::class);
    Route::resource('location', LocationController::class);
    Route::resource('agent', AgentController::class);
    Route::resource('agent-settings', AgentSettingsController::class);
    Route::resource('compounder', CompounderController::class);


    Route::resource('transaction', TransactionController::class);
    Route::resource('agent-withdraw', AgentWithdrawController::class);
    Route::resource('agent-pay', AgentPayController::class);
    Route::resource('client-pay', ClientPayController::class);
    Route::resource('doctor-receive', DoctorReceiveController::class);
    Route::resource('hospital-receive', HospitalReceiveController::class);
    Route::resource('push-notification', PushNotificationController::class);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('user-ban/{id}', [UserController::class, 'ban'])->name('user.ban');
    Route::get('user-unban/{id}', [UserController::class, 'unban'])->name('user.ban');
});

Auth::routes();
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::get('/register', [AdminController::class, 'register'])->name('register');


Route::get('hello', function(){

    $data = [
         'agent-appointment-list',
         'agent-appointment-edit',
         'agent-test-list',
         'agent-test-edit',
         'appointment-list',
         'appointment-edit',
         'doctor-list',
         'doctor-create',
         'doctor-edit',
         'doctor-delete',
         'hospital-list',
         'hospital-create',
         'hospital-edit',
         'hospital-delete',
         'registered-users-list',
         'patient-test-list',
         'patient-test-edit',
         'referred-patients-list',
         'role-list',
         'role-create',
         'role-edit',
         'role-delete',
         'specialization-list',
         'specialization-create',
         'specialization-edit',
         'specialization-delete',
         'test-category-list',
         'test-category-create',
         'test-category-edit',
         'test-category-delete',
         'hospital-test-list',
         'hospital-test-create',
         'hospital-test-edit',
         'hospital-test-delete',
         'test-list',
         'test-create',
         'test-edit',
         'test-delete',
         'user-list',
         'user-create',
         'user-edit',
         'user-delete',
         'agent-list',
         'agent-create',
         'agent-edit',
         'agent-delete',
         'agent-pay-list',
         'agent-settings-edit',
         'agent-withdraw-list',
         'agent-withdraw-edit',
         'patient-pay-list',
         'compounder-list',
         'compounder-create',
         'compounder-edit',
         'compounder-delete',
         'doctor-location-list',
         'doctor-location-create',
         'doctor-location-edit',
         'doctor-location-delete',
         'doctor-receive-list',
         'hospital-receive-list',
         'push-notification-list',
         'push-notification-create',
         'transaction-list',
         'transaction-create',
         'settings-edit',


    ];


    foreach($data as $data){

        DB::table('permissions')->insert(
            [
                'name' => $data,
                'guard_name' => 'web',
            ]

            );

    }



});
