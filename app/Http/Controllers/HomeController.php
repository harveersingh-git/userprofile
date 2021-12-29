<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use DB;

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
        $data['current_month'] = User::whereMonth(
            'created_at', '=', Carbon::now()->month
        )->count();
        $data['exprince'] = User::select('experience', DB::raw('count(*) as total'))
        ->groupBy('experience')->get();

        // dd($data['exprince']->toArray());
        return view('home',compact('data'));
    }
}
