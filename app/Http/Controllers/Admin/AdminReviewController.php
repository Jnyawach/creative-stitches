<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews=ReviewResource::collection(Review::with(['product','user'])
            ->when(request('rating'),function ($query,$rating){
                $query->orderBy('rating', $rating);
            })
            ->when(request('age'),function ($query,$age){
                $query->orderBy('created_at', $age);
            })
            ->paginate(10));
        $filters=request()->only(['age','rating']);
        return inertia::render('admin.ratings.index', compact('reviews','filters'));
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
        $review=new ReviewResource(Review::with(['product','user'])->findOrFail($id));
        $previous = Review::where('id', '<', $id)->max('id');
        $next = Review::where('id', '>', $id)->min('id');
        return inertia::render('admin.ratings.show',compact('review','next','previous'));
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
        $review=Review::findOrFail($id);
        $review->delete();
        return redirect()->route('ratings.index')
            ->with('status','Reviews successfully deleted');
    }
}
