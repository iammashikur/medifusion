<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DoctorLocationDataTable;
use App\Http\Controllers\Controller;
use App\Models\DoctorLocation;
use Illuminate\Http\Request;

class DoctorLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoctorLocationDataTable $doctorLocationDataTable)
    {
        return $doctorLocationDataTable->render('admin.doctor_location_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor_location_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (DoctorLocation::where(['doctor_id' => $request->doctor_id, 'name' => $request->name])->count()) {

            $location = DoctorLocation::where(['doctor_id' => $request->doctor_id, 'name' => $request->name])->first();
            $location->doctor_id = $request->doctor_id;

            $location->address = $request->address;

            $location->district_id = $request->district;
            $location->thana_id = $request->thana;

            $location->start_time = $request->start_time;
            $location->end_time = $request->end_time;
            $location->consultation_fee = $request->consultation_fee;
            $location->save();

            toast('Location Updated!', 'success')->width('300px')->padding('10px');
            return redirect()->route('doctor-location.index');
        }

        $location = new DoctorLocation();
        $location->doctor_id = $request->doctor_id;


        $location->district_id = $request->district;
        $location->thana_id = $request->thana;

        $location->address = $request->address;

        $location->start_time = $request->start_time;
        $location->end_time = $request->end_time;
        $location->consultation_fee = $request->consultation_fee;
        $location->save();


        toast('Location Added!', 'success')->width('300px')->padding('10px');
        return redirect()->route('doctor-location.index');
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
    public function edit($id)
    {
        $location = DoctorLocation::findOrFail($id);
        return view('admin.doctor_location_edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $location = DoctorLocation::findOrFail($id);
        $location->doctor_id = $request->doctor_id;

        $location->district_id = $request->district;
        $location->thana_id = $request->thana;

        $location->address = $request->address;

        $location->start_time = $request->start_time;
        $location->end_time = $request->end_time;
        $location->consultation_fee = $request->consultation_fee;
        $location->save();

        toast('Location Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('doctor-location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DoctorLocation::findOrFail($id)->delete();
    }
}
