<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //

    public function getCategories(){
       return CategoryResource::collection(Category::all());

    }

    public function getPosts(){

        $posts=PostResource::collection(Post::latest()->skip(request('skip'))->limit(request('limit'))->get());
        return $posts;
    }

    public function getCoupon(){
        return Coupon::select('code','discount','expires')->where('status',1)->where('expires','>=', Carbon::today())->latest()->first();
    }

    public function getCountry(){
        return Country::select('name','id')->orderBy('name')->get();
    }

    public function productSearch(){

    }

}
