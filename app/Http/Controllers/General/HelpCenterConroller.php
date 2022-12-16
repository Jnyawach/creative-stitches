<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HelpCenterConroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=FaqCategory::select('name','id','slug')->get();
        $faqs=FaqResource::collection(Faq::when(request('search'),function ($query,$search){
            $query->where('question','like', '%'.$search.'%');
        })->
        paginate(20));
        $search=request('search');
        return inertia::render('help-center.index', compact('categories','faqs','search'));
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
        $faq_category=FaqCategory::findBySlugOrFail($id);

        $categories=FaqCategory::select('name','id','slug')->get();
        $faqs=FaqResource::collection(Faq::where('faq_category_id', $faq_category->id)->when(request('search'),function ($query,$search){
            $query->where('question','like', '%'.$search.'%');
        })->
        paginate(20));
        $search=request('search');

        return inertia::render('help-center.show', compact('faqs', 'faq_category','categories','search'));
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
    }
}
