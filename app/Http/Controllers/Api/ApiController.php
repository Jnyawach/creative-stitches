<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
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

}
