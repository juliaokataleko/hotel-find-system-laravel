<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\User;
use App\City;
use App\Event;
use App\Meal;
use App\Gallery;
use App\Contact;
use App\Note;
use Auth;
use Carbon\Carbon;
use Hash;
use Mail;

class HomeController extends Controller
{
    public function __construct() {
        //$this->middleware(['auth' => 'verified']);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        // $to_name = 'TO_NAME';
        // $to_email = "juliofeli78@gmail.com";
        // $data = array('name'=>"Sam Jose", "body" => "Test mail");
            
        // Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
        //     $message->to($to_email, $to_name)
        //             ->subject('Artisans Web Testing Mail');
        //     $message->from('juliofeli78@gmail.com','Artisans Web');
        // });

        $cities = City::with('hotels')->get();
        $userCity = $request->session()->get('userCity');
        $city = City::find($userCity);
        if($city) {
            $hotels = Hotel::where('city_id', $userCity)->with('city')
            ->with('meals')->with('rooms')->paginate(10);
            $cityUser = $city->name;
            $hotelArray = array();
            //array_push($cart, 13);

            foreach($hotels as $hotel) {
                array_push($hotelArray, $hotel->id);
            }

            $meals = Meal::whereIn('hotel_id', $hotelArray)->with('hotel')->get();
            $galleries = Gallery::whereIn('hotel_id', $hotelArray)->with('hotel')->get();
            $events = Event::whereIn('hotel_id', $hotelArray)->with('hotel')->get();
           

        } else {
            $hotels = Hotel::with('meals')->with('rooms')->with('city')->paginate(10);;
            $cityUser = "Clica numa cidade";
            $meals = Meal::with('hotel')->get();
            $events = Event::with('hotel')->get();
            $galleries = Gallery::with('hotel')->get();
        }
    
        
        return view('home', ['cities'=>$cities, 'cityUser'=>$cityUser, 'hotels'=>$hotels, 
        'events'=>$events, 'meals'=>$meals, 'galleries'=>$galleries]);
    }

    public function profile()
    {
        $this->middleware('auth');
        $user = User::where('id', '=', Auth::user()->id)->with('hotels')
        ->with('provinces')->with('galleries')->with('rooms')->with('resourcs')->with('contacts')->with('notes')
        ->with('cities')->with('meals')->with('payments')->with('events')->first();
        return view('profile', compact('user'));
    }

    public function dashboard()
    {
        $this->middleware('auth');
        $user = User::where('id', '=', Auth::user()->id)->with('hotels')
        ->with('provinces')->with('galleries')->with('rooms')->with('resourcs')->with('contacts')->with('notes')
        ->with('cities')->with('meals')->with('payments')->with('events')->first();
        return view('profile', compact('user'));
    }

    public function users()
    {
        $users = User::paginate(10);
        if(Auth::user()->role == 1) {
            return view('admin.users.index', compact('users'));
        } else {
            echo "Não tens permissão para estar aqui.";
        }
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'=>'required|min:2|string|max:50',
            'username'=>'required|string|min:2|max:50'
        ]);

        if($user->username === $request->post('username')) {

        }else {
            $request->validate([
                'username'=>'unique:users'
            ]);
        }

        
        $user->name = $request->post('name');
        $user->username = $request->post('username');
        $user->save();
        return redirect()->to('/dashboard/profile')
            ->with('success','Perfil actualizado com sucesso!');
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'password'=>'required|min:5',
            'new_password'=>'required|min:5|max:300',
            'repeat_password'=>'required|min:5|max:300',
        ]);

        $user = Auth::user();
        

        if (Hash::check($request->post('password'), $user->password)) {
            if($request->post('new_password') === $request->post('repeat_password')) {
                $user->password = Hash::make($request->post('new_password'));
                $user->save();
                return redirect()->to('/dashboard/profile')->with('success', 'Palavra-passe alterada com sucesso!');
            }
            return redirect()->to('/dashboard/profile')->with('warning','A confirmação da nova palavra-passe falhou!');
        }

        return redirect()->to('/dashboard/profile')->with('warning','A palavra-passe actual não está correcta!');
        
        //echo 'Password changed successfully.';
    }

    public function citySet(Request $request, $id) {
        $city = City::find($id);
        if($city) {
            $request->session()->put('userCity', $id);
            //print_r($request->session()->get('userCity'));
            return redirect()->to('/')
            ->with('success','Local definido com sucesso!');
        }
        return redirect()->to('/')
            ->with('warning','Cidade não registada!');
    }

    public function clearPlace(Request $request) {
        $request->session()->forget('userCity');
        return redirect()->to('/');
    }

    public function help() {
        return view('inst.help');
    }

    public function tc() {
        return view('inst.t-e-c');
    }

}
