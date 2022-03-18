<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PushNotificationDataTable;
use App\Http\Controllers\Controller;
use App\Models\PushNotification;
use Illuminate\Http\Request;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PushNotificationDataTable $pushNotificationDataTable)
    {
        return $pushNotificationDataTable->render('admin.push_notification_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.push_notification_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $notification = new PushNotification();

        if ($request->hasFile('image')) {
            $imagePath         = MakeImage($request, 'image', public_path('/uploads/images/'));
            /** Save request data to db */
            $notification->image  = $imagePath;
        }

        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->link = $request->link;
        $notification->user_id = $request->user_id;
        $notification->agent_id = $request->agent_id;
        $notification->save();

        sendNotificationToSubsciber($request->title, $request->description, $imagePath);

        toast('Notification sent!', 'success')->width('300px')->padding('10px');
        return redirect()->back();

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
        //
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
        //
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
