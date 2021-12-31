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
                <h1 class="page-header">Edit User</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading">
                    <a class="btn btn-primary"  type="reset" href="{{url('users')}}"><i class="fa fa-arrow-left"></i> Back </a> Edit User
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1 col-lg-10">

                                <form role="form" action="{{url('update-user')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>First Name</label>
                                                <input class="form-control" placeholder="Ex:Jackson" name="first_name" value="{{$user['name']}}" required="" autocomplete="off" />
                                                @error('first_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Last Name</label>
                                                <input class="form-control" placeholder="Ex: roi" name="last_name" value="{{$user['last_name']}}" required="" autocomplete="off" />
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
                                                <input class="form-control" placeholder="Ex:TK0001" name="employee_id" value="{{$user['employee_id']}}" required="" autocomplete="on|off" />
                                                @error('employee_id')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Ex:Jackson@temporary-mail.net" name="email" value="{{$user['email']}}" required="" autocomplete="on|off" />
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
                                                <input type="number" class="form-control" placeholder="Ex:968565472" name="mobile" value="{{$user['mobile']}}" required="" autocomplete="on|off" />
                                                @error('mobile')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Resume title</label>
                                                <input class="form-control" placeholder="Ex:***" name="resume_title" value="{{$user['resume_title']}}" required="" autocomplete="on|off" />
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
                                                <input type="text" class="form-control" placeholder="12/16/2021" name="joining_date" id="joining_date" value="{{$user['joining_date']}}" required="" />
                                                @error('joining_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <label>Shift Time</label>
                                            <div class="row">
                                                <div class="col-lg-3">

                                                    <input type="time" class="form-control" placeholder="EX:877 Mulberry Lane" name="shift_start" value="{{$user['shift_start']}}" required="" autocomplete="on|off" />
                                                    @error('shift_start')
                                                    <p class="alert alert-danger"> {{ $message }} </p>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3">

                                                    <input type="time" class="form-control" placeholder="EX:877 Mulberry Lane" name="shift_end" value="{{$user['shift_end']}}" required="" autocomplete="on|off" />
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
                                                <input type="text" class="form-control" placeholder="EX:PHP/Node" name="team" value="{{$user['team']}}" required="" autocomplete="on|off" />
                                                @error('team')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Total EXP(in year)</label>
                                                <input type="text" class="form-control" placeholder="EX:3.5" name="experience" value="{{$user['experience']}}" required="" autocomplete="on|off" />
                                                @error('experience')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>About Employee </label>
                                        <textarea class="form-control" rows="3" name="about_employee">{{$user['about_employee']}}</textarea>
                                        @error('about_employee')
                                        <p class="alert alert-danger"> {{ $message }} </p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
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