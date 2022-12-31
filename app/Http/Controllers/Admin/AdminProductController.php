<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Embroidery;
use App\Models\Format;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        $products=Product::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })->
        select('id','name','slug','price','status','sku','category_id')->withCount('embroideries')->with('category')->paginate(10);
        $filters=request()->only(['search']);
        return inertia::render('admin.products.index', compact('products','filters'));
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
        $sizes=Size::select('id','size_in_inches','size_in_mm')->get();

        return  inertia::render('admin.products.create', compact('categories', 'sizes'));
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
            'total_stitches'=>'required|integer',
            'size_id'=>'required|integer',
            'design_size_inches'=>'required|string|max:50',
            'design_size_mm'=>'required|string|max:50',
            'main_image'=>'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'second_image'=>'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'third_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'fourth_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'color_chart'=>'required|mimes:pdf|max:2048'
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
            'total_stitches'=>$validated['total_stitches'],
            'size_id'=>$validated['size_id'],
            'design_size_inches'=>$validated['design_size_inches'],
            'design_size_mm'=>$validated['design_size_mm']

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
        if($files=$request->color_chart){
            $product->addMedia($files)->toMediaCollection('colorChart');
        }

        return redirect()->route('products.index')
            ->with('status', 'Product Successfully created');
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
        $product=Product::findBySlugOrFail($id)->load(['category','size','embroideries']);
        $product=new ProductResource($product);
        return inertia::render('admin.products.show', compact('product'));
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
        $categories=Category::select('id','name')->get();
        $sizes=Size::select('id','size_in_inches','size_in_mm')->get();
        $product=new ProductResource(Product::findOrFail($id));
        return inertia::render('admin.products.edit', compact('product','sizes','categories'));
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
        $product=Product::findOrFail($id);

        $validated=$request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|between:0,9999999999.99',
            'description'=>'required',
            'keywords'=>'required|max:500',
            'meta_description'=>'required|max:1000',
            'category_id'=>'required|integer',
            'status'=>'required|integer',
            'total_stitches'=>'required|integer',
            'size_id'=>'required|integer',
            'design_size_inches'=>'required|string|max:50',
            'design_size_mm'=>'required|string|max:50',
            'main_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'second_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'third_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'fourth_image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:ratio=1/1|dimensions:width=1000,width=1000',
            'color_chart'=>'nullable|mimes:pdf|max:2048'
        ],[
            'dimensions'=>'Image must be square and measure 1000px by 1000px'
        ]);

        $product->update([
            'name'=>$validated['name'],
            'price'=>$validated['price'],
            'description'=>$validated['description'],
            'meta_description'=>$validated['meta_description'],
            'keywords'=>$validated['keywords'],
            'category_id'=>$validated['category_id'],
            'status'=>$validated['status'],
            'total_stitches'=>$validated['total_stitches'],
            'size_id'=>$validated['size_id'],
            'design_size_inches'=>$validated['design_size_inches'],
            'design_size_mm'=>$validated['design_size_mm']

        ]);

        //Media manager

        if($files=$request->main_image){
            $product->clearMediaCollection('mainImage');
            $product->addMedia($files)->toMediaCollection('mainImage');
        }
        if($files=$request->second_image){
            $product->clearMediaCollection('secondImage');
            $product->addMedia($files)->toMediaCollection('secondImage');
        }
        if($files=$request->third_image) {
            if ( $product->getMedia('thirdImage')->count()>0){
                $product->clearMediaCollection('thirdImage');
                $product->addMedia($files)->toMediaCollection('thirdImage');
            }else{
                $product->addMedia($files)->toMediaCollection('thirdImage');
            }

        }
        if($files=$request->fourth_image){
            if ( $product->getMedia('fourthImage')->count()>0){
                $product->clearMediaCollection('fourthImage');
                $product->addMedia($files)->toMediaCollection('fourthImage');
            }else{
                $product->addMedia($files)->toMediaCollection('fourthImage');
            }
        }
        if($files=$request->color_chart){
            $product->clearMediaCollection('colorChart');
            $product->addMedia($files)->toMediaCollection('colorChart');
        }

        return redirect()->route('products.index')
            ->with('status', 'Product Successfully Updated');
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
        $product=Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('status', 'Product Successfully deleted');
    }

    public function attachFiles($id){
        $product=Product::findOrFail($id)->only('name','id','design_size_mm','design_size_inches');
        $formats=Format::select('id','name', 'abbreviation')->get();
        $designs=Embroidery::where('product_id', $id)->select('id','file_name','product_id','format_id')->with('format')->get();

        return inertia::render('admin.products.attach-files',compact('product','formats','designs'));
    }

    public function saveFiles(Request $request){
        $validated=$request->validate([
            'format_id'=>'required|integer',
            'product_id'=>'required|integer',
            'artwork'=>'required|mimes:zip|max:5000'
        ],[
            'format_id.required'=>'Please select one format',
            'artwork.zip'=>'Only zip files are accepted',
            'artwork.required'=>'Please add design file in .zip format'
        ]);
        $product=Product::findOrFail($validated['product_id']);
        $format=Format::findOrFail($validated['format_id']);
        $file=$product->sku.'-'.$format->abbreviation.'-'.$request->file('artwork')->getClientOriginalName();

        $embroidery=Storage::disk('local')->putFileAs('artworks',$request->file('artwork'),$file );
        $design=Embroidery::create([
            'product_id'=>$product->id,
            'format_id'=>$format->id,
            'file_name'=>$file
        ]);

        return redirect()->back()
            ->with('status','Design Saved Successfully');
    }

    public function adminDownload($id){
      $embroidery=Embroidery::findOrFail($id);
        if (Storage::disk('artworks')->exists($embroidery->file_name)) {
            $headers = [
                'Content-Type' => 'application/pdf',
            ];
            return Storage::disk('artworks')->download($embroidery->file_name,$embroidery->file_name,$headers);


        }else{
            return redirect()->back()
                ->with('status','File not found');
        }
    }

    public function adminDelete($id){
     $embroidery=Embroidery::findOrFail($id);
        if (Storage::disk('artworks')->exists($embroidery->file_name)) {
            Storage::disk('artworks')->delete($embroidery->file_name);
        }
        $embroidery->delete();

     return redirect()->back()
         ->with('Design Successfully deleted');
    }
}
