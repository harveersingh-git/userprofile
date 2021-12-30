<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teams;

class TeamController extends Controller
{
    public function index(Request $request){
        $data = Teams::latest()->paginate(10);

        return view('team.index', compact('data'));
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $url = '';
        if ($request->isMethod('post')) {
           
            $request->validate([
                'name' => 'required'
            ]);

            $input = $request->all();


            $user = Teams::create($input);
            return redirect('team')->with('message', 'Data added Successfully');
        }
        return view('team.create', compact('url'));
    }

    public function view(Request $reques, $id)
    {

        $url = '';
        $id =  $id;
        $data = Teams::find($id);
        return view('team.edit', compact('id', 'url', 'data'));
    }


    public function update(Request $request)
    {

        $input = $request->all();
        $id = $request['id'];
        $data = Teams::find($id);
        $data->update([
            'name' => $input['name']
        ]);

        if ($id) {
            return  redirect()->route('team')->with('message', 'Data update Successfully');
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
        $skillsEducation = Teams::find($id);

        if ($skillsEducation) {
            $skillsEducation->delete();
            return response()->json(['status' => 'success']);
        }
    }
}