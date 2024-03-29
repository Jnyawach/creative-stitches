<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\PromotionResource;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Termwind\render;

class AdminPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotions=Promotion::select('id','name','slug','discount')->withCount('products')->paginate(10);

        return inertia::render('admin.promotion.index',compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return inertia::render('admin.promotion.create');
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
            'description'=>'required|string|max:60',
            'title'=>'required|string|max:60',
            'discount'=>'required|integer|max:20',
            'status'=>'required|integer',
            'photo'=>'required|image|mimes:png|max:2048|dimensions:ratio=1/1|dimensions:min_width=400,min_height=400',
        ]);
        $promotion=Promotion::create([
            'name'=>$validated['name'],
            'discount'=>$validated['discount'],
            'status'=>$validated['status'],
            'title'=>$validated['title'],
            'description'=>$validated['description']
        ]);

        if($files=$request->photo){
            $promotion->addMedia($files)->toMediaCollection('photo');
        }


        return redirect()->route('promotion.index')
            ->with('status','Promotion created successfully');

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
        $promotion=Promotion::with('products')->select('name','id','discount','title','description')->findOrFail($id);

        $products=Product::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })->select('id','name','sku')->paginate(50);
        $filters=request()->only(['search']);
        return inertia::render('admin.promotion.show', compact('promotion','products','filters'));
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
        $promotion=new PromotionResource(Promotion::findOrFail($id));
        return inertia::render('admin.promotion.edit', compact('promotion'));
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
            'name'=>'required|string|max:255',
            'description'=>'required|string|max:60',
            'title'=>'required|string|max:60',
            'discount'=>'required|integer|max:20',
            'status'=>'required|integer',
            'photo'=>'nullable|image|mimes:png|max:2048|dimensions:ratio=1/1|dimensions:min_width=400,min_height=400',
        ]);
        $promotion=Promotion::findOrFail($id);
        $promotion->update([
            'name'=>$validated['name'],
            'discount'=>$validated['discount'],
            'status'=>$validated['status'],
            'title'=>$validated['title'],
            'description'=>$validated['description']
        ]);

        if($files=$request->photo){
            $promotion->clearMediaCollection('photo');
            $promotion->addMedia($files)->toMediaCollection('photo');
        }


        return redirect()->route('promotion.index')
            ->with('status','Promotion created successfully');
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
        $promotion=Promotion::findOrFail($id);
        $promotion->delete();
        return redirect()->route('promotion.index')
            ->with('status','Promotion deleted Successfully');
    }

   /* public function addProduct($id){
        $promotion=Promotion::with('products')->select('name','id','discount')->findOrFail($id);
        $products=Product::query()
            ->when(request('search'),function ($query,$search){
                $query->where('name','like', '%'.$search.'%');
            })->select('id','name','sku')->paginate(50);
        $filters=request()->only(['search']);
        return inertia::render('admin.promotion.add-product', compact('promotion','products','filters'));

    }*/

    public function saveProduct(Request $request){
        $product=Product::findOrFail($request->product_id);
        $product->update(['promotion_id'=>$request->promotion_id]);
        return redirect()->back()
            ->with('status', 'Product added to promotion successfully');
    }

    public function removeProduct(Request $request){
        $product=Product::findOrFail($request->product_id);
        $product->update(['promotion_id'=>null]);
        return redirect()->back()
            ->with('status', 'Product removed from promotion successfully');
    }
}
