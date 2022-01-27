<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyPerformance;
use App\Models\ClickUp;
use App\Models\UserSkills;


class DailyPerformanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('access');
    }
    public function index(Request $request)
    {
        $data = DailyPerformance::latest()->paginate(10);

        return view(' dailyperformance.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $url = '';
        if ($request->isMethod('post')) {

            $request->validate([
                'title' => 'required',
                'background_color' => 'required',
                'font_color' => 'required'
            ]);

            $input = $request->all();
            $user = DailyPerformance::create($input);
            return redirect('daily-performance')->with('message', 'Data added Successfully');
        }
        return view(' dailyperformance.create', compact('url'));
    }

    public function view(Request $reques, $id)
    {

        $url = '';
        $id =  $id;
        $data = DailyPerformance::find($id);
        return view(' dailyperformance.edit', compact('id', 'url', 'data'));
    }


    public function update(Request $request)
    {

        $input = $request->all();
        $id = $request['id'];
        $data = DailyPerformance::find($id);
        $data->update([
            'title' => $input['title'],
            'background_color' => $input['background_color'],
            'font_color' => $input['font_color'],
            'min' => isset($input['min']) ? ($input['min']) : '0',
            'max' => isset($input['max']) ? ($input['max']) : '0',
            'need_a_reason' => isset($input['need_a_reason']) ? ($input['need_a_reason']) : '0'

        ]);

        if ($id) {

            return  redirect()->route('daily-performance')->with('message', 'Data update Successfully');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request['id'];
        $skillsEducation = DailyPerformance::find($id);

        if ($skillsEducation) {
            $skillsEducation->delete();
            return response()->json(['status' => 'success']);
        }
    }
    public function getDailyPerformance(Request $request)
    {

        $result = DailyPerformance::get();
       $getperformance = ClickUp::select('daily_performance_id')->where('id',$request['id'])->first();

        if ($result) {

            return response()->json(['status' => 'success', 'data' => $result,'daily'=>$getperformance]);
        }
    }
    public function checkDailyPerformance(Request $request)
    {

        $result = DailyPerformance::where(['id' => $request['id']])->first();


        if ($result) {

            return response()->json(['status' => 'success', 'data' => $result]);
        }
    }


    public function updateReport(Request $request)
    {

        $input = $request->all();

        $id = $input['click_up_report_id'];

        $data = ClickUp::where('id', '=', $id)->first();

        $data->update([
            'daily_performance_id' => $input['daily_status_id'],
            'time' => $input['time'],
            'reason' => isset($input['reason']) ? $input['reason'] : '',

        ]);

        return response()->json([
            'status' => 'success'

        ]);
    }

    public function showOnFront(Request $request)
    {


        $result = UserSkills::where(['skill_value_id' => $request['skill_id'], 'user_id' => $request['user_id']])->first();

        $result->update([
            'show_on_front' => '1',

        ]);
        if ($result) {

            return response()->json(['status' => 'success', 'data' => $result]);
        }
    }
    public function skillShowOnFront(Request $request)
    {


        $result = UserSkills::where(['skill_value_id' => $request['skill_id'], 'user_id' => $request['user_id']])->first();

        $result->update([
            'show_on_front' => '1',

        ]);
        if ($result) {

            return response()->json(['status' => 'success', 'data' => $result]);
        }
    }
    
}
