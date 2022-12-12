<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::paginate(10)
            ->through(fn($category)=>[
                'id'=>$category->id,
                'name'=>$category->name,
                'status'=>$category->status,
                'slug'=>$category->slug
            ]);
        return inertia::render('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return inertia::render('admin.categories.create');
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
           'name'=>'required|string|max:50',
            'tags'=>'required|string|max:500',
            'description'=>'required|min:3|max:1000',
            'status'=>'required|integer|max:2'
        ]);

        $category=Category::create([
            'name'=>$validated['name'],
            'tags'=>$validated['tags'],
            'description'=>$validated['description'],
            'status'=>$validated['status']
        ]);

        return redirect()->route('categories.index');
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
        $category=Category::findBySlugOrFail($id)->only('name','id','description','slug','tags','status');
        return inertia::render('admin.categories.show', compact('category'));
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
        $category=Category::findOrFail($id);
        return inertia::render('admin.categories.edit', compact('category'));
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
        $validated=$request->validate([
            'name'=>'required|string|max:50',
            'tags'=>'required|string|max:500',
            'description'=>'required|min:3|max:1000',
            'status'=>'required|integer|max:2'
        ]);

        $category=Category::findOrFail($id);
        $category->update([
            'name'=>$validated['name'],
            'tags'=>$validated['tags'],
            'description'=>$validated['description'],
            'status'=>$validated['status']
        ]);

        return redirect()->route('categories.index');
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

        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
