<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\SkillsEducation;
use App\Models\ClientStatus;
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
        $data['current_month'] = User::where('id', '!=', 1)->whereMonth(
            'created_at', '=', Carbon::now()->month
        )->count();
        $data['exprince'] = User::select('experience', DB::raw('count(*) as total'))->orderBy('experience','asc')
        ->groupBy('experience')->where('id', '!=', 1)->get();


        $data['technology'] = SkillsEducation::withCount(['primary_skills_user','secondary_skills_user','learning_skills_user'])->where(['category'=>'skill'])->get();
        $data['client_status'] =  ClientStatus::withCount('client_status_count')->get(); 
        // dd($data['client_status']->toArray());
        return view('home',compact('data'));
    }
}
