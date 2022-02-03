<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\SkillsEducation;
use App\Models\Clients;
use App\Models\ClientStatus;
use DB;
use Auth;

use App\Models\WorkType;


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
        $this->middleware('access');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['work_type_count'] = WorkType::with('work_type_user_count')->get();
        // dd($data['work_type_count']->toArray());
        $data['current_month'] = User::where('id', '!=', 1)->whereMonth(
            'created_at',
            '=',
            Carbon::now()->month
        )->count();

        $data['total_client'] = Clients::distinct('client_email')->count();
        $data['active_client'] = Clients::whereHas('client_type', function ($q) {
            $q->where('title', '=', 'active');
        })->count();

        $data['zeo_three'] = User::where('experience', '>=', 1)->where('experience', '<', 3)->count();

        $data['three_five'] = User::where('experience', '>=', 3)->where('experience', '<', 5)->count();
        $data['five_ten'] = User::where('experience', '>=', 5)->where('experience', '<', 10)->count();
        $data['ten_fifty'] = User::where('experience', '>=', 10)->where('experience', '<', 30)->count();
        $data['technology'] = SkillsEducation::withCount(['primary_skills_user', 'secondary_skills_user', 'learning_skills_user'])
            ->where(['category' => 'skill'])->where('show_on_front', '=', '1')->orderBy('primary_skills_user_count', 'DESC')->get();


        $data['client_status'] =  ClientStatus::withCount('client_status_count')->orderBy('order_by', 'asc')->get();

        return view('home', compact('data'));
    }
}
