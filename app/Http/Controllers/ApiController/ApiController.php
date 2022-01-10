<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\TestCategory;
use App\Models\TestSubcategory;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function doctors()
    {

        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {
            $doctor->specialization = $doctor->getSpecialization->specialization;
            $doctor->gender = $doctor->getGender;
        }

        return response()->json([
            'success' => true,
            'doctors_list' => $doctors,
        ], 200);
    }

    public function fix_appointment(Request $request)
    {


        if (!$request->filled('doctor_id')) {
            return response()->json([
                'success' => false,
                'message' => 'doctor_id required !',
            ], 200);
        }

        if (!Doctor::find($request->doctor_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Doctor not found !',
            ], 200);
        }

        $appointment = new Appointment();
        $appointment->patient_id = $request->user()->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->hospital_id = Doctor::find($request->doctor_id)->hospital_id;
        $appointment->appointment_fee = Doctor::find($request->doctor_id)->consultationfee;
        $appointment->status_id = 1;
        $appointment->save();

        return response()->json([
            'success' => true,
            'message' => 'Appointment Requested !',
        ], 200);
    }

    public function my_appointments(Request $request)
    {
        $appointments = Appointment::where('patient_id', $request->user()->id)->with('getDoctor','getHospital', 'getStatus')->get();
        return response()->json([
            'success' => true,
            'appointments' => $appointments,
        ], 200);
    }

    public function tests(){

        $tests = TestSubcategory::all();

        foreach( $tests as $test){

            $test->category = $test->getParent->name;

            foreach($test->getPrice as $it){


                 $it->get_hospital =  $it->getHospital;


                 unset($it->id);
                 unset($it->created_at);
                 unset($it->updated_at);
                 unset($it->get_hospital->created_at);
                 unset($it->get_hospital->updated_at);
            }

            $test->prices = $test->getPrice;

            unset($test->hospital_id);
            unset($test->category_id);
            unset($test->created_at);
            unset($test->updated_at);

           // unset($test->hospitals->get_hospital);
        }

        return response()->json([
            'success' => true,
            'tests' => @$tests,
        ], 200);

    }


    public function test_category(){
        $category = TestCategory::all();
        return response()->json([
            'success' => true,
            'test_categories' => @$category,
        ], 200);
    }

    public function test_by_cat($id){

        $category = TestSubcategory::where(['category_id' => $id])->get();

        return response()->json([
            'success' => true,
            'tests' => @$category,
        ], 200);

    }



}
