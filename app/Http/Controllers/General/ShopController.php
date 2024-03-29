<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\PromotionResource;
use App\Http\Resources\ReviewResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Size;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShopController extends Controller
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
            ->when(request('range'),function ($query,$range){
                //update when review and orders are created
                if ($range=='most-popular'){
                    $query->orderBy('created_at');
                }elseif ($range=='top-rated'){
                    $query->orderBy('created_at','DESC');
                }elseif ($range=='low-to-high'){
                    $query->orderBy('price','ASC');
                }elseif ($range=='high-to-low'){
                    $query->orderBy('price','DESC');
                }

            })
            ->when(request('price'),function ($query,$price){

                if ($price=='0-1'){
                    $query->where('price','<=',1);
                }elseif ($price=='1-5'){
                    $query->whereBetween('price',[1,5]);
                }elseif ($price=='5-15'){
                    $query->whereBetween('price',[5,15]);
                }elseif ($price=='15-above'){
                    $query->where('price','>=',15);
                }

            })
            ->when(request('hoop'),function ($query,$hoop){
                $query->where('size_id',$hoop);
            })
            ->when(request('category'),function ($query,$category){
                $query->where('category_id',$category);
            })->with('embroideries','promotion')->inRandomOrder()->paginate(20);

        $products=ProductResource::collection($products);


        $hoops=Size::select('id','size_in_mm','size_in_inches')->get();
        $categories=Category::select('name','id')->get();

        $filters=request()->only(['price','hoop','range','category']);

        if (request('hoop')){
            $selectedHoop=Size::findOrFail(request('hoop'));
        }else{
            $selectedHoop=null;
        }
        if (request('category')){
            $selectedCategory=Category::findOrFail(request('category'));
        }else{
            $selectedCategory=null;
        }

        return inertia::render('shop.index',compact('categories','products','hoops','filters','selectedHoop','selectedCategory'));
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
        $product=Product::findBySlugOrFail($id)->load(['category','size','embroideries','promotion']);
        $product=new ProductResource($product);
        $reviews=ReviewResource::collection(Review::where('product_id',$product->id)->with('user')->paginate(10));
        $products=ProductResource::collection(Product::where('category_id', $product->category_id)->where('id','!=',$product->id)->with('embroideries','promotion')->latest()->limit(5)->get());
        return inertia::render('shop.show', compact('product','products','reviews'));
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


        return inertia::render('shop.index');
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

    public function shopCategory($id){
        $category=new CategoryResource(Category::findBySlugOrFail($id));
        $products=Product::query()
            ->when(request('range'),function ($query,$range){
                //update when review and orders are created
                if ($range=='most-popular'){
                    $query->orderBy('created_at');
                }elseif ($range=='top-rated'){
                    $query->orderBy('created_at','DESC');
                }elseif ($range=='low-to-high'){
                    $query->orderBy('price','ASC');
                }elseif ($range=='high-to-low'){
                    $query->orderBy('price','DESC');
                }

            })
            ->when(request('price'),function ($query,$price){

                if ($price=='0-1'){
                    $query->where('price','<=',1);
                }elseif ($price=='1-5'){
                    $query->whereBetween('price',[1,5]);
                }elseif ($price=='5-15'){
                    $query->whereBetween('price',[5,15]);
                }elseif ($price=='15-above'){
                    $query->where('price','>=',15);
                }

            })
            ->when(request('hoop'),function ($query,$hoop){
                $query->where('size_id',$hoop);
            })->where('category_id', $category->id)->with('embroideries','promotion')->paginate(20);
        $products=ProductResource::collection($products);
        $hoops=Size::select('id','size_in_mm','size_in_inches')->get();
        $filters=request()->only(['price','hoop','range']);
        if (request('hoop')){
            $selectedHoop=Size::findOrFail(request('hoop'));
        }else{
            $selectedHoop=null;
        }
     return inertia::render('shop/category', compact('category','products','hoops','filters','selectedHoop'));
    }

    public function shopPromotion($id){

        $promotion=new PromotionResource(Promotion::findBySlugOrFail($id));
        $products=Product::where('promotion_id',$promotion->id)
            ->when(request('range'),function ($query,$range){
                //update when review and orders are created
                if ($range=='most-popular'){
                    $query->orderBy('created_at');
                }elseif ($range=='top-rated'){
                    $query->orderBy('created_at','DESC');
                }elseif ($range=='low-to-high'){
                    $query->orderBy('price','ASC');
                }elseif ($range=='high-to-low'){
                    $query->orderBy('price','DESC');
                }

            })
            ->when(request('price'),function ($query,$price){

                if ($price=='0-1'){
                    $query->where('price','<=',1);
                }elseif ($price=='1-5'){
                    $query->whereBetween('price',[1,5]);
                }elseif ($price=='5-15'){
                    $query->whereBetween('price',[5,15]);
                }elseif ($price=='15-above'){
                    $query->where('price','>=',15);
                }

            })
            ->when(request('hoop'),function ($query,$hoop){
                $query->where('size_id',$hoop);
            })
            ->when(request('category'),function ($query,$category){
                $query->where('category_id',$category);
            })->with('embroideries','promotion')->paginate(20);

        $products=ProductResource::collection($products);

        $hoops=Size::select('id','size_in_mm','size_in_inches')->get();
        $categories=Category::select('name','id')->get();

        $filters=request()->only(['price','hoop','sort','category']);

        if (request('hoop')){
            $selectedHoop=Size::findOrFail(request('hoop'));
        }else{
            $selectedHoop=null;
        }
        if (request('category')){
            $selectedCategory=Category::findOrFail(request('category'));
        }else{
            $selectedCategory=null;
        }


        return inertia::render('shop.promotions', compact('promotion','products','hoops','categories','selectedCategory','selectedHoop','filters'));
    }
}
