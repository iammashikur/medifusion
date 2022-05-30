<?php

namespace App\Http\Controllers;

use App\DataTables\AgentAppointmentDataTable;
use App\Models\Agent;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AgentAppointment;

class AgentAppointmentController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:agent-appointment-list|agent-appointment-edit', ['only' => ['index']]);
         $this->middleware('permission:agent-appointment-edit', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(AgentAppointmentDataTable $dataTables)
    {
        return $dataTables->render('admin.agent_appointment_all');
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

        $appointment = Appointment::findOrFail($id);
        return view('admin.agent_appointment_edit', compact('appointment'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->appointment_date = $request->appointment_date;
        $appointment->status_id = $request->status_id;
        $appointment->serial = $request->serial;
        $appointment->save();

        if ($request->status_id == 2) {

            if($appointment->by_agent == 1){
                $notification_id = Agent::find(AgentAppointment::where('appointment_id')->first()->agent_id)->notification_id;
            }else{
                $notification_id = $appointment->getPatient->notification_id;
            }

            $title = "Your appointment has been fixed!";
            $content = "Your serial no. $request->serial, Doctor Name: ". $appointment->getDoctor->name;
            sendNotificationToUser($title, $content, 'USER' ,  $notification_id, null);
        }

        if ($request->status_id == 5) {
           DB::table('wallets')->where(['appointment_id' => $appointment->id])->update([
                'status' => 1,
            ]);
        }

        toast('Appointment Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('agent-appointment.index');


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
