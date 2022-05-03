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
                                            <input type="hidden" name="resource_id" id="resource_id" value="{{old('resource_id')}}">

                                            <div class="col-lg-3 form-group">
                                                <label>Working Resource<span style="color: red;">*</span></label>
                                                <input type="hidden" name="client_name" value="{{$id}}">
                                                <select class="form-control" name="working_user_name" id="workingusers" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['users'] as $key=>$user)

                                                    <option value="{{$user['id']}}" {{ ( $user['id'] == old('working_user_name')) ? 'selected' : '' }}>{{$user['name']}} - {{$user['last_name']}}</option>


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

                                                    <option value="{{$user['id']}}" {{ ( $user['id'] == old('hire_user_name')) ? 'selected' : '' }}>{{$user['name']}} - {{$user['last_name']}}</option>


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
                                                <input class="form-control" placeholder="Ex: 45" name="hours" id="hours" value="{{old('hours')}}" autocomplete="off" type="number" min="1" />
                                                @error('hours')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror


                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Work Duration<span style="color: red;">*</span></label>
                                                <select class="form-control" name="work_type" id="work_type" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['workstatus'] as $key=>$type)

                                                    <option value="{{$type['id']}}" {{ ( $type['id'] == old('work_type')) ? 'selected' : '' }}>{{$type['title']}}</option>


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
                                                <select class="form-control" name="resource_status" id="resource_status" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['client_status'] as $key=>$client)

                                                    <option value="{{$client['id']}}" {{ ( $client['id'] == old('resource_status')) ? 'selected' : '' }}>{{$client['title']}}</option>


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
                                            <div class="col-lg-2 form-group ">
                                                <label>Month<span style="color: red;">*</span></label>
                                                <select class="form-control" name="month" id="month" required="">
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

                                            <div class="col-lg-2 form-group form-group datepicker-prsonal_new">
                                                <label>Year <span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="2022" name="year" id="year" value="{{old('year')}}" autocomplete="off" />
                                                @error('year')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 form-group">
                                                <label>Service Id<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="Ex: 12345" name="service_id" id="service_id" value="{{old('service_id')}}" autocomplete="off" type="text" min="1" />
                                                @error('service_id')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror


                                            </div>

                                            <div class="col-lg-2 form-group datepicker-prsonal_new">
                                                <label>Start Date<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="2022-01-13" name="start_date" id="start_date" value="{{old('start_date')}}" required="" autocomplete="off" />
                                                @error('start_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                            <div class="col-lg-2 form-group form-group datepicker-prsonal_new">
                                                <label>End Date</label>
                                                <input class="form-control" placeholder="2022-01-13" name="end_date" id="end_date" value="{{old('end_date')}}" autocomplete="off" />
                                                @error('end_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-2 form-group ">
                                                <label>Status<span style="color: red;">*</span></label>
                                                <select class="form-control" name="status" id="status" required="">
                                                    <option value="">--Please select--</option>
                                                    <option selected value='Active'>Active</option>
                                                    <option value='In-active'>In-active</option>
                                                    <option value='Completed'>Completed</option>


                                                </select>
                                                @error('month')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-3 form-group form-group " id="button_div">
                                            @if(!empty(old('resource_id')))
                                            <button type="submit" class="btn btn-info " id="add">Add</button>
                                            <a href="javascript:window.location.href=window.location.href" class="btn btn-danger " id="add">Reset </a>
                                            @else
                                            <button type="submit" class="btn btn-info " id="add">Add</button>
                                            @endif

                                        </div>

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
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Working Resource</th>
                                    <th class="text-center">Front Resource</th>
                                    <th class="text-center">Hours</th>
                                    <th class="text-center">Work Duration</th>
                                    <th class="text-center">Resource Hire Status</th>
                                    <th class="text-center">Month</th>
                                    <th class="text-center">Year</th>
                                    <th class="text-center">Start date</th>
                                    <th class="text-center">End date</th>
                                    <th class="text-center" width="12%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse($result as $key => $value)
                                <tr>

                                    <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color: {{isset($value->client_type->background_color) ? $value->client_type->background_color:''}}"><span style="color: {{isset($value->client_type->font_color) ? $value->client_type->font_color:'';}}">{{ $key+1 }} </span></td>
                                    <td class="text-center">{{ $value->status}}</td>
                                    <td class="text-center">

                                        @if(isset($value['working_resource']->name))
                                        {{$value['working_resource']->name}} {{$value['working_resource']->last_name}}-{{$value['working_resource']->employee_id}} </br> {{$value['working_resource']->client_status_value[0]->title}} ({{isset($value['working_resource']['work_status_value'][0]->title)?$value['working_resource']['work_status_value'][0]->title:'N/A'}}),</br>
                                        @endif


                                    </td>
                                    <td class="text-center">

                                        @if(isset($value['hire_resource']->name))
                                        {{$value['hire_resource']->name}} {{$value['hire_resource']->last_name}}-{{$value['hire_resource']->employee_id}} </br> {{isset($value['hire_resource']['client_status_value'][0]->title)?$value['hire_resource']['client_status_value'][0]->title:'N/A'}}),</br>
                                        @endif


                                    </td>
                                    <td class="text-center">{{ $value->hours}}</td>

                                    <td class="text-center"> {{isset($value['working_resource']['work_status_value'][0]->title)?$value['working_resource']['work_status_value'][0]->title:'N/A'}}</td>
                                    <td class="text-center">{{isset($value['hire_resource']['client_status_value'][0]->title)?$value['hire_resource']['client_status_value'][0]->title:'N/A'}}</td>
                                    <td class="text-center">{{ isset($value->month)?$value->month:'' }}</td>
                                    <td class="text-center">{{ isset($value->year)?$value->year:'' }}</td>
                                    <td class="text-center">{{ $value->start_date}}</td>
                                    <td class="text-center">{{ ($value->end_date)?$value->end_date:'continue'}}</td>

                                    <td class="text-center">
                                        <a class="btn btn-warning myac_btn edit_resource" href="javascript:void(0)" data-toggle="tooltip" title="Edit!" id="{{$value->id}}"> <i class="fa fa-edit"></i></button>

                                            <a class="delete btn btn-danger myac_btn" id="{{$value->id}}" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></button>
                                                <!-- <a class="btn btn-success  myac_btn" href="{{url('/add-resource')}}/{{$value->id}}" data-toggle="tooltip" title="Add New Resources!">
                                                    <i class="fa fa-user-plus"></i> -->
                                                </button>

                                    </td>
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


    counter = 0;
    $(document).on('click', '.edit_resource', function() {
        id = $(this).attr('id');
        var current = $(this);


        $.ajax({
            type: "POST",
            url: "{{url('edit_resource')}}",
            data: {
                _token: '{{csrf_token()}}',
                id: id
            },
            beforeSend: function() {

            },
            success: function(data) {

                if (counter <= 0) {
                    $('#button_div').append('<a href="javascript:window.location.href=window.location.href" class="btn btn-danger " id="add">Reset </a>');
                    counter++;
                }
                $('#resource_id').val(data.data.id);
                $('#workingusers').val(data.data.working_user_id).trigger("change");
                $('#hireusers').val(data.data.hire_user_id).trigger("change");
                $('#status').val(data.data.status).trigger("change");
                $('#hours').val(data.data.hours);
                $('#resource_status').val(data.data.hours);
                $('#work_type').val(data.data.hours);
                $('#month').val(data.data.month);
                $('#year').val(data.data.year);
                $('#start_date').val(data.data.start_date);
                $('#end_date').val(data.data.end_date);
                $('#work_type').val(data.data.working_resource.work_type);
                $('#resource_status').val(data.data.working_resource.client_status);
                $('#service_id').val(data.data.service_id);
                $('#add').text('Update');

            }
        })

    });


    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        var current = $(this);
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
                    url: "{{url('delete_resource')}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: id
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {
                        $(current).closest('tr').remove();

                    }
                })

            } else {
                swal("Your Record safe now!");
            }
        });

    });
</script>
@endsection
@endsection