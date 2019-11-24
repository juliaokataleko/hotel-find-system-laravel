<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('user')
        ->paginate(20);
        return view('admin.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notes.create');
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
            'note'=>'required'
        ]);

        $note = new Note([
            'note' => $request->get('note'),
            'user_id' => Auth::user()->id
        ]);
        $note->save();
        return redirect('/dashboard/notes')->with('success', 'Nota registada!');
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
        $note = Note::find($id);
        if($note) {
            return view('admin.notes.edit', ['note' => $note]);
        }
        return redirect('/dashboard/notes')->with('warning', 'Algo correu mal!');
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
            'note'=>'required'
        ]);

        $note = Note::find($id);
        if($note) {
            $note->note =  $request->get('note');

            $note->save();
            return redirect('/dashboard/notes')->with('success', 'Nota actualizada!');
        }

        return redirect('/dashboard/notes')->with('warning', 'Algo correu mal!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        if($note) {
            $note->delete();
            return redirect('/dashboard/notes')->with('success', 'Nota excluida!');
        }
        return redirect('/dashboard/notes')->with('warning', 'Algo correu mal!');
    }
}
