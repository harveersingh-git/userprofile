@extends('admin.layout.head')
@section('title')
Add Daily Performance
@endsection
@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Daily Performance</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('daily-performance')}}">
                                <i class="fa fa-arrow-left"></i> Back </a></span> <span>Add Daily Performance</span>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{$url}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>Name</label>
                                                <input class="form-control" placeholder="Ex:abc" name="title" value="{{old('title')}}" required="" autocomplete="off" />
                                                @error('name')
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
                                                            <input type="text" value="#e01ab5" class="form-control" name="background_color" />
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
                                                            <input type="text" value="#e01ab5" class="form-control" name="font_color" />
                                                            <span class="input-group-addon"><i></i></span>
                                                            @error('font_color')
                                                            <p class="alert alert-danger"> {{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 form-group">
                                                <label>Min</label>
                                                <div class="row">

                                                    <div class="col-md-12 col-sm-12  ">
                                                        <div class="input-group ">
                                                            <input type="text" value="" class="form-control" name="min" min="0"/>
                                                            <span class="input-group-addon"><i></i></span>
                                                            @error('font_color')
                                                            <p class="alert alert-danger"> {{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Max</label>
                                                <div class="row">

                                                    <div class="col-md-12 col-sm-12  ">
                                                        <div class="input-group ">
                                                            <input type="text" value="" class="form-control" name="max" min="1" />
                                                            <span class="input-group-addon"><i></i></span>
                                                            @error('font_color')
                                                            <p class="alert alert-danger"> {{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>Need A Reason</label>
                                                <div class="row">

                                                    <div class="col-md-12 col-sm-12  ">
                                                        <div class="input-group">
                                                            <input type="checkbox" id="need_a_reason" name="need_a_reason" value="1">

                                                            @error('need_a_reason')
                                                            <p class="alert alert-danger"> {{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>







                                    <button type="submit" class="btn btn-info submit_info">Add</button>
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

        if (typeof($.fn.colorpicker) === 'undefined') {
            return;
        }

        $('.demo2').colorpicker();


    };


    $(document).ready(function() {

        init_ColorPicker();


    });
</script>
@endsection
@endsection