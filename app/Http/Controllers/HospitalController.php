<?php

namespace App\Http\Controllers;

use App\DataTables\HospitalsDataTable;
use App\Models\Hospital;
use App\Models\TestCategory;
use App\Models\TestCommDisc;
use Illuminate\Http\Request;

class HospitalController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:hospital-list|hospital-create|hospital-edit|hospital-delete', ['only' => ['index','store']]);
         $this->middleware('permission:hospital-create', ['only' => ['create','store']]);
         $this->middleware('permission:hospital-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:hospital-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HospitalsDataTable $dataTables)
    {
        return $dataTables->render('admin.hospital_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hospital_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $hospital = new Hospital();
        $hospital->name = $request->name;

        $hospital->district_id = $request->district;
        $hospital->thana_id = $request->thana;

        $hospital->address = $request->address;
        $hospital->phone = $request->phone;
        $hospital->save();

        foreach (TestCategory::all() as $key => $value) {

            $data = new TestCommDisc();
            $data->test_category_id = $value->id;
            $data->hospital_id = $hospital->id;
            $data->commission = $request->{'test_commission_'.$value->id};
            $data->discount = $request->{'test_discount_'.$value->id};
            $data->save();

        }

        toast('Hospital Added!', 'success')->width('300px')->padding('10px');
        return redirect()->route('hospital.index');

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
        $hospital = Hospital::findOrFail($id);
        return view('admin.hospital_edit',compact('hospital'));
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
        $hospital = Hospital::findOrFail($id);
        $hospital->name = $request->name;

        $hospital->district_id = $request->district;
        $hospital->thana_id = $request->thana;

        $hospital->address = $request->address;
        $hospital->phone = $request->phone;
        $hospital->save();

        foreach (TestCategory::all() as $value) {



            if (TestCommDisc::where(['test_category_id' => $value->id, 'hospital_id' => $hospital->id])->first()) {
                $data = TestCommDisc::where(['test_category_id' => $value->id, 'hospital_id' => $hospital->id])->first();
            }else $data = new TestCommDisc();

            $data->test_category_id = $value->id;
            $data->hospital_id = $hospital->id;
            $data->commission = $request->{'test_commission_'.$value->id};
            $data->discount = $request->{'test_discount_'.$value->id};
            $data->save();

        }

        toast('Hospital Added!', 'success')->width('300px')->padding('10px');
        return redirect()->route('hospital.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
    }
}
