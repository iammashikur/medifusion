<?php

namespace App\Http\Controllers;

use App\DataTables\AgentTestsDataTable;
use App\DataTables\PatientTestsDataTable;
use App\Models\PatientTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgentTestsDataTable $patientTestsDataTable)
    {
        return $patientTestsDataTable->render('admin.agent_test_index');
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
        return view('admin.agent_test_edit', compact('test'));
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

        return redirect()->back();
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
