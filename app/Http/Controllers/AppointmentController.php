<?php

namespace App\Http\Controllers;

use App\DataTables\AppointmentsDataTable;
use App\Models\Agent;
use App\Models\AgentAppointment;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(AppointmentsDataTable $dataTables)
    {
        return $dataTables->render('admin.appointment_all');
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
    public function edit(Appointment $appointment)
    {
        return view('admin.appointment_edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Appointment $appointment, Request $request)
    {
        $appointment = Appointment::findOrFail($appointment->id);
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
            sendNotificationToUser($title, $content, 'USER' , null , $notification_id);
        }

        if ($request->status_id == 5) {
           DB::table('wallets')->where(['appointment_id' => $appointment->id])->update([
                'status' => 1,
            ]);
        }



        toast('Appointment Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('appointment.index');


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
