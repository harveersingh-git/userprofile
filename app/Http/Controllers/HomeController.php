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
            'created_at',
            '=',
            Carbon::now()->month
        )->count();


        $data['zeo_three'] = User::where('experience', '>=', 1)->where('experience', '<=', 3)->count();

        $data['three_five'] = User::where('experience', '>=', 4)->where('experience', '<=', 5)->count();
        $data['five_ten'] = User::where('experience', '>=', 6)->where('experience', '<=', 10)->count();
        $data['ten_fifty'] = User::where('experience', '>=', 11)->where('experience', '<=', 30)->count();
        $data['technology'] = SkillsEducation::withCount(['primary_skills_user','secondary_skills_user', 'learning_skills_user'])
            ->where(['category' => 'skill'])->orderBy('primary_skills_user_count', 'desc')->get();


        $data['client_status'] =  ClientStatus::withCount('client_status_count')->get();
        // dd(  $data['technology']->toArray());
        return view('home', compact('data'));
    }
}
