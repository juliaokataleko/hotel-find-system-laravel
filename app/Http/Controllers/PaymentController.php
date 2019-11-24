<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Hotel;
use App\Finance;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('user')
        ->with('hotel')->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hotels = Hotel::orderBy('name', 'asc')->get();
        return view('admin.payments.create', ['hotels'=>$hotels]);
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
            'hotel_id'=>'required',
            'datestart'=>'required',
            'datefinish'=>'required'
        ]);

        if($request->file('doc') != "") {
            $path = Storage::putFile('public', $request->file('doc'));
            $url = Storage::url($path);
        }else {
            $url = '';
        }

        $payment = new Payment([
            'datestart' => $request->get('datestart'),
            'datefinish' => $request->get('datefinish'),
            'hotel_id' => $request->get('hotel_id'),
            'user_id' => Auth::user()->id,
            'doc' => $url
        ]);

        $payment->save();
        $finance = new Finance([
            'valueM' => 5700,
            'kind' => 2,
            'desc' => 'Pagamento mensais dos hotéis',
            'user_id' => Auth::user()->id
        ]);
        $finance->save();

        return redirect('/dashboard/payments')->with('success', 'Pagamento registado!');
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
        $payment = Payment::find($id);
        return view('admin.payments.edit', ['payment' => $payment, 'hotels'=>$hotels]);
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
            'datestart'=>'required',
            'datefinish'=>'required'
        ]);

        $payment = Payment::find($id);
        $payment->datestart =  $request->get('datestart');
        $payment->datefinish =  $request->get('datefinish');
        $payment->hotel_id =  $request->get('hotel_id');

        if($request->file('doc') != "") {
            $path = Storage::putFile('public', $request->file('doc'));
            $url = Storage::url($path);
            $payment->doc = $url;
        }

        $payment->save();
        return redirect('/dashboard/payments')->with('success', 'Pagamento actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if($payment) {
            //Storage::delete($blog->image);
            $image = $payment->doc;
            removeImage($image);
            $payment->delete();
            return redirect('/dashboard/payments')->with('success', 'Pagamento excluido!');
        }
        return redirect('/dashboard/payments')->with('warning', 'Algo correu mal!');
    }
}
