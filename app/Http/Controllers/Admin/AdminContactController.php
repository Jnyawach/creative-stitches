<?php

namespace App\Http\Controllers\Admin;

use App\Events\ContactResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $messages=Contact::query()
            ->when(request('search'),function ($query,$search){
                $query->where('subject','like', '%'.$search.'%')
                ->orWhere('message','like', '%'.$search.'%')
                    ->orWhere('name','like', '%'.$search.'%');
            })
            ->when(request('status'),function ($query,$status){

                $query->where('status', $status);
            })
           ->latest()->paginate(10);
        $messages=ContactResource::collection($messages);
        $filters=request()->only(['search','status']);

        return inertia::render('admin.contact.index', compact('messages','filters'));
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
        $message=new ContactResource(Contact::findOrFail($id));
        if (!$message->status){
            $message->update(['status'=>1]);
        }
        return inertia::render('admin.contact.show', compact('message'));
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
            'response'=>'required'
        ]);

        $contact=Contact::findOrFail($id);

        $contact->update([
            'response'=>$validated['response'],
            'status'=>2,
            'user_id'=>Auth::id()
        ]);

        event(new ContactResponse($contact));
        return redirect()->back()
            ->with('status','Response submitted Successfully');
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

        $message=Contact::findOrFail($id);
        $message->delete();
        return redirect()->route('contact.index')
            ->with('status','Message deleted Successfully');
    }

    public function markRead($id){
        $message=Contact::findOrFail($id);
        $message->update(['status'=>1]);
        return redirect()->route('contact.index')
            ->with('status','Message marked as read');
    }

}
