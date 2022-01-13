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
                <h1 class="page-header">Clients</h1>
            </div>

           


            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
        <div class="col-lg-3">
                <a class="btn btn-info mb-20" href="{{ url('add-client') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-book fa-fw"></i> Add Client
                </a>
            </div>

</div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                      <span>Clients<span>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive" >
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">EmpID</th>
                                <th class="text-center">Resource Name</th>
                                <th class="text-center">Emp Status</th>
                                <th class="text-center">Client Code</th>
                                <th class="text-center">Client Name</th>
                                <th class="text-center">Client Email</th>
                                <th class="text-center">TL Code</th>
                                <th class="text-center">TL Name</th>
                                <th class="text-center">Resource</th>
                                <th class="text-center">Hours</th>
                                <th class="text-center">Sarting date</th>
                               



                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr>
                                   <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">{{ $value->users['employee_id'] }}</td>
                                <td class="text-center">{{ $value->users['employeename_id'] }}{{ $value->users['last_name'] }}</td>
                                <td class="text-center">{{ $value->emp_status['title'] }}</td>
                                <td class="text-center">{{ $value->client_code}}</td>
                                <td class="text-center">{{ $value->client_name}}</td>
                                <td class="text-center">{{ $value->client_email}}</td>
                                <td class="text-center">{{ $value->team['tl_code'] }}</td>
                                <td class="text-center">{{ $value->team['name'] }}</td>
                                <td class="text-center">{{ $value->work_type['title'] }}</td>
                                <td class="text-center">{{ $value->hours }}</td>
                                <td class="text-center">{{ $value->starting_date}}</td>

                                <td class="text-center">
                                    <a  class="btn btn-warning" href="{{url('/client/edit')}}/{{$value->id}}"><i class="fa fa-edit"></i> Edit</button>

                                    <a class="delete btn btn-danger" id="{{$value->id}}"> <i class="fa fa-trash"></i> Delete</button>

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

@endsection
@endsection