<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resourc;
use App\Hotel;
use Auth;

class ResourcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        if(Auth::user()->role > 1) {
            $resourcs = Resourc::where('hotel_id', '=', Auth::user()->hotel_id)->orderBy('name', 'asc')->with('user')
        ->with('hotel')->paginate(10);
        } else {
            $resourcs = Resourc::orderBy('name', 'asc')->with('user')
        ->with('hotel')->paginate(10);
        }
        
        return view('admin.resourcs.index', compact('resourcs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        if(Auth::user()->role > 1) {
            $hotels = Hotel::where('id', '=', Auth::user()->hotel_id)->get();
        } else {
            $hotels = Hotel::orderBy('name', 'asc')->get();
        }
        return view('admin.resourcs.create', ['hotels'=>$hotels]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        $request->validate([
            'name'=>'required',
            'hotel_id'=>'required'
        ]);

        if(Auth::user()->role > 1) {
            $hotel = Auth::user()->hotel_id;
        } else {
            $hotel = $request->get('hotel_id');
        }

        $resourc = new Resourc([
            'name' => $request->get('name'),
            'hotel_id' => $hotel,
            'user_id' => Auth::user()->id
        ]);
        $resourc->save();
        return redirect('/dashboard/resourcs')->with('success', 'Recurso registado!');
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
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }

        if(Auth::user()->role > 1) {
            $hotels = Hotel::where('id', '=', Auth::user()->hotel_id)->get();
        } else {
            $hotels = Hotel::orderBy('name', 'asc')->get();
        }

        $resourc = Resourc::find($id);
        if($resourc) {
            if(Auth::user()->role == 1 || $resourc->hotel_id == Auth::user()->hotel_id) {
            return view('admin.resourcs.edit', ['resourc' => $resourc, 
            'hotels'=>$hotels]);
            }
        }

        return redirect('/dashboard/resourcs')->with('success', 'Recurso actualizado!');
        
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
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        $request->validate([
            'name'=>'required',
            'hotel_id'=>'required'
        ]);

        $resourc = Resourc::find($id);
        if($resourc) {
            if(Auth::user()->role == 1 || $resourc->hotel_id == Auth::user()->hotel_id) {
                $resourc->name =  $request->get('name');
                $resourc->hotel_id =  $request->get('hotel_id');
                $resourc->save();
                return redirect('/dashboard/resourcs')->with('success', 'Recurso actualizado!');
            }
            return redirect('/dashboard/resourcs')->with('warning', 'Algo correu mal!');
        }
        return redirect('/dashboard/resourcs')->with('warning', 'Algo correu mal!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        $resourc = Resourc::find($id);
        if($resourc) {
            if(Auth::user()->role == 1 || 
            $resourc->hotel_id == Auth::user()->hotel_id) { 
                $resourc->delete();
                return redirect('/dashboard/resourcs')->with('success', 'Recurso excluído excluído!');
            }   
        }
    } 
}
