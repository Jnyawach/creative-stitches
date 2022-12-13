<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function getCategories(){
        $categories=Category::select('name','slug','id')->get();
        return $categories;
    }

}
