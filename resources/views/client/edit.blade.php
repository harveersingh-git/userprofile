@extends('admin.layout.head')
@section('title')
Edit Client 
@endsection
@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Client</h1>
            </div>



            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-heading mypnl_heading">
                        <span class="back_btn"><a type="reset" href="{{url('clients')}}">
                                <i class="fa fa-arrow-left"></i> Back </a></span> <span>Edit Client</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" action="{{url('update-client')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">

                                    <div class="form-group">
                                        <div class="row">
                                          
                                            <div class="col-lg-3 form-group">
                                                <label>Client Status</label>
                                                <select class="form-control" name="client_type" required="">
                                                    <option value="">--Please select--</option>
                                                    @forelse($data['client_type'] as $key=>$status)
                                                    @if($status['id']==$client->client_type_id)
                                                    <option selected value="{{$status['id']}}">{{$status['title']}}</option>

                                                    @else
                                                    <option value="{{$status['id']}}">{{$status['title']}}</option>

                                                    @endif


                                                    @empty
                                                    <p>No client Status Found</p>
                                                    @endforelse

                                                </select>
                                                @error('client_type')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Start Date</label>
                                                <input class="form-control" placeholder="2022-01-13" name="start_date" id="start_date" value="{{ $client->starting_date }}" required="" autocomplete="off" />
                                                @error('start_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>End Date</label>
                                                <input class="form-control" placeholder="2022-01-13" name="end_date" id="end_date" value="{{ $client->end_date }}"  autocomplete="off" />
                                                @error('end_date')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                         

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 form-group">
                                                <label>Client Code</label>
                                                <input class="form-control" placeholder="Ex:TK0987" name="client_code" value="{{$client['client_code']}}" required="" autocomplete="off" />
                                                @error('client_code')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Client Name</label>
                                                <input class="form-control" placeholder="Ex:abc" name="client_name" value="{{$client['client_name']}}" required="" autocomplete="off" />
                                                @error('client_name')
                                                <p class="alert alert-danger"> {{ $message }} </p>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 form-group">
                                                <label>Client Email</label>
                                                <input type="email" class="form-control" placeholder="Ex:abc@gmail.com" name="client_email" value="{{$client['client_email']}}" required="" autocomplete="off" />
                                                @error('client_email')
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
    $(document).ready(function() {
        $('#users').select2();

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