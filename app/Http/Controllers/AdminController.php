<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientTest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login()
    {
        return view('admin.login');
    }

    public function index()
    {
        $doctor = Doctor::all();
        $patient = Patient::all();
        $appointments = Appointment::all();
        $usertest = PatientTest::all();
        return view('admin.dashboard', compact('doctor','patient','appointments','usertest'));
    }
}
