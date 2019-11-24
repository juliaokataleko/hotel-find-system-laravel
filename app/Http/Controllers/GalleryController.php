<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Hotel;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
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
            $photos = Gallery::where('hotel_id', '=', Auth::user()->hotel_id)->with('user')->with('hotel')->paginate(25);
        } else {
            $photos = Gallery::with('user')->with('hotel')->paginate(25);
        }
        return view('admin.photos.index', compact('photos'));
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
        return view('admin.photos.create', ['hotels'=>$hotels]);
    }

    public function store(Request $request)
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        $request->validate([
            'image'=>'required',
            'hotel_id'=>'required',
        ]);

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }

        $gallery = new Gallery([
            'desc' => $request->get('desc'),
            'user_id' => Auth::user()->id,
            'hotel_id' => $request->get('hotel_id'),
            'image' => $url
        ]);
        $gallery->save();
        return redirect('/dashboard/photos')->with('success', 'Foto registada!');
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }

        if(Auth::user()->role > 1) {
            $hotels = Hotel::where('id', '=', Auth::user()->hotel_id)->orderBy('name', 'asc')->get();
        } else {
            $hotels = Hotel::orderBy('name', 'asc')->get();
        }
        $photo = Gallery::find($id);
        if($photo) {
            if(Auth::user()->role == 1 || $photo->hotel_id == Auth::user()->hotel_id) {
            return view('admin.photos.edit', ['photo' => $photo, 'hotels'=>$hotels]);
            } 
        }
        
        
        if(Auth::user()->role > 1) {
            $photos = Gallery::where('hotel_id', '=', Auth::user()->hotel_id)->with('user')->with('hotel')->paginate(25);
        } else {
            $photos = Gallery::with('user')->with('hotel')->paginate(25);
        }
        return view('admin.photos.index', compact('photos'));
        
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
            'hotel_id'=>'required'
        ]);

        $photo = Gallery::find($id);
        if($photo) {
            if(Auth::user()->role == 1 || $photo->hotel_id == Auth::user()->hotel_id) {
                $photo->desc =  $request->get('desc');
                $photo->hotel_id =  $request->get('hotel_id');
                $photo->save();
                return redirect('/dashboard/photos')->with('success', 'Foto actualizada!');
            }
        }
        return redirect('/dashboard/photos');
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

        $photo = Gallery::find($id);
        if($photo) {
            if(Auth::user()->role == 1 || $photo->hotel_id == Auth::user()->hotel_id) {
                $image = $photo->image;
                removeImage($image);
                $photo->delete();
                return redirect('/photos')->with('success', 'Foto excluida!');
            }   
        }
        return redirect('/dashboard/photos');
    }

    public function makeCover($id) {
        $photo = Gallery::find($id);
        if($photo) {
            if(Auth::user()->role == 1 || $photo->hotel_id == Auth::user()->hotel_id) {
                //$affected = DB::table('galleries')->update(array('cover' => 0));
                $affected = DB::table('galleries')->where('hotel_id', '=', $photo->hotel_id)->update(array('cover' => 0));
                $photo->cover = 1;
                $photo->save();
                return redirect('/dashboard/photos')->with('success', 'Foto definida com capa!');
            }   
        }
    }
}
