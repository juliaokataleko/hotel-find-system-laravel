<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Finance;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finances = Finance::with('user')
        ->paginate(10);
        return view('admin.finances.index', compact('finances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.finances.create');
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
            'valueM'=>'required',
            'kind'=>'required'
        ]);

        $finance = new Finance([
            'valueM' => $request->get('valueM'),
            'kind' => $request->get('kind'),
            'desc' => $request->get('desc'),
            'user_id' => Auth::user()->id
        ]);
        $finance->save();
        return redirect('/dashboard/finances')->with('success', 'Movimento registado!');
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
        $finance = Finance::find($id);
        return view('admin.finances.edit', ['finance' => $finance]);
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
            'valueM'=>'required',
            'kind'=>'required'
        ]);

        $finance = Finance::find($id);
        $finance->valueM =  $request->get('valueM');
        $finance->desc =  $request->get('desc');
        $finance->kind =  $request->get('kind');

        $finance->save();
        return redirect('/dashboard/finances')->with('success', 'Movimento actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $finance = Finance::find($id);
        if($finance) {
            $finance->delete();
            return redirect('/dashboard/finances')->with('success', 'Movimento excluido!');
        }
        return redirect('/dashboard/finances')->with('warning', 'Algo correu mal!');
    }
}
