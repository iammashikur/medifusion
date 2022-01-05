<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function doctors()
    {

        $doctors = Doctor::all();

        foreach ($doctors as $doctor) {
            $doctor->specialization = $doctor->getSpecialization->specialization;
        }

        return response()->json([
            'success' => true,
            'doctors_list' => $doctors,
        ], 200);
    }
}
