<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminTermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $terms=Term::all();
        return inertia::render('admin.terms.index',compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return inertia::render('admin.terms.create');
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
           'status'=>'required|integer',
           'category'=>'required|string|max:25',
           'content'=>'required'
        ]);

        $term=Term::create([
            'status'=>$validated['status'],
            'category'=>$validated['category'],
            'content'=>$validated['content']
        ]);
        return redirect()->route('terms.index')
            ->with('status', 'Policy text Create Successfully');
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
        $term=Term::findOrFail($id);
        return inertia::render('admin.terms.show', compact('term'));
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
        $term=Term::findOrFail($id);
        return inertia::render('admin.terms.edit', compact('term'));
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
            'status'=>'required|integer',
            'category'=>'required|string|max:25',
            'content'=>'required'
        ]);

        $term=Term::findOrFail($id);
        $term->update([
            'status'=>$validated['status'],
            'category'=>$validated['category'],
            'content'=>$validated['content']
        ]);
        return redirect()->route('terms.index')
            ->with('status', 'Policy text Updated Successfully');
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

        $term=Term::findOrFail($id);
        $term->delete();
        return redirect()->route('terms.index')
            ->with('status', 'Policy text Deleted Successfully');
    }
}
