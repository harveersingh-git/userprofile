@extends('admin.layout.head')
@section('title')
ClickUp Report

@endsection
@section('content')
@include('admin.layout.header')

<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Working Hours</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('/')}}">
                                <i class="fa fa-arrow-left"></i> Back </a></span> <span>Working Hours</span>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{$url}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-lg-3 form-group">
                                            <label>Years<span style="color: red;">*</span></label>
                                            <select class="form-control" name="year" required="" id="year">
                                                <option value="">--Please select--</option>
                                                @forelse($years as $key=>$year)

                                                <option value="{{$year}} " {{($current_year == $year?'selected':'')}}>{{$year}}</option>





                                                @empty
                                                <p>No Year Found</p>
                                                @endforelse

                                            </select>
                                            @error('client_type')
                                            <p class="alert alert-danger"> {{ $message }} </p>
                                            @enderror
                                        </div>
                                        @foreach($months as $key=>$val)
                                        <div class="col-lg-3 form-group">
                                            <label>{{(isset($val->month))?$val->month:$val}}</label>
                                            <input type="hidden" class="form-control" placeholder="Ex:176" name="months[]" value="{{(isset($val->month))?$val->month:$val}}" autocomplete="off" />

                                            <input class="form-control" placeholder="Ex:176" name="hours[]" value="{{isset($val->hours)?$val->hours:''}}" autocomplete="off" type="number" />
                                            @error('client_code')
                                            <p class="alert alert-danger"> {{ $message }} </p>
                                            @enderror
                                        </div>


                                        @endforeach



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
    $('#year').on('change', function() {
   
        location.href = base_url + "/working-hours/" + this.value;
    });
</script>
@endsection
@endsection
