<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TransactionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:transaction-list|transaction-create', ['only' => ['index','store']]);
         $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TransactionDataTable $transactionDataTable)
    {
        return $transactionDataTable->render('admin.transaction_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transaction_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {







        $transaction = new Wallet();
        $transaction->user_type = $request->user_type;
        $transaction->user_id = $request->user_id;
        $transaction->account_holder = getName($request->user_type, $request->user_id);
        $transaction->transaction_type = $request->transaction_type;
        $transaction->amount = $request->amount;
        $transaction->status = 1;
        $transaction->save();


        if ($request->user_type == 'hospital' || $request->user_type == 'doctor') {
            if ($request->transaction_type == '-') {
                $transaction = new Wallet();
                $transaction->user_type = 'medic';
                $transaction->user_id = 0;
                $transaction->account_holder = getName('medic', 0);
                $transaction->transaction_type = '+';
                $transaction->amount = $request->amount;
                $transaction->status = 1;
                $transaction->save();
            }
        }

        toast('Transaction Successful!', 'success')->width('350px')->padding('10px');
        return redirect()->route('transaction.index');
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
