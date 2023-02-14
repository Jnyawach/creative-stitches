<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\PromotionResource;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    //
    public function index()
    {
        //

        $products=Product::with('embroideries','promotion')->inRandomOrder()->limit(15)->get();
        $products=ProductResource::collection($products);
        $promotion=new PromotionResource(Promotion::where('status',1)->latest()->first());


        return inertia::render('welcome', compact('products','promotion'));
    }
}
