<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Province;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\View;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::where('user_id', '=', Auth::user()->id)
        ->orderBy('name', 'asc')->with('user')->with('rooms')->paginate(5);
        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::orderBy('name', 'asc')->with('user')->get();
        return view('admin.hotels.create', ['provinces'=>$provinces]);
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
            'name'=>'required',
            'slug'=>'required',
            'address'=>'required',
            'email'=>'required',
            'phone1'=>'required',
            'facebook'=>'required',
            'province_id'=>'required',
            'city_id'=>'required',
        ]);

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }

        $hotel = new Hotel([
            'name' => $request->get('name'),
            'user_id' => Auth::user()->id,
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'phone1' => $request->get('phone1'),
            'phone2' => $request->get('phone2'),
            'facebook' => $request->get('facebook'),
            'instagram' => $request->get('instagram'),
            'website' => $request->get('website'),
            'city_id' => $request->get('city_id'),
            'province_id' => $request->get('province_id'),
            'about' => $request->get('about'),
            'map' => $request->get('map'),
            'slug' => $request->get('slug'),
            'image' => $url,
            'category' => 1
        ]);
        $hotel->save();
        return redirect('/dashboard/hotels')->with('success', 'Hotel registado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $hotel = Hotel::where('slug', '=', $id)->with('meals')->with('resourcs')->with('events')->with('galleries')->with('rooms')->first();
        if($hotel) {
            $ip = $request->ip();
            $platform = 1;
            $visualization = new View([
                'ip' => $ip,
                'hotel_id' => $hotel->id,
                'platform' => $platform
            ]);
            $visualization->save();
            return view('admin.hotels.show', ['hotel' => $hotel]);
        } else {
            echo "Hotel não encontrado";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinces = Province::where('user_id', '=', Auth::user()->id)->orderBy('name', 'asc')->with('user')->paginate(9);
        $hotel = Hotel::find($id);
        return view('admin.hotels.edit', ['hotel' => $hotel, 'provinces'=>$provinces]); 
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
            'name'=>'required',
            'slug'=>'required',
            'address'=>'required',
            'email'=>'required',
            'phone1'=>'required',
            'facebook'=>'required',
            'province_id'=>'required',
            'city_id'=>'required'
        ]);


        $hotel = Hotel::find($id);
        $hotel->name =  $request->get('name');
        $hotel->address = $request->get('address');
        $hotel->email = $request->get('email');
        $hotel->phone1 = $request->get('phone1');
        $hotel->phone2 = $request->get('phone2');
        $hotel->facebook = $request->get('facebook');
        $hotel->instagram = $request->get('instagram');
        $hotel->website = $request->get('website');
        $hotel->city_id = $request->get('city_id');
        $hotel->province_id = $request->get('province_id');
        $hotel->about = $request->get('about');
        $hotel->slug = $request->get('slug');
        $hotel->map = $request->get('map');
        $hotel->category = 1;

        if($request->file('image') != "") {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);

            if(file_exists($hotel->image)) {
                $image = $hotel->image;
                removeImage($image);
            }
          
            $hotel->image = $url;
        }

        $hotel->save();

        return redirect('/dashboard/hotels')->with('success', 'Hotel actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::find($id);
        if($hotel) {
            //Storage::delete($blog->image);
            $image = $hotel->image;
            removeImage($image);
            $hotel->delete();
            return redirect('/dashboard/hotels')->with('success', 'Hotel excluido!');
        }
        return redirect('/dashboard/hotels')->with('warning', 'Algo correu mal!');
    }

    // API to mobile application

    // get hotels
    public function gethotels($city_id)
    {
        if($city_id == 0)
            $hotels = Hotel::with('city')->with('events')->with('meals')->with('rooms')->with('galleries')->get();
        else
            $hotels = Hotel::where('city_id', '=', $city_id)->with('city')->with('events')->with('meals')->with('rooms')->with('galleries')->get();
        return response()->json($hotels);
    }

    public function gethotel(Request $request, $id)
    {
        $hotel = Hotel::with('rooms')->with('meals')->with('galleries')->with('events')->find($id);
        $ip = $request->ip();
            $platform = 2;
            $visualization = new View([
            'ip' => $ip,
            'hotel_id' => $hotel->id,
            'platform' => $platform
        ]);
        $visualization->save();
        return response()->json($hotel);
    }
}
