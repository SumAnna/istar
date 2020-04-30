<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Number;
use App\Http\Requests\StoreContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
		return view('index', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContact $request)
    {
        $contact = new Contact;
        $contact->firstname = $request->firstname;
		$contact->lastname = $request->lastname;
        $contact->created_at = date("Y-m-d H:i:s");
        $contact->updated_at = date("Y-m-d H:i:s");
        $contact->save();
		$contact->numbers();
		$number = new Number;
		$number->phone = $request->phone[0];
		$number->contact_id = $contact->id;
		$number->save();
        return redirect('contacts/'.$contact->id);
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
		$contact->numbers();
        return view('show', [
            'contact' => $contact,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //$contact->numbers();
        return view('edit', [
            'contact' => $contact,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContact $request, Contact $contact)
    {
        $contact->firstname = $request->firstname;
		$contact->lastname = $request->lastname;
        $contact->created_at = date("Y-m-d H:i:s");
        $contact->updated_at = date("Y-m-d H:i:s");
        $contact->save();
		foreach($request->phone as $id => $phone){
			if($id){
				$number = Number::findOrFail($id);
			} else {
				$number = new Number;
				$number->contact_id = $contact->id;
			}
			$number->phone = $phone;
			$number->save();
		}
        return redirect('contacts/'.$contact->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
		$number = Number::findOrFail($id);
		$contact_id = $number->contact_id;
        $number->delete();
        return redirect('/contacts/'.$contact_id.'/edit');
    }
}
