<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Number;
use App\Http\Requests\StoreContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

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
		$validated = $request->validated();
		$phone = $validated['phone'][0];
		$exists = Number::where('phone', $phone)->first();	
		if (!$exists) {		
			$contact = new Contact;
			$contact->firstname = $validated['firstname'];
			$contact->lastname = $validated['lastname'];
			$contact->created_at = date("Y-m-d H:i:s");
			$contact->updated_at = date("Y-m-d H:i:s");
			$contact->save();
			$number = new Number;
			$number->phone = $request->phone[0];
			$number->contact_id = $contact->id;
			$number->save();
		} else {
			//Номер уже существует в телефонной книге!
			return view('create', [
				'msg' => 'Номер уже существует в телефонной книге!'
			]);
		}
		
		return redirect('contacts/'.$contact->id)->withInput($request->all());
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
        $contact->numbers();
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
		$validated = $request->validated();
		$input = $request->input();
        $contact->firstname = $validated['firstname'];
		$contact->lastname = $validated['lastname'];
        $contact->created_at = date("Y-m-d H:i:s");
        $contact->updated_at = date("Y-m-d H:i:s");
        $contact->save();
		foreach($validated['phone'] as $id => $phone){
			$exists = Number::where('phone', $phone)->first();
			if ($phone) {
				if($id){
					if (!$exists || ($exists && ($exists->contact_id === $contact->id))) {
						$number = Number::findOrFail($id);
					}
				} else {
					if (!$exists) {
						$number = new Number;
						$number->contact_id = $contact->id;
					} else {
						//Номер уже существует в телефонной книге!
						$contact->numbers();
						return view('edit', [
							'contact' => $contact,
							'msg' => 'Номер уже существует в телефонной книге!'
						]);
						//return redirect('contacts/'.$contact->id.'/edit')->with('msg', 'Номер уже существует в телефонной книге!');
					}
				}
				if ($number) {
					$number->phone = $phone;
					if (count($contact->numbers) < 20 ) {
						$number->save();				
					}
					else{
						// Превышено допустимое количество контактов
						return view('edit', [
							'contact' => $contact,
							'msg' => 'Превышено допустимое количество контактов!'
						]);
					}
					$number = false;					
				}
			}
		}
		return redirect('contacts/'.$contact->id.'/edit')->withInput($request->all());
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
