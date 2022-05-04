@extends('admin.layout.head')
@section('title')
All services

@endsection
@section('content')
@include('admin.layout.header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet" />

<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">All Services</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">

                </div>

                <div class="pull-right">
                    <form action="{{url('services')}}" method="GET" role="search" autocomplete="off" class="form-inline">
                        <div class="form-group">

                            <input class="form-control" placeholder="Ex:2022" name="year" id="year" value="{{Request::get('year')}}" autocomplete="off" />

                        </div>
                        <div class="form-group">

                            <select class="form-control" name="month" id="month">
                                <option value="">--Select Month--</option>
                                <option value='Janaury' {{ ( Request::get('month') == 'Janaury') ? 'selected' : '' }}>Janaury</option>
                                <option value='February' {{ ( Request::get('month')  == 'February')  ? 'selected' : '' }}>February</option>
                                <option value='March' {{ ( Request::get('month')  =='March') ? 'selected' : '' }}>March</option>
                                <option value='April' {{ ( Request::get('month')  == 'April') ? 'selected' : '' }}>April</option>
                                <option value='May' {{ ( Request::get('month')  == 'May') ? 'selected' : '' }}>May</option>
                                <option value='June' {{ ( Request::get('month')  == 'june') ? 'selected' : '' }}>June</option>
                                <option value='July' {{ ( Request::get('month') == 'July') ? 'selected' : '' }}>July</option>
                                <option value='August' {{ ( Request::get('month')  == 'August') ? 'selected' : '' }}>August</option>
                                <option value='September' {{ ( Request::get('month')  == 'September') ? 'selected' : '' }}>September</option>
                                <option value='October' {{ ( Request::get('month')  == 'October') ? 'selected' : '' }}>October</option>
                                <option value='November' {{ (Request::get('month')  == 'November') ? 'selected' : '' }}>November</option>
                                <option value='December' {{ (Request::get('month')  == 'December') ? 'selected' : '' }}>December</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-default">Search</button>

                            <a type="button" href="{{route('services')}}" class="btn btn-danger btn-default">Clear</a>
                            <!-- <a type="button" href="{{url('clients?client_status=yes')}}" class="btn btn-primary btn-default" target="_blank">Export</a> -->

                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <div class="">
            <div class="form-inline">
            <a data-toggle="tooltip" data-placement="top" title="Resource Status" href="{{url('services?status=0&year=')}}{{request()->get('year')?request()->get('year'):''}}&month={{request()->get('month')?request()->get('month'):''}}" class="btn" style="margin-bottom: 4px; background-color:gray;color:#fff;">All({{$data['All']}}) </a>

                <a data-toggle="tooltip" data-placement="top" title="Resource Status" href="{{url('services?status=Active&year=')}}{{request()->get('year')?request()->get('year'):''}}&month={{request()->get('month')?request()->get('month'):''}}" class="btn" style="margin-bottom: 4px; background-color:#556b2f;color:#fff;">Active({{$data['active']}}) </a>
                <a data-toggle="tooltip" data-placement="top" title="Resource Status" href="{{url('services?status=In-active&year=')}}{{request()->get('year')?request()->get('year'):''}}&month={{request()->get('month')?request()->get('month'):''}}" class="btn" style="margin-bottom: 4px; background-color:#e3963e;color:#fff;">In-active({{$data['In-active']}}) </a>
                <a data-toggle="tooltip" data-placement="top" title="Resource Status" href="{{url('services?status=Completed&year=')}}{{request()->get('year')?request()->get('year'):''}}&month={{request()->get('month')?request()->get('month'):''}}" class="btn" style="margin-bottom: 4px; background-color:#1b1b1b;color:#fff;">Completed({{$data['Completed']}}) </a>



            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="panel-body">
                    <div class="row">

                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center">Sr. No.</th>

                                    <th class="text-center">Client Details</th>
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
                                    @if($value->status=='Active')
                                    <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color:#556b2f "><span style="color:#fff">{{ $key+1 }} </span></td>

                                    @elseif($value->status=='In-active')
                                    <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color:#e3963e "><span style="color:#fff;}}">{{ $key+1 }} </span></td>

                                    @elseif($value->status=='Completed')
                                    <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color:#1b1b1b"><span style="color:#fff">{{ $key+1 }} </span></td>
                                    @else
                                    <td class="text-center" data-toggle="tooltip" data-placement="top">{{ $key+1 }}</td>

                                    @endif

                                    <!-- <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color: {{isset($value->client_type->background_color) ? $value->client_type->background_color:''}}"><span style="color: {{isset($value->client_type->font_color) ? $value->client_type->font_color:'';}}">{{ $key+1 }} </span></td> -->

                                    <td class="text-center">

                                        @if(isset($value['client_details']->client_name))
                                        {{$value['client_details']->client_code}}</br>
                                        {{$value['client_details']->client_name}}
                                        </br>{{$value['client_details']->client_email}}

                                        @endif
                                    </td>
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
                                        <a class="btn btn-warning myac_btn edit_resource" href="{{url('/add-resource')}}/{{$value->client_id}}" data-toggle="tooltip" title="Edit!" id="{{$value->id}}"> <i class="fa fa-edit"></i></button>

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
                        {!! $result->links() !!}
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