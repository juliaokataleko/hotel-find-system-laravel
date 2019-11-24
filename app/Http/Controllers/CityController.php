<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\City;
use App\Province;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::where('user_id', '=', Auth::user()->id)
        ->orderBy('name', 'asc')->with('province')->with('user')
        ->with('hotels')->paginate(10);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::where('user_id', '=', Auth::user()->id)->orderBy('name', 'asc')->with('user')->get();
        return view('admin.cities.create', compact('provinces'));
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
            'province_id'=>'required',
        ]);

        $city = new City([
            'name' => $request->get('name'),
            'province_id' => $request->get('province_id'),
            'user_id' => Auth::user()->id
        ]);
        $city->save();
        return redirect('/dashboard/cities')->with('success', 'Cidade registada!');
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
        $provinces = Province::where('user_id', '=', Auth::user()->id)->orderBy('name', 'asc')->with('user')->get();
        $city = City::find($id);
        return view('admin.cities.edit', ['city' => $city, 'provinces'=>$provinces]); 
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
            'province_id'=>'required'
        ]);

        $city = City::find($id);
        $city->name =  $request->get('name');
        $city->province_id =  $request->get('province_id');
        $city->save();

        return redirect('/dashboard/cities')->with('success', 'Cidade actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();

        return redirect('/dashboard/cities')->with('success', 'Cidade excluída!');
    }

    public function getcities() {
        $cities = City::all();
        return response()->json($cities);
    }
}
