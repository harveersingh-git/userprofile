@extends('admin.layout.head')

@section('content')
@include('admin.layout.header')

Toast::message('message', 'level', 'title');
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn btn-info mb-20" href="{{ url('information') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                        <i class="fa fa-user fa-fw"></i> Add User
                    </a>
                </div>


                <div class="pull-right">
                    <form action="{{url('users')}}" method="GET" role="search" autocomplete="off" class="form-inline">
                        <div class="form-group">

                            <input type="text" class="form-control" name="search" placeholder="empid , name , mobile number" value="{{Request::get('search')}}">
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="client_status">
                                <option value="">--Select client status--</option>
                                @forelse($client_status as $key=>$clientstatus)
                                <option value="{{$clientstatus['id']}}" {{ (Request::get('client_status')) == $clientstatus['id']  ? 'selected' : ''}}>{{$clientstatus['title']}}</option>
                                @empty
                                <option value="">No data found</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">

                            <select class="form-control" name="work_status">
                                <option value="">--Select work status--</option>
                                @forelse($work_type as $key=>$worktype)
                                <option value="{{$worktype['id']}}" {{ (Request::get('work_status')) == $worktype['id']  ? 'selected' : ''}}>{{$worktype['title']}}</option>


                                @empty
                                <option value="">No data found</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">

                            <select class="form-control" name="exprince">
                                <option value="">Range Of experience</option>
                                <option value="0-3" {{ (Request::get('exprince')) == '0-3'  ? 'selected' : ''}}>0 - 3</option>
                                <option value="3-5" {{ (Request::get('exprince')) == '3-5'  ? 'selected' : ''}}>3 - 5</option>
                                <option value="5-10" {{ (Request::get('exprince')) == '5-10'  ? 'selected' : ''}}>5 - 10</option>
                                <option value="10-plus" {{ (Request::get('exprince')) == '10-plus'  ? 'selected' : ''}}>10+</option>

                            </select>
                        </div>

                        <div class="form-group">


                            <select id="multiple-checkboxes" multiple="multiple" name="skills[]">

                                @forelse($technologyes as $key=>$technology)


                                @if(!empty($search_skills) && in_array($technology['value'],$search_skills))
                                <option value="{{$technology['value']}}" selected>{{$technology['value']}}</option>
                                @else
                                <option value="{{$technology['value']}}">{{$technology['value']}}</option>
                                @endif
                                @empty
                                <option value="">No data found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">

                            <select class="form-control" name="type">
                                <option value="">--Skill type--</option>
                                <option value="1" {{ (Request::get('type')) == '1'  ? 'selected' : ''}}>Primary</option>
                                <option value="2" {{ (Request::get('type')) == '2'  ? 'selected' : ''}}>Secondary</option>
                                <option value="3" {{ (Request::get('type')) == '3'  ? 'selected' : ''}}>Learning</option>

                            </select>
                        </div>

                        <button type="submit" class="btn btn-info btn-default">Submit</button>

                        <a type="button" href="{{route('users')}}" class="btn btn-danger btn-default">Clear</a>
                    </form>
                </div>

            </div>
        </div>
        <div class="">
            <div class="form-inline">
                @forelse ($client_status as $status)

                <a href="{{url('/users?client_status=')}}{{$status['id']}}" class="btn" style="margin-bottom: 4px; background-color:{{$status['background_color']}};  color:{{$status['font_color']}};"> {{$status['title']}} {{($status['count'])?$status['count']:0}}</a>
                @empty
                <a class="btn btn-success btn-xs " style="margin-bottom: 4px;"> plese add a new status</a>
                @endforelse

            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span>Users</span>
                        <!-- <div class="col-sm-3 pull-right my_usearch">
                            <form action="{{url('users')}}" method="GET" role="search" autocomplete="off">

                                <div class="input-group">
                                    <input type="text" value="{{ Request::get('search') }}" class="form-control" name="search" placeholder="Search users"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div> -->
                    </div>
                    <!-- /.panel-heading -->



                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Emp Id</th>
                                <th class="text-center"> Name</th>
                                <th class="text-center">Joining Date</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Experience</th>
                               

                                <th class="text-center">Skills</th>
                                <th class="text-center">Time</th>
                                <th class="text-center">Team</th>



                                <th class="text-center" style="width: 14%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr class="text-center">
                                <td style="background-color: {{isset($value->client_status_value['0']->background_color) ? $value->client_status_value['0']->background_color:'';}}  "><span style="color: {{isset($value->client_status_value['0']->font_color) ? $value->client_status_value['0']->font_color:'';}}">{{ $value->employee_id }} </span></td>
                                <td>{{ $value->name }} {{ $value->last_name }} </br> <span style="color: red;font-size: 10px;">{{isset($value->work_status_value['0']->title) ? $value->work_status_value['0']->title:'';}}</span></td>
                                <td>{{ Carbon\Carbon::parse($value->joining_date)->format('d F Y') }}</td>
                                <td>{{ $value->email  }}</td>
                                <td>{{ $value->mobile  }}</td>
                                <td>{{ $value->experience  }}</td>
                            

                                <td>
                                    @if($value->skills->count()>0)
                                    @foreach($value->skills as $key=>$res)
                                    @if($res->type=='1')
                                    <a class="btn btn-success btn-xs " style="margin-bottom: 4px;"> {{isset($res->skills_details['value'])?$res->skills_details['value']:'';}}</a>
                                    @elseif($res->type=='2')
                                    <a class="btn btn-warning btn-xs" style="margin-bottom: 4px;"> {{isset($res->skills_details['value'])?$res->skills_details['value']:''}}</a>

                                    @elseif ($res->type=='3')
                                    <a class="btn btn-default btn-xs" style="margin-bottom: 4px;">{{isset($res->skills_details['value'])?$res->skills_details['value']:''}}</a>

                                    @endif
                                    @endforeach

                                    @endif


                                </td>
                                <td class="text-center">{{ $value->shift_start  }}-{{ $value->shift_end  }}</td>
                                <td class="text-center">{{ isset($value->myTeam->name)?$value->myTeam->name:'' }}</td>
                                

                                <td>
                                    <a class="btn btn-warning myac_btn" href="{{url('/information')}}/{{$value->id}}"><i class="fa fa-edit"></i> </a>

                                    <a class="delete btn btn-danger myac_btn" id="{{$value->id}}"> <i class="fa fa-trash"></i></a>
                                    <a class=" btn btn-primary myac_btn" href="{{url('/resume')}}/{{$value->id}}"><i class="fa fa-cloud-download" aria-hidden="true"></i> </a>
                                    <a class="btn btn-info myac_btn" href="{{url('/view-resume')}}/{{$value->id}}"><i class="fa fa-eye" aria-hidden="true"></i> </a>

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10">There are no data.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                    <div class="pagination-wrapper">
                        {{ $data->links() }}
                    </div>

                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>

    <!-- /.row -->
</div>


@section('script')
<script>
    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "{{url('delete_user')}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: id
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {
                        window.location.reload();
                    }
                })
                //   axios.get(`/api/move_to_trash/${id}`).then(() => {
                //      this.$router.push("/users");
                //     let i = this.users.map((data) => data.id).indexOf(id);
                //     this.users.splice(i, 1);
                //      this.$toaster.success('Record delete successfully.')
                //   });
            } else {
                swal("Your Record safe now!");
            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        $('#multiple-checkboxes').multiselect({
            includeSelectAllOption: true,
        });
    });
</script>
@endsection
@endsection