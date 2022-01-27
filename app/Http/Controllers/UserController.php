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
use App\Models\UserPortfolio;
use App\Models\ClientStatus;
use App\Models\WorkType;
use App\Models\Miscellaneous;
use App\Models\Role;
use Auth;
use App\Models\UserProject;
use App\Models\Teams;
use Validator;
use PDF;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Hash;
use Session;
use App\Models\ClientType;









class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function userList(Request $request)
    {

        $search_skills = $request['skills'];
        if (isset($request['skills']) && !empty($request['skills'])) {
            $skill =  SkillsEducation::whereIn('value', $request['skills']);

            $skills = $skill->pluck('id');
        }


        // $query = User::with('myTeam')->where('id', '!=', 1);


        $query = User::with('skills','myTeam', 'client_status_value', 'work_status_value')->where('id', '!=', 1);

        if (Session::get('role') != "ADMIN") {

            $query->where(['id' => Auth::user()->id]);
        }

        if (isset($skills) && $skills->count() > 0) {

            $query->whereHas('skills', function ($q) use ($skills, $request) {

                if (isset($request['tech'])) {
                    $q->where('skill_value_id', $request['tech']);
                }
                if (isset($request['type']) && $request['type'] != null) {

                    $q->where('type', $request['type']);
                }
                $q->whereIn('skill_value_id', $skills->toArray());
            });
        }
        if (isset($request['client_status'])  && $request['client_status'] != null) {

            $query->where(['client_status' => $request['client_status']]);
        }
        if (isset($request['exprince'])  && $request['exprince'] != null) {
            if ($request['exprince'] == "0-3") {
                $query->where('experience', '>=', 1)->where('experience', '<=', 3);
            }
            if ($request['exprince'] == "3-5") {
                $query->where('experience', '>', 3)->where('experience', '<=', 5);
            }
            if ($request['exprince'] == "5-10") {
                $query->where('experience', '>', 5)->where('experience', '<=', 10);
            }
            if ($request['exprince'] == "10-plus") {

                $query->where('experience', '>', 11)->where('experience', '<=', 30);
            }
        }
        if (isset($request['client_status']) && $request['client_status'] != null) {
            $query->where('client_status', $request['client_status']);
        }
        if (isset($request['work_status']) && $request['work_status'] != null) {

            $query->where('work_type', $request['work_status']);
        }
        if (isset($request['search']) && $request['search'] != null) {
            $query->where('mobile', 'like', '%' . $request['search'] . '%');
        }

        if (isset($request['search']) && $request['search'] != null) {

            $query->orWhere('name', 'like', '%' . $request['search'] . '%');
        }
        if (isset($request['search']) && $request['search'] != null) {
            $query->orWhere('last_name', 'like', '%' . $request['search'] . '%');
        }
        if (isset($request['search']) && $request['search'] != null) {
            $query->orWhere('employee_id', 'like', '%' . $request['search'] . '%');
        }

        // } else {

        //     $query = User::with(['myTeam', 'skills', 'client_status_value', 'work_status_value'])->where('id', '!=', 1);

        //     if (isset($request['client_status'])  && $request['client_status'] != null) {

        //         $query->where(['client_status' => $request['client_status']]);
        //     }
        //     if (isset($request['exprince'])  && $request['exprince'] != null) {
        //         if ($request['exprince'] == "0-3") {
        //             $query->where('experience', '>=', 1)->where('experience', '<=', 3);
        //         }
        //         if ($request['exprince'] == "3-5") {
        //             $query->where('experience', '>=', 4)->where('experience', '<=', 5);
        //         }
        //         if ($request['exprince'] == "5-10") {
        //             $query->where('experience', '>=', 6)->where('experience', '<=', 10);
        //         }
        //         if ($request['exprince'] == "10-plus") {

        //             $query->where('experience', '>=', 11)->where('experience', '<=', 30);
        //         }
        //     }
        //     if (isset($request['client_status']) && $request['client_status'] != null) {
        //         $query->where('client_status', $request['client_status']);
        //     }
        //     if (isset($request['work_status']) && $request['work_status'] != null) {

        //         $query->where('work_type', $request['work_status']);
        //     }
        //     if (isset($request['search']) && $request['search'] != null) {
        //         $query->where('mobile', 'like', '%' . $request['search'] . '%');
        //     }

        //     if (isset($request['search']) && $request['search'] != null) {

        //         $query->orWhere('name', 'like', '%' . $request['search'] . '%');
        //     }
        //     if (isset($request['search']) && $request['search'] != null) {
        //         $query->orWhere('last_name', 'like', '%' . $request['search'] . '%');
        //     }
        //     if (isset($request['search']) && $request['search'] != null) {
        //         $query->orWhere('employee_id', 'like', '%' . $request['search'] . '%');
        //     }
        // }

        $data = $query->orderBy('id', 'DESC')->paginate(20);
        // dd(  $data->toArray());

        $client_status = ClientStatus::with('client_status_count')->orderBy('order_by','asc')->get();

        $work_type = WorkType::get();

        $technologyes = SkillsEducation::where(['category' => 'skill'])->get();


        return view('users.index', compact('data', 'client_status', 'work_type', 'technologyes', 'search_skills'));
    }


    public function addSkills(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();

            // $validator = Validator::make($request->all(), [
            //     'edu_type.*' => 'required',
            //     'edu_title.*' => 'required',
            //     // 'edu_from.*' => 'required|date',
            //     // 'edu_to.*' => 'required|date|after_or_equal:edu_from',

            // ]);

            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' =>
            //         false, 'message' => $validator->errors()->first(),
            //         'Data' => '',
            //         'Status_code' => "401"
            //     ]);
            // }

            UserEducation::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['edu_type']); $i++) {
                if (isset($input['edu_type'][$i])) {

                    $inp['order'] = $i + 1;
                    $inp['user_id'] =  $input['user_id'];
                    $inp['degree_type_id'] =  $input['edu_type'][$i];
                    $inp['education_title_id'] =  $input['edu_title'][$i];
                    $inp['from'] =  $input['edu_from'][$i];
                    $inp['to'] =  $input['edu_to'][$i];

                    $skills = UserEducation::create($inp);
                }
            }


            UserPortfolio::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['portfolio']); $i++) {
                if (isset($input['portfolio'][$i])) {

                    // $inp['order'] = $i + 1;
                    $inp['user_id'] =  $input['user_id'];
                    $inp['name'] =  $input['portfolio'][$i];


                    UserPortfolio::create($inp);
                }
            }



            return response()->json([
                'status' => true,
                'last_insert_id' => $skills
            ]);
        }
    }

    public function addExprince(Request $request)
    {
        if ($request->isMethod('post')) {

            $input = $request->all();
            // dd( $input );
            //    dd( $input['present_checked'][1]);
            UserExperince::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['company_name']); $i++) {
                if (isset($input['company_name'][$i])) {

                    $value['order'] = $i + 1;
                    $value['user_id'] =  $input['user_id'];
                    $value['company_name'] =  $input['company_name'][$i];
                    $value['designation'] =  $input['designation'][$i];
                    $value['role_responsibilitie'] =  $input['role_res'][$i];
                    $value['from'] =  $input['exp_from'][$i];
                    //   dd($input['present_checked'][$i]);
                    if ($input['present_checked'][$i] == "1") {
                        $value['to'] =  date("Y");
                        $value['present'] =  1;
                    } else {
                        $value['to'] =  $input['exp_to'][$i];
                        $value['present'] =  '';
                    }

                    UserExperince::create($value);
                }
            }






            return response()->json([
                'status' => 'success',

            ]);
        }
    }
    public function addCertificate(Request $request)
    {
        if ($request->isMethod('post')) {

            $input = $request->all();

            Certification::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['certification']); $i++) {
                if (isset($input['certification'][$i])) {
                    $inpu['order'] = $i + 1;
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
    public function addAchievement(Request $request)
    {


        if ($request->isMethod('post')) {

            $input = $request->all();
            // dd($input);

            userAchievement::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['title']); $i++) {
                if (isset($input['title'][$i])) {
                    $inp['order'] = $i + 1;
                    $inp['user_id'] =  $input['user_id'];
                    $inp['title'] =  $input['title'][$i];
                    $inp['description'] =  $input['description'][$i];
                    userAchievement::create($inp);
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
         
            UserProject::where(['user_id' => $input['user_id']])->delete();
            for ($i = 0; $i < count($input['project_name']); $i++) {
                if (isset($input['project_name'][$i])) {

                    $inp['order'] = $i + 1;
                    $inp['project_name'] =  $input['project_name'][$i];
                    $inp['project_skills'] =  $input['project_skills'][$i];
                    $inp['team_size'] =  $input['team_size'][$i];
                    $inp['url'] =  $input['url'][$i];
                    $inp['user_id'] =  $input['user_id'];
                    $inp['project_description'] =  $input['project_description'][$i];
                    $userProject = UserProject::create($inp);
                }
            }


            Miscellaneous::where(['user_id' => $input['user_id']])->delete();
         
                if (isset($input['miscellaneous_title'])) {


                    $mis['miscellaneous_title'] =  $input['miscellaneous_title'];

                    $mis['user_id'] =  $input['user_id'];
                    $mis['miscellaneous'] =  $input['miscellaneous'];
                    Miscellaneous::create($mis);
           
            }


            return response()->json([
                'status' => 'success',
                'role' => Session::get('role')

            ]);
        }
    }

    public function add(Request $request)
    {

        $url = '';

        if ($request->isMethod('post')) {
            $input = $request->all();

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'email' =>    'required|email|max:255|ends_with:virtualemployee.com,teckvalley.com|unique:users,email,' . $input['id'] . ',id',
                'last_name' => 'required',
                'employee_id' => 'required|starts_with:tk,TK|unique:users,employee_id,' . $input['id'] . ',id',
                'resume_title' => 'required',
                'mobile' =>  'required||max:11|unique:users,mobile,' . $input['id'] . ',id',
                'joining_date' => 'required',
                'shift_start' => 'required',
                'shift_end' => 'required',
                'team' => 'required',
                'about_employee' => 'required',
                'experience' => 'required|numeric',


            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' =>
                    false, 'message' => $validator->errors()->first(),
                    'Data' => '',
                    'Status_code' => "401"
                ]);
            }



            $getTeam = Teams::where('id', '=', $input['team'])->first();

            $input['resume_emp_id'] = substr($input['first_name'], 0, 1) . substr($input['last_name'], 0, 1) . '_' . substr($getTeam['name'], 0, 2) . '_' . $input['employee_id'];

            // $enc = Crypt::encryptString($input['password']);
            if (isset($input['id'])) {
                $exist_user = User::where(['id' => $input['id']])->first();



                $input['check_password'] = Crypt::encryptString($input['password']);
                $input['password'] = bcrypt($input['password']);

                $input['updated_by'] = Auth::user()->id;
            } else {
                $input['check_password'] = Crypt::encryptString($input['password']);
                $input['password'] = bcrypt($input['password']);
                $input['added_by'] = Auth::user()->id;
            }

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
        if (isset($id)) {
            $id = base64_decode($id);
        }
        $allskills = SkillsEducation::where('category', '=', 'skill')->get();
        $education = SkillsEducation::where('category', '=', 'education')->get();
        $roles = Role::get();
        $certificate = SkillsEducation::where('category', '=', 'certificate')->get();
        $course = SkillsEducation::where('category', '=', 'course')->get();
        $team = Teams::get();
        $client_type = ClientType::get();
        $client_status = ClientStatus::orderBy('order_by','asc')->get();
        $work_type = WorkType::get();

        $selectedPrimarySkills = [];
        $selectedSecondrySkills = [];
        $selectedLearningSkills = [];
        $data = [];
        if (isset($id)) {

            $allskills = SkillsEducation::doesntHave('checkSkills', 'or', function ($q) use ($id) {
                $q->where(['user_id' => $id]);
            })->where('category', '=', 'skill')->get();
            // dd($allskills->toArray());

            $data = User::with(['miscellaneous','created_by', 'change_by', 'portfolio', 'education', 'exprince', 'certification', 'learning_skills', 'achievement', 'project', 'myTeam'])->with('skills', function ($q) {

                $q->orderBy('order', 'asc');
            })->where('id', '=', $id)->first();
            if (Session::get('role') != "ADMIN") {
                if (Auth::user()->id != $id) {
                    return redirect('information/' . Auth::user()->id);
                }
            }
            $selectedPrimarySkills = UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => 1])->get();
            $selectedSecondrySkills = UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => 2])->get();

            $selectedLearningSkills = UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => 3])->get();
            $selectedEducationType = UserEducation::where('user_id', '=', $id)->pluck('degree_type_id');

            $selectedEducationType = $selectedEducationType->toArray();
            // dd(Crypt::decryptString($data['check_password']));
            if ($data['check_password']) {
                $data['password'] = Crypt::decryptString($data['check_password']);
            } else {
                $data['password'] = 'welcome';
            }
            // dd($data->toArray());

            return view('users.information', compact('allskills', 'data', 'education', 'certificate', 'selectedPrimarySkills', 'selectedSecondrySkills', 'selectedLearningSkills', 'selectedEducationType', 'course', 'team', 'client_type', 'work_type', 'roles', 'client_status'));
        }

        return view('users.information', compact('allskills', 'data', 'education', 'certificate', 'course', 'team', 'selectedPrimarySkills', 'selectedSecondrySkills', 'selectedLearningSkills', 'client_type', 'work_type', 'roles', 'client_status'));
    }


    public function skillsSorting(Request $request)
    {
        $input = $request->all();


        if ($request['type'] == 2) {
            $skills = UserSkills::where(['user_id' => $request['user_id']])->get();

            UserSkills::where(['user_id' => $input['user_id'], 'type' => 2])->delete();


            foreach ($request['order'] as $order) {
                $inpu['order'] = $order['position'];
                $inpu['user_id'] =  $input['user_id'];
                $inpu['type'] =  $order['type'];
                $inpu['skill_value_id'] =  $order['id'];
                $alreadyExist =   UserSkills::where(['user_id' => $input['user_id'], 'type' => 2, 'skill_value_id' => $order['id']])->first();
                if ($alreadyExist == "") {
                    $skills = UserSkills::create($inpu);
                }
            }
        } else if ($request['type'] == 3) {
            $skills = UserSkills::where(['user_id' => $request['user_id']])->get();

            UserSkills::where(['user_id' => $input['user_id'], 'type' => 2])->delete();


            foreach ($request['order'] as $order) {
                $inpu['order'] = $order['position'];
                $inpu['user_id'] =  $input['user_id'];
                $inpu['type'] =  $order['type'];
                $inpu['skill_value_id'] =  $order['id'];
                $alreadyExist =   UserSkills::where(['user_id' => $input['user_id'], 'type' => 3, 'skill_value_id' => $order['id']])->first();
                if ($alreadyExist == "") {
                    $skills = UserSkills::create($inpu);
                }
            }
        } else {
            $skills = UserSkills::where(['user_id' => $request['user_id']])->get();

            UserSkills::where(['user_id' => $input['user_id'], 'type' => 1])->delete();


            foreach ($request['order'] as $order) {
                $inpu['order'] = $order['position'];
                $inpu['user_id'] =  $input['user_id'];
                $inpu['type'] =  $order['type'];
                $inpu['skill_value_id'] =  $order['id'];
                $alreadyExist =   UserSkills::where(['user_id' => $input['user_id'], 'type' => 1, 'skill_value_id' => $order['id']])->first();
                if ($alreadyExist == "") {
                    $skills = UserSkills::create($inpu);
                }
            }
        }


        return response()->json([
            'status' => true,

        ]);
    }

    public function learningSkillsSorting(Request $request)
    {

        $input = $request->all();
        $skills = LearningSkills::where(['user_id' => $request['user_id']])->get();

        LearningSkills::where(['user_id' => $input['user_id']])->delete();


        foreach ($request['order'] as $order) {
            $inpu['order'] = $order['position'];
            $inpu['user_id'] =  $input['user_id'];
            // $inpu['type'] =  $order['type'];
            $inpu['learning_skill_value_id'] =  $order['id'];
            $alreadyExist =   LearningSkills::where(['user_id' => $input['user_id'], 'learning_skill_value_id' => $order['id']])->first();
            if ($alreadyExist == "") {
                $skills = LearningSkills::create($inpu);
            }
        }

        return response()->json([
            'status' => true,
            // 'last_insert_id' => $updated
        ]);
    }


    public function educationType(Request $request)
    {
        $education = SkillsEducation::where('category', '=', 'education')->get();
        $certificate = SkillsEducation::where('category', '=', 'certificate')->get();
        $course = SkillsEducation::where('category', '=', 'course')->get();


        return response()->json([
            'status' => true,
            'data' => $education,
            'certificate' => $certificate,
            'course' => $course
        ]);
    }
    public function viewResume(Request $request, $id = null)
    {
        if (Session::get('role') != "ADMIN") {
            if (Auth::user()->id != $id) {
                return redirect('view-resume/' . Auth::user()->id);
            }
        }
        $data = User::where('id', '=', $id)->first();
        $data['project'] =  UserProject::where('user_id', '=', $id)->get();
        $data['certificate'] =  Certification::where('user_id', '=', $id)->get();
        $data['primary_skills'] =  UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => '1'])->orderBy('order', 'asc')->get();
        $data['secondry_skills'] =  UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => '2'])->orderBy('order', 'asc')->get();

        $data['education'] =  UserEducation::with('education_details', 'course')->where('user_id', '=', $id)->orderBy('order', 'asc')->get();
        $data['portfolio'] =  UserPortfolio::where('user_id', '=', $id)->get();
        $data['miscellaneous'] =  Miscellaneous::where('user_id', '=', $id)->first();
        // dd($data['miscellaneous']->toArray());




        return view('pdf.view_pdf', compact('data'));
    }


    public function resume(Request $request, $id = null)
    {
        if (Session::get('role') != "ADMIN") {
            if (Auth::user()->id != $id) {
                return redirect('resume/' . Auth::user()->id);
            }
        }

        $data = User::where('id', '=', $id)->first();
        $data['project'] =  UserProject::where('user_id', '=', $id)->get();
        $data['certificate'] =  Certification::where('user_id', '=', $id)->get();
        $data['primary_skills'] =  UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => '1'])->orderBy('order', 'asc')->get();
        $data['secondry_skills'] =  UserSkills::with('skills_details')->where(['user_id' => $id, 'type' => '2'])->orderBy('order', 'asc')->get();

        $data['education'] =  UserEducation::with('education_details', 'course')->where('user_id', '=', $id)->orderBy('order', 'asc')->get();

        if ($data) {

            view()->share('data', $data);

            $pdf_doc = PDF::loadView('pdf.export_pdf', $data->toArray());

            return $pdf_doc->download('pdf.pdf');
        }


        return view('pdf.export_pdf', compact('data'));
    }


    public function changePasswordPost(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            // Current password and new password same
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password successfully changed!");
    }
    public function showChangePasswordGet()
    {

        return view('auth.passwords.change-password');
    }


    public function removeSkill(Request $request)
    {
        $id = $request['user_id'];
        $remove =   UserSkills::where(['skill_value_id' => $request['id'], 'user_id' => $request['user_id']])->delete();
        if ($remove) {

            $allskills = SkillsEducation::doesntHave('checkSkills', 'or', function ($q) use ($id) {
                $q->where(['user_id' => $id]);
            })->where('category', '=', 'skill')->get();
            return response()->json([
                'status' => true,
                'data' => $allskills
            ]);
        }
    }


    public function removeExp(Request $request)
    {
        $id = $request['id'];
        $exp = UserExperince::find($id);

        if ($exp) {
            $exp->delete();
            return response()->json(['status' => 'success']);
        }
    }

    public function removeCertificate(Request $request)
    {
        $id = $request['id'];
        $certificate = Certification::find($id);

        if ($certificate) {
            $certificate->delete();
            return response()->json(['status' => 'success']);
        }
    }



    public function removeAchievement(Request $request)
    {
        $id = $request['id'];
        $ach = userAchievement::find($id);

        if ($ach) {
            $ach->delete();
            return response()->json(['status' => 'success']);
        }
    }

    public function removeProject(Request $request)
    {
        $id = $request['id'];
        $ach = UserProject::find($id);

        if ($ach) {
            $ach->delete();
            return response()->json(['status' => 'success']);
        }
    }
    public function removePortfolio(Request $request)
    {
        $id = $request['id'];
        $portfolio = UserPortfolio::find($id);

        if ($portfolio) {
            $portfolio->delete();
            return response()->json(['status' => 'success']);
        }
    }


    public function removeEducation(Request $request)
    {
        $id = $request['user_id'];
        $remove =   UserEducation::where(['id' => $request['id'], 'user_id' => $request['user_id']])->delete();
        if ($remove) {

            return response()->json([
                'status' => true
            ]);
        }
    }
    public function checkPresent(Request $request)
    {

        $data =   UserExperince::where(['present' => 1, 'user_id' => $request['user_id']])->first();

        if ($data) {

            return response()->json([
                'status' => true,
                'data' => $data

            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => ''

            ]);
        }
    }
}
