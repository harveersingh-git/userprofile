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
                <h1 class="page-header">Edit Team</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('team')}}">
                        <i class="fa fa-arrow-left"></i> Back </a></span> <span>Edit Team</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{url('update-team')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">

                                    <div class="">
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>Name</label>
                                                <input class="form-control form-group" placeholder="Ex:abc" name="name" value="{{$data['name']}}" required="" autocomplete="off" />
                                                @error('name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                                <label>TL Code</label>
                                                <input class="form-control form-group" placeholder="Ex:TK0123" name="tl_code" value="{{$data['tl_code']}}"  autocomplete="off" />
                                                @error('tl_code')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                                <label>Click Up Team ID</label>
                                                <input class="form-control form-group" placeholder="Ex:123456" name="click_up_team_id" value="{{$data['click_up_team_id']}}" autocomplete="off" />
                                                @error('click_up_team_id')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                                <label>Click Up Access Token</label>
                                                <input class="form-control form-group" placeholder="pk_49441641f_43SO0ZORIP60GBVCVY3H2WHJBSJV1V2D" name="click_up_access_token" value="{{$data['click_up_access_token']}}" autocomplete="off" />
                                                @error('click_up_access_token')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>




                                    <button type="submit" class="btn btn-info submit_info">Update</button>



                                </form>
                            </div>
                            <!-- /.col-lg-6 form-group (nested) -->

                            <!-- /.col-lg-6 form-group (nested) -->
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
@endsection