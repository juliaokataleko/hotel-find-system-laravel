<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Hotel;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
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
            $hotels = Hotel::where('id', '=', Auth::user()->hotel_id)->get();
            $rooms = Room::where('hotel_id', '=', Auth::user()->hotel_id)->orderBy('name', 'asc')->with('user')->with('hotel')->paginate(10);
        } else {
            $rooms = Room::orderBy('name', 'asc')->with('user')->with('hotel')->paginate(10);
        }
        
        return view('admin.rooms.index', compact('rooms'));
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
        return view('admin.rooms.create', ['hotels'=>$hotels]);
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
            'hotel_id'=>'required',
            'open'=>'required',
        ]);

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }

        $room = new Room([
            'name' => $request->get('name'),
            'hotel_id' => $request->get('hotel_id'),
            'user_id' => Auth::user()->id,
            'desc' => $request->get('desc'),
            'open' => $request->get('open'),
            'price' => $request->get('price'),
            'image' => $url
        ]);
        $room->save();
        return redirect('/dashboard/rooms')->with('success', 'Quarto registado!');
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
        $room = Room::find($id);
        if($room) {
            if(Auth::user()->role == 1 || $room->hotel_id == Auth::user()->hotel_id) { 
                return view('admin.rooms.edit', ['room' => $room, 'hotels'=>$hotels]);
            }
        }
        return redirect('/dashboard/rooms')->with('warning', 'Operação interrompida!');
        
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
            'hotel_id'=>'required',
            'open'=>'required',
        ]);

        $room = Room::find($id);
        if($room) {
            if(Auth::user()->role == 1 || $room->hotel_id == Auth::user()->hotel_id) { 
                $room->name =  $request->get('name');
                $room->desc =  $request->get('desc');
                $room->open =  $request->get('open');
                $room->price =  $request->get('price');
                $room->hotel_id =  $request->get('hotel_id');

                if($request->file('image') != "") {
                    $path = Storage::putFile('public', $request->file('image'));
                    $url = Storage::url($path);
                    $room->image = $url;
                }

                $room->save();
                return redirect('/dashboard/rooms')->with('success', 'Quarto actualizado!');
            }
        }
        return redirect('/dashboard/rooms')->with('warning', 'Operação interrompida!');
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
        $room = Room::find($id);
        if($room) {
            if(Auth::user()->role == 1 || 
            $room->hotel_id == Auth::user()->hotel_id) { 
                $image = $room->image;
                removeImage($image);
                $room->delete();
                return redirect('/dashboard/rooms')->with('success', 'Quarto excluído!');
            }
        }

        return redirect('/dashboard/rooms')->with('warning', 'Operação interrompida!');
    }
}
