<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CompounderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Compounder;
use App\Models\CompounderDoctor;
use App\Models\CompounderHospital;
use App\Models\Gender;
use Illuminate\Http\Request;

class CompounderController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:compounder-list|compounder-create|compounder-edit|compounder-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:compounder-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:compounder-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:compounder-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompounderDataTable $compounderDataTable)
    {
        return $compounderDataTable->render('admin.compounder_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $gender = Gender::get();
        return view('admin.compounder_create', compact('gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {







        $compounder = new Compounder();

        $compounder->name = $request->name;

        if ($request->hasFile('avatar')) {
            $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
            /** Save request data to db */
            $compounder->avatar      = $imagePath;
        }

        $compounder->gender = $request->gender;
        $compounder->phone = $request->phone;
        $compounder->password = bcrypt($request->password);
        $compounder->district = $request->district;
        $compounder->thana = $request->thana;
        $compounder->save();


        if ($request->has('doctors')) {
            foreach ($request->doctors as $key => $doctor) {
                $ComDoctor = new CompounderDoctor();
                $ComDoctor->compounder_id = $compounder->id;
                $ComDoctor->doctor_id = $doctor;
                $ComDoctor->save();
            }
        }

        if ($request->hospitals) {

                $ComHospital = new CompounderHospital();
                $ComHospital->compounder_id = $compounder->id;
                $ComHospital->hospital_id = $request->hospitals;
                $ComHospital->save();

        }




        toast('Compounder Added!', 'success')->width('300px')->padding('10px');
        return redirect()->route('compounder.index');
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
    public function edit(Compounder $compounder)
    {
        $gender = Gender::get();
        return view('admin.compounder_edit', compact('compounder', 'gender'));
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
        $compounder =  Compounder::findOrFail($id);

        $compounder->name = $request->name;

        if ($request->hasFile('avatar')) {
            $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
            /** Save request data to db */
            $compounder->avatar      = $imagePath;
        }
        $compounder->gender = $request->gender;
        $compounder->phone = $request->phone;

        if ($request->has('password')) {
            $compounder->password = bcrypt($request->password);
        }

        $compounder->district = $request->district;
        $compounder->thana = $request->thana;
        $compounder->save();


        if ($request->has('doctors')) {
            CompounderDoctor::where('compounder_id', $compounder->id)->delete();
            foreach ($request->doctors as $key => $doctor) {
                $ComDoctor = new CompounderDoctor();
                $ComDoctor->compounder_id = $compounder->id;
                $ComDoctor->doctor_id = $doctor;
                $ComDoctor->save();
            }
        }

        CompounderHospital::where('compounder_id', $compounder->id)->delete();
        if ($request->hospitals) {

                $ComHospital = new CompounderHospital();
                $ComHospital->compounder_id = $compounder->id;
                $ComHospital->hospital_id = $request->hospitals;
                $ComHospital->save();

        }




        toast('Compounder Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('compounder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Compounder::find($id)->delete();
    }
}
