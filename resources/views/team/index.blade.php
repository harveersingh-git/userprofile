@extends('admin.layout.head')
@section('title')
Users
@endsection
@section('content')
@include('admin.layout.header')
Toast::message('message', 'level', 'title');
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Teams</h1>
            </div>




            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-3">
                <a class="btn btn-info mb-20" href="{{ url('add-team') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-book fa-fw"></i> Add Team
                </a>
                <!-- <a class="btn btn-info mb-20" href="{{ url('daily-performance') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-book fa-fw"></i> Performance
                </a> -->
            </div>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span>Teams<span>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Name</th>




                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">{{ $value->name }}</td>


                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{url('/team/edit')}}/{{$value->id}}"><i class="fa fa-edit"></i> Edit</a>

                                    <a class="delete btn btn-danger" id="{{$value->id}}"> <i class="fa fa-trash"></i> Delete</a>
                                    @if(!empty($value->click_up_team_id) && !empty($value->click_up_access_token))
                                    <a class="btn btn-success" href="{{url('/click-up-team-sync')}}/{{$value->id}}"><i class="fa fa-users"></i> ClickUp Team Sync</a>
                                    <!-- <a class="btn btn-primary" href="{{url('/clickup-report')}}/{{$value->id}}"><i class="fa fa-file"></i> ClicUp Report</a> -->
                                    <!-- <a class="btn btn-warning" href="{{url('/click-up-report-sync')}}/{{$value->id}}"><i class="fa fa-edit"></i> ClickUp Report Sync</a>
                                    <a class="btn btn-warning" href="{{url('/genrate-daily-report')}}/{{$value->id}}"><i class="fa fa-book" target="_blank"></i> Generate Report</a> -->

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="10">There are no data.</td>
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
                    url: "{{url('delete_team')}}",
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

@endsection
@endsection