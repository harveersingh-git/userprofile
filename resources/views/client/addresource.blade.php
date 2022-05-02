@extends('admin.layout.head')
@section('title')
Add Resource

@endsection
@section('content')
@include('admin.layout.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />

<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Resource</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('clients')}}">
                                <i class="fa fa-arrow-left"></i> Back </a></span> <span>Add Resource</span>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{$url}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-lg-3 form-group">
                                                <label>Working Resource<span style="color: red;">*</span></label>
                                                <input type="hidden" name="client_name" value="{{$id}}">
                                                <select class="form-control" name="working_user_name" id="workingusers" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['users'] as $key=>$user)

                                                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['last_name']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('name')}}" required="" autocomplete="off" /> -->
                                                @error('working_user_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Front Resource <span style="color: red;">*</span></label>
                                                <select class="form-control" name="hire_user_name" id="hireusers" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['users'] as $key=>$user)

                                                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['last_name']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('name')}}" required="" autocomplete="off" /> -->
                                                @error('hire_user_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Hours<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="Ex: 45" name="hours" id="hours" value="{{old('hours')}}" autocomplete="off" type="number" min="1"/>
                                                @error('hours')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror


                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Work Duration<span style="color: red;">*</span></label>
                                                <select class="form-control" name="work_type" id="" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['workstatus'] as $key=>$type)

                                                    <option value="{{$type['id']}}">{{$type['title']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>

                                                @error('work_type')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Resource Hire Status<span style="color: red;">*</span></label>
                                                <select class="form-control" name="resource_status" id="" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['client_status'] as $key=>$client)

                                                    <option value="{{$client['id']}}">{{$client['title']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                @error('resource_status')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>








                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 form-group ">
                                                <label>Month<span style="color: red;">*</span></label>
                                                <select class="form-control" name="month" id="" required="">
                                                    <option value="">--Please select--</option>
                                                    <option selected value='Janaury'>Janaury</option>
                                                    <option value='February'>February</option>
                                                    <option value='March'>March</option>
                                                    <option value='April'>April</option>
                                                    <option value='May'>May</option>
                                                    <option value='June'>June</option>
                                                    <option value='July'>July</option>
                                                    <option value='August'>August</option>
                                                    <option value='September'>September</option>
                                                    <option value='October'>October</option>
                                                    <option value='November'>November</option>
                                                    <option value='December'>December</option>

                                                </select>
                                                @error('month')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="col-lg-3 form-group form-group datepicker-prsonal_new">
                                                <label>Year <span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="2022" name="year" id="year" value="{{old('year')}}" autocomplete="off" />
                                                @error('year')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="col-lg-3 form-group datepicker-prsonal_new">
                                                <label>Start Date<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="2022-01-13" name="start_date" id="start_date" value="{{old('start_date')}}" required="" autocomplete="off" />
                                                @error('start_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="col-lg-3 form-group form-group datepicker-prsonal_new">
                                                <label>End Date</label>
                                                <input class="form-control" placeholder="2022-01-13" name="end_date" id="end_date" value="{{old('end_date')}}" autocomplete="off" />
                                                @error('end_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn btn-info submit_info">Add</button>
                                </form>
                                </div>
                                </div>

                            <!-- /.col-lg-6 (nested) -->

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">Sr. No.</th>

                                            <th class="text-center" width="18%">Working Resource</th>
                                            <th class="text-center" width="18%">Front Resource</th>
                                            <th class="text-center" width="8%">Hours</th>
                                            <th class="text-center" width="8%">Work Duration</th>
                                            <th class="text-center" width="8%">Resource Hire Status</th>
                                            <th class="text-center" width="8%">Month</th>
                                            <th class="text-center" width="8%">Year</th>
                                            <th class="text-center" width="8%">Start date</th>
                                            <th class="text-center" width="8%">End date</th>
                                            <!-- <th class="text-center" width="12%">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse($result as $key => $value)
                                        <tr>
                                            <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color: {{isset($value->client_type->background_color) ? $value->client_type->background_color:''}}"><span style="color: {{isset($value->client_type->font_color) ? $value->client_type->font_color:'';}}">{{ $key+1 }} </span></td>

                                            <td class="">
                                        
                                                @if(isset($value['working_resource']->name))
                                                {{$value['working_resource']->name}} {{$value['working_resource']->last_name}}-{{$value['working_resource']->employee_id}} {{$value['working_resource']->client_status_value[0]->title}} ({{isset($value['working_resource']['work_status_value'][0]->title)?$value['working_resource']['work_status_value'][0]->title:'N/A'}}),</br>
                                                @endif
                                            

                                            </td>
                                            <td class="">
                                             
                                                @if(isset($value['hire_resource']->name))
                                                {{$value['hire_resource']->name}} {{$value['hire_resource']->last_name}}-{{$value['hire_resource']->employee_id}} {{isset($value['hire_resource']['client_status_value'][0]->title)?$value['hire_resource']['client_status_value'][0]->title:'N/A'}}),</br>
                                                @endif
                                             

                                            </td>
                                            <td class="text-center">{{ $value->hours}}</td>
                                            
                                            <td class="text-center"> {{isset($value['working_resource']['work_status_value'][0]->title)?$value['working_resource']['work_status_value'][0]->title:'N/A'}}</td>
                                            <td class="text-center">{{isset($value['hire_resource']['client_status_value'][0]->title)?$value['hire_resource']['client_status_value'][0]->title:'N/A'}}</td>
                                            <td class="text-center">{{ isset($value->month)?$value->month:'' }}</td>
                                            <td class="text-center">{{ isset($value->year)?$value->year:'' }}</td>
                                            <td class="text-center">{{ $value->start_date}}</td>
                                            <td class="text-center">{{ $value->end_date}}</td>

                                            <!-- <td class="text-center">
        <a class="btn btn-warning myac_btn" href="{{url('/client/edit')}}/{{$value->id}}" data-toggle="tooltip" title="Edit!"> <i class="fa fa-edit"></i></button>

            <a class="delete btn btn-danger myac_btn" id="{{$value->id}}" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></button>
                <a class="btn btn-success  myac_btn" href="{{url('/add-resource')}}/{{$value->id}}" data-toggle="tooltip" title="Add New Resources!"><i class="fa fa-user-plus"></i></button>

    </td> -->
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="13">There are no data.</td>
                                        </tr>
                                        @endforelse



                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('#clients').select2();
            $('#workingusers').select2();
            $('#hireusers').select2();

            $("#start_date").datepicker({
                    format: 'yy-mm-dd',
                    // maxDate: new Date()

                }

            );

            $("#end_date").datepicker({
                format: 'yy-mm-dd',
                // maxDate: new Date()

            });

            $("#year").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
            var today = new Date();
            var startDate = new Date(today.getFullYear(), 6, 1);
            var endDate = new Date(today.getFullYear(), 6, 31);




        });
    </script>
    @endsection
    @endsection