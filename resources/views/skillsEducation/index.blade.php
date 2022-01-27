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




            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-3">
                <a class="btn btn-info mb-20" href="{{ url('add-skills-education') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-book fa-fw"></i> Add Skills-Education
                </a>
            </div>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span>Skills-Education</span>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Value</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Show on front</th>




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
                                    @if($value->category=='skill')
                                    @if($value->show_on_front=='1')
                                    <i class="fa fa-eye show_on_main" aria-hidden="true" id="{{$value->id}}"></i>

                                    @else
                                    <i class="fa fa-eye-slash show_on_main" aria-hidden="true" id="{{$value->id}}"></i>
                                    @endif

                                @endif

                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{url('/skills-education/edit')}}/{{$value->id}}"><i class="fa fa-edit"></i> Edit</button>

                                        <a class="delete btn btn-danger" id="{{$value->id}}"> <i class="fa fa-trash"></i> Delete</button>

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
            
            } else {
                swal("Your Record safe now!");
            }
        });

    });


    
    $(document).on('click', '.show_on_main', function() {
        var token = $('input[name="_token"]').attr('value');
        $(this).toggleClass("fa-eye fa-eye-slash");
        var data = {
            id: $(this).attr('id')
        };
        $.ajax({
            type: 'POST',
            url: base_url + '/skill_show_on_front',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-Token': token
            },

            success: function(result) {
               
                toastr.success("Record Update successfully");

                


            }
        })

    });
</script>

@endsection
@endsection