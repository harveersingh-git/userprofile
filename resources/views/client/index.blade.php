@extends('admin.layout.head')
@section('title')
Clients
@endsection
@section('content')
@include('admin.layout.header')
Toast::message('message', 'level', 'title');
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clients</h1>
            </div>




            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn btn-info mb-20" href="{{ url('add-client') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                        <i class="fa fa-book fa-fw"></i> Add Client
                    </a>
                    <!-- <a class="btn btn-info mb-20" href="{{ url('add-resource') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                        <i class="fa fa-book fa-fw"></i> Add Resource
                    </a> -->
                </div>

                <div class="pull-right">
                    <form action="{{url('clients')}}" method="GET" role="search" autocomplete="off" class="form-inline">

                        <div class="form-group">

                            <input type="text" class="form-control" name="client_search" placeholder="search by client name,email,code" value="{{Request::get('client_search')}}">
                        </div>
                        <!-- <div class="form-group">

                        <input type="text" class="form-control" name="client_search" placeholder="clinet name,code,email" value="{{Request::get('client_search')}}">
                    </div> -->
                        <div class="form-group">

                            <select class="form-control" name="client_type">
                                <option value="">--Select client type--</option>
                                @forelse($client_type as $key=>$clientstatus)
                                <option value="{{$clientstatus['id']}}" {{ (Request::get('client_type')) == $clientstatus['id']  ? 'selected' : ''}}>{{$clientstatus['title']}}</option>
                                @empty
                                <option value="">No data found</option>
                                @endforelse
                            </select>
                        </div>


                        <!-- <div class="form-group">

                        <select class="form-control" name="work_type">
                            <option value="">--Select work type--</option>
                            @forelse($work_type as $key=>$clientstatus)
                            <option value="{{$clientstatus['id']}}" {{ (Request::get('work_type')) == $clientstatus['id']  ? 'selected' : ''}}>{{$clientstatus['title']}}</option>
                            @empty
                            <option value="">No data found</option>
                            @endforelse
                        </select>
                    </div> -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-default">Search</button>

                            <a type="button" href="{{route('clients')}}" class="btn btn-danger btn-default">Clear</a>
                            <!-- <a type="button" href="{{url('clients?client_status=yes')}}" class="btn btn-primary btn-default" target="_blank">Export</a> -->

                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->
        <div class="">
            <div class="form-inline">
                <a data-toggle="tooltip" data-placement="top" title="Client Status" href="{{url('clients?client_type=0')}}" class="btn" style="margin-bottom: 4px; background-color:gray;color:#fff;">All({{$count['all']}}) </a>

                @forelse ($client_type as $status)

                <a data-toggle="tooltip" data-placement="top" title="Client Status" href="{{url('clients?client_type=')}}{{$status['id']}}" class="btn" style="margin-bottom: 4px; background-color:{{$status['background_color']}};  color:{{$status['font_color']}};"> {{$status['title']}}({{$status['count']}}) </a>
                @empty
                <a class="btn btn-success btn-xs " style="margin-bottom: 4px;"> plese add a new status</a>
                @endforelse

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span>Clients<span>

                    </div>

                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th width="5%" class="text-center">Sr. No.</th>
                                <th class="text-center" width="18%">Number of resource</th>
                                <!-- <th class="text-center" width="18%">Working Resource</th>
                                <th class="text-center" width="18%">Hire Resource</th> -->
                                <th class="text-center" width="8%">Client Code</th>
                                <th class="text-center" width="8%">Client Name</th>
                                <th class="text-center" width="8%">Client Email</th>
                                <th class="text-center" width="8%">Client Type</th>
                                <th class="text-center" width="8%">Start date</th>
                                <th class="text-center" width="8%">End date</th>
                                <th class="text-center" width="12%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr>
                                <td class="text-center" data-toggle="tooltip" data-placement="top" style="background-color: {{isset($value->client_type->background_color) ? $value->client_type->background_color:''}}"><span style="color: {{isset($value->client_type->font_color) ? $value->client_type->font_color:'';}}">{{ $key+1 }} </span></td>
                                <td class="text-center"><a href="{{url('add-resource')}}/{{$value->id}}">{{count($value->client_resource)}}</a></td>

                                <td class="text-center">{{ $value->client_code}}</td>
                                <td class="text-center">{{ $value->client_name}}</td>
                                <td class="text-center">{{ $value->client_email}}</td>
                                <td class="text-center">{{ isset($value->client_type['title'])?$value->client_type['title']:'' }}</td>

                                <td class="text-center">{{ $value->starting_date}}</td>
                                <td class="text-center">{{ ($value->end_date)?$value->end_date:'continue'}}</td>

                                <td class="text-center">
                                    <a class="btn btn-warning myac_btn" href="{{url('/client/edit')}}/{{$value->id}}" data-toggle="tooltip" title="Edit!"> <i class="fa fa-edit"></i></button>

                                        <a class="delete btn btn-danger myac_btn" id="{{$value->id}}" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></button>
                                            <a class="btn btn-success  myac_btn" href="{{url('/add-resource')}}/{{$value->id}}" data-toggle="tooltip" title="Add New Resources!"><i class="fa fa-user-plus"></i></button>

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="13">There are no data.</td>
                            </tr>
                            @endif
                        </tbody>

                    </table>
                    {!! $data->links() !!}

                    <!-- /.panel-body -->
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
    $(document).on('click', '.delete', function() {
        id = $(this).attr('id');
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    url: "{{url('delete_client')}}",
                    data: {
                        _token: '{{csrf_token()}}',
                        id: id
                    },
                    beforeSend: function() {

                    },
                    success: function(data) {
                        window.location.reload();
                    }
                })

            } else {
                swal("Your Record safe now!");
            }
        });

    });
</script>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection
@endsection