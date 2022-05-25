<?php

namespace App\Http\Controllers;

use App\DataTables\PatientTestsDataTable;
use App\Models\PatientTest;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientTestController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:patient-test-list|patient-test-edit', ['only' => ['index']]);
         $this->middleware('permission:patient-test-edit', ['only' => ['edit','update']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PatientTestsDataTable $patientTestsDataTable)
    {
        return $patientTestsDataTable->render('admin.patient_test_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $test = PatientTest::find($id);
        return view('admin.patient_test_edit', compact('test'));
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
        $test = PatientTest::find($id);
        $test->status_id = $request->status;
        $test->save();

        if ($request->status == 2) {
            DB::table('wallets')->where(['test_id' => $test->id])->update([
                'status' => 1,
            ]);
        }



        return redirect()->route('patient-test.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
