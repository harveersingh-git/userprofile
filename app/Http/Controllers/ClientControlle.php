<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clients;
use App\Models\ClientStatus;
use App\Models\WorkType;
use App\Models\Teams;
use App\Models\User;
use App\Models\ClientType;
use App\Models\ClientResource;

use Maatwebsite\Excel\Facades\Excel;


class ClientControlle extends Controller
{
    public function __construct()
    {
        $this->middleware('access');
    }

    // public function csv()
    // {
    //     $fileName = 'tasks.csv';
    //     $tasks = Clients::all();
    //     // dd($tasks->toArray());
    //     $headers = array(
    //         "Content-type"        => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //         "Pragma"              => "no-cache",
    //         "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
    //         "Expires"             => "0"
    //     );
    //     $columns = array('Title', 'Assign', 'Description', 'Start Date', 'Due Date');
    //     $callback = function () use ($tasks, $columns) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, $columns);

    //         foreach ($tasks as $task) {
    //             $row['Title']  = $task->client_name;
    //             $row['Assign']    = $task->client_name;
    //             $row['Description']    = $task->client_name;
    //             $row['Start Date']  = $task->client_name;
    //             $row['Due Date']  = $task->client_name;

    //             fputcsv($file, array($row['Title'], $row['Assign'], $row['Description'], $row['Start Date'], $row['Due Date']));
    //         }

    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function index(Request $request)
    {
        $work_type = WorkType::get();
        $client_status = ClientStatus::get();
        $client_type = ClientType::get();
        $query = Clients::with(['users', 'client_type', 'client_resource']);

        if (isset($request['search']) && $request['search'] != null) {
            // $query->whereHas('users', function ($query) use ($request) {
            //     $query->orWhere('name','like', '%' . $request['search'] . '%');

            // });
            $query->whereHas('users', function ($query) use ($request) {
                $query->where('employee_id', 'like', '%' . $request['search'] . '%');
            });
        }
        if (isset($request['client_search']) && $request['client_search'] != null) {

            $query->orWhere('client_code', 'like', '%' . $request['client_search'] . '%');
        }
        if (isset($request['client_search']) && $request['client_search'] != null) {
            $query->orWhere('client_name', 'like', '%' . $request['client_search'] . '%');
        }
        if (isset($request['client_search']) && $request['client_search'] != null) {

            $query->orWhere('client_email', 'like', '%' . $request['client_search'] . '%');
        }
        if (isset($request['client_type']) && $request['client_type'] != null) {

            $query->where('client_type_id', $request['client_type']);
        }
        // if (isset($request['work_type']) && $request['work_type'] != null) {

        //     $query->where('work_type_id', $request['work_type']);
        // }
        // ,'emp_status', 'emp_status']
        $data = $query->orderBy('id', 'DESC')->paginate(15);
        // dd($data->toArray());
        if ($request['client_status'] == 'yes') {

            $fileName = 'clientsheet.csv';
            $tasks = $data;
            // dd($tasks->toArray());
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );
            $columns = array('EmpId', 'Resource Name', 'Client Status', 'Client Code', 'Client Name', 'Client Email', 'TL Code', 'TL Name', 'Resource', 'Hours', 'Sarting date', 'End date');
            $callback = function () use ($tasks, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($tasks as $task) {
                    $row['EmpId']  = isset($task->users['employee_id']) ? $task->users['employee_id'] : 'N/A';
                    $row['Resource Name']    = isset($task->users['name']) ? $task->users['name'] : 'N/A';
                    $row['Client Status']    = isset($task->client_status['title']) ? $task->client_status['title'] : 'N/A';
                    $row['Client Code']  = isset($task->client_code) ? $task->client_code : 'N/A';
                    $row['Client Name']  = isset($task->client_name) ? $task->client_name : 'N/A';
                    $row['Client Email']  = isset($task->client_email) ? $task->client_email : 'N/A';
                    $row['TL Code']  = isset($task->users->myTeam['tl_code']) ? $task->users->myTeam['tl_code'] : 'N/A';
                    $row['TL Name']  = isset($task->users->myTeam['name']) ? $task->users->myTeam['name'] : 'N/A';
                    $row['Resource']  = isset($task->work_type['title']) ? $task->work_type['title'] : 'N/A';
                    $row['Hours']  = isset($task->hours) ? $task->hours : 'N/A';
                    $row['Sarting date']  = isset($task->starting_date) ? $task->starting_date : 'N/A';
                    $row['End date']  = isset($task->end_date) ? $task->end_date : 'N/A';


                    fputcsv($file, array($row['EmpId'], $row['Resource Name'], $row['Client Status'], $row['Client Code'], $row['Client Name'], $row['Client Email'], $row['TL Code'], $row['TL Name'], $row['Resource'], $row['Hours'], $row['Sarting date'], $row['End date']));
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
        // dd($data->toArray());
        return view('client.index', compact('data', 'client_type', 'work_type', 'client_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $url = '';

        $data['client_status'] = ClientStatus::get();
        $data['client_type'] =  ClientType::get();
        $data['workstatus'] =  WorkType::get();
        // $data['team'] =  Teams::get();
        $data['users'] = User::where('id', '!=', 1)->get();

        if ($request->isMethod('post')) {
         
            if (!empty($request['end_date'])) {
           
                $request->validate([
              
                    'client_type' => 'required',
                    'client_code' => 'required',
                    'client_name' => 'required',
                    'client_email' => 'required',
                    'hours' => 'required',
                    'start_date' => 'required|before_or_equal:end_date',
                    'end_date' => 'date_format:Y-m-d',
                    'hours_cunsumed' => 'required',


                ]);
            } else {
                $request->validate([
                    'client_type' => 'required',
                    'client_code' => 'required',
                    'client_name' => 'required',
                    'client_email' => 'required',
                    'hours' => 'required',
                    'start_date' => 'required',
                    'hours_cunsumed' => 'required',


                ]);
            }

            $request->validate([
                // 'user_name' => 'required',
                'client_type' => 'required',
                'client_code' => 'required',
                'client_name' => 'required',
                'client_email' => 'required',
                // 'work_type' => 'required',
                // 'team_leader' => 'required',
                'hours' => 'required',
                'start_date' => 'required',
                // 'start_date' => 'required|before_or_equal:end_date',
                // 'end_date' => 'date_format:Y-m-d',
                'hours_cunsumed' => 'required',


            ]);

            // dd();

            $input = $request->all();
            // $input['user_id'] =  $input['user_name'];
            $input['client_type_id'] =  $input['client_type'];
            // $input['work_type_id'] =  $input['work_type'];
            // $input['client_status_id'] =  $input['client_status'];
            $input['hours_cunsumed'] =  $input['hours_cunsumed'];
            $input['starting_date'] =  $input['start_date'];
            $input['end_date'] =  isset($input['end_date']) ? $input['end_date'] : NULL;
            $client = Clients::create($input);
            // if ($client) {
            //     $updated['client_status'] = $input['client_status'];
            //     $updated['work_type'] = $input['work_type'];
            //     User::updateOrCreate(['id' => $input['user_name']], $updated);
            // }


            return redirect('clients')->with('message', 'Data added Successfully');
        }
        return view('client.create', compact('url', 'data'));
    }

    public function view(Request $reques, $id)
    {

        $data['client_status'] = ClientStatus::get();
        $data['workstatus'] =  WorkType::get();
        $data['client_type'] =  ClientType::get();
        // $data['team'] =  Teams::get();
        $data['users'] = User::where('id', '!=', 1)->get();
        $url = '';
        $id =  $id;
        $client = Clients::find($id);

        return view('client.edit', compact('id', 'url', 'data', 'client'));
    }


    public function update(Request $request)
    {

        $input = $request->all();
        $id = $request['id'];
        $data = Clients::find($id);
        $data->update([
            // 'user_id' => isset($input['user_name']) ? $input['user_name'] : '',
            // 'client_status_id' => isset($input['client_status']) ? $input['client_status'] : '',
            'client_code' => isset($input['client_code']) ? $input['client_code'] : '',
            'client_name' => isset($input['client_name']) ? $input['client_name'] : '',
            'client_email' => isset($input['client_email']) ? $input['client_email'] : '',
            // 'work_type_id' => isset($input['work_type']) ? $input['work_type'] : '',
            'client_type_id' => isset($input['client_type']) ? $input['client_type'] : '',
            // 'team_id' => isset($input['team_leader']) ? $input['team_leader'] : '',
            'hours' => isset($input['hours']) ? $input['hours'] : '',
            'starting_date' => isset($input['start_date']) ? $input['start_date'] : '',
            'end_date' => isset($input['end_date']) ? $input['end_date'] : NULL,
            'hours_cunsumed' => isset($input['hours_cunsumed']) ? $input['hours_cunsumed'] : '',


        ]);
        // if ($data) {
        //     $updated['client_status'] = $input['client_status'];
        //     $updated['work_type'] = $input['work_type'];
        //     User::updateOrCreate(['id' => $input['user_name']], $updated);
        // }

        if ($data) {
            return  redirect()->route('clients')->with('message', 'Data update Successfully');
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
        $skillsEducation = Clients::find($id);

        if ($skillsEducation) {
            $skillsEducation->delete();
            return response()->json(['status' => 'success']);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createResource(Request $request, $id)
    {

        $url = '';
        $data['client_status'] = ClientStatus::get();
        $data['workstatus'] =  WorkType::get();
        $data['users'] = User::where('id', '!=', 1)->get();
        $data['clients'] = Clients::get();
        if ($request->isMethod('post')) {
            // dd($request->all());
            $request->validate([
                'client_name' => 'required',
                'working_user_name' => 'required',
                'hire_user_name' => 'required',
            ]);
            $input = $request->all();
            $input['client_id'] =  $input['client_name'];
            $input['working_user_id'] =  $input['working_user_name'];
            $input['hire_user_id'] =  $input['hire_user_name'];
            $client = ClientResource::create($input);

            if ($client) {
                $updated['client_status'] = $input['resource_status'];
                $updated['work_type'] = $input['work_type'];
                User::updateOrCreate(['id' => $input['working_user_name']], $updated);
            }
            return redirect('clients')->with('message', 'Data added Successfully');
        }
        return view('client.addresource', compact('url', 'data', 'id'));
    }
}
