<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkillsEducation;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('access');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SkillsEducation::latest()->paginate(10);

        return view('skillsEducation.index', compact('data'));
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
                'value' => 'required|unique:skills_education,value',
                'category' => 'required',
            ]);

            $input = $request->all();


            $user = SkillsEducation::create($input);
            return redirect('skills-education')->with('message', 'Data added Successfully');
        }
        return view('skillsEducation.create', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        SkillsEducation::create($request->all());

        return redirect()->route('skillsEducation.index')
            ->with('success', 'Record created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $skillsEducation = SkillsEducation::find($id);

        if ($skillsEducation) {
            $skillsEducation->delete();
            return response()->json(['status' => 'success']);
        }
    }

    public function view(Request $reques, $id)
    {

        $url = '';
        $id =  $id;
        $data = SkillsEducation::find($id);
        return view('skillsEducation.edit', compact('id', 'url', 'data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $input = $request->all();
        $id = $request['id'];
        $data = SkillsEducation::find($id);
        $data->update([
            'value' => $input['value'],
            'category' => $input['category'],
            'show_on_front' => isset($input['show_on_front']) ? ($input['show_on_front']) : '0'
        ]);

        if ($id) {
            return  redirect()->route('skills-education')->with('message', 'Data update Successfully');
        }
    }


    public function skillShowOnFront(Request $request)
    {


        $result = SkillsEducation::where(['id' => $request['id']])->first();

        if ($result->show_on_front == '0') {
            $status = '1';
        } else {
            $status = '0';
        }
        $result->update([
            'show_on_front' => $status,

        ]);
        if ($result) {

            return response()->json(['status' => 'success', 'data' => $result]);
        }
    }
}
