<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $authors=AuthorResource::collection(Author::paginate(10));

        return inertia::render('admin.authors.index', compact('authors'));
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
        $validated=$request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'profile_link'=>'required|string|max:255',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $author=Author::create([
            'first_name'=>$validated['first_name'],
            'last_name'=>$validated['last_name'],
            'profile_link'=>$validated['profile_link']
        ]);
        if($profile=$request->file('avatar')) {
            $author->addMedia($profile)->toMediaCollection('profile');

        }

        return redirect()->back()
            ->with('status','Author Created Successfully');
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
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'profile_link'=>'required|string|max:255',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $author=Author::findOrFail($id);
        $author->update([
            'first_name'=>$validated['first_name'],
            'last_name'=>$validated['last_name'],
            'profile_link'=>$validated['profile_link']
        ]);

        if($files=$request->file('avatar')) {
            if ( $author->getMedia('profile')->count()>0){
                $author->clearMediaCollection('profile');
                $author->addMedia($files)->toMediaCollection('profile');
            }else{
                $author->addMedia($files)->toMediaCollection('profile');
            }

        }

        return redirect()->back()
            ->with('status','Author Update Successfully');

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
        $author=Author::findOrFail($id);
        $author->delete();
        return redirect()->back()
            ->with('status', 'Author deleted Successfully');
    }
}
