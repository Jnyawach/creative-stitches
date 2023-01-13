<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //

    public function index(){
        $query=request('item');
        $products=Product::with('media')->search($query)->get();
        return $products;
    }
}
