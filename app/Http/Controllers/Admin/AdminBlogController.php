<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::when(request('search'),function ($query,$search){
            $query->where('title','like', '%'.$search.'%');
        })
            ->paginate(10);
        $posts=PostResource::collection($posts);
        $search=request('search');
        return  inertia::render('admin.posts.index',compact('search','posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return  inertia::render('admin.posts.create');
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
           'title'=>'required|min:10|string|max:120',
           'credit'=>'required|min:10|string|max:120',
           'author'=>'required|min:10|string|max:120',
           'summary'=>'required|min:10|string|max:850',
           'tags'=>'required|string',
           'content'=>'required',
           'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=1200,height=675',
       ]);

        $post=Post::create([
            'title'=>$validated['title'],
            'status'=>1,
            'index_status'=>0,
            'summary'=>$validated['summary'],
            'content'=>$validated['content'],
            'credit'=>$validated['credit'],
            'author'=>$validated['author'],
            'tags'=>$validated['tags'],

        ]);

        if($files=$request->image){
            $post->addMedia($files)->toMediaCollection('blogImage');
        }

        return redirect()->route('posts.index');
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
        $post=new PostResource(Post::findBySlugOrFail($id));

        return inertia::render('admin.posts.show', compact('post'));
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
        $post=Post::findOrFail($id);
        $postImage=$post->getFirstMediaUrl('blogImage','blog-icon');
        return inertia::render('admin.posts.edit', compact('post', 'postImage'));
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
            'title'=>'required|min:10|string|max:120',
            'credit'=>'required|min:10|string|max:120',
            'author'=>'required|min:10|string|max:120',
            'summary'=>'required|min:10|string|max:850',
            'tags'=>'required|string',
            'content'=>'required',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:width=1200,height=675',
        ]);

        $post=Post::findOrFail($id);
        $post->update([
            'title'=>$validated['title'],
            'summary'=>$validated['summary'],
            'content'=>$validated['content'],
            'credit'=>$validated['credit'],
            'author'=>$validated['author'],
            'tags'=>$validated['tags'],

        ]);

        if($files=$request->image){
            $post->clearMediaCollection('blogImage');
            $post->addMedia($files)->toMediaCollection('blogImage');
        }

        return redirect()->route('posts.index')
            ->with('status','Post Updated Successfully');
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
        $post=Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('status','Post Deleted Successfully');
    }
}
