<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Hotel;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::with('user')
        ->with('hotel')->paginate(10);
        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::orderBy('name', 'asc')->get();
        return view('admin.contracts.create', ['hotels'=>$hotels]);
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
            'doc'=>'required',
            'hotel_id'=>'required'
        ]);

        if($request->file('doc') != "") {
            $path = Storage::putFile('public', $request->file('doc'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }

        $contract = new Contract([
            'dateassign' => $request->get('dateassign'),
            'hotel_id' => $request->get('hotel_id'),
            'user_id' => Auth::user()->id,
            'doc' => $url
        ]);
        $contract->save();
        return redirect('/dashboard/contracts')->with('success', 'Contracto registado!');
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
        $hotels = Hotel::orderBy('name', 'asc')->get();
        $contract = Contract::find($id);
        return view('admin.contracts.edit', ['contract' => $contract, 'hotels'=>$hotels]);
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
            'hotel_id'=>'required',
            'dateassign'=>'required'
        ]);

        $contract = Contract::find($id);
        $contract->dateassign =  $request->get('dateassign');
        $contract->hotel_id =  $request->get('hotel_id');

        if($request->file('doc') != "") {
            $path = Storage::putFile('public', $request->file('doc'));
            $url = Storage::url($path);
            $contract->doc = $url;
        }

        $contract->save();
        return redirect('/dashboard/contracts')->with('success', 'Contracto actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contract = Contract::find($id);
        if($contract) {
            //Storage::delete($blog->image);
            $image = $contract->doc;
            removeImage($image);
            $contract->delete();
            return redirect('/dashboard/contracts')->with('success', 'Contracto excluido!');
        }
        return redirect('/dashboard/contracts')->with('warning', 'Algo correu mal!');
    }
}
