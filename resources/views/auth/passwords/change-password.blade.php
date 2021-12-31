
@extends('admin.layout.head')
@section('title')
Users
@endsection
@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <h1 class="page-header"> Change Password</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                     <span class="back_btn"><a type="reset" href="{{ url('home') }}"><i class="fa fa-arrow-left"></i> Back</a></span><span> Change Password</span> 
                    </div>
                    <div class="panel-body">
                        
                                <div class="panel_box">
                                    <div class="panel panel-default my_panel">


                                     
                                            @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                            @endif
                                            @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                            @if($errors)
                                            @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger">{{ $error }}</div>
                                            @endforeach
                                            @endif
                                            <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
                                                {{ csrf_field() }}

                                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                                    <label for="new-password" class="col-md-4">Current Password</label>

                                                    <div class="col-md-6">
                                                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                                                        @if ($errors->has('current-password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('current-password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                                    <label for="new-password" class="col-md-4">New Password</label>

                                                    <div class="col-md-6">
                                                        <input id="new-password" type="password" class="form-control" name="new-password" required>

                                                        @if ($errors->has('new-password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('new-password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="new-password-confirm" class="col-md-4">Confirm New Password</label>

                                                    <div class="col-md-6">
                                                        <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            Change Password
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        
                                    </div>
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