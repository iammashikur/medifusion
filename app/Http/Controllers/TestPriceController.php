<?php

namespace App\Http\Controllers;

use App\DataTables\TestPricesDataTable;
use App\Models\TestPrice;
use Illuminate\Http\Request;

class TestPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TestPricesDataTable $dataTables)
    {
        return $dataTables->render('admin.test_price_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test_price_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (TestPrice::where(['hospital_id' => $request->hospital, 'test_id' => $request->test_id,])->count()) {
            toast('Already Exist!', 'error')->width('300px')->padding('10px');
            return redirect()->route('test-price.index');
        }

        $price = new TestPrice();
        $price->hospital_id = $request->hospital;
        $price->test_id = $request->test_id;
        $price->price = $request->price;
        //$price->discount_price = $request->discount_price;
        $price->save();

        toast('Test Created!', 'success')->width('300px')->padding('10px');
        return redirect()->route('test-price.index');
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
        $testPrice = TestPrice::findOrFail($id);
        return view('admin.test_price_edit', compact('testPrice'));
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
        $testPrice = TestPrice::findOrFail($id);
        $testPrice->price = $request->price;
        //$testPrice->discount_price = $request->discount_price;
        $testPrice->save();

        toast('Test Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('test-price.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestPrice $testPrice)
    {
        $testPrice->delete();
    }
}
