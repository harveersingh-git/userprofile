<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clients;
use App\Models\ClientStatus;
use App\Models\WorkType;
use App\Models\Teams;
use App\Models\User;

class ClientControlle extends Controller
{
    public function __construct()
    {
        $this->middleware('access');
    }

    public function index(Request $request)
    {
        $data = Clients::with(['users','emp_status','work_type','team'])->latest()->paginate(10);
        // dd($data->toArray());
        return view('client.index', compact('data'));
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
        $data['workstatus'] =  WorkType::get();
        $data['team'] =  Teams::get();
        $data['users'] = User::where('id', '!=', 1)->get();

        if ($request->isMethod('post')) {

            $request->validate([
                'user_name' => 'required',
                'emp_status' => 'required',
                'client_code' => 'required',
                'client_name' => 'required',
                'client_email' => 'required',
                'work_type' => 'required',
                'team_leader' => 'required',
                'hours' => 'required',
                'start_date' => 'required',

            ]);


           
            $input = $request->all();
            $input['user_id'] =  $input['user_name'];
            $input['client_status_id'] =  $input['emp_status']; 
            $input['work_type_id'] =  $input['work_type'];
            $input['team_id'] =  $input['team_leader'];
        
            $input['starting_date'] =  $input['start_date'];


            $user = Clients::create($input);
            return redirect('clients')->with('message', 'Data added Successfully');
        }
        return view('client.create', compact('url','data'));
    }

    public function view(Request $reques, $id)
    {
        
        $data['client_status'] = ClientStatus::get();
        $data['workstatus'] =  WorkType::get();
        $data['team'] =  Teams::get();
        $data['users'] = User::where('id', '!=', 1)->get();
        $url = '';
        $id =  $id;
        $client = Clients::find($id);
        // dd($client);
        return view('client.edit', compact('id', 'url', 'data','client'));
    }


    public function update(Request $request)
    {

        $input = $request->all();
        $id = $request['id'];
        $data = Clients::find($id);
        $data->update([
            'user_id' => isset($input['user_name']) ? $input['user_name'] : '',
            'client_status_id' => isset($input['emp_status']) ? $input['emp_status'] : '',
            'client_code' => isset($input['client_code']) ? $input['client_code'] : '',
            'client_name' => isset($input['client_name']) ? $input['client_name'] : '',
            'client_email' => isset($input['client_email']) ? $input['client_email'] : '',
            'work_type_id' => isset($input['work_type']) ? $input['work_type'] : '',
            'team_id' => isset($input['team_leader']) ? $input['team_leader'] : '',
            'hours' => isset($input['hours']) ? $input['hours'] : '',
            'starting_date' => isset($input['start_date']) ? $input['start_date'] : '',


        ]);

        if ($id) {
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
}
