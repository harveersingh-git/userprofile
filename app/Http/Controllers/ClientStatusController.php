<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientStatus;

class ClientStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('access');
    }
    public function index(Request $request)
    {
        $data = ClientStatus::orderBy('order_by')->paginate(10);

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
            if (isset($request->image)) {

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('clientStatus'), $imageName);

                $input['image'] =  $imageName;
            }
            if (isset($request->icon)) {
                $input['icon'] = $request->icon;
            }


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
        if (isset($request->image)) {

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('clientStatus'), $imageName);

            $input['image'] =  $imageName;
        }
        $data->update([
            'title' => $input['title'],
            'background_color' => $input['background_color'],
            'font_color' => $input['font_color'],
            'icon' => (isset($input['icon'])) ? $input['icon'] : $data['icon'],
            'image' => (isset($input['image'])) ? $input['image'] : $data['image']
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

    public function hireStatusShorting(Request $request)
    {
        if (count($request['order']) > 0) {
            foreach ($request['order'] as $order) {
                $position['order_by'] = $order['position'];
                ClientStatus::updateOrCreate(['id' => $order['id']], $position);
            }
        }
        return response()->json(['status' => 'success']);
    }
}
