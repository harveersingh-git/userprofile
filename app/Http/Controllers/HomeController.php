<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\SkillsEducation;
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
        $data['current_month'] = User::where('id', '!=', 1)->whereMonth(
            'created_at',
            '=',
            Carbon::now()->month
        )->count();


        $data['zeo_three'] = User::where('experience', '>=', 1)->where('experience', '<=', 3)->count();

        $data['three_five'] = User::where('experience', '>=', 4)->where('experience', '<=', 5)->count();
        $data['five_ten'] = User::where('experience', '>=', 6)->where('experience', '<=', 10)->count();
        $data['ten_fifty'] = User::where('experience', '>=', 11)->where('experience', '<=', 30)->count();
        $data['technology'] = SkillsEducation::withCount(['primary_skills_user', 'secondary_skills_user', 'learning_skills_user'])
            ->where(['category' => 'skill'])->where('show_on_front','=','1')->orderBy('primary_skills_user_count', 'desc')->get();


        $data['client_status'] =  ClientStatus::withCount('client_status_count')->get();
        // dd(  $data['technology']->toArray());
        return view('home', compact('data'));
    }

    // public function userList(Request $request)
    // {

    //     $search_skills = $request['skills'];
    //     if (isset($request['skills']) && !empty($request['skills'])) {
    //         $skill =  SkillsEducation::whereIn('value', $request['skills']);

    //         $skills = $skill->pluck('id');
    //     }


    //     // $query = User::with('myTeam')->where('id', '!=', 1);


    //     $query = User::with('myTeam', 'client_status_value', 'work_status_value')->where('id', '!=', 1);
    //     if (isset($skills) && $skills->count() > 0) {
            
    //         $query->whereHas('skills', function ($q) use ($skills, $request) {

    //             if (isset($request['tech'])) {
    //                 $q->where('skill_value_id', $request['tech']);
    //             }
    //             if (isset($request['type']) && $request['type'] != null) {

    //                 $q->where('type', $request['type']);
    //             }
    //             $q->whereIn('skill_value_id', $skills->toArray());
    //         });
    //     }
    //     if (isset($request['client_status'])  && $request['client_status'] != null) {

    //         $query->where(['client_status' => $request['client_status']]);
    //     }
    //     if (isset($request['exprince'])  && $request['exprince'] != null) {
    //         if ($request['exprince'] == "0-3") {
    //             $query->where('experience', '>=', 1)->where('experience', '<=', 3);
    //         }
    //         if ($request['exprince'] == "3-5") {
    //             $query->where('experience', '>', 3)->where('experience', '<=', 5);
    //         }
    //         if ($request['exprince'] == "5-10") {
    //             $query->where('experience', '>', 5)->where('experience', '<=', 10);
    //         }
    //         if ($request['exprince'] == "10-plus") {

    //             $query->where('experience', '>', 11)->where('experience', '<=', 30);
    //         }
    //     }
    //     if (isset($request['client_status']) && $request['client_status'] != null) {
    //         $query->where('client_status', $request['client_status']);
    //     }
    //     if (isset($request['work_status']) && $request['work_status'] != null) {

    //         $query->where('work_type', $request['work_status']);
    //     }
    //     if (isset($request['search']) && $request['search'] != null) {
    //         $query->where('mobile', 'like', '%' . $request['search'] . '%');
    //     }

    //     if (isset($request['search']) && $request['search'] != null) {

    //         $query->orWhere('name', 'like', '%' . $request['search'] . '%');
    //     }
    //     if (isset($request['search']) && $request['search'] != null) {
    //         $query->orWhere('last_name', 'like', '%' . $request['search'] . '%');
    //     }
    //     if (isset($request['search']) && $request['search'] != null) {
    //         $query->orWhere('employee_id', 'like', '%' . $request['search'] . '%');
    //     }

    //     // } else {

    //     //     $query = User::with(['myTeam', 'skills', 'client_status_value', 'work_status_value'])->where('id', '!=', 1);

    //     //     if (isset($request['client_status'])  && $request['client_status'] != null) {

    //     //         $query->where(['client_status' => $request['client_status']]);
    //     //     }
    //     //     if (isset($request['exprince'])  && $request['exprince'] != null) {
    //     //         if ($request['exprince'] == "0-3") {
    //     //             $query->where('experience', '>=', 1)->where('experience', '<=', 3);
    //     //         }
    //     //         if ($request['exprince'] == "3-5") {
    //     //             $query->where('experience', '>=', 4)->where('experience', '<=', 5);
    //     //         }
    //     //         if ($request['exprince'] == "5-10") {
    //     //             $query->where('experience', '>=', 6)->where('experience', '<=', 10);
    //     //         }
    //     //         if ($request['exprince'] == "10-plus") {

    //     //             $query->where('experience', '>=', 11)->where('experience', '<=', 30);
    //     //         }
    //     //     }
    //     //     if (isset($request['client_status']) && $request['client_status'] != null) {
    //     //         $query->where('client_status', $request['client_status']);
    //     //     }
    //     //     if (isset($request['work_status']) && $request['work_status'] != null) {

    //     //         $query->where('work_type', $request['work_status']);
    //     //     }
    //     //     if (isset($request['search']) && $request['search'] != null) {
    //     //         $query->where('mobile', 'like', '%' . $request['search'] . '%');
    //     //     }

    //     //     if (isset($request['search']) && $request['search'] != null) {

    //     //         $query->orWhere('name', 'like', '%' . $request['search'] . '%');
    //     //     }
    //     //     if (isset($request['search']) && $request['search'] != null) {
    //     //         $query->orWhere('last_name', 'like', '%' . $request['search'] . '%');
    //     //     }
    //     //     if (isset($request['search']) && $request['search'] != null) {
    //     //         $query->orWhere('employee_id', 'like', '%' . $request['search'] . '%');
    //     //     }
    //     // }

    //     $data = $query->orderBy('id', 'DESC')->paginate(15);
    //     $client_status = ClientStatus::with('client_status_count')->get();

    //     $work_type = WorkType::get();
    //     // if($data->count()>0){

    //     //     foreach( $client_status  as $k=>$val){
    //     //         foreach($data as $key=>$value){

    //     //         if($val['id']==$value['client_status']){
    //     //             $temp=1;

    //     //         }else{
    //     //             $temp=0;
    //     //         }
    //     //         $client_status[$k]['count'] +=$temp;
    //     //         }


    //     //     }

    //     // }
    //     $technologyes = SkillsEducation::where(['category' => 'skill'])->get();

    //     // dd($data->toArray());
    //     return view('users.index', compact('data', 'client_status', 'work_type', 'technologyes', 'search_skills'));
    // }
}
