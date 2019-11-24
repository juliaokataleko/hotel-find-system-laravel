<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use Auth;

class ProvinceController extends Controller
{

    public function index()
    {
        $provinces = Province::orderBy('name', 'asc')->with('user')
        ->with('cities')->paginate(10);
        return view('admin.provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('admin.provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $province = new Province([
            'name' => $request->get('name'),
            'slug' => slug($request->get('name')),
            'user_id' => Auth::user()->id
        ]);
        $province->save();
        return redirect('/dashboard/provinces')->with('success', 'Província registada!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $province = Province::find($id);
        return view('admin.provinces.edit', compact('province'));  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $province = Province::find($id);
        $province->name =  $request->get('name');
        $province->save();

        return redirect('/dashboard/provinces')->with('success', 'Província actualizada!');
    }

    public function destroy($id)
    {
        $province = Province::find($id);
        $province->delete();

        return redirect('/dashboard/provinces')->with('success', 'Província excluída!');
    }
}
