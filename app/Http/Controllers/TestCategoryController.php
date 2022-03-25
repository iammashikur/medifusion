<?php

namespace App\Http\Controllers;

use App\DataTables\TestCategoriesDataTable;
use App\Models\TestCategory;
use Illuminate\Http\Request;

class TestCategoryController   extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TestCategoriesDataTable $dataTables)
    {
        return $dataTables->render('admin.test_category_all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test_category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new TestCategory();


        if ($request->hasFile('image')) {

            $imagePath         = MakeImage($request, 'image', public_path('/uploads/images/'));
            /** Save request data to db */
            $category->image      = $imagePath;
        }

        $category->name = $request->name;



        $category->hospital_id = auth()->user()->hospital_id;
        $category->save();
        toast('Specialization Created!', 'success')->width('300px')->padding('10px');
        return redirect()->route('test-category.index');
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
        $test_category = TestCategory::findOrFail($id);
        return view('admin.test_category_edit',compact('test_category'));
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
        $category =  TestCategory::findOrFail($id);

        if ($request->hasFile('image')) {

            $imagePath         = MakeImage($request, 'image', public_path('/uploads/images/'));
            /** Save request data to db */
            $category->image      = $imagePath;
        }

        $category->name = $request->name;

        $category->hospital_id = auth()->user()->hospital_id;
        $category->save();
        toast('Test Category Updated!', 'success')->width('300px')->padding('10px');
        return redirect()->route('test-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestCategory $test_category)
    {
        $test_category->delete();
    }
}
