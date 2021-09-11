<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()== null){
            return redirect('login');
        }
        if (!Auth::user()->status) {
            return view('block');
        }
        $users = User::get();
        return view('home',['users' => $users]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexWelcome()
    {
        if (Auth::user()== null){
            return redirect('login');
        }
        $user =Auth::user();
        $user->updated_at = date('Y-m-d G:i:s');
        $user->save();
        if (!Auth::user()->status) {
            return view('block');
        }
        $social = [];
        $socials = User::select("provider")->distinct()->get()->toArray();
        $user = [];
        foreach ($socials as $key => $value) {
            $social[] = $value["provider"];
            $user[] = User::where('provider', '=', $value["provider"])->count();
        }
        return view('welcome')
            ->with('year',json_encode($social,JSON_NUMERIC_CHECK))
            ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
    }
}
