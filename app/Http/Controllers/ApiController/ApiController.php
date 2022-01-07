<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
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
}
