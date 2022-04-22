<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentAppointment;
use App\Models\AgentTest;
use App\Models\AgentWithdraw;
use App\Models\Appointment;
use App\Models\CompounderDoctor;
use App\Models\CompounderHospital;
use App\Models\Doctor;
use App\Models\DoctorLocation;
use App\Models\DoctorSpecialization;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\PatientTestItem;
use App\Models\PushNotification;
use App\Models\TestCategory;
use App\Models\TestCommDisc;
use App\Models\TestPrice;
use App\Models\TestSubcategory;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function doctors()
    {

        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {
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

    public function agent_fix_appointment(Request $request)
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

        $patient = Patient::where(['phone' => $request->phone])
            ->first();

        if (!$patient) {
            $patient = new Patient();
        }

        $patient->name = $request->name;
        $patient->birth_date = $request->birth_date;
        $patient->gender = $request->gender;
        $patient->district = $request->district;
        $patient->thana = $request->thana;
        $patient->blood_group = $request->blood_group;
        $patient->referred_by_id = $request->user()->id;
        $patient->phone = $request->phone;
        $patient->password = bcrypt('12345678');
        $patient->save();

        $appointment = new Appointment();
        $appointment->patient_id = $patient->id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->hospital_id = 0;
        $appointment->appointment_fee = 0;
        $appointment->status_id = 1;
        $appointment->location = $request->location;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->by_agent = 1;
        $appointment->save();

        $agentAppointment = new AgentAppointment();
        $agentAppointment->patient_id = $patient->id;
        $agentAppointment->agent_id   = $request->user()->id;
        $agentAppointment->appointment_id   =  $appointment->id;
        $agentAppointment->save();


        //Update with wallet
        $appointmentUp = Appointment::find($appointment->id);
        $appointmentUp->appointment_fee = json_encode(appointmentPay($appointment->id, $request->location, $request->user()->id));
        $appointmentUp->save();


        return response()->json([
            'success' => true,
            'message' => 'Appointment Requested !',
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
        $appointment->hospital_id = 0;
        $appointment->appointment_fee = 0;
        $appointment->status_id = 1;
        $appointment->location = $request->location;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->by_agent = 0;
        $appointment->save();


        //Update with wallet
        $appointmentUp = Appointment::find($appointment->id);
        $appointmentUp->appointment_fee = json_encode(appointmentPay($appointment->id, $request->location));
        $appointmentUp->save();

        return response()->json([
            'success' => true,
            'message' => 'Appointment Requested !',
        ], 200);
    }

    public function my_appointments(Request $request)
    {
        $appointments = Appointment::where('patient_id', $request->user()->id)->with('getDoctor', 'getHospital', 'getStatus')->get();


        foreach ($appointments as $value) {
            $value->location = $value->getLocation;
        }

        return response()->json([
            'success' => true,
            'appointments' => $appointments,
        ], 200);
    }

    public function agent_appointments(Request $request)
    {

        $appointments = AgentAppointment::where('agent_id', $request->user()->id)->get();

        foreach ($appointments as $appointment) {
            $appointment->details = Appointment::where('id', $appointment->appointment_id)->with('getDoctor', 'getPatient', 'getHospital', 'getStatus')->get();
            foreach ($appointment->details as $ad) {
                $ad->location = $ad->getLocation;
            }
        }

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
                $it->get_category = TestCommDisc::where(['hospital_id' => $it->getHospital->id, 'test_category_id' => $test->getParent->id])->first();

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
                $it->get_category = TestCommDisc::where(['hospital_id' => $it->getHospital->id, 'test_category_id' => $test->getParent->id])->first();
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





    public function agent_patient_tests(Request $request)
    {


        $patient = Patient::where(['phone' => $request->phone])
            ->first();

        if (!$patient) {
            $patient = new Patient();
        }

        $patient->name = $request->name;
        $patient->birth_date = $request->birth_date;
        $patient->gender = $request->gender;
        $patient->district = $request->district;
        $patient->thana = $request->thana;
        $patient->phone = $request->phone;
        $patient->blood_group = $request->blood_group;
        $patient->referred_by_id = $request->user()->id;
        $patient->password = bcrypt('12345678');
        $patient->save();




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
        $test->patient_id = $patient->id;
        $test->test_uid = round(time() / 1000) . random(5);
        $test->status_id = 1;
        $test->hospital_id = 0;
        $test->by_agent = 1;
        $test->save();


        foreach ($request->orderItems as $data) {

            $data = (object) $data;
            $item = new PatientTestItem();
            $item->test_name = $data->testName;
            $item->test_id = $data->test_id;
            $item->patient_test_id = $test->id;
            $item->hospital_id = $data->hospitalID;
            $item->hospital_name = $data->hospitalName;
            $item->save();
            $get_category = TestCommDisc::where(['hospital_id' => $data->hospitalID, 'test_category_id' => $data->cat_id])->first();
            $itemUp = PatientTestItem::find($item->id);
            $itemUp->price = testPay($get_category, TestPrice::where(['hospital_id' => $data->hospitalID, 'test_id' => $itemUp->test_id])->first()->price, $test->id, $request->user()->id);
            $itemUp->save();
        }


        $agentAppointment = new AgentTest();
        $agentAppointment->agent_id = $request->user()->id;
        $agentAppointment->patient_id = $patient->id;
        $agentAppointment->test_id   = $test->id;
        $agentAppointment->save();


        // $data = json_encode($request->all(), JSON_PRETTY_PRINT);
        // file_put_contents(public_path('data.json'), $data);

        return response()->json([
            'success' => true,
            'test_uid' =>  $test->test_uid,
        ], 200);
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
        $test->test_uid = round(time() / 1000) . random(5);
        $test->status_id = 1;
        $test->hospital_id = 0;
        $test->by_agent = 0;
        $test->save();


        foreach ($request->orderItems as $data) {

            $data = (object) $data;
            $item = new PatientTestItem();
            $item->test_name = $data->testName;
            $item->test_id = $data->test_id;
            $item->patient_test_id = $test->id;
            $item->hospital_id = $data->hospitalID;
            $item->hospital_name = $data->hospitalName;
            $item->save();


            $get_category = TestCommDisc::where(['hospital_id' => $data->hospitalID, 'test_category_id' => $data->cat_id])->first();
            $itemUp = PatientTestItem::find($item->id);
            $itemUp->price = testPay($get_category, TestPrice::where(['hospital_id' => $data->hospitalID, 'test_id' => $itemUp->test_id])->first()->price, $test->id);
            $itemUp->save();
        }

        // $data = json_encode($request->all(), JSON_PRETTY_PRINT);
        // file_put_contents(public_path('data.json'), $data);

        return response()->json([
            'success' => true,
            'test_uid' =>  $test->test_uid,
        ], 200);
    }

    public function my_tests(Request $request)
    {

        $tests = PatientTest::where('patient_id', $request->user()->id)->with('getStatus')->get();
        foreach ($tests as $test) {
            $test_items = PatientTestItem::where('patient_test_id', $test->id)->get();
            foreach ($test_items as $key) {


                $key->location = Hospital::find($key->hospital_id);
                $key->image = @TestSubcategory::find($key->test_id)->image;
            }

            $test->test_items = $test_items;
        }

        return $tests;
    }


    public function agent_tests(Request $request)
    {

        $agentTest =  AgentTest::where(['agent_id' => $request->user()->id])->get();

        foreach ($agentTest as $atest) {

            $tests = PatientTest::where('id', $atest->test_id)->with('getStatus')->get();
            $patient = Patient::find($atest->patient_id);

            foreach ($tests as $test) {
                $test_items = PatientTestItem::where('patient_test_id', $test->id)->get();
                $test->test_items = $test_items;
            }

            $atest->details = $tests;
            $atest->patient = $patient;
        }

        return $agentTest;
    }


    public function update_profile(Request $request)
    {


        $user =  Patient::find($request->user()->id);

        if ($request->hasFile('avatar')) {
            $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
            $user->avatar      = $imagePath;
        }
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('district')) {
            $user->district = $request->district;
        }

        if ($request->has('thana')) {
            $user->thana = $request->thana;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }
        if ($request->has('birth_date')) {
            $user->birth_date = $request->birth_date;
        }
        if ($request->has('gender')) {
            $user->gender = $request->gender;
        }

        $user->notification_id = $request->notification_id;
        $user->blood_group = $request->blood_group;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User Successfully Updated ',
            'user_data' => $user,
        ], 200);
    }

    public function withdraw(Request $request)
    {

        $current = currentBalance('agent', $request->user()->id);

        if (!$request->has('amount')) {
            return response()->json([
                'success' => false,
                'message' => 'amount missing',
                'balance' => $current
            ], 200);
        }

        if ($request->amount <= $current) {


            $withdraw = new AgentWithdraw();
            $withdraw->agent_id  = $request->user()->id;
            $withdraw->status  = 1;
            $withdraw->amount  = $request->amount;
            $withdraw->withdraw_method  = $request->withdraw_method;
            $withdraw->account_details  = $request->account_details;
            $withdraw->save();

            return response()->json([
                'success' => true,
                'message' => 'withdraw requested',
                'balance' => $current
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'amount is greater than balance.',
                'balance' => $current
            ], 200);
        }
    }

    public function notifications()
    {

        $notifications = PushNotification::all();
        foreach ($notifications as $value) {
            $value->image = asset($value->image);
        }
        return response()->json([
            'success' => true,
            'notifications' => $notifications,
        ], 200);
    }

    public function agent(Request $request)
    {
        $agent = Agent::find($request->id);

        return response()->json([
            'success' => true,
            'agent' => $agent,
        ], 200);
    }

    public function balance(Request $request)
    {
        return response()->json([
            'success' => true,
            'balance' => currentBalance('agent', $request->user()->id),
        ], 200);
    }

    public function change_password(Request $request)
    {
        $user = Patient::where(['phone' => $request->phone])->first();
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();
            if (@Hash::check($request->password, $user->password)) {
                $user->tokens()->where('tokenable_id', $user->id)->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Password Successfully changed!',
                    'token' => $user->createToken('tokens')->plainTextToken,
                    'user_data' => $user,
                ], 200);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Phone number does not exist!',
        ], 200);
    }

    public function cancel_appointment(Request $request)
    {
        $appointment = Appointment::find($request->appointment_id);
        $appointment->status_id = 4;
        $appointment->save();


        if ($appointment) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment cancelled!',
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Appointment not found!',
        ], 200);
    }

    public function change_notification_id(Request $request)
    {

        $agent = Agent::find($request->user()->id);
        $agent->notification_id = $request->notification_id;
        $agent->save();

        return response()->json([
            'success' => true,
            'message' => 'Notification ID Updated!',
        ], 200);

    }

    public function compounder_doctors(Request $request){

        $doctors = [];

        foreach(CompounderDoctor::where(['compounder_id' => $request->user()->id])->get() as $doc){
            $doctors[] = @Doctor::find($doc->doctor_id);
        }

        return response()->json([
            'success' => true,
            'doctors' => $doctors,
        ], 200);

    }
    public function compounder_hospitals(Request $request){

        $hospitals = [];

        foreach(CompounderHospital::where(['compounder_id' => $request->user()->id])->get() as $doc){
            $hospitals[] = @Doctor::find($doc->hospital_id);
        }

        return response()->json([
            'success' => true,
            'hospitals' => $hospitals,
        ], 200);

    }

    public function compounder_appointments(Request $request){

        $appointments = Appointment::where('doctor_id', $request->id)->with('getDoctor', 'getHospital', 'getStatus')->get();

        foreach ($appointments as $value) {
            $value->location = $value->getLocation;
        }

        return response()->json([
            'success' => true,
            'appointments' => $appointments,
        ], 200);

    }

    public function compounder_tests(Request $request){

        $tests = PatientTest::where('hospital_id', $request->id)->with('getStatus')->get();
        foreach ($tests as $test) {
            $test_items = PatientTestItem::where('patient_test_id', $test->id)->get();
            foreach ($test_items as $key) {
                $key->location = Hospital::find($key->hospital_id);
                $key->image = @TestSubcategory::find($key->test_id)->image;
            }
            $test->test_items = $test_items;
        }

        return $tests;

    }

    public function compounder_appointment_update(Request $request){

        $appointment = Appointment::find($request->id);
        $appointment->status_id = $request->status;
        $appointment->save();

        return response()->json([
            'success' => true,
            'message' => 'Appointment Updated',
        ], 200);

    }

    public function compounder_test_update(Request $request){

        $appointment = PatientTest::find($request->id);
        $appointment->status_id = $request->status;
        $appointment->save();

        return response()->json([
            'success' => true,
            'message' => 'Test Updated',
        ], 200);

    }


}
