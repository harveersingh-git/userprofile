@extends('admin.layout.head')
@section('title')
Resource Hire Status
@endsection
@section('content')
@include('admin.layout.header')
Toast::message('message', 'level', 'title');
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Resource Hire Status</h1>
            </div>




            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-3">
                <a class="btn btn-info mb-20" href="{{ url('add-client-status') }}" class="active"><i class="fa fa-plus fa-fw"></i>
                    <i class="fa fa-book fa-fw"></i> Add
                </a>
            </div>

        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span> Resource Hire Status<span>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Title</th>




                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="resource_table">
                            @if(!empty($data) && $data->count())
                            @foreach($data as $key => $value)
                            <tr style="background-color:{{$value['background_color']}};  color:{{$value['font_color']}}" id="{{isset($value->id)?$value->id:''}}">
                                <td class="text-center"><i class="fa fa-arrows pull-left" aria-hidden="true"></i>
                                    {{ $key+1 }}
                                </td>
                                <td class="text-center">{{ $value->title }}</td>


                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{url('/client-status/edit')}}/{{$value->id}}"><i class="fa fa-edit"></i> Edit</button>

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
                    url: "{{url('delete_client_status')}}",
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


    $("#resource_table").sortable({
        connectWith: '.container',
        placeholder: "ui-state-highlight",
        beforeStop: function(event, ui) {
            draggedItem = ui.item;
        },
        iteams: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function(event, ui) {
            var type = 3;
            var order = new Array();
            $('#resource_table>tr').each(function(index, element) {

                order.push({
                        id: $(this).attr("id"),
                        position: index + 1,

                    }

                );
            });
            // console.log('push', order);
            updateOrder(order);


        }
    });

    function updateOrder(order) {
        var token = $('input[name="_token"]').attr('value');

        var data = {
            order: order
        };

        $.ajax({
            type: 'POST',
            url: base_url + '/hire_status_sorting',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-Token': token
            },

            success: function(data) {
                toastr.success("Record Update successfully");


            }
        })

    }
</script>

@endsection
@endsection