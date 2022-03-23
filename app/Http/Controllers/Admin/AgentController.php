<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AgentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Gender;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgentDataTable $agentDataTable)
    {
        return $agentDataTable->render('admin.agent_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $gender = Gender::get();
        return view('admin.agent_create',compact('gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $agent = new Agent();

        $agent->name = $request->name;

        if ($request->hasFile('avatar')) {
            $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
            /** Save request data to db */
            $agent->avatar      = $imagePath;
        }

        $agent->gender = $request->gender;
        $agent->phone = $request->phone;
        $agent->password = bcrypt($request->password);
        $agent->billing_address = $request->billing_address;
        $agent->district = $request->district;
        $agent->thana = $request->thana;
        $agent->bkash = $request->bkash;
        $agent->nagad = $request->nagad;
        $agent->bank_details = $request->bank_details;
        $agent->commission = $request->commission;
        $agent->status = $request->status;
        $agent->save();

        toast('Agent Added!', 'success')->width('300px')->padding('10px');
        return redirect()->route('agent.index');
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
    public function edit(Agent $agent)
    {
        $gender = Gender::get();
        return view('admin.agent_edit', compact('agent','gender'));
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
        $agent =  Agent::findOrFail($id);

        $agent->name = $request->name;

        if ($request->hasFile('avatar')) {
            $imagePath         = MakeImage($request, 'avatar', public_path('/uploads/images/'));
            /** Save request data to db */
            $agent->avatar      = $imagePath;
        }
        $agent->gender = $request->gender;
        $agent->phone = $request->phone;

        if ($request->password) {
            $agent->password = bcrypt($request->password);
        }

        $agent->billing_address = $request->billing_address;
        $agent->district = $request->district;
        $agent->thana = $request->thana;
        $agent->bkash = $request->bkash;
        $agent->nagad = $request->nagad;
        $agent->bank_details = $request->bank_details;
        $agent->commission = $request->commission;
        $agent->status = $request->status;
        $agent->save();

        toast('Agent Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('agent.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agent::find($id)->delete();
    }
}
