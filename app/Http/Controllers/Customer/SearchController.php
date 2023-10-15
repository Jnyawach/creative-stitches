<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function index(){
        $query=request('search');
        $products=Product::search($query)->take(5)->get();
        return ProductResource::collection($products);
    }
}
