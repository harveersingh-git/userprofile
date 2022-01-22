@extends('admin.layout.head')
@section('title')
Add Resource

@endsection
@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Resource</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('clients')}}">
                                <i class="fa fa-arrow-left"></i> Back </a></span> <span>Add Resource</span>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{$url}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-lg-3 form-group">
                                                <label>Working Resource<span style="color: red;">*</span></label>
                                                <input type="hidden" name="client_name" value="{{$id}}">
                                                <select class="form-control" name="working_user_name" id="workingusers" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['users'] as $key=>$user)

                                                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['last_name']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('name')}}" required="" autocomplete="off" /> -->
                                                @error('working_user_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Hire Resource <span style="color: red;">*</span></label>
                                                <select class="form-control" name="hire_user_name" id="hireusers" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['users'] as $key=>$user)

                                                    <option value="{{$user['id']}}">{{$user['name']}} - {{$user['last_name']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                <!-- <input class="form-control" placeholder="Ex:abc" name="name" value="{{old('name')}}" required="" autocomplete="off" /> -->
                                                @error('hire_user_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Work Duration<span style="color: red;">*</span></label>
                                                <select class="form-control" name="work_type" id="" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['workstatus'] as $key=>$type)

                                                    <option value="{{$type['id']}}">{{$type['title']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                              
                                                @error('work_type')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Resource Hire Status<span style="color: red;">*</span></label>
                                                <select class="form-control" name="resource_status" id="" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['client_status'] as $key=>$client)

                                                    <option value="{{$client['id']}}">{{$client['title']}}</option>


                                                    @empty
                                                    <p>No User Found</p>
                                                    @endforelse

                                                </select>
                                                @error('resource_status')
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
        $('#clients').select2();
        $('#workingusers').select2();
        $('#hireusers').select2();

        $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd',
                // maxDate: new Date()

            }

        );

        $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd',
                // maxDate: new Date()

            }

        );
    });
</script>
@endsection
@endsection