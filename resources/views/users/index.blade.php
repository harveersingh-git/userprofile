@extends('admin.layout.head')

@section('content')
@include('admin.layout.header')

Toast::message('message', 'level', 'title');
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users</h1>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3">
                <a class="btn btn-info mb-20" href="{{ url('information') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-user fa-fw"></i> Add User
                </a>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span>Users</span>
                        <div class="col-sm-3 pull-right my_usearch">
                            <form action="{{url('users')}}" method="GET" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" value="{{ Request::get('search') }}" class="form-control" name="search" placeholder="Search users"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.panel-heading -->



                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Emp Id</th>
                                <th class="text-center"> Name</th>
                                
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Resume Title</th>

                                <th class="text-center">Skills</th>



                                <th class="text-center" style="width: 22%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr class="text-center">
                                <td>{{ $value->employee_id }}</td>
                                <td>{{ $value->name }} {{ $value->last_name }}</td>
                                
                                <td>{{ $value->email  }}</td>
                                <td>{{ $value->mobile  }}</td>
                                <td>{{ $value->resume_title }}</td>

                                <td>
                                    @if($value->skills->count()>0)
                                    @foreach($value->skills as $key=>$res)
                                    {{$res->skills_details['value']}}
                                    @endforeach

                                    @endif


                                </td>

                                <td>
                                    <a class="btn btn-warning" href="{{url('/information')}}/{{$value->id}}"><i class="fa fa-edit"></i> Edit</button>

                                        <a class="delete btn btn-danger" id="{{$value->id}}"> <i class="fa fa-trash"></i> Delete</button>
                                            <a class="btn btn-info" href="{{url('/resume')}}/{{$value->id}}"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download</button>
                                            <a class="btn btn-info" href="{{url('/view-resume')}}/{{$value->id}}"><i class="fa fa-cloud-download" aria-hidden="true"></i> View</button>

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

                    <div class="pagination-wrapper">
                        {{ $data->links() }}
                    </div>

                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>

    <!-- /.row -->
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
                    url: "{{url('delete_user')}}",
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
                //   axios.get(`/api/move_to_trash/${id}`).then(() => {
                //      this.$router.push("/users");
                //     let i = this.users.map((data) => data.id).indexOf(id);
                //     this.users.splice(i, 1);
                //      this.$toaster.success('Record delete successfully.')
                //   });
            } else {
                swal("Your Record safe now!");
            }
        });

    });
</script>

@endsection
@endsection