<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return inertia::render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories=Category::select('id','name')->get();

        return  inertia::render('admin.products.create', compact('categories'));
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
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|between:0,9999999999.99',
            'description'=>'required',
            'keywords'=>'required|max:500',
            'meta_description'=>'required|max:1000',
            'category_id'=>'required|integer',
            'status'=>'required|integer',
            'main_image'=>'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'second_image'=>'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'third_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'fourth_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000'
        ],[
            'dimensions'=>'Image must be square and measure 1000px by 1000px'
        ]);



        $product=Auth::user()->products()->create([
            'sku'=>'CR'.strtoupper(Str::random(8)),
            'mpn'=>rand(10000,99999),
            'name'=>$validated['name'],
            'price'=>$validated['price'],
            'description'=>$validated['description'],
            'meta_description'=>$validated['meta_description'],
            'keywords'=>$validated['keywords'],
            'category_id'=>$validated['category_id'],
            'status'=>$validated['status'],

        ]);
        if($files=$request->main_image){
            $product->addMedia($files)->toMediaCollection('mainImage');
        }
        if($files=$request->second_image){
            $product->addMedia($files)->toMediaCollection('secondImage');
        }
        if($files=$request->third_image) {
            $product->addMedia($files)->toMediaCollection('thirdImage');
        }
        if($files=$request->fourth_image){
            $product->addMedia($files)->toMediaCollection('fourthImage');
        }

        return $product;
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
