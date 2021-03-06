<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Http;
use DateTime;
use DateTimeZone;
use App\Models\Teams;
use App\Models\User;
use Carbon\Carbon;
use App\Models\ClickUp;
use App\Models\DailyPerformance;
use App\Models\WorkingHour;


class ClickUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function clickTimeSync(Request $request)
    {
        $id = $request['id'];
        $team =  Teams::where('id', $id)->first();
        if (isset($team->click_up_access_token) && isset($team->click_up_team_id)) {
            $start_date = Carbon::create($request['daterange'])->toDateTimeString();
            $end_date = Carbon::create($request['daterange'])->endOfDay()->toDateTimeString();

            $unix_start_date = strtotime($start_date) * 1000;
            $unix_end_date = strtotime($end_date) * 1000;

            $click_up_team_id = $team->click_up_team_id;
            // $team = Teams::select('id')->where('click_up_team_id', $click_up_team_id)->first();
            $users =  User::select('id', 'click_up_user_id')->where(['team' => $team['id']])->whereNotNull('click_up_user_id')->get();

            if (count($users) > 0) {

                foreach ($users as $key => $val) {
                    $response = Http::withHeaders([
                        'Authorization' => $team->click_up_access_token,
                        'Content-Type' => 'application/json'
                    ])->get(env('CLICKUP_BASE_URL') . '/team/' . $click_up_team_id . '/time_entries?start_date=' . number_format($unix_start_date, 0, '.', '') . '&end_date=' . number_format($unix_end_date, 0, '.', '') . '&assignee=' . $val['click_up_user_id']);
                    $data = json_decode($response->body());

                    if (isset($data->data) && count($data->data) > 0) {

                        $temp = 0;
                        foreach ($data as $key => $res) {
                            foreach ($res as $key => $value) {
                                $temp += $value->duration;
                            }
                        }
                        $minutes = '';
                        $hour = '';

                        $input = $temp;
                        $uSec = $input % 1000;
                        $input = floor($input / 1000);
                        $seconds = $input % 60;

                        $input = floor($input / 60);
                        $minutes = $input % 60;

                        $input = floor($input / 60);

                        $hour = $input;

                        $input = [];
                        $input['user_id'] = $val->id;
                        $input['date'] =  $start_date;
                        $input['time'] =  $hour . ':' . $minutes;





                        if ((intval($hour) == 0 && intval($minutes) == 0)) {
                            $chek_time_new =  DailyPerformance::where('min', intval($hour))->where('max', intval($hour))->first();
                            $input['daily_performance_id'] =  $chek_time_new['id'];
                        } else {

                            $chek_time =  DailyPerformance::where('min', '<=', intval($hour))->where('max', '>', intval($hour))->first();

                            $input['daily_performance_id'] =  $chek_time['id'];
                        }


                        $input['status'] =  "1";

                        ClickUp::where(['user_id' => $val->id, 'date' => $start_date])->delete();
                        $success =   ClickUp::create($input);
                    } else {
                        if (isset($request['sync'])) {
                            $chek_time_new =  DailyPerformance::where('min', '0')->where('max', 0)->first();
                            $inputt['daily_performance_id'] =  $chek_time_new['id'];
                        }


                        $inputt['user_id'] = $val->id;
                        $inputt['date'] =  $start_date;
                        $inputt['time'] =  "00:00";
                        $inputt['status'] =  "1";
                        ClickUp::where(['user_id' => $val->id, 'date' => $start_date])->delete();
                        $success =   ClickUp::create($inputt);
                    }
                }
            }
            return redirect()->back()->with('message', 'Data Sync successfully');
            // return redirect('team')->with('message', 'Data Sync successfully');
        } else {
            return redirect('team')->with('message', 'Access token not found');
        }
    }


    public function clickTeamSync(Request $request, $id)
    {
        $team =  Teams::where('id', $id)->first();
        if (isset($team->click_up_access_token) && isset($team->click_up_team_id)) {

            $response = Http::withHeaders([
                'Authorization' => $team->click_up_access_token,
                'Content-Type' => 'application/json'
            ])->get(env('CLICKUP_BASE_URL') . '/team');
            $data = json_decode($response->body());

            if ($data) {

                foreach ($data->teams as $key => $result) {

                    foreach ($result->members as $key => $val) {
                        $user = User::where(['email' => $val->user->email])->first();

                        if ($user) {
                            $input['click_up_user_id'] =  $val->user->id;
                            User::updateOrCreate(['id' => $user['id']], $input);
                        }
                    }
                }
            }
            return redirect('team')->with('message', 'Team Sync successfully');
        } else {
            return redirect('team')->with('message', 'Acceess token not found');
        }
    }


    public function genrateReport($id)
    {
        $date = Carbon::now()->toDateString();

        $users =  User::where(['team' => $id])->whereNotNull('click_up_user_id')->pluck('id');
        $click = ClickUp::with('user')->whereIn('user_id', $users)->where('date', '=', $date)->get();


        if (count($click)) {
            foreach ($click as $key => $valu) {

                $columns[] = $valu->user['name'] . ' ' . $valu->user['last_name'];
            }

            $fileName = $date . 'dailyreport.csv';
            $tasks = $click;

            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            array_unshift($columns, "Date");
            // $columns = array('Name', 'Time', 'Date');
            $callback = function () use ($tasks, $columns, $date) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);
                foreach ($tasks as $newky => $data) {

                    $row[$data->user['name'] . ' ' . $data->user['last_name']]  = $data->time;
                }

                $row = array('Date' => $date) + $row;
                fputcsv($file, $row);




                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }


    public function view(Request $reques, $id = NULL)
    {

        $teams =  Teams::get();
        if ($reques['daterange_search']) {
            $id = $reques['id'];
            $curent_month_first_date = Carbon::parse('01-' . $reques['daterange_search'])->startOfMonth()->toDateString();

            $curent_month_end_date = Carbon::parse('01-' . $reques['daterange_search'])->endOfMonth()->toDateString();
        } else {
            $curent_month_first_date = Carbon::now()->startOfMonth()->toDateString();
            $curent_month_end_date = Carbon::now()->endOfMonth()->toDateString();
        }

        $columns = [];
        $result = [];
        $finalTime = [];
        $users =  User::where(['team' => $id])->whereNotNull('click_up_user_id')->pluck('id');
        if (count($users) > 0) {
            foreach ($users as $key => $value) {

                $check_record =  ClickUp::where('user_id', $value)->first();
                if (empty($check_record)) {
                    for ($i = 0; $i < Carbon::now()->daysInMonth; $i++) {

                        $input['user_id'] = $value;
                        $input['date'] = Carbon::now()->startOfMonth()->addDays($i)->toDateString();

                        if (Carbon::now()->startOfMonth()->addDays($i)->isWeekday() == "false") {
                            $input['status'] = '0';
                        } else {
                            $input['status'] = '2';
                        }
                        $input['time'] = '00:00';
                        ClickUp::create($input);
                    }
                }
            }
        }

        $click = ClickUp::with('user', 'daily_performance')->whereIn('user_id', $users)->whereBetween('date', [$curent_month_first_date, $curent_month_end_date])->orderBy('user_id')->orderBy('date')->get();






        foreach ($users as $user) {
            // dd($curent_month_first_date);
            $data_exists = ClickUp::where('date', $curent_month_first_date)->where('user_id', $user)->get();

            if (count($data_exists) > 0) {

                if (count($click)) {
                    $columns = [];
                    $totalTime = [];
                    $total = 0;
                    $minutes = 0;
                    $minutes2 = 0;

                    foreach ($click as $key => $valu) {
                        $hours = 0;
                        $minutes = 0;
                        if ($valu) {
                            list($hour, $minute) = explode(':', $valu->time);
                            $minutes += $hour * 60;
                            $minutes += $minute;
                            // $time = explode(':', $valu->time);
                            // $minutes += $time[0] * 60;
                            // $minutes += $time[1];
                            $hours = floor($minutes / 60);
                            $minutes -= $hours * 60;
                            $totalTime[$valu->user_id][] = $hours . ':' . $minutes;
                        }

                        if (!in_array($valu->user['name'] . ' ' . $valu->user['last_name'], $columns, true)) {
                            $columns[] = $valu->user['name'] . ' ' . $valu->user['last_name'];
                        }
                    }

                    foreach ($totalTime as $key => $getTime) {
                        $hours2 = 0;
                        $minutes2 = 0;
                        $minutes = 0;

                        foreach ($getTime as $key => $timeVal) {

                            // $time2 = explode(':', $timeVal);
                            // $minutes2 += $time2[0] * 60;
                            // $minutes2 += $time2[1];
                            list($hour, $minute) = explode(':', $timeVal);

                            $minutes += $hour * 60;
                            $minutes += $minute;
                        }

                        // $hours2 = floor($minutes2 / 60);

                        // $minutes2 -= $hours2 * 60;

                        // $finalTime[] = $hours2 . ':' . $minutes2;

                        $hours = floor($minutes / 60);
                        $minutes -= $hours * 60;
                        $finalTime[] = $hours . ':' . $minutes;
                    }
                    // dd($finalTime);

                    array_unshift($finalTime, "Total");
                    array_unshift($columns, "Date");

                    foreach ($click as $key => $value) {
                        $title = isset($value['daily_performance']->title) ? ($value['daily_performance']->title) : '';
                        $background_color = isset($value['daily_performance']->background_color) ? ($value['daily_performance']->background_color) : '';
                        $font_color = isset($value['daily_performance']->font_color) ? ($value['daily_performance']->font_color) : '';

                        if (isset($value->time)) {

                            $result[$value->date][] = $value->time . ',' . $value->id . ',' . $value->status . ',' .  $background_color . ',' .  $font_color . ',' .  $title;
                            // dd($value->time . ',' . $value->id . ',' . $value->status . ',' .  $background_color . ',' .  $font_color . ',' .  $title);
                            // $result[$value->date] = $value->time . ',' . $value->id . ',' . $value->status . ',' .  $background_color . ',' .  $font_color . ',' .  $title;
                        }
                    }
                    // dd($result);


                    return view('clickup.view', compact('id', 'columns', 'result', 'teams', 'finalTime'));
                }
            } else {

                if (!isset($reques['daterange_search'])) {

                    for ($i = 0; $i < Carbon::now()->daysInMonth; $i++) {

                        $input['user_id'] = $user;
                        $input['date'] = Carbon::now()->startOfMonth()->addDays($i)->toDateString();

                        if (Carbon::now()->startOfMonth()->addDays($i)->isWeekday() == "false") {
                            $input['status'] = '0';
                        } else {
                            $input['status'] = '2';
                        }
                        $input['time'] = '00:00';
                        $success =   ClickUp::create($input);
                    }
                }
            }
        }


        return view('clickup.view', compact('id', 'columns', 'result', 'teams', 'finalTime'));
    }


    public function getSyncDate(Request $request)
    {

        $id = $request['team_id'];
        $users =  User::where(['team' => $id])->whereNotNull('click_up_user_id')->pluck('id');

        $click = ClickUp::select('date')->whereIn('user_id', $users)->where('status', '1')->groupBy('date')->get();

        if ($click) {
            return response()->json(['status' => 'success', 'data' => $click]);
        }
    }

    public function workingHours(Request $reques, $year = NULL)
    {

        $url = '';
        $years = ['2022', '2023', '2024', '2025', '2026'];
        if (isset($year)) {
            $current_year = $year;
        } else {
            $current_year = date('Y');
        }

        $months = WorkingHour::where('year', '=', $current_year)->get();

        if (count($months)) {
            $months = $months;
        } else {
            $months = array(
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July ',
                'August',
                'September',
                'October',
                'November',
                'December',
            );
        }


        if ($reques->isMethod('post')) {
            $input = $reques->all();

            WorkingHour::where('year', $reques->year)->delete();
            $id = '';

            foreach ($reques->months as $key => $val) {

                $res['year'] =  $reques->year;
                $res['hours'] = isset($reques->hours[$key]) ? $reques->hours[$key] : '';
                $res['month'] = $reques->months[$key];

                $data = WorkingHour::updateOrCreate(['id' => $id], $res);
            }

            return redirect()->back()->with('success', 'Data added Successfully');
        }

        return view('clickup.workinghours', compact('years', 'url', 'current_year', 'months'));
    }
}
