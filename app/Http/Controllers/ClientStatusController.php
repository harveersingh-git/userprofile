<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientStatus;

class ClientStatusController extends Controller
{
    public function index(Request $request){
        $data = ClientStatus::latest()->paginate(10);

        return view('clientstatus.index', compact('data'));
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
                'title' => 'required',
                'background_color' => 'required',
                'font_color' => 'required'
            ]);

            $input = $request->all();


            $user = ClientStatus::create($input);
            return redirect('client-status')->with('message', 'Data added Successfully');
        }
        return view('clientstatus.create', compact('url'));
    }

    public function view(Request $reques, $id)
    {

        $url = '';
        $id =  $id;
        $data = ClientStatus::find($id);
        return view('clientstatus.edit', compact('id', 'url', 'data'));
    }


    public function update(Request $request)
    {

        $input = $request->all();
        $id = $request['id'];
        $data = ClientStatus::find($id);
        $data->update([
            'title' => $input['title'],
            'background_color' => $input['background_color'],
            'font_color' => $input['font_color']
        ]);

        if ($id) {
            return  redirect()->route('client-status')->with('message', 'Data update Successfully');
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
        $skillsEducation = ClientStatus::find($id);

        if ($skillsEducation) {
            $skillsEducation->delete();
            return response()->json(['status' => 'success']);
        }
    }
}