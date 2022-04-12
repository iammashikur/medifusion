<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AgentWithdrawDataTable;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\AgentWithdraw;
use App\Models\Wallet;
use Illuminate\Http\Request;

class AgentWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AgentWithdrawDataTable $agentWithdrawDataTable)
    {
        return $agentWithdrawDataTable->render('admin.agent_withdraw_all');
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

        $request = AgentWithdraw::find($id);
        $agent = Agent::find($request->agent_id);
        return view('admin.agent_withdraw_edit', compact('request','agent'));
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
        $agent_withdraw = AgentWithdraw::find($id);
        $agent_withdraw->status = $request->status;
        $agent_withdraw->trx_id = $request->trx_id;
        $agent_withdraw->save();

        if ($agent_withdraw->status == 3) {


            $title = "Your balance withdraw is successful.";
            $content = "Text: TrxID: $request->trx_id
            Current Balance: ".currentBalance('agent', $agent_withdraw->agent_id);
            sendNotificationToUser($title, $content, 'AGENT' , null , Agent::find($agent_withdraw->agent_id)->notification_id);

            $transaction = new Wallet();
            $transaction->user_type = 'agent';
            $transaction->user_id = $agent_withdraw->agent_id;
            $transaction->transaction_type = '-';
            $transaction->amount = $agent_withdraw->amount;
            $transaction->status = 1;
            $transaction->save();

        }


        toast('Status Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('agent-withdraw.index');

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
