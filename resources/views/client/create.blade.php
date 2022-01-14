@extends('admin.layout.head')
@section('title')
Add Skills Education
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
                                            <div class="col-lg-6">
                                                <label>Name</label>
                                                <select class="form-control" name="user_name" id="users" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['users'] as $key=>$user)
                                                
                                                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['last_name']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('name')}}" required="" autocomplete="off" /> -->
                                                @error('user_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Emp Status</label>
                                                <select class="form-control" name="emp_status" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['client_status'] as $key=>$status)

                                                    <option value="{{$status['id']}}">{{$status['title']}}</option>


                                                    @empty
                                                    <p>No client Status Found</p>
                                                    @endforelse

                                                </select>
                                                @error('emp_status')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Client Code</label>
                                                <input class="form-control" placeholder="Ex:TK0987" name="client_code" value="{{old('client_code')}}" required="" autocomplete="off" />
                                                @error('client_code')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Client Name</label>
                                                <input class="form-control" placeholder="Ex:abc" name="client_name" value="{{old('client_name')}}" required="" autocomplete="off" />
                                                @error('client_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Client Email</label>
                                                <input type="email" class="form-control" placeholder="Ex:abc@gmail.com" name="client_email" value="{{old('client_email')}}" required="" autocomplete="off" />
                                                @error('client_email')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Work Type</label>
                                                <select class="form-control" name="work_type" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['workstatus'] as $key=>$worktype)

                                                    <option value="{{$worktype['id']}}">{{$worktype['title']}}</option>


                                                    @empty
                                                    <p>No Work type Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('client_name')}}" required="" autocomplete="off" /> -->
                                                @error('work_type')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="row">
                                        <div class="col-lg-6">
                                                <label>Hours</label>
                                                <input type="number" class="form-control" placeholder="Ex:152" name="hours" value="{{old('hours')}}" required="" autocomplete="off" />
                                                @error('hours')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Team Leader</label>
                                                <select class="form-control" name="team_leader" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['team'] as $key=>$team)

                                                    <option value="{{$team['id']}}">{{$team['name']}}-{{$team['tl_code']}}</option>


                                                    @empty
                                                    <p>No Work type Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('client_name')}}" required="" autocomplete="off" /> -->
                                                @error('team_leader')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="row">
                                           
                                            <div class="col-lg-6 datepicker-prsonal_new" >
                                                <label>Start Date</label>
                                                <input class="form-control" placeholder="2022-01-13" name="start_date" id="start_date" value="{{old('start_date')}}" required="" autocomplete="off" />
                                                @error('start_date')
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

        $("#start_date").datepicker(
        {
            dateFormat: 'yy-mm-dd',
            // maxDate: new Date()
           
        }

    );
    });
</script>
@endsection
@endsection