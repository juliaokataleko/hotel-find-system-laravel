<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Room;
use App\Hotel;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class EventController extends Controller
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
            $events = Event::where('hotel_id', '=', Auth::user()->hotel_id)->orderBy('name', 'asc')->with('user')
                ->with('hotel')->paginate(10);
        } else {
            $events = Event::orderBy('name', 'asc')->with('user')
            ->with('hotel')->paginate(10);
        }
        return view('admin.events.index', compact('events'));
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

        return view('admin.events.create', ['hotels'=>$hotels]);
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
            'status'=>'required',
        ]);

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }

        if(Auth::user()->role > 1) {
            $hotel = Hotel::where('id', '=', Auth::user()->hotel_id)->get();
        } else {
            $hotel = $request->get('hotel_id');
        }

        $event = new Event([
            'name' => $request->get('name'),
            'hotel_id' => $hotel,
            'user_id' => Auth::user()->id,
            'desc' => $request->get('desc'),
            'status' => $request->get('status'),
            'dateevent' => date_format(date_create($request->get('dateevent')), 'Y-m-d H:i:s'),
            'price' => $request->get('price'),
            'image' => $url
        ]);
        $event->save();
        return redirect('/dashboard/events')->with('success', 'Evento registado!');
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

        $event = Event::find($id);
        if($event) {
            if(Auth::user()->role == 1 || $event->hotel_id == Auth::user()->hotel_id) {
            return view('admin.events.edit', ['event' => $event, 'hotels'=>$hotels]);
            }
        }
        return redirect('/dashboard/events')->with('warning', 'Operação interrompida!');
        
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
            'status'=>'required',
            'dateevent'=>'required',
        ]);

        $event = Event::find($id);
        $event->name =  $request->get('name');
        $event->desc =  $request->get('desc');
        $event->status =  $request->get('status');
        $event->price =  $request->get('price');
        $event->dateevent =  $request->get('dateevent');
        $event->hotel_id =  $request->get('hotel_id');

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $event->image = $url;
        }

        $event->save();
        return redirect('/dashboard/events')->with('success', 'Evento actualizado!');
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
        $event = Event::find($id);
        if($event) {
            $image = $event->image;
            removeImage($image);
            $event->delete();
            return redirect('/dashboard/events')->with('success', 'Evento excluido!');
        }
        return redirect('/dashboard/events')->with('warning', 'Ocorreu algum erro!');
    }
}
