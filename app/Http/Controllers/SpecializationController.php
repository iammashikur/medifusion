<?php

namespace App\Http\Controllers;

use App\DataTables\SpecializationsDataTable;
use App\Models\DoctorSpecialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SpecializationsDataTable $dataTables)
    {
        return $dataTables->render('admin.specialization_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.specialization_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $specialization = new DoctorSpecialization();
        $specialization->specialization = $request->specialization;
        $specialization->hospital_id = auth()->user()->hospital_id;
        $specialization->save();
        toast('Specialization Created!', 'success')->width('300px')->padding('10px');
        return redirect()->route('specialization.index');
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
        $specialization = DoctorSpecialization::findOrFail($id);
        return view('admin.specialization_edit',compact('specialization'));

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




        $specialization = DoctorSpecialization::findOrFail($id);
        $specialization->specialization = $request->specialization;
        $specialization->hospital_id = auth()->user()->hospital_id;

        $specialization->save();

        toast('Specialization Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('specialization.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorSpecialization $specialization)
    {

        $specialization->delete();
    }
}
