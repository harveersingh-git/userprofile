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
                <h1 class="page-header">Edit Skills Education</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                    <span class="back_btn"><a type="reset" href="{{url('skills-education')}}"><i class="fa fa-arrow-left"></i> Back </a></span> <span> Edit Skills Education</span>
                    </div>

                  



                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{url('update-skills-education')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label>Value</label>
                                                <input class="form-control" placeholder="Ex:abc" name="value" value="{{$data['value']}}" required="" autocomplete="off" />
                                                @error('value')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Category</label>
                                                <select name="category" id="category" class="form-control">
                                                    <option value="skill" {{$data['category'] == 'skill'  ? 'selected' : ''}}>Skills</option>
                                                    <option value="education" {{$data['category']== 'education'  ? 'selected' : ''}}>Education</option>
                                                    <option value="certificate" {{$data['category'] == 'certificate' ? 'selected' : ''}}>Certificate</option>
                                                    <option value="course"  {{$data['category'] == 'course' ? 'selected' : ''}}>Course</option>
                                                </select>
                                                @error('category')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-6 form-group">
                                                <label>Show on front</label>
                                                <div class="row">

                                                    <div class="col-md-12 col-sm-12  ">
                                                        <div class="input-group">
                                                            <input type="checkbox" id="show_on_front" name="show_on_front" value="1" {{ isset($data['show_on_front']) ? $data['show_on_front'] == '1' ? 'checked=checked' :'' :''}}>

                                                            @error('show_on_front')
                                                            <p class="alert alert-danger"> {{ $message }} </p>
                                                            @enderror
                                                        </div>
                                                    </div>
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