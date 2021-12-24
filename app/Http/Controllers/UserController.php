<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Redirect;
use App\Models\SkillsEducation;
use App\Models\UserSkills;
use App\Models\UserEducation;
use App\Models\UserExperince;
use App\Models\Certification;
use App\Models\LearningSkills;
use App\Models\userAchievement;
use App\Models\UserProject;
use Validator;
use PDF;









class UserController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request['search'])) {
            $skills =  SkillsEducation::where('value', 'like', '%' . $request['search'] . '%')->pluck('id');
        }

       
        $query = User::where('id', '!=', 1);

        if (isset($skills) && $skills->count() > 0) {

            $query->whereHas('skills', function ($q) use ($skills) {
                $q->whereIn('skill_value_id',$skills->toArray());
            });
           
        } else {
            if (isset($request['search'])) {
                $query->where('mobile', 'like', '%' . $request['search'] . '%');
            }
            if (isset($request['search'])) {
                $query->orWhere('name', 'like', '%' . $request['search'] . '%');
            }
            if (isset($request['search'])) {
                $query->orWhere('last_name', 'like', '%' . $request['search'] . '%');
            }
            if (isset($request['search'])) {
                $query->orWhere('employee_id', 'like', '%' . $request['search'] . '%');
            }
        }

        $data = $query->orderBy('id','DESC')->paginate(10);
        
        return view('users.index', compact('data'));
    }


    public function addSkills(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();

            UserSkills::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['skill_value_id']); $i++) {

                $inpu['order'] =  $i+1;
                $inpu['user_id'] =  $input['user_id'];
                $inpu['skill_value_id'] =  $input['skill_value_id'][$i];
                $skills = UserSkills::create($inpu);
            }
            LearningSkills::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['learning_skills']); $i++) {
                $inpu['order'] =  $i+1;
                $inpu['user_id'] =  $input['user_id'];
                $inpu['learning_skill_value_id'] =  $input['learning_skills'][$i];
                $learningSkills = LearningSkills::create($inpu);
            }
            UserEducation::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['edu_type']); $i++) {
                if (isset($input['edu_type'][$i])) {
                 
                    $inp['order'] = $i+1;
                    $inp['user_id'] =  $input['user_id'];
                    $inp['degree_type_id'] =  $input['edu_type'][$i];
                    $inp['education_title_id'] =  $input['edu_title'][$i];
                    $inp['from'] =  $input['edu_from'][$i];
                    $inp['to'] =  $input['edu_to'][$i];
                    $skills = UserEducation::create($inp);
                }
            }




            return response()->json([
                'status' => 'success',
                'last_insert_id' => $skills
            ]);
        }
    }

    public function addExprince(Request $request)
    {
        if ($request->isMethod('post')) {

            $input = $request->all();

            UserExperince::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['company_name']); $i++) {
                if (isset($input['company_name'][$i])) {

                    $value['order'] = $i+1;
                    $value['user_id'] =  $input['user_id'];
                    $value['company_name'] =  $input['company_name'][$i];
                    $value['designation'] =  $input['designation'][$i];
                    $value['role_responsibilitie'] =  $input['role_res'][$i];
                    $value['from'] =  $input['exp_from'][$i];
                    $value['to'] =  $input['exp_to'][$i];
                    UserExperince::create($value);
                }
            }
            Certification::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['certification']); $i++) {
                if (isset($input['certification'][$i])) {
                    $inpu['order'] = $i+1;
                    $inpu['certification'] =  $input['certification'][$i];
                    $inpu['certifications_value_id'] =  $input['certification_type'][$i];
                    $inpu['user_id'] =  $input['user_id'];
                    $skills = Certification::create($inpu);
                }
            }





            return response()->json([
                'status' => 'success',
                
            ]);
        }
    }


    public function addProject(Request $request)
    {


        if ($request->isMethod('post')) {

            $input = $request->all();
            // dd($input);

            userAchievement::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['title']); $i++) {
                if (isset($input['title'][$i])) {
                    $inp['order'] = $i+1;
                    $inp['user_id'] =  $input['user_id'];
                    $inp['title'] =  $input['title'][$i];
                    $inp['description'] =  $input['description'][$i];
                    userAchievement::create($inp);
                }
            }
            UserProject::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['project_name']); $i++) {
                if (isset($input['project_name'][$i])) {

                    $inp['order'] = $i+1;
                    $inp['project_name'] =  $input['project_name'][$i];
                    $inp['project_skills'] =  $input['project_skills'][$i];
                    $inp['team_size'] =  $input['team_size'][$i];
                    $inp['url'] =  $input['url'][$i];
                    $inp['project_description'] =  $input['project_description'][$i];
                    $userProject = UserProject::create($inp);
                }
            }




            return response()->json([
                'status' => 'success',

            ]);
        }
    }

    public function add(Request $request)
    {

        $url = '';

        if ($request->isMethod('post')) {
            $input = $request->all();
            // dd( $input); 
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $input['id'] . ',id',
                'last_name' => 'required',
                'employee_id' => 'required|unique:users,employee_id,' . $input['id'] . ',id',
                'resume_title' => 'required',
                'mobile' =>  'required|unique:users,mobile,' . $input['id'] . ',id',
                'joining_date' => 'required',
                'shift_start' => 'required',
                'shift_end' => 'required',
                'team' => 'required',
                'about_employee' => 'required',
                'experience' => 'required'

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' =>
                    false, 'message' => $validator->errors()->first(),
                    'Data' => '',
                    'Status_code' => "401"
                ]);
            }
            // $validator = $request->validate([
            //     'first_name' => 'required',
            //     'email' => 'required|email|unique:users',
            //     'last_name' => 'required',
            //     'employee_id' => 'required',
            //     'resume_title' => 'required',
            //     'mobile' => 'required',
            //     'joining_date' => 'required',
            //     'shift_start' => 'required',
            //     'shift_end' => 'required',
            //     'team' => 'required',
            //     'about_employee' => 'required',
            //     'experience' => 'required'
            // ]);



            $input['password'] = bcrypt('welcome');
            $input['name'] =  $input['first_name'];
            $user = User::updateOrCreate(['id' => $input['id']], $input);


            return response()->json([
                'status' => true,
                'last_insert_id' => $user->id
            ]);
            // return redirect('users')->with('message', 'Data added Successfully');
        }
        return view('users.add', compact('url'));
    }

    public function view(Request $reques, $id)
    {

        $url = '';
        $id =  $id;
        $user = User::find($id);
        return view('users.edit', compact('id', 'url', 'user'));
    }

    // public function viewInformation(Request $reques, $id)
    // {

    //     $url = '';
    //     $id =  $id;
    //     $user = User::find($id);
    //     return view('users.edit', compact('id', 'url', 'user'));
    // }
    public function destroy(Request $request)
    {

        $id = $request['id'];
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['status' => 'success']);
        }
    }
    public function update(Request $request)
    {

        $input = $request->all();

        $id = $request['id'];
        $user = User::find($id);
        $user->update([
            'name' => $input['first_name'],
            'email' => $input['email'],
            'last_name' => $input['last_name'],
            'employee_id' => $input['employee_id'],
            'resume_title' => $input['resume_title'],
            'mobile' => $input['mobile'],
            'joining_date' => $input['joining_date'],
            'shift_start' => $input['shift_start'],
            'mobile' => $input['mobile'],
            'shift_end' => $input['shift_end'],
            'about_employee' => $input['about_employee'],
            'team' => $input['team'],
            'experience' => $input['experience'],

        ]);
        // dd($user->all());
        if ($user) {
            return  redirect()->route('users')->with('message', 'Data update Successfully');
            // redirect()->back()->with('message', 'Data update Successfully');
        }
    }

    public function information(Request $request, $id = null)
    {
        $allskills = SkillsEducation::where('category', '=', 'skill')->get();
        $education = SkillsEducation::where('category', '=', 'education')->get();
        $certificate = SkillsEducation::where('category', '=', 'certificate')->get();

        $data = [];
        if (isset($id)) {
          

            $data = User::with(['education', 'exprince', 'certification', 'learning_skills', 'achievement', 'project'])->with('skills', function ($q) {
                $q->orderBy('order', 'asc');
            })->where('id', '=', $id)->first();
            // dd($data->toArray());
            $selectedSkills =UserSkills::where('user_id','=', $id)->pluck('skill_value_id');
            $selectedLearningSkills =LearningSkills::where('user_id','=', $id)->pluck('learning_skill_value_id');
            $selectedEducationType = UserEducation::where('user_id','=', $id)->pluck('degree_type_id');

            $selectedSkills = $selectedSkills->toArray();
            $selectedLearningSkills = $selectedLearningSkills->toArray();
            $selectedEducationType = $selectedEducationType->toArray();
            // dd($education );

            return view('users.information',compact('allskills', 'data', 'education', 'certificate','selectedSkills','selectedLearningSkills','selectedEducationType'));
        }

        return view('users.information', compact('allskills', 'data', 'education', 'certificate'));
    }


    public function skillsSorting(Request $request)
    {
        $skills = UserSkills::where(['user_id' => $request['user_id']])->get();

        foreach ($skills as $skill) {
            foreach ($request['order'] as $order) {
                if ($order['id'] == $skill->id) {
                    $updated = UserSkills::where(['id' => $skill['id']])->first();
                    $updated->update(['order' => $order['position']]);
                }
            }
        }
        return response()->json([
            'status' => true,
            'last_insert_id' => $updated
        ]);
    }

    public function learningSkillsSorting(Request $request)
    {
        $skills = LearningSkills::where(['user_id' => $request['user_id']])->get();

        foreach ($skills as $skill) {
            foreach ($request['order'] as $order) {
                if ($order['id'] == $skill->id) {
                    $updated = LearningSkills::where(['id' => $skill['id']])->first();
                    $updated->update(['order' => $order['position']]);
                }
            }
        }
        return response()->json([
            'status' => true,
            'last_insert_id' => $updated
        ]);
    }


    public function educationType(Request $request){
        $education = SkillsEducation::where('category', '=', 'education')->get();
        $certificate = SkillsEducation::where('category', '=', 'certificate')->get();


        return response()->json([
            'status' => true,
            'data' => $education,
            'certificate'=>$certificate
        ]);
    }

    public function resume(Request $request, $id = null)
    {

        // $skills = SkillsEducation::get();

        // if ($skills) {

        //     view()->share('skills', $skills);

        //     $pdf_doc = PDF::loadView('pdf.export_pdf', $skills->toArray());

        //     return $pdf_doc->download('pdf.pdf');
        // }


        return view('pdf.export_pdf');
    }
}