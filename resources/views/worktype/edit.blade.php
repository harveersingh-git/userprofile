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
                <h1 class="page-header">Edit Work Type</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('work-type')}}">
                        <i class="fa fa-arrow-left"></i> Back </a></span> <span>Edit Work Type</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                            <form role="form" action="{{url('update-work-type')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">

                                    <div class="">
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>Name</label>
                                                <input class="form-control" placeholder="Ex:abc" name="title" value="{{$data['title']}}" required="" autocomplete="off" />
                                                @error('title')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                            <label>Background Color</label>
                                                <div class="row">
                                                    
                                                    <div class="col-md-12 col-sm-12  ">
                                                        <div class="input-group demo2">
                                                            <input type="text" value="{{$data['background_color']}}" class="form-control" name="background_color" />
                                                            <span class="input-group-addon"><i></i></span>
                                                            @error('background_color')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                            <label>Font Color</label>
                                                <div class="row">
                                                    
                                                    <div class="col-md-12 col-sm-12  ">
                                                        <div class="input-group demo2">
                                                            <input type="text" value="{{$data['font_color']}}" class="form-control" name="font_color"/>
                                                            <span class="input-group-addon"><i></i></span>
                                                            @error('font_color')
                                                             <p class="alert alert-danger"> {{ $message }} </p>
                                                             @enderror
                                                        </div>
                                                    </div>
                                                </div>


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
 function init_ColorPicker() {

if (typeof ($.fn.colorpicker) === 'undefined') { return; }

$('.demo2').colorpicker();


};


$(document).ready(function () {

init_ColorPicker();


});	
</script>
@endsection
@endsection