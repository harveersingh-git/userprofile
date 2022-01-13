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

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Name</label>
                                                <input class="form-control" placeholder="Ex:abc" name="name" value="{{$data['name']}}" required="" autocomplete="off" />
                                                @error('name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                                <label>TL Code</label>
                                                <input class="form-control" placeholder="Ex:TK0123" name="tl_code" value="{{$data['tl_code']}}"  autocomplete="off" />
                                                @error('tl_code')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                    </div>




                                    <button type="submit" class="btn btn-info submit_info">Update</button>



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
@endsection