<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;
use App\Hotel;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MealController extends Controller
{
    public function index()
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }

        if(Auth::user()->role > 1) {
            $meals = Meal::where('hotel_id', '=', Auth::user()->hotel_id)->orderBy('name', 'asc')->with('user')
        ->with('hotel')->paginate(5);
        } else {
            $meals = Meal::orderBy('name', 'asc')->with('user')
        ->with('hotel')->paginate(5);
        }

        return view('admin.meals.index', compact('meals'));
    }

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
        return view('admin.meals.create', ['hotels'=>$hotels]);
    }

    public function store(Request $request)
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        $request->validate([
            'name'=>'required',
            'hotel_id'=>'required',
            'price'=>'required',
        ]);

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }



        $meal = new Meal([
            'name' => $request->get('name'),
            'hotel_id' => $request->get('hotel_id'),
            'user_id' => Auth::user()->id,
            'desc' => $request->get('desc'),
            'price' => $request->get('price'),
            'image' => $url
        ]);
        $meal->save();
        return redirect('/dashboard/meals')->with('success', 'Prato registado!');
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
            $hotels = Hotel::where('id', '=', Auth::user()->hotel_id)->get();
        } else {
            $hotels = Hotel::orderBy('name', 'asc')->get();
        }

        $meal = Meal::find($id);
        if($meal) {
            if(Auth::user()->role == 1 || $meal->hotel_id == Auth::user()->hotel_id) {
            return view('admin.meals.edit', ['meal' => $meal, 'hotels'=>$hotels]);
            }
        }
        return redirect('/dashboard/meals');
        
    }

    public function update(Request $request, $id)
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        $request->validate([
            'name'=>'required',
            'hotel_id'=>'required',
            'price'=>'required',
        ]);

        $meal = Meal::find($id);
        $meal->name =  $request->get('name');
        $meal->desc =  $request->get('desc');
        $meal->price =  $request->get('price');
        $meal->hotel_id =  $request->get('hotel_id');

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
            $meal->image = $url;
        }

        $meal->save();
        return redirect('/dashboard/meals')->with('success', 'Actualizado!');
    }

    public function destroy($id)
    {
        $meal = Meal::find($id);
        if($meal) {
            if(Auth::user()->role == 1 || $meal->hotel_id == Auth::user()->hotel_id) {
            $image = $meal->image;
            removeImage($image);
            $meal->delete();
            return redirect('/dashboard/meals')->with('success', 'Excluido...!');
            }
        }
        return redirect('/dashboard/meals');
    }
}
