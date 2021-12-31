@extends('Admin.layout.head')
@section('title')
Users
@endsection
@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add User</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <a class="btn btn-outline btn-primary" type="reset" href="{{url('users')}}"><i class="fa fa-arrow-back"></i> Back </a> Add User
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{$url}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>First Name</label>
                                                <input class="form-control" placeholder="Ex:Jackson" name="first_name" value="{{old('first_name')}}" required="" autocomplete="off" />
                                                @error('first_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Last Name</label>
                                                <input class="form-control" placeholder="Ex: roi" name="last_name" value="{{old('last_name')}}" required="" autocomplete="off" />
                                                @error('last_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Employee id</label>
                                                <input class="form-control" placeholder="Ex:TK0001" name="employee_id" value="{{old('employee_id')}}" required="" autocomplete="on|off" />
                                                @error('employee_id')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Ex:Jackson@temporary-mail.net" name="email" value="{{old('email')}}" required="" autocomplete="on|off" />
                                                @error('email')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Mobile</label>
                                                <input type="number" class="form-control" placeholder="Ex:968565472" name="mobile" value="{{old('mobile')}}" required="" autocomplete="on|off" />
                                                @error('mobile')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Resume title</label>
                                                <input class="form-control" placeholder="Ex:***" name="resume_title" value="{{old('resume_title')}}" required="" autocomplete="on|off" />
                                                @error('resume_title')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Joining Date</label>
                                                <input type="text" class="form-control" placeholder="12/16/2021" name="joining_date" id="joining_date" value="{{old('joining_data')}}" required="" />
                                                @error('joining_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <label>Shift Time</label>
                                            <div class="row">
                                                <div class="col-lg-3">

                                                    <input type="time" class="form-control" placeholder="EX:877 Mulberry Lane" name="shift_start" value="{{old('shift_start')}}" required="" autocomplete="on|off" />
                                                    @error('shift_start')
                                                    <p class="alert alert-danger"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3">

                                                    <input type="time" class="form-control" placeholder="EX:877 Mulberry Lane" name="shift_end" value="{{old('shift_end')}}" required="" autocomplete="on|off" />
                                                    @error('shift_end')
                                                    <p class="alert alert-danger"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Team</label>
                                                <input type="text" class="form-control" placeholder="EX:PHP/Node" name="team" value="{{old('team')}}" required="" autocomplete="on|off" />
                                                @error('team')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Total EXP(in year)</label>
                                                <input type="text" class="form-control" placeholder="EX:3.5" name="experience" value="{{old('experience')}}" required="" autocomplete="on|off" />
                                                @error('experience')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>About Employee </label>
                                        <textarea class="form-control" rows="3" name="about_employee">{{old('about_employee')}}</textarea>
                                        @error('about_employee')
                                        <p class="alert alert-danger"> {{ $message }} </p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary submit_info">Add</button>
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
    $(function() {

        $("#joining_date").datepicker();
    });
</script>
@endsection