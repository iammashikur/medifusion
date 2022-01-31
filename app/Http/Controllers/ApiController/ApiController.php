<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\PatientTestItem;
use App\Models\TestCategory;
use App\Models\TestSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    public function doctors()
    {

        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {


            foreach ($doctor->getLocations as $loc) {
                $loc->location = $loc->getLocation->location;
                unset($loc->id);
                unset($loc->doctor_id);
                unset($loc->location_id);
                unset($loc->created_at);
                unset($loc->updated_at);
                unset($loc->getLocation);
            }

            $doctor->specialization = $doctor->getSpecialization->specialization;
            $doctor->gender = $doctor->getGender;
            $doctor->locations = $doctor->getLocations;
            unset($doctor->getLocations);
            unset($doctor->getGender);
            unset($doctor->getSpecialization);
        }

        return response()->json([
            'success' => true,
            'doctors' => $doctors,
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

        if (!$request->filled('location')) {
            return response()->json([
                'success' => false,
                'message' => 'location required !',
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
        $appointment->location = $request->location;
        $appointment->save();

        return response()->json([
            'success' => true,
            'message' => 'Appointment Requested !',
        ], 200);
    }

    public function my_appointments(Request $request)
    {
        $appointments = Appointment::where('patient_id', $request->user()->id)->with('getDoctor', 'getHospital', 'getStatus')->get();
        return response()->json([
            'success' => true,
            'appointments' => $appointments,
        ], 200);
    }

    public function tests()
    {

        $tests = TestSubcategory::all();

        foreach ($tests as $test) {

            $test->category = $test->getParent->name;

            foreach ($test->getPrice as $it) {


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


    public function test_category()
    {


        $category = TestCategory::all();

        return response()->json([
            'success' => true,
            'test_categories' => @$category,
        ], 200);
    }

    public function test_by_cat($id)
    {

        $tests = TestSubcategory::where(['category_id' => $id])->get();


        foreach ($tests as $test) {

            $test->category = $test->getParent->name;

            foreach ($test->getPrice as $it) {


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

    public function doc_cat()
    {


        $spec = DoctorSpecialization::all();

        return response()->json([
            'success' => true,
            'categories' => @$spec,
        ], 200);
    }

    public function doc_by_cat($id)
    {

        $cat = DoctorSpecialization::find($id);


        foreach ($cat->getDoctors as $doctor) {


            foreach ($doctor->getLocations as $loc) {
                $loc->location = $loc->getLocation->location;
                unset($loc->id);
                unset($loc->doctor_id);
                unset($loc->location_id);
                unset($loc->created_at);
                unset($loc->updated_at);
                unset($loc->getLocation);
            }

            $doctor->specialization = $doctor->getSpecialization->specialization;
            $doctor->gender = $doctor->getGender;
            $doctor->locations = $doctor->getLocations;
            unset($doctor->getLocations);
            unset($doctor->getGender);
            unset($doctor->getSpecialization);
        }


        if ($cat->count() > 0) {

            return response()->json([
                'success' => true,
                'doctors' => @$cat->getDoctors,
            ], 200);
        }
        return response()->json([
            'success' => false,
        ], 404);
    }

    public function patient_tests(Request $request)
    {


        function random($len)
        {
            $char = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $total = strlen($char) - 1;
            $text = "";
            for ($i = 0; $i < $len; $i++) {
                $text = $text . $char[rand(0, $total)];
            }
            return $text;
        }

        $test = new PatientTest();
        $test->patient_id = $request->user()->id;
        $test->test_uid = round(time() / 1000).random(5);
        $test->status_id = 0;
        $test->hospital_id = 0;
        $test->save();


        foreach ($request->orderItems as $data) {

            $data = (object) $data;
            $item = new PatientTestItem();
            $item->test_name = $data->testName;
            $item->test_id = $data->test_id;
            $item->patient_test_id = $test->id;
            $item->hospital_id = $data->hospitalID;
            $item->hospital_name = $data->hospitalName;
            $item->price = $data->price;
            $item->save();
        }

        // $data = json_encode($request->all(), JSON_PRETTY_PRINT);
        // file_put_contents(public_path('data.json'), $data);

        return response()->json([
            'success' => true,
            'test_uid' =>  $test->test_uid,
        ], 200);
    }

    public function my_tests(Request $request){


        $tests = PatientTest::where('patient_id', $request->user()->id)->get();

        foreach($tests as $test){

            $test_items = PatientTestItem::where('patient_test_id', $test->id)->get();


            $test->test_items = $test_items;
        }

        return $tests;
    }
}
