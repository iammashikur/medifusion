<?php

namespace App\Http\Controllers;


use App\DataTables\DoctorsDataTable;
use App\Models\Doctor;
use App\Models\DoctorLocation;
use App\Models\DoctorSpecialization;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Color\BIFF5;

class DoctorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorsDataTable $dataTables)
    {
        return $dataTables->render('admin.doctor_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialization = DoctorSpecialization::get();
        $gender = Gender::get();
        return view('admin.doctor_create', compact('specialization', 'gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $doctor = new Doctor();
        /** Save image on dir */
        $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
        /** Save request data to db */
        $doctor->avatar      = $imagePath;
        $doctor->name      = $request->name;
        $doctor->registration      = $request->registration;
        $doctor->gender      = $request->gender;
        $doctor->specialization      = $request->specialization;
        $doctor->qualification      = $request->qualification;
        $doctor->phone      = $request->phone;
        $doctor->consultationfee      = $request->consultationfee;
        $doctor->hospital_id = auth()->user()->hospital_id;
        $doctor->save();

        foreach($request->location as $location){
            $store = new DoctorLocation();
            $store->location_id = $location;
            $store->doctor_id = $doctor->id;
            $store->save();
        }






        toast('Doctor Added!', 'success')->width('300px')->padding('10px');
        return redirect()->route('doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $specialization = DoctorSpecialization::get();
        $gender = Gender::get();
        return view('admin.doctor_edit', compact('specialization', 'gender', 'doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Doctor $doctor, Request $request)
    {



        $doctor = Doctor::findOrFail($doctor->id);
        /** Save image on dir */

        if ($request->hasFile('avatar')) {

            $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
            /** Save request data to db */
            $doctor->avatar      = $imagePath;
        }


        $doctor->name      = $request->name;
        $doctor->registration      = $request->registration;
        $doctor->gender      = $request->gender;
        $doctor->specialization      = $request->specialization;
        $doctor->qualification      = $request->qualification;
        $doctor->phone      = $request->phone;
        $doctor->consultationfee      = $request->consultationfee;
        $doctor->save();

        DoctorLocation::where(['doctor_id' =>  $doctor->id])->delete();

        foreach($request->location as $location){
            $store = new DoctorLocation();
            $store->location_id = $location;
            $store->doctor_id = $doctor->id;
            $store->save();
        }

        toast('Doctor Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {

        $doctor->delete();
    }
}
