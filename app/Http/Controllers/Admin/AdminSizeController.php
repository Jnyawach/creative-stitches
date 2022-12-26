<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sizes=Size::all();
        return inertia::render('admin.sizing.index', compact('sizes'));
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
            'size_in_inches'=>'required|string|max:50',
            'size_in_mm'=>'required|string|max:50',
            'stitching_area_inches'=>'required|string|max:50',
            'stitching_area_mm'=>'required|string|max:50'
        ]);

        $size=Size::create([
            'size_in_inches'=>$validated['size_in_inches'],
            'size_in_mm'=>$validated['size_in_mm'],
            'stitching_area_inches'=>$validated['stitching_area_inches'],
            'stitching_area_mm'=>$validated['stitching_area_mm']
        ]);

        return redirect()->back()
            ->with('status','Size Successfully saved');
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
        $validated=$request->validate([
            'size_in_inches'=>'required|string|max:50',
            'size_in_mm'=>'required|string|max:50',
            'stitching_area_inches'=>'required|string|max:50',
            'stitching_area_mm'=>'required|string|max:50'
        ]);
        $size=Size::findOrFail($id);
        $size->update([
            'size_in_inches'=>$validated['size_in_inches'],
            'size_in_mm'=>$validated['size_in_mm'],
            'stitching_area_inches'=>$validated['stitching_area_inches'],
            'stitching_area_mm'=>$validated['stitching_area_mm']
        ]);

        return redirect()->back()
            ->with('status','Size Successfully Updated');
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
        $size=Size::findOrFail($id);
        $size->delete();
        return redirect()->back()
            ->with('status','Size Successfully Deleted');
    }
}
