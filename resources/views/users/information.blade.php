@extends('admin.layout.head')
@section('title')
Users
@endsection
@section('content')
@include('admin.layout.header')
Toast::message('message', 'level', 'title');


@section('script')
<!-- MultiStep Form -->
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="panel-heading">
        @if(Session::get('role')=="ADMIN")
            <span class="pull-right"><a class="btn btn-outline btn-primary" type="reset" href="{{ url('users')}}"><i class="fa fa-arrow-left"></i> Back </a>
            </span>
            @endif
        </div>
        <!-- MultiStep Form -->
        <div class="container-fluid" id="">
            <div class="row justify-content-center mt-0">
                <div class="">
                    <div class="px-0 pt-4 pb-0 mt-3 mb-3">

                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <div id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Personal Infromation</strong></li>
                                        <li id="skills"><strong>Skills</strong></li>
                                        <li id="personal"><strong>Education</strong></li>
                                        <li id="payment"><strong>Experience</strong></li>
                                        <li id="certificate"><strong>Certificate</strong></li>
                                        <li id="achievement"><strong>Achievement</strong></li>
                                        <li id="confirm"><strong>Projects</strong></li>
                                    </ul> <!-- fieldsets -->
                                    <fieldset>
                                        <form action="{{url('add-user')}}" id="genralInfo" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="{{isset($data->id)?$data->id:'' }}">
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>First Name<span style="color: red;">*</span></label>
                                                        <input class="form-control" placeholder="Ex:Jackson" name="first_name" value="{{isset($data->name)?$data->name:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Last Name <span style="color: red;">*</span></label>
                                                        <input class="form-control" placeholder="Ex: roi" name="last_name" value="{{isset($data->last_name)?$data->last_name:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Employee id<span style="color: red;">*</span></label>
                                                        <input class="form-control" placeholder="Ex:TK0001" name="employee_id" value="{{isset($data->employee_id)?$data->employee_id:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Email <span style="color: red;">*</span></label>
                                                        <input type="email" class="form-control" placeholder="Ex:Jackson@temporary-mail.net" name="email" value="{{isset($data->email)?$data->email:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Password<span style="color: red;">*</span></label>
                                                        <input type="password" class="form-control" placeholder="Ex:123@123" name="password" value="{{isset($data->password)?$data->password:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                    @if(Session::get('role')=="ADMIN")
                                                    <div class="col-lg-6">
                                                        <label>User Type <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="user_role" {{ isset($data->id)  ? '' : 'required=""'}}>

                                                        @forelse($roles as $key=>$role)
                                                        @if(isset($data->user_role)  && $role['id']== $data->user_role)
                                                        <option value="{{$role['id']}}" selected>{{$role['name']}} </option>

                                                        @else
                                                        <option value="{{$role['id']}}">{{$role['name']}}</option>

                                                        @endif
                                                        @empty
                                                        <p>Rolse</p>
                                                        @endforelse
                                                        </select>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-6">
                                                        <label>User Type <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="user_role" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                       
                                                        @foreach($roles as $key=>$role)
                                                         @if($role['name']== 'USER')
                                                        <option value="{{$role['id']}}" selected>{{$role['name']}} </option>
                                                        @endif
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Mobile<span style="color: red;">*</span></label>
                                                        <input type="number" class="form-control" placeholder="Ex:968565472" name="mobile" value="{{isset($data->mobile)?$data->mobile:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Resume title<span style="color: red;">*</span></label>
                                                        <input class="form-control" placeholder="Ex:***" name="resume_title" value="{{isset($data->resume_title)?$data->resume_title:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 datepicker-prsonal">
                                                        <label>Joining Date<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" placeholder="2021-01-02" name="joining_date" id="joining_date" value="{{isset($data->joining_date)?$data->joining_date:'' }}" required="" autocomplete="on|off" />
                                                       
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label>Shift Time<span style="color: red;">*</span></label>
                                                                <input type="time" class="form-control" placeholder="" name="shift_start" value="{{isset($data->shift_start)?$data->shift_start:'' }}" required="" autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label>&nbsp;</label>
                                                                <input type="time" class="form-control" placeholder="" name="shift_end" value="{{isset($data->shift_end)?$data->shift_end:'' }}" required="" autocomplete="on|off" />

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Team<span style="color: red;">*</span></label>
                                                        <select class="form-control" name="team" {{ isset($data->id)  ? '' : 'required=""'}}>

                                                            @forelse($team as $key=>$res)
                                                            @if(isset($data->myTeam['id'] ) && $res['id']== $data->myTeam['id'])
                                                            <option value="{{$res['id']}}" selected>{{$res['name']}} </option>

                                                            @else
                                                            <option value="{{$res['id']}}">{{$res['name']}}</option>

                                                            @endif
                                                            @empty
                                                            <p>Team not found</p>
                                                            @endforelse
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Total EXP(in year)<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" placeholder="EX:3.5" name="experience" value="{{isset($data->experience)?$data->experience:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                </div>
                                                @if(Session::get('role')=="ADMIN")
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Resource Hire Status<span style="color: red;">*</span></label>
                                                        <select class="form-control" name="client_status" {{ isset($data->id)  ? '' : 'required=""'}}>

                                                            @forelse($client_status as $key=>$clientstatus)
                                                            @if(isset($data['client_status'] ) && $clientstatus['id']== $data['client_status'])
                                                            <option value="{{$clientstatus['id']}}" selected>{{$clientstatus['title']}} </option>

                                                            @else
                                                            <option value="{{$clientstatus['id']}}">{{$clientstatus['title']}}</option>

                                                            @endif
                                                            @empty
                                                            <p>Team not found</p>
                                                            @endforelse
                                                        </select>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Work Duration<span style="color: red;">*</span></label>
                                                        <select class="form-control" name="work_type" {{ isset($data->id)  ? '' : 'required=""'}}>

                                                            @forelse($work_type as $key=>$worktype)
                                                            @if(isset($data['work_type'] ) && $worktype['id']== $data['work_type'])
                                                            <option value="{{$worktype['id']}}" selected>{{$worktype['title']}} </option>

                                                            @else
                                                            <option value="{{$worktype['id']}}">{{$worktype['title']}}</option>

                                                            @endif
                                                            @empty
                                                            <p>Team not found</p>
                                                            @endforelse
                                                        </select>

                                                    </div>
                                                </div>
                                                @endif
                                                <div class="form-group">
                                                    <label>About Employee<span style="color: red;">*</span></label>
                                                    <textarea class="form-control" rows="3" name="about_employee">{{isset($data->about_employee)?$data->about_employee:'' }}</textarea>


                                                </div>

                                            </div>
                                            <input type="submit" value="Next Step" class=" action-button btn btn-primary  col-md-3 pull-right mr-1" id="genral_info_submit" />
                                         
                                            <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_genral_info_submit" style=" margin-right: 5px;">
                                           
                                        </form>
                                        <input type="button" name="next" style="display: none;" class="next btn btn-info  action-button col-md-3" value="Next Step" id="genral_info_button" />
                                        <input type="button" name="next" style="display: none;" class="next btn btn-info  action-button col-md-3" value="Next Step" id="genral_info_button_two" />
                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-card">
                                            <input type="hidden" name="drag_user_id" id="drag_user_id" class="user_id" value="{{isset($data->id)?$data->id:'' }}">

                                            <div class="alert alert-info small"><i class="fa fa-comment"></i>&nbsp;&nbsp;Drag &amp; Drop fields from the left (Available Skills) over to the right side in the desired location on your dashboard.</div>
                                            <span name="el_validationErrorFields"></span>
                                            <br />
                                            <div class="row dragSortableItems">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-header"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;Available Skills<span style="color: red;">*</span> </div>
                                                        <div class="card-body well">
                                                            <ul id="in_available_fields" name="in_available_fields" class="custom-scrollbar in_available_fields sortable-list fixed-panel ui-sortable">
                                                                @forelse ($allskills as $skill)
                                                                <li class="sortable-item  allowSecondary allowExport" id="{{$skill['id']}}">{{$skill['value']}}</li>

                                                                @empty
                                                                <p>No Skills</p>
                                                                @endforelse

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card primaryPanel">
                                                        <div class="card-header"><i class="fa fa-star-o"></i>&nbsp;&nbsp;Primary Skills</div>
                                                        <div class="card-body well">
                                                            <ul id="primary_sortable" name="in_primary_fields" class="sortable-list secondaryDropzone fixed-panel" data-fieldtype="secondary"> @forelse ($selectedPrimarySkills as $skill)
                                                                <li class="sortable-item  allowSecondary allowExport" id="{{isset($skill->skills_details['id'])?$skill->skills_details['id']:''}}">{{isset($skill->skills_details['value']) ? $skill->skills_details['value'] : ''}}   <i class="fa fa-close skill_delete" style="color:red;float: right;  cursor: pointer;"></i></li> @empty
                                                                <div class="alert alert-warning small">
                                                                    <center>No Fields Selected</center>
                                                                </div> @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="card secondaryPanel">
                                                        <div class="card-header"><i class="fa fa-star-o"></i>&nbsp;&nbsp;Secondary Skills</div>
                                                        <div class="card-body well">

                                                            <ul id="sortable" name="in_secondary_fields" class="sortable-list secondaryDropzone fixed-panel" data-fieldtype="secondary">

                                                                @forelse ($selectedSecondrySkills as $skill)
                                                                <li class="sortable-item  allowSecondary allowExport" id="{{isset($skill->skills_details['id']) ? $skill->skills_details['id'] : ''}}">{{ isset($skill->skills_details['value']) ? $skill->skills_details['value'] :''}} <i class="fa fa-close skill_delete" style="color:red;float: right;  cursor: pointer;"></i></li>

                                                                @empty
                                                                <div class="alert alert-warning small">
                                                                    <center>No Fields Selected</center>
                                                                </div>
                                                                @endforelse
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <br />
                                                    <div class="card exportPanel">
                                                        <div class="card-header"><i class="fa fa-download"></i>&nbsp;&nbsp;Learning Skills</div>
                                                        <div class="card-body well">

                                                            <ul id="sortable_lerning" name="in_export_fields" class="sortable-list exportDropzone fixed-panel">
                                                                @forelse ($selectedLearningSkills as $skill)
                                                                <li class="sortable-item  allowSecondary allowExport" id="{{isset($skill->skills_details['id'])?$skill->skills_details['id']:''}}">{{isset($skill->skills_details['value']) ? $skill->skills_details['value'] :''}} <i class="fa fa-close skill_delete" style="color:red;float: right; cursor: pointer;"></i></li>

                                                                @empty
                                                                <div class="alert alert-warning small">
                                                                    <center>No Fields Selected</center>
                                                                </div>
                                                                @endforelse

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <input type="button" id="new_skills_prev" name="previous" class="previous action-button-previous  pull-left btn btn-warning" value="Previous" />


                                        <input type="button" name="next" class="next action-button btn btn-primary  col-md-3 pull-right" value="Next Step" />
                                        <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_skills" style=" margin-right: 5px;">

                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    

                                    </fieldset>





                                    <fieldset>
                                        <form action="{{url('add-user-skills')}}" id="skillsForm">
                                            <input type="hidden" value="" name="user_id" class="user_id">
                                            <div class="form-card">



                                                <h2 class="fs-title">Education</h2>
                                                <div class="row">
                                                    <div class="education_more col-lg-12">
                                                        <div class="row">

                                                            <div class="col-lg-3">


                                                                <!-- <input type="hidden" name="order[]" value="1"> -->
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>Type
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif </label>
                                                                <select class="form-control" aria-label="Default select example" name="edu_type[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                    <option value="">--Please select--</option>
                                                                    @forelse($education as $key=>$dat)
                                                                    <option value="{{$dat['id']}}">{{$dat['value']}}</option>
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Title
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <select class="form-control" aria-label="Default select example" name="edu_title[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                    <option value="">--Please select--</option>
                                                                    @forelse($course as $key=>$res)

                                                                    @if($res['id']==$res['education_title_id'])
                                                                    <option value="{{$res['id']}}" selected>{{$res['value']}} </option>
                                                                    @else
                                                                    <option value="{{$res['id']}}">{{$res['value']}}</option>
                                                                    @endif
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse
                                                                </select>
                                                            </div>

                                                            <div class="col-lg-3 datepicker-wrap">
                                                                <label>From
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>

                                                                <input type="text" class="form-control edu_to" placeholder="YYYY" name="edu_from[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="off" />

                                                            </div>
                                                            <div class="col-lg-3 datepicker-wrap">
                                                                <label>To
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <input type="text" class="form-control edu_from" placeholder="YYYY" name="edu_to[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="off" />

                                                            </div>
                                                        </div>
                                                        @if(isset($data->education) && (count($data->education)>0))
                                                        @foreach($data->education as $key=>$value)
                                                        <div class="row for_position" order="{{$value['order']}}" id="{{$value['id']}}">

                                                           <span class="educt_close"><i class="fa fa-close education_delete" style="color:red;  cursor: pointer;"></i></span>

                                                            <div class="col-lg-3">
                                                                <label> <i class="fa fa-arrows" aria-hidden="true"></i>Type<span style="color: red;">*</span> </label>
                                                                <select class="form-control" aria-label="Default select example" name="edu_type[]" required="">

                                                                    @forelse($education as $key=>$dat)

                                                                    @if($dat['id']==$value['degree_type_id'])
                                                                    <option value="{{$dat['id']}}" selected>{{$dat['value']}} </option>
                                                                    @else
                                                                    <option value="{{$dat['id']}}">{{$dat['value']}}</option>
                                                                    @endif
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse

                                                                </select>
                                                            </div>

                                                            <div class="col-lg-3">
                                                                <label>Title <span style="color: red;">*</span> </label>
                                                                <select class="form-control" aria-label="Default select example" name="edu_title[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                    @forelse($course as $key=>$datt)

                                                                    @if($datt['id']==$value['education_title_id'])
                                                                    <option value="{{$datt['id']}}" selected>{{$datt['value']}} </option>
                                                                    @else
                                                                    <option value="{{$datt['id']}}">{{$datt['value']}}</option>
                                                                    @endif
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse

                                                                    <!-- <option value="1" {{ isset($value['education_title_id']) == '1'  ? 'selected' : ''}}>BBA</option>
                                                                    <option value="2" {{ isset($value['education_title_id']) == '2'  ? 'selected' : ''}}>BCA</option>
                                                                    <option value="3" {{ isset($value['education_title_id']) == '3'  ? 'selected' : ''}}>B.Come</option> -->
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-3 datepicker-wrap">
                                                                <label>From<span style="color: red;">*</span> </label>
                                                                <input type="text" class="form-control edu_to" placeholder="12-17-2021" name="edu_from[]" value="{{ isset($value['from'])?$value['from']:''}}" required="" autocomplete="off" />

                                                            </div>
                                                            <div class="col-lg-3 datepicker-wrap">
                                                                <label>To<span style="color: red;">*</span> </label>
                                                                <input type="text" class="form-control edu_from" placeholder="12-17-2021" name="edu_to[]" value="{{ isset($value['to'])?$value['to']:''}}" required="" autocomplete="off" />

                                                            </div>

                                                        </div>
                                                        @endforeach
                                                        @endif



                                                        <a href="javascript:void(0);" class="add_button btn btn-info" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>

                                                    </div>

                                                </div>
                                                <div class="row ">
                                                        <div class="col-lg-6 portfolio_more">
                                                            <div class="form-group">
                                                                <label>
                                                                Portfolio </label>
                                                                <input type="text" name="portfolio[]" class="form-control" placeholder="https://test.com"  autocomplete="off">
                                                               <span class="portfolio_add_remove">     
                                                                <i class="fa fa-plus add_more_portfolio" id="add_more_portfolio" style="color:green;    margin-top: 7px; margin-right: -36px;  cursor: pointer;"></i>
                                                                </span>


                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    @if(isset($data->portfolio) && (count($data->portfolio)>0))
                                                    @foreach($data->portfolio as $key=>$portfolio)
                                                    <div class="row ">
                                                        <div class="col-lg-6 portfolio_more">
                                                            <div class="form-group">
                                                                <label>
                                                                Portfolio </label>
                                                                <input type="text" name="portfolio[]" class="form-control" placeholder="https://test.com" value="{{$portfolio->name}}"  autocomplete="off">
                                                               <span class="portfolio_add_remove">
                                                                <i class="fa fa-minus remove_curent_portfolio" id="{{$portfolio->id}}" style="color:red;    margin-top: 7px; margin-right: -36px;  cursor: pointer;"></i>

                                                                </span>

                                                            </div>
                                                        </div>
                                                        
                                                    </div>               
                                                    @endforeach               
                                                    @endif

                                            </div>

                                            <input type="submit" value="Next Step" class=" action-button btn btn-primary  col-md-3 pull-right" id="skills_submit" />
                                            <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_skills_submit" style=" margin-right: 5px;">
                         
                                        </form>
                                        <input type="button" id="skills_prev" name="previous" class="previous action-button-previous  pull-left btn btn-warning" value="Previous" />

                                        <input type="button" style="display:none" name="next" class="next action-button btn btn-primary  col-md-3 pull-right" value="Next Stepp" id="skills_button" />
                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    

                                    </fieldset>
                                    <fieldset>
                                        <form action="{{url('add-user-exprince')}}" id="exprinceForm">
                                            <input type="hidden" value="" name="user_id" class="user_id">
                                            <div class="form-card">
                                                <h2 class="fs-title">Total Experience</h2>

                                                <div class="exp_more">
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>Companay Name
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <input type="text" class="form-control" placeholder="XYZ" name="company_name[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-3 ">
                                                                <label>Designation
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif

                                                                </label>
                                                                <input type="text" class="form-control" placeholder="Team leader" name="designation[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>

                                                            <div class="col-lg-2 datepicker-wrap">
                                                                <label>From
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <input type="text" class="form-control exp_from" placeholder="2021-12" name="exp_from[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-2 datepicker-wrap">
                                                                <label>To
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <input type="text" class="form-control exp_to" placeholder="2021-12" name="exp_to[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on" />

                                                            </div>
                                                            <div class="col-lg-2">
                                                            <label>Present</label>
                                                            <span class="chec_box">
                                                            <input type="hidden" name="present_checked[]" value="" class="present_checked">
                                                              <input type="checkbox"  name="present" class="present " id="present" value="">
                                                            </span>
                                                            </div>


                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Role and Responsibilities
                                                                        @if(isset($data->id))

                                                                        @else
                                                                        <span style="color: red;">*</span>

                                                                        @endif
                                                                    </label>
                                                                    <textarea class="form-control" rows="3" name="role_res[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                       
                                                    </div>

                                                    @if(isset($data->exprince) && count($data->exprince)>0)

                                                    @foreach($data->exprince as $key=>$value)
                                                    <div>
                                                    <div class="my_separator"></div>


                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Companay Name <span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="XYZ" name="company_name[]" value="{{ isset($value['company_name'])?$value['company_name']:''}}" required="" autocomplete="off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Designation<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="Team leader" name="designation[]" value="{{ isset($value['designation'])?$value['designation']:''}}" required="" autocomplete="on" />

                                                        </div>
                                                        <div class="col-lg-2 datepicker-wrap">
                                                            <label>From<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control exp_from" placeholder="2021-12" name="exp_from[]" value="{{ isset($value['from'])?$value['from']:''}}" required="" autocomplete="on" />

                                                        </div>
                                                        <div class="col-lg-2 datepicker-wrap">
                                                            <label>To<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control exp_to" placeholder="2021-12" name="exp_to[]" value="{{ isset($value['to'])?$value['to']:''}}" required="" autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-2">
                                                        <label>Present</label>
                                                        <input type="hidden" name="present_checked[]" value="" class="present_checked">
                                                        <span class="chec_box">
                                                        <input type="checkbox" name="present" class="present " id="present" value="" {{$value['present']=='1'?'checked':''}}> 
                                                        </span>  
                                                        <span class="educt_close"> 
                                                        <i class="fa fa-close exp_delete" style="color:red;float: right; cursor: pointer;" id="{{ isset($value['id'])?$value['id']:''}}"></i>
                                                        </span>
                                                    </div>

                                                    </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Role and Responsibilities<span style="color: red;">*</span> </label>
                                                                    <textarea class="form-control ckeditor" rows="3" name="role_res[]" required="" id="{{$value['id']}}">{{ isset($value['role_responsibilitie'])?$value['role_responsibilitie']:''}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        </div>

                                                    

                                                    @endforeach


                                                    @endif
                                                    <a href="javascript:void(0);" class="exp_add_button btn btn-info" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i> Add more</a>

                                                </div>




                                            </div>
                                            <input type="submit" value="Next Step" class="  action-button btn btn-primary  col-md-3 pull-right" id="exprince_submit" />
                                            <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_exprince_submit" style=" margin-right: 5px;">
                       
                                        </form>
                                        <input type="button" name="previous" id="exprince_prev" class="previous action-button-previous  pull-left btn btn-warning" value="Previous" />

                                        <input type="button" name="make_payment" style="display:none" class="next action-button pull-right" value="Next Step" id="exprince_button" />
                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    

                                    </fieldset>



                                    <fieldset>
                                        <form action="{{url('add-user-certificate')}}" id="certificateForm">
                                            <input type="hidden" value="" name="user_id" class="user_id">
                                            <div class="form-card">
                                                <h2 class="fs-title">Certification</h2>

                                                <div class="certification_more">
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>Type
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <select class="form-control" aria-label="Default select example" name="certification_type[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                    <option value="">--Please select--</option>
                                                                    @forelse($certificate as $key=>$dat)
                                                                    <option value="{{$dat['id']}}">{{$dat['value']}}</option>
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse
                                                                </select>
                                                            </div>


                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-lg-12 mt-15">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Certification @if(isset($data->id))

                                                                        @else
                                                                        <span style="color: red;">*</span>

                                                                        @endif</label>
                                                                    <textarea class="form-control" rows="3" name="certification[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(isset($data->certification) && count($data->certification)>0)
                                                    @foreach($data->certification as $key=>$value)
                                                    
                                                    <div class="my_separator"></div>

                                                    <div class="for_position">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>Type<span style="color: red;">*</span> </label>
                                                                <select class="form-control" aria-label="Default select example" name="certification_type[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                    <option value="">--Please select--</option>
                                                                    @forelse($certificate as $key=>$dat)
                                                                    @if($dat['id']==$value['certifications_value_id'])
                                                                    <option value="{{$dat['id']}}" selected>{{$dat['value']}} </option>
                                                                    @else
                                                                    <option value="{{$dat['id']}}">{{$dat['value']}}</option>
                                                                    @endif
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                            <span class="certfi_close"> 
                                                            <i class="fa fa-close exp_certificate" style="color:red;float: right; cursor: pointer;" id="{{$value['id']}}"></i>
                                                            </span>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 mt-15">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Certification <span style="color: red;">*</span> </label>
                                                                    <textarea class="form-control ckeditor" rows="3" name="certification[]">{{ isset($value['certification'])?$value['certification']:''}} </textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    @endforeach


                                                    @endif
                                                    <a href="javascript:void(0);" class="certification_add_button btn btn-info" title="Add field"><i class="fa fa-plus" aria-hidden="true"> Add more</i></a>

                                                </div>




                                            </div>
                                            <input type="submit" name="certificate_submit" class="action-button pull-right btn btn-primary" value="Next Step" id="certificate_submit" />
                                            <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_certificate_submit" style=" margin-right: 5px;">
                           
                                        </form>
                                        <input type="button" name="previous" id="certificate_prev" class="previous action-button-previous  pull-left btn btn-warning" value="Previous" />

                                        <input type="button" name="certificate_button" style="display:none" class="next action-button pull-right" value="Next Step" id="certificate_button" />
                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    


                                    </fieldset>

                                    <fieldset>
                                    <form action="{{url('add-user-achievement')}}" id="achievementForm">

                                    <div class="form-card">
                                            <h2 class="fs-title">Achievement</h2>
                                                <input type="hidden" value="" name="user_id" class="user_id">
                                                
                                                    <div class="ach_more">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>Title @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif </label>
                                                                <input type="text" class="form-control" placeholder="EX:abc" name="title[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="off" />

                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label>Achievement Description
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <textarea class="form-control " rows="3" name="description[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>

                                                            </div>
                                                        </div>

                                                        @if(isset($data->achievement) && count($data->achievement)>0)
                                                       
                                                        @foreach($data->achievement as $key=>$value)
                                                        <div class="my_separator"></div>
                                                        
                                                        <div class="row for_position">
                                                            <div class="col-lg-12">
                                                                <label>Title <span style="color: red;">*</span> </label>
                                                                <input type="text" class="form-control" placeholder="EX:abc" name="title[]" value="{{ isset($value['title'])?$value['title']:''}}" required="" autocomplete="on" />
                                                                <span class="educt_close"> 
                                                                <i class="fa fa-close remove_achievement" style="color:red;float: right; cursor: pointer;" id="{{$value['id']}}"></i>
                                                                </span>

                                                            </div>
                                                            <div class="col-lg-12">
                                                                <label>Achievement Description<span style="color: red;">*</span> </label>
                                                                <textarea class="form-control ckeditor" rows="3" name="description[]">{{ isset($value['description'])?$value['description']:''}}</textarea>
                                                            </div>
                                                           

                                                        </div>
                                                        @endforeach

                                                        @endif
                                                        <a href="javascript:void(0);" class="ach_add_button btn btn-info mt-15" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i> Add more</a>
                                                    </div>
                                                   

                                    </div>
                                        <input type="submit" name="achivment_submit" class="btn action-button pull-right btn-primary" value="Next Step" id="achivment_submit" />
                                        <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_achivment_submit" style=" margin-right: 5px;">

                                        </form>
                                        <input type="button" name="previous" class="previous action-button-previous btn btn-warning pull-left " value="Previous" id="achievement_prev" />
                                        <input type="button" style="display:none" name="next" class="next action-button pull-right btn-primary" value="Next Step" id="achievement_button" />
                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    

                                    </fieldset>



                                    <fieldset>
                                        <form action="{{url('add-user-project')}}" id="projectForm">

                                            <input type="hidden" value="" name="user_id" class="user_id">

                                            <div class="form-card">

                                                <div class="project_more">
                                                    <h2 class="fs-title">Project
                                                        @if(isset($data->id))

                                                        @else
                                                        <span style="color: red;">*</span>

                                                        @endif
                                                    </h2>
                                                    <div class="row form-group">

                                                        <div class="col-lg-3">
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i> Project Name
                                                                @if(isset($data->id))

                                                                @else
                                                                <span style="color: red;">*</span>

                                                                @endif
                                                            </label>
                                                            <input type="text" class="form-control" placeholder="XYZ" name="project_name[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Project Skills
                                                                @if(isset($data->id))

                                                                @else
                                                                <span style="color: red;">*</span>

                                                                @endif
                                                            </label>
                                                            <input type="text" class="form-control" placeholder="php,node etc" name="project_skills[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>


                                                        <div class="col-lg-3">
                                                            <label>Team Size
                                                                @if(isset($data->id))

                                                                @else
                                                                <span style="color: red;">*</span>

                                                                @endif
                                                            </label>
                                                            <input type="text" class="form-control" placeholder="1" name="team_size[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Url
                                                                @if(isset($data->id))

                                                                @else
                                                                <span style="color: red;">*</span>

                                                                @endif

                                                            </label>
                                                            <input type="text" class="form-control" placeholder="https://github.com/" name="url[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                        <div>
                                                            <div class="col-md-12">
                                                                <label>Project Description
                                                                    @if(isset($data->id))

                                                                    @else
                                                                    <span style="color: red;">*</span>

                                                                    @endif
                                                                </label>
                                                                <textarea class="form-control" rows="3" name="project_description[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <a href="javascript:void(0);" class="project_add_button btn btn-info" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i> Add more</a>
                                                    @if(isset($data->project) && count($data->project)>0)
                                                    
                                                    @foreach($data->project as $key=>$value)
                                                    <div class="my_separator"></div>
                                                    <div class="row form-group for_position">

                                                    <span class="certfi_close"> 
                                                            <i class="fa fa-close remove_project" style="color:red;float: right; cursor: pointer;" id="{{$value['id']}}"></i>
                                                    </span>
                                                    
                                                        <div class="col-lg-3">
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i> Project Name<span style="color: red;">*</span> </label>
                                                            
                                                            <input type="text" class="form-control" placeholder="XYZ" name="project_name[]" value="{{ isset($value['project_name'])?$value['project_name']:''}}" required="" autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Project Skills<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="php,node etc" name="project_skills[]" value="{{ isset($value['project_skills'])?$value['project_skills']:''}}" required="" autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Team Size<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="1" name="team_size[]" value="{{ isset($value['team_size'])?$value['team_size']:''}}" required="" autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Url<span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" placeholder="1" name="url[]" value="{{ isset($value['url'])?$value['url']:''}}" required="" autocomplete="on|off" />


                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label>Project Description<span style="color: red;">*</span> </label>
                                                            <textarea class="form-control ckeditor" rows="3" name="project_description[]" required="">{{ isset($value['project_description'])?$value['project_description']:''}}</textarea>


                                                        </div>
                                                    </div>


                                                    @endforeach
                                                    @endif


                                               
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label>Miscellaneous Title</label>
                                                        <input class="form-control" name="miscellaneous_title" value="{{ isset($data['miscellaneous']->miscellaneous_title)?$data['miscellaneous']->miscellaneous_title:''}}"> </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <label>Miscellaneous </label>
                                                    <textarea class="form-control" rows="3" name="miscellaneous">{{ isset($data['miscellaneous']->miscellaneous)?$data['miscellaneous']->miscellaneous:''}}</textarea>
                                                </div>
                                            </div>              

                                            </div>
                                            <input type="submit" value="Confirm" class="action-button btn btn-success col-md-3 pull-right" id="project_submit" />
                                            <!-- <input type="submit"  value="Save" class=" action-button btn btn-primary  col-md-3 pull-right mr-1 mr-1" id="save_project_submit" style=" margin-right: 5px;"> -->

                                        </form>
                                        <input type="button" id="project_previous" name="previous" class="previous action-button-previous  pull-left btn btn-warning" value="Previous" />
                                        <p >CreatedBy:<b>{{isset ($data->created_by['name']) ? $data->created_by['name'] : ''}}</b> UpdatedBy:<b>{{ isset($data->change_by['name']) ? $data->change_by['name']  : ''  }}</b></p>    

                                    </fieldset>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<script>
 
 
 $("#save_genral_info_submit").click(function() {
        // $(document).on("click", "#genral_info_submit", function() {
        $('#genralInfo').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();


            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    toastr.success("Record insert successfully");
                    window.location.href = base_url+ "/users";

                }
            })
        })
    });
    $("#save_skills").click(function() {
        window.location.href = base_url+ "/users";
    });

    $("#genral_info_submit").click(function() {
        // $(document).on("click", "#genral_info_submit", function() {
        $('#genralInfo').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();


            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {

                    if (data.status == true) {
                        toastr.success("Record insert successfully");
                        $('.user_id').val(data.last_insert_id);
                        $('#genral_info_submit').hide();
                        $('#genral_info_button_two').show();
                        $('#genral_info_button_two').trigger('click');
                    } else {
                        toastr.error(data.message);
                    }

                }
            })
        })
    });


    $(document).on("click", "#save_skills_submit", function() {
        $('#skillsForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    toastr.success("Record insert successfully");
                    window.location.href = base_url+ "/users";
                },
                error: function(textStatus, errorThrown) {
                    toastr.error("Somting went wrong Please try again");
                }
            })
        })
    });
    $(document).on("click", "#skills_submit", function() {
        $('#skillsForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    if (data.status = "success") {
                        toastr.success("Record insert successfully");
                        $('#skills_submit').hide();
                        $('#skills_button').show();
                        $('#skills_button').trigger('click');
                    } else {
                        toastr.error(data.message);
                    }

                },
                error: function(textStatus, errorThrown) {
                    toastr.error("Somting went wrong Please try again");
                }
            })
        })
    });

    $(document).on("click", "#save_achivment_submit", function() {
        $('#achievementForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    toastr.success("Record insert successfully");
                    window.location.href = base_url+ "/users";

                }
            })
        })
    });

    $(document).on("click", "#achivment_submit", function() {
        $('#achievementForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    if (data.status = "success") {
                        toastr.success("Record insert successfully");
                        $('#achievement_submit').hide();
                        $('#achievement_button').show();
                        $('#achievement_button').trigger('click');
                    } else {
                        toastr.error(data.message);
                    }

                }
            })
        })
    });

    $(document).on("click", "#save_certificate_submit", function() {
        $('#certificateForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                 
                    toastr.success("Record insert successfully");
                    window.location.href = base_url+ "/users";
                }
            })
        })
    });
    $(document).on("click", "#certificate_submit", function() {
        $('#certificateForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    if (data.status = "success") {
                        toastr.success("Record insert successfully");
                        $('#certificate_submit').hide();
                        $('#certificate_button').show();
                        $('#certificate_button').trigger('click');
                    } else {
                        toastr.error(data.message);
                    }

                }
            })
        })
    });
    $(document).on("click", "#save_exprince_submit", function() {
        $('#exprinceForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    toastr.success("Record insert successfully");
                    window.location.href = base_url+ "/users";

                }
            })
        })
    });
    $(document).on("click", "#exprince_submit", function() {
        $('#exprinceForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    if (data.status = "success") {
                        toastr.success("Record insert successfully");
                        $('#exprince_submit').hide();
                        $('#exprince_button').show();
                        $('#exprince_button').trigger('click');
                    } else {
                        toastr.error(data.message);
                    }

                }
            })
        })
    });

    $(document).on("click", "#project_submit", function() {
        $('#projectForm').submit(function(e) {
            e.stopImmediatePropagation();
            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {
                    console.log('role',data.role);
                    if (data.status == "success") {
                    
                            toastr.success("Record insert successfully");
                        window.location.href = {!!json_encode(url('/')) !!} + "/users";
                      
                     

                    }

                }
            });
        });
    });





    $(function() {
        $("#sortable").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
            iteams: "li",
            cursor: 'move',
            opacity: 0.6,
            update: function(event, ui) {
                var type = 2;
                var order = new Array();
                $('#sortable>li').each(function(index, element) {
                   
                    order.push({
                            id: $(this).attr("id"),
                            position: index + 1,
                            type: 2

                        }

                    );
                });

                updateOrder(order, type);

            }
        });
        $("#primary_sortable").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
            iteams: "li",
            cursor: 'move',
            opacity: 0.6,
            update: function(event, ui) {

                var orderr = new Array();
                $('#primary_sortable>li').each(function(index, element) {
                    console.log('idddd', $(this).attr("id"));
                    var type = 1;
                    orderr.push({
                            id: $(this).attr("id"),
                            position: index + 1,
                            type: 1

                        }

                    );
                });

                updateOrder(orderr, type);

            }
        });

        $("#sortable_lerning").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
            iteams: "li",
            cursor: 'move',
            opacity: 0.6,
            update: function(event, ui) {
                var type = 3;
                var order = new Array();
                $('#sortable_lerning>li').each(function(index, element) {

                    order.push({
                            id: $(this).attr("id"),
                            position: index + 1,
                            type: 3

                        }

                    );
                });
                updateOrder(order, type);
                // updateOrderLerning(order);

            }
        });
        $(".education_more").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
        });
        $(".exp_more").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
        });
        $(".certification_more").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
        });

        $(".ach_more").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
        });
        $(".project_more").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function(event, ui) {
                draggedItem = ui.item;
            },
        });



    });

    function updateOrder(order, type) {
        var token = $('input[name="_token"]').attr('value');
        // var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            user_id: $('.user_id').val(),
            order: order,
            type: type
            // _token: token
        };

        $.ajax({
            type: 'POST',
            url: base_url + '/skills_sorting',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-Token': token
            },

            success: function(data) {

                console.log('test', data);
                if (data.status = "success") {
                    toastr.success("Record insert successfully");

                    // $('#exprince_button').trigger('click');
                } else {
                    toastr.error(data.message);
                }

            }
        })

    }

    function updateOrderLerning(order) {
        var token = $('input[name="_token"]').attr('value');
        // var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            user_id: $('.user_id').val(),
            order: order,
            // _token: token
        };

        $.ajax({
            type: 'POST',
            url: base_url + '/learning_skills_sorting',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-Token': token
            },

            success: function(data) {

                console.log('test', data);
                if (data.status = "success") {
                    toastr.success("Record insert successfully");


                } else {
                    toastr.error(data.message);
                }

            }
        })

    }








    $(window).on('load', function() {

        
        CKEDITOR.replace('miscellaneous', {
            toolbar: [
                // { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                {
                    name: 'editing',
                    items: ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList']
                }
            ]
        });
        CKEDITOR.replace('about_employee', {
            toolbar: [
                // { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                {
                    name: 'editing',
                    items: ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList']
                }
            ]
        });
    
        CKEDITOR.config.toolbar = [
            ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList'],
            ] ;

        CKEDITOR.replace('role_res[]', {
            toolbar: [{
                name: 'editing',
                items: ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList']
            }]
        });
        CKEDITOR.replace('certification[]', {
            toolbar: [{
                name: 'editing',
                items: ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList']
            }]
        });
        CKEDITOR.replace('description[]', {
            toolbar: [{
                name: 'editing',
                items: ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList']
            }]
        });
        CKEDITOR.replace('project_description[]', {
            toolbar: [{
                name: 'editing',
                items: ['Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 'Bold', 'Italic', 'NumberedList', 'BulletedList']
            }]
        });
        CKEDITOR.instances['about_employee'].updateElement();


        // CKEDITOR.replaceAll( 'ckeditor' ); 
        // CKEDITOR.replace('ckeditor');
        // $('.ckeditor').ckeditor();






    });
</script>
@endsection
@endsection