<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminFaqCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $categories=FaqCategory::paginate(10)
            ->through(fn($category)=>[
                'id'=>$category->id,
                'name'=>$category->name,
                'status'=>$category->status
            ]);

        return inertia::render('admin.faqs-category.index', compact('categories'));
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
        $validated=$request->validate([
            'name'=>'string|max:255|unique:faq_categories|required',
            'status'=>'required'
        ]);

        $category=FaqCategory::create([
            'name'=>$validated['name'],
            'status'=>$validated['status']
        ]);
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
        $category=FaqCategory::findOrFail($id);
        $validated=$request->validate([
            'name'=>'string|max:255|required',
            'status'=>'required'
        ]);

        $category->update([
            'name'=>$validated['name'],
            'status'=>$validated['status']
        ]);
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

        $category=FaqCategory::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
