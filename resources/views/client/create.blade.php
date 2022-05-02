@extends('admin.layout.head')
@section('title')
Add Client

@endsection
@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Client</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('clients')}}">
                                <i class="fa fa-arrow-left"></i> Back </a></span> <span>Add Client</span>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{$url}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-lg-3 form-group">
                                                <label>Client Status<span style="color: red;">*</span></label>
                                                <select class="form-control" name="client_type" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['client_type'] as $key=>$status)
                                                    @if (old('client_type') == $status['id'])

                                                    <option value="{{$status['id']}}" selected>{{$status['title']}}</option>
                                                    @else
                                                    <option value="{{$status['id']}} ">{{$status['title']}}</option>
                                                    @endif




                                                    @empty
                                                    <p>No client Status Found</p>
                                                    @endforelse

                                                </select>
                                                @error('client_type')
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
                                            <div class="col-lg-3 form-group">
                                                <label>Hours<span style="color: red;">*</span></label>
                                                <input type="number" class="form-control" placeholder="Ex:152" name="hours" value="{{old('hours')}}" required="" autocomplete="off" />
                                                @error('hours')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>



                                        </div>


                                        <div class="row">
                                            <div class="col-lg-3 form-group">
                                                <label>Client Code<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="Ex:TK0987" name="client_code" value="{{old('client_code')}}" required="" autocomplete="off" />
                                                @error('client_code')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Client Name<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="Ex:abc" name="client_name" value="{{old('client_name')}}" required="" autocomplete="off" />
                                                @error('client_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Client Email<span style="color: red;">*</span></label>
                                                <input type="email" class="form-control" placeholder="Ex:abc@gmail.com" name="client_email" value="{{old('client_email')}}" required="" autocomplete="off" />
                                                @error('client_email')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Work duration<span style="color: red;">*</span></label>
                                                <input type="number" class="form-control" placeholder="Ex:152" name="hours_cunsumed" value="{{old('hours_cunsumed')}}" required="" autocomplete="off" />
                                                @error('hours_cunsumed')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>




                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 form-group">
                                                <label>Month<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="Ex:5" name="month" value="{{old('month')}}" required="" autocomplete="off" />
                                                @error('month')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Year<span style="color: red;">*</span></label>
                                                <input class="form-control" placeholder="Ex:5" name="year" value="{{old('year')}}" required="" autocomplete="off" />
                                                @error('year')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>







                                    <button type="submit" class="btn btn-info submit_info">Add</button>
                                </form>
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
                                            @forelse($value['client_resource'] as $index=>$res)
                                            @if(isset($res['working_resource']->name))
                                            {{$res['working_resource']->name}} {{$res['working_resource']->last_name}}-{{$res['working_resource']->employee_id}} {{$res['working_resource']->client_status_value[0]->title}} ({{$res['working_resource']->work_status_value[0]->title}}),</br>
                                            @endif
                                            @empty
                                            <p>No Resource available yet</p>
                                            @endforelse

                                        </td>
                                        <td class="">
                                            @forelse($value['client_resource'] as $index=>$res)
                                            {{$res['hire_resource']->name}} {{$res['hire_resource']->last_name}}-{{$res['hire_resource']->employee_id}} {{$res['hire_resource']->client_status_value[0]->title}} ({{$res['hire_resource']->work_status_value[0]->title}}),</br>

                                            @empty
                                            <p>No Resource available yet</p>
                                            @endforelse

                                        </td>
                                        <td class="text-center">{{ $value->hours}}</td>
                                        <td class="text-center">{{ $value->hours_cunsumed}}</td>
                                        <td class="text-center">{{ isset($value->client_type->title) ? $value->client_type->title:''}}</td>
                                        <td class="text-center">{{ isset($value->month)?$value->month:'' }}</td>
                                        <td class="text-center">{{ isset($value->year)?$value->year:'' }}</td>
                                        <td class="text-center">{{ $value->starting_date}}</td>
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
<script>
    $(document).ready(function() {
        $('#users').select2();

        $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd',
                // maxDate: new Date()

            }

        );

        $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd',
                // maxDate: new Date()

            }

        );
    });
</script>
@endsection
@endsection