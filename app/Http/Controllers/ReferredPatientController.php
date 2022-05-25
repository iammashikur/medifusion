<?php

namespace App\Http\Controllers;

use App\DataTables\ReferredPatientsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferredPatientController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:referred-patients-list', ['only' => ['index']]);

    }

    public function index(ReferredPatientsDataTable $referredPatientsDataTable){
        return $referredPatientsDataTable->render('referred_patients');
    }
}
