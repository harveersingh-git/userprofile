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
                <h1 class="page-header">Skills-Education</h1>
            </div>

            <div class="pull-right">
                <a href="{{ url('add-skills-education') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-book fa-fw"></i> Add Skills-Education
                </a>
            </div>


            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Skills-Education
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive" >
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">value</th>
                                <th class="text-center">category</th>



                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr>
                                   <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">{{ $value->value }}</td>
                                <td class="text-center">{{ $value->category }}</td>

                                <td class="text-center">
                                    <a href="{{url('/skills-education/edit')}}/{{$value->id}}">Edit</button>

                                        <a class="delete" id="{{$value->id}}">Delete</button>

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
                    url: "{{url('delete_skills_education')}}",
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