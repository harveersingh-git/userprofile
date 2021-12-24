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
            <a type="reset" href="{{ url('users')}}"> Back </a>
        </div>
        <!-- MultiStep Form -->
        <div class="container-fluid" id="">
            <div class="row justify-content-center mt-0">
                <div class="">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">

                        <div class="row">
                            <div class="col-md-12 mx-0">
                                <div id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Personal Infromation</strong></li>
                                        <li id="personal"><strong>Skills & Education</strong></li>
                                        <li id="payment"><strong>Experience</strong></li>
                                        <li id="confirm"><strong>Projects</strong></li>
                                    </ul> <!-- fieldsets -->
                                    <fieldset>
                                        <form action="{{url('add-user')}}" id="genralInfo" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="{{isset($data->id)?$data->id:'' }}">
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>First Name</label>
                                                        <input class="form-control" placeholder="Ex:Jackson" name="first_name" value="{{isset($data->name)?$data->name:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Last Name</label>
                                                        <input class="form-control" placeholder="Ex: roi" name="last_name" value="{{isset($data->last_name)?$data->last_name:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Employee id</label>
                                                        <input class="form-control" placeholder="Ex:TK0001" name="employee_id" value="{{isset($data->employee_id)?$data->employee_id:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" placeholder="Ex:Jackson@temporary-mail.net" name="email" value="{{isset($data->email)?$data->email:'' }}" required="" autocomplete="off"/>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Mobile</label>
                                                        <input type="number" class="form-control" placeholder="Ex:968565472" name="mobile" value="{{isset($data->mobile)?$data->mobile:'' }}" required=""     autocomplete="off"/>

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Resume title</label>
                                                        <input class="form-control" placeholder="Ex:***" name="resume_title" value="{{isset($data->resume_title)?$data->resume_title:'' }}" required="" autocomplete="off" />

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Joining Date</label>
                                                        <input type="text" class="form-control" placeholder="2021-01-02" name="joining_date" id="joining_date" value="{{isset($data->joining_date)?$data->joining_date:'' }}" required="" autocomplete="on|off" />

                                                    </div>
                                                    <label>Shift Time</label>
                                                    <div class="row">
                                                        <div class="col-lg-3">

                                                            <input type="time" class="form-control" placeholder="" name="shift_start" value="{{isset($data->shift_start)?$data->shift_start:'' }}" required="" autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">

                                                            <input type="time" class="form-control" placeholder="" name="shift_end" value="{{isset($data->shift_end)?$data->shift_end:'' }}" required="" autocomplete="on|off" />

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Team</label>
                                                        <input type="text" class="form-control" placeholder="EX:PHP/Node" name="team" value="{{isset($data->team)?$data->team:'' }}" required="" autocomplete="on|off" />

                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Total EXP(in year)</label>
                                                        <input type="text" class="form-control" placeholder="EX:3.5" name="experience" value="{{isset($data->experience)?$data->experience:'' }}" required="" autocomplete="on|off" />

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>About Employee </label>
                                                    <textarea class="form-control" rows="3" name="about_employee">{{isset($data->about_employee)?$data->about_employee:'' }}</textarea>


                                                </div>

                                            </div>
                                            <input type="submit" value="Next Step" class=" action-button" id="genral_info_submit" />

                                        </form>
                                        <input type="button" name="next" style="display: none;" class="next action-button" value="Next Step" id="genral_info_button" />

                                    </fieldset>
                                    <fieldset>
                                        <form action="{{url('add-user-skills')}}" id="skillsForm">
                                            <input type="hidden" value="" name="user_id" class="user_id">
                                            <div class="form-card">
                                                <h2 class="fs-title">Skills</h2>

                                                <div class="row">
                                                    <div class="col-lg-3">

                                                        <select class="selectpicker" multiple data-live-search="true" data-style="form-control" name="skill_value_id[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                            @forelse($allskills as $key=>$dat)
                                                            @if(isset($selectedSkills) && in_array($dat['id'],$selectedSkills))
                                                            <option value="{{$dat['id']}}" selected>{{$dat['value']}}</option>
                                                           @else
                                                           <option value="{{$dat['id']}}" >{{$dat['value']}}</option>
                                                           @endif
                                                           @empty
                                                            <p>No replies</p>
                                                            @endforelse

                                                        </select>

                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="hidden" name="drag_user_id" id="drag_user_id" value="{{isset($data->id)?$data->id:'' }}">
                                                        <ul id="sortable">
                                                            @if(isset($data->skills))
                                                            @forelse($data->skills as $key=>$dat)
                                                            <li class="ui-state-default" style="margin: 4px;" id="{{$dat['id']}}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> {{$dat['skills_details']['value']}}</li>
                                                            @empty
                                                            <p>No Skills</p>
                                                            @endforelse
                                                            @endif
                                                        </ul>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <label>Learning Skills</label>
                                                        <select class="selectpicker" multiple data-live-search="true" data-style="form-control" name="learning_skills[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                        @forelse($allskills as $key=>$dat)
                                                            @if(isset($selectedLearningSkills) && in_array($dat['id'],$selectedLearningSkills))
                                                            <option value="{{$dat['id']}}" selected>{{$dat['value']}}</option>
                                                           @else
                                                           <option value="{{$dat['id']}}" >{{$dat['value']}}</option>
                                                           @endif
                                                           @empty
                                                            <p>No replies</p>
                                                            @endforelse

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <input type="hidden" name="drag_user_id" id="drag_user_id" value="{{isset($data->id)?$data->id:'' }}">
                                                        <ul id="sortable_lerning">
                                                            @if(isset($data->learning_skills))
                                                            @forelse($data->learning_skills as $key=>$dat)

                                                            <li class="ui-state-default" style="margin: 4px;" id="{{$dat['id']}}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> {{$dat['skills_details']['value']}}</li>

                                                            @empty
                                                            <p>No Skills</p>
                                                            @endforelse
                                                            @endif
                                                        </ul>
                                                    </div>


                                                </div>
                                                <h2 class="fs-title">Education</h2>
                                                <div class="education_more">
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-3">
                                                        

                                                        <!-- <input type="hidden" name="order[]" value="1"> -->
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Type</label>
                                                            <select class="form-control" aria-label="Default select example" name="edu_type[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                <option value="">--Please select--</option>
                                                                @forelse($education as $key=>$dat)
                                                                <option value="{{$dat['id']}}" >{{$dat['value']}}</option>
                                                                @empty
                                                                <p>No replies</p>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Title</label>
                                                            <select class="form-control" aria-label="Default select example" name="edu_title[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                <option value="">--Please select--</option>
                                                                <option value="1">BBA</option>
                                                                <option value="2">BCA</option>
                                                                <option value="3">B.Come</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label>From</label>

                                                            <input type="text" class="form-control edu_to" placeholder="12-17-2021" name="edu_from[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>To</label>
                                                            <input type="text" class="form-control edu_from" placeholder="12-17-2021" name="edu_to[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="off" />

                                                        </div>
                                                    </div>
                                                    @if(isset($data->education) && (count($data->education)>0))
                                                    @foreach($data->education as $key=>$value)
                                                    <div class="row" order="{{$value['order']}}">
                                                        <div class="col-lg-3">
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Type</label>
                                                            <select class="form-control" aria-label="Default select example" name="edu_type[]" required="">
                                                           
                                                            @forelse($education as $key=>$dat)
                                                               
                                                                @if($dat['id']==$value['degree_type_id'])
                                                                        <option value="{{$dat['id']}}" selected>{{$dat['value']}} </option>
                                                                    @else
                                                                    <option value="{{$dat['id']}}" >{{$dat['value']}}</option>
                                                                    @endif
                                                                @empty
                                                                    <p>No replies</p>
                                                                    @endforelse
                                                               
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label>Title</label>
                                                            <select class="form-control" aria-label="Default select example" name="edu_title[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                <option value="1" {{ isset($value['education_title_id']) == '1'  ? 'selected' : ''}}>BBA</option>
                                                                <option value="2" {{ isset($value['education_title_id']) == '2'  ? 'selected' : ''}}>BCA</option>
                                                                <option value="3" {{ isset($value['education_title_id']) == '3'  ? 'selected' : ''}}>B.Come</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>From</label>
                                                            <input type="text" class="form-control edu_to" placeholder="12-17-2021" name="edu_from[]" value="{{ isset($value['from'])?$value['from']:''}}" required="" autocomplete="off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>To</label>
                                                            <input type="text" class="form-control edu_from" placeholder="12-17-2021" name="edu_to[]" value="{{ isset($value['to'])?$value['to']:''}}" required="" autocomplete="off" />

                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif



                                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>

                                                </div>


                                            </div>

                                            <input type="submit" value="Next Step" class=" action-button" id="skills_submit" />

                                        </form>
                                        <input type="button" id="skills_prev" name="previous" class="previous action-button-previous" value="Previous" />

                                        <input type="button" style="display:none" name="next" class="next action-button" value="Next Stepp" id="skills_button" />

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
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Companay Name</label>
                                                            <input type="text" class="form-control" placeholder="XYZ" name="company_name[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Designation</label>
                                                            <input type="text" class="form-control" placeholder="Team leader" name="designation[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label>From</label>
                                                            <input type="text" class="form-control exp_from" placeholder="2021-12-19" name="exp_from[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>To</label>
                                                            <input type="text" class="form-control exp_to" placeholder="2021-12-19" name="exp_to[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Role and Responsibilities </label>
                                                                <textarea class="form-control" rows="3" name="role_res[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>

                                                    @if(isset($data->exprince) && count($data->exprince)>0)

                                                    @foreach($data->exprince as $key=>$value)
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Companay Name</label>
                                                            <input type="text" class="form-control" placeholder="XYZ" name="company_name[]" value="{{ isset($value['company_name'])?$value['company_name']:''}}" required="" autocomplete="off" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>Designation</label>
                                                            <input type="text" class="form-control" placeholder="Team leader" name="designation[]" value="{{ isset($value['designation'])?$value['designation']:''}}" required="" autocomplete="on" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>From</label>
                                                            <input type="text" class="form-control exp_from" placeholder="2021-12-19" name="exp_from[]" value="{{ isset($value['from'])?$value['from']:''}}" required="" autocomplete="on" />

                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label>To</label>
                                                            <input type="text" class="form-control exp_to" placeholder="2021-12-19" name="exp_to[]" value="{{ isset($value['to'])?$value['to']:''}}" required="" autocomplete="on|off" />

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Role and Responsibilities </label>
                                                                    <textarea class="form-control ckeditor" rows="3" name="role_res[]" required="">{{ isset($value['role_responsibilitie'])?$value['role_responsibilitie']:''}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    @endforeach


                                                    @endif
                                                    <a href="javascript:void(0);" class="exp_add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>

                                                </div>

                                                <div class="certification_more">
                                                <div>
                                                 <div class="row">
                                                        <div class="col-lg-4">
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Type</label>
                                                                <select class="form-control" aria-label="Default select example" name="certification_type[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                    <option value="">--Please select--</option>
                                                                    @forelse($certificate as $key=>$dat)
                                                                    <option value="{{$dat['id']}}" >{{$dat['value']}}</option>
                                                                    @empty
                                                                    <p>No replies</p>
                                                                    @endforelse
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>
                                                                Certification </label>
                                                                <textarea class="form-control" rows="3" name="certification[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($data->certification) && count($data->certification)>0)
                                                    @foreach($data->certification as $key=>$value)
                                                    <div>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                        <label><i class="fa fa-arrows" aria-hidden="true"></i>Type</label>
                                                            <select class="form-control" aria-label="Default select example" name="certification_type[]" {{ isset($data->id)  ? '' : 'required=""'}}>
                                                                <option value="">--Please select--</option>
                                                                @forelse($certificate as $key=>$dat)
                                                                @if($dat['id']==$value['certifications_value_id'])
                                                                    <option value="{{$dat['id']}}" selected>{{$dat['value']}} </option>
                                                                    @else
                                                                    <option value="{{$dat['id']}}" >{{$dat['value']}}</option>
                                                                @endif
                                                                @empty
                                                                <p>No replies</p>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label><i class="fa fa-arrows" aria-hidden="true"></i>
                                                                    Certification </label>
                                                                <textarea class="form-control ckeditor" rows="3" name="certification[]">{{ isset($value['certification'])?$value['certification']:''}} </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    @endforeach


                                                    @endif
                                                    <a href="javascript:void(0);" class="certification_add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                  
                                                </div>


                                            </div>
                                            <input type="submit" value="Next Step" class=" action-button" id="exprince_submit" />

                                        </form>
                                        <input type="button" name="previous" id="exprince_prev" class="previous action-button-previous" value="Previous" />

                                        <input type="button" name="make_payment" style="display:none" class="next action-button" value="Next Step" id="exprince_button" />
                                    </fieldset>
                                    <fieldset>
                                        <form action="{{url('add-user-project')}}" id="projectForm">

                                            <input type="hidden" value="" name="user_id" class="user_id">

                                            <div class="form-card">


                                               

                                                <div class="row ach_more">
                                                        <h2 class="fs-title">Achievement</h2>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label><i class="fa fa-arrows" aria-hidden="true"></i>Title </label>
                                                            <input type="text" class="form-control" placeholder="EX:abc" name="title[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label>Achievement Description </label>
                                                            <textarea class="form-control " rows="3" name="description[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>

                                                        </div>
                                                    </div>
                                                        @if(isset($data->achievement) && count($data->achievement)>0)
                                                    @foreach($data->achievement as $key=>$value)
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <label>Title </label>
                                                            <input type="text" class="form-control" placeholder="EX:abc" name="title[]" value="{{ isset($value['title'])?$value['title']:''}}" required="" autocomplete="on" />

                                                        </div>
                                                        <div class="col-lg-12">
                                                            <label>Achievement Description </label>
                                                            <textarea class="form-control ckeditor" rows="3" name="description[]">{{ isset($value['description'])?$value['description']:''}}</textarea>

                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    @endif
                                                        <a href="javascript:void(0);" class="ach_add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                       
                                                </div>
                                                      

                                               


                                                <div class="project_more">
                                                    <h2 class="fs-title">Project</h2>
                                                    <div class="row">
                                                       
                                                            <div class="col-lg-3">
                                                                <label>Project Name</label>
                                                                <input type="text" class="form-control" placeholder="XYZ" name="project_name[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Project Skills</label>
                                                                <input type="text" class="form-control" placeholder="php,node etc" name="project_skills[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>


                                                            <div class="col-lg-3">
                                                                <label>Team Size</label>
                                                                <input type="text" class="form-control" placeholder="1" name="team_size[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Url</label>
                                                                <input type="text" class="form-control" placeholder="https://github.com/" name="url[]" value="" {{ isset($data->id)  ? '' : 'required=""'}} autocomplete="on|off" />

                                                            </div>
                                                            <div class="row">
                                                            <label>Project Description</label>
                                                            <textarea class="form-control" rows="3" name="project_description[]" {{ isset($data->id)  ? '' : 'required=""'}}></textarea>


                                                        </div>
                                                        </div>
                                          
                                                    <a href="javascript:void(0);" class="project_add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    @if(isset($data->project) && count($data->project)>0)
                                                    @foreach($data->project as $key=>$value)
                                                    <div class="row">
                                                            <div class="col-lg-3">
                                                                <label>Project Name</label>
                                                                <input type="text" class="form-control" placeholder="XYZ" name="project_name[]" value="{{ isset($value['project_name'])?$value['project_name']:''}}" required="" autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Project Skills</label>
                                                                <input type="text" class="form-control" placeholder="php,node etc" name="project_skills[]" value="{{ isset($value['project_skills'])?$value['project_skills']:''}}" required="" autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Team Size</label>
                                                                <input type="text" class="form-control" placeholder="1" name="team_size[]" value="{{ isset($value['team_size'])?$value['team_size']:''}}" required="" autocomplete="on|off" />

                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Url</label>
                                                                <input type="text" class="form-control" placeholder="1" name="url[]" value="{{ isset($value['url'])?$value['url']:''}}" required="" autocomplete="on|off" />


                                                            </div>
                                                            <div class="row">
                                                            <label>Project Description</label>
                                                            <textarea class="form-control ckeditor" rows="3" name="project_description[]" required="">{{ isset($value['project_description'])?$value['project_description']:''}}</textarea>


                                                        </div>
                                                        </div>
                                                  

                                                    @endforeach
                                                    @endif
                                                 </div>
                                            


                                            </div>
                                            <input type="submit" value="Confirm" class=" action-button" id="project_submit" />
                                        </form>
                                        <input type="button" id="project_previous" name="previous" class="previous action-button-previous" value="Previous" />
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
    $('#genralInfo').submit(function(e) {
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
                console.log('test', data);
                if (data.status == true) {
                    toastr.success("Record insert successfully");
                    $('.user_id').val(data.last_insert_id);
                    $('#genral_info_submit').hide();
                    $('#genral_info_button').show();
                    $('#genral_info_button').trigger('click');
                } else {
                    toastr.error(data.message);
                }

            }
        })
    })

    $('#skillsForm').submit(function(e) {
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

    $('#exprinceForm').submit(function(e) {
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

    $('#projectForm').submit(function(e) {
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
                    window.location.href = {!! json_encode(url('/')) !!}+"/users"

                }

            }
        })
    });


    $(function() {
        $("#sortable").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
            iteams: "li",
            cursor: 'move',
            opacity: 0.6,
            update: function(event, ui) {

                var order = new Array();
                $('#sortable>li').each(function(index, element) {
                    console.log('idddd', $(this).attr("id"));
                    order.push({
                            id: $(this).attr("id"),
                            position: index + 1,

                        }

                    );
                });

                updateOrder(order);

            }
        });

        $("#sortable_lerning").sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
            iteams: "li",
            cursor: 'move',
            opacity: 0.6,
            update: function(event, ui) {

                var order = new Array();
                $('#sortable_lerning>li').each(function(index, element) {
                    
                    order.push({
                            id: $(this).attr("id"),
                            position: index + 1,

                        }

                    );
                });

                updateOrderLerning(order);

            }
        });
        $( ".education_more" ).sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
        });
        $( ".exp_more" ).sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
        });
        $( ".certification_more" ).sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
        });
        
        $( ".ach_more" ).sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
        });
        $( ".project_more" ).sortable({
            connectWith: '.container',
            placeholder: "ui-state-highlight",
            beforeStop: function (event, ui) { draggedItem = ui.item;},
        });

        

    });

    function updateOrderLerning(order) {
        var token = $('input[name="_token"]').attr('value');
        // var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            user_id: $('#drag_user_id').val(),
            order: order,
            // _token: token
        };

        $.ajax({
            type: 'POST',
            url: '/learning_skills_sorting',
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
    function updateOrder(order) {
        var token = $('input[name="_token"]').attr('value');
        // var token = $('meta[name="csrf-token"]').attr('content');
        var data = {
            user_id: $('#drag_user_id').val(),
            order: order,
            // _token: token
        };

        $.ajax({
            type: 'POST',
            url: '/skills_sorting',
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
    $(window).on('load', function() {
        CKEDITOR.replace('about_employee');

        CKEDITOR.replace('role_res[]');
        CKEDITOR.replace('certification[]');
        CKEDITOR.replace('description[]');
        CKEDITOR.replace('project_description[]');
        // CKEDITOR.replaceAll( 'ckeditor' ); 
        // CKEDITOR.replace('ckeditor');
        // $('.ckeditor').ckeditor();






    });
</script>
@endsection