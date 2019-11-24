<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::with('user')
        ->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone'=>'required',
            'name'=>'required'
        ]);

        $contact = new Contact([
            'phone' => $request->get('phone'),
            'phone2' => $request->get('phone2'),
            'email' => $request->get('email'),
            'email2' => $request->get('email2'),
            'name' => $request->get('name'),
            'user_id' => Auth::user()->id
        ]);
        $contact->save();
        return redirect('/dashboard/contacts')->with('success', 'Contacto registado!');
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
        $contact = Contact::find($id);
        if($contact) {
            return view('admin.contacts.edit', ['contact' => $contact]);
        }

        return redirect('/dashboard/contacts')->with('warning', 'Algo correu mal!');
        
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
        $request->validate([
            'phone'=>'required',
            'name'=>'required'
        ]);

        $contact = Contact::find($id);
        if($contact) {
            $contact->phone =  $request->get('phone');
            $contact->phone2 =  $request->get('phone2');
            $contact->email =  $request->get('email');
            $contact->email2 =  $request->get('email2');
            $contact->name =  $request->get('name');

            $contact->save();
            return redirect('/dashboard/contacts')->with('success', 'Contacto actualizado!');
        }

        return redirect('/dashboard/contacts')->with('warning', 'Algo correu mal!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if($contact) {
            $contact->delete();
            return redirect('/dashboard/contacts')->with('success', 'Contacto excluido!');
        }
        return redirect('/dashboard/contacts')->with('warning', 'Algo correu mal!');
    }
}
