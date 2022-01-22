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


class ClickUpController extends Controller
{

    public function clickTimeSync(Request $request)
    {
        $id = $request['id'];
        // rang code
        // $rangdate = explode('-', $request['daterange']);
        // rang code

        $team =  Teams::where('id', $id)->first();
        if (isset($team->click_up_access_token) && isset($team->click_up_team_id)) {
            $start_date = Carbon::create($request['daterange'])->toDateTimeString();
            $end_date = Carbon::create($request['daterange'])->endOfDay()->toDateTimeString();


            // range code
            // $start_date = Carbon::create($rangdate[0])->startOfDay()->toDateTimeString();
            // $end_date = Carbon::create($rangdate[1])->endOfDay()->toDateTimeString();
            // range code

            // $start_date = Carbon::now()->startOfDay()->toDateTimeString();
            // $end_date = Carbon::now()->endOfDay()->toDateTimeString();

            // $end_date = Carbon::create($request['start_date'])->addHours(23)->addMinutes(59)->toDateTimeString();

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

                    if (count($data->data) > 0) {
                        $temp = 0;
                        foreach ($data as $key => $res) {
                            foreach ($res as $key => $value) {
                                $temp += $value->duration;
                            }
                        }

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
                        $input['time'] =  $hour . ':' . $minutes . ':' . $seconds;
                        ClickUp::where(['user_id' => $val->id, 'date' => $start_date])->delete();
                        $success =   ClickUp::create($input);
                    } else {
                        $input['user_id'] = $val->id;
                        $input['date'] =  $start_date;
                        $input['time'] =  "00:00:00";
                        ClickUp::where(['user_id' => $val->id, 'date' => $start_date])->delete();
                        $success =   ClickUp::create($input);
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


    public function view(Request $reques, $id)
    {
     
        $columns = [];
        $result = [];
        $users =  User::where(['team' => $id])->whereNotNull('click_up_user_id')->pluck('id');
        $click = ClickUp::with('user', 'daily_performance')->whereIn('user_id', $users)->get();

        if (count($click)) {
            $columns = [];

            foreach ($click as $key => $valu) {

                if (!in_array($valu->user['name'] . ' ' . $valu->user['last_name'], $columns, true)) {
                    $columns[] = $valu->user['name'] . ' ' . $valu->user['last_name'];
                }
            }

            array_unshift($columns, "Date");
            foreach ($click as $key => $value) {
                // dd($value->daily_performance);
                $result[$value->date][] = $value->time . ',' . $value->id;
            }

            return view('clickup.view', compact('id', 'columns', 'result'));
        }
        return view('clickup.view', compact('id', 'columns', 'result'));
    }


    public function getSyncDate(Request $request)
    {
        // dd($request->all());
        $id = $request['team_id'];
        $users =  User::where(['team' => $id])->whereNotNull('click_up_user_id')->pluck('id');

        $click = ClickUp::select('date')->whereIn('user_id', $users)->groupBy('date')->get();
        if ($click) {
            return response()->json(['status' => 'success', 'data' => $click]);
        }
    }
}
