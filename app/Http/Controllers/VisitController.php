<?php

namespace App\Http\Controllers;
use App\View;
use Auth;

use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        if(is_null(Auth::user()->hotel_id) && Auth::user()->role > 1) {
            return redirect('/unfinished');
        }
        if(Auth::user()->role > 1) {
            $guestts = View::where('hotel_id', '=', Auth::user()->hotel_id)->orderBy('created_at', 'desc')
        ->paginate(10);
        $allVisits = View::all();
        $allVisits = View::where('hotel_id', '=', Auth::user()->hotel_id)->get();
        } else {
            $guestts = View::orderBy('created_at', 'desc')
        ->paginate(10);
        $allVisits = View::all();
        }
        
        return view('admin.visualizations.index', ['guestts' => $guestts, 'allVisits' => $allVisits]);
    }
}
