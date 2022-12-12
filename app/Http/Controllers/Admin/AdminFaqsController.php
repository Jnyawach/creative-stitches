<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqResource;
use App\Models\Category;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminFaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$faqs=Faq::with('category')->paginate(10);
        $faqs=FaqResource::collection(Faq::paginate(10));
        $categories=FaqCategory::select('name','slug','id')->get();

        return  inertia::render('admin.faqs.index', compact('faqs','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=FaqCategory::select('name','id')->get();

        return  inertia::render('admin.faqs.create', compact('categories'));
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
           'question'=>'required|max:455|string',
           'answer'=>'required|max:1000',
           'category'=>'required|integer'
        ]);

        $faq=Faq::create([
           'question'=>$validated['question'],
            'answer'=>$validated['answer'],
            'faq_category_id'=>$validated['category']
        ]);

        return redirect()->route('faqs.index');
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
        $categories=FaqCategory::select('name','id','slug')->get();
        $faq=Faq::findBySlugOrFail($id);
        return inertia::render('admin.faqs.show', compact('faq','categories'));
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

        $faq=Faq::findOrFail($id);

        $categories=FaqCategory::select('name','id')->get();
        return  inertia::render('admin.faqs.edit', compact('categories','faq'));
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

        $validated = $request->validate([
            'question' => 'required|max:455|string',
            'answer' => 'required|max:1000',
            'category' => 'required|integer'
        ]);
        $faq = Faq::findOrFail($id);
        $faq->update([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'faq_category_id' => $validated['category']
        ]);

        return redirect()->route('faqs.index');
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
        $faq=Faq::findOrFail($id);
        $faq->delete();
        return redirect()->back();
    }
}
