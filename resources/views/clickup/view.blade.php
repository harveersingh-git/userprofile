@extends('admin.layout.head')
@section('title')
ClickUp Report

@endsection
@section('content')
@include('admin.layout.header')

Toast::message('message', 'level', 'title');
<div id="page-wrapper" style="min-height: 183px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Click Up Report</h1>
            </div>

        </div>
        @if(Session::get('role')=="ADMIN")
        <div class="row">
            <div class="col-lg-12">
                <div class="pull-left">
                    <a class="btn btn-info mb-20" href="{{url('team')}}"><i class="fa fa-arrow-left  fa-fw"></i>
                        <i class="fa fa-users fa-fw"></i> Back
                    </a>
                </div>


                <div class="pull-right">
                    <form action="{{ url('click-up-time-sync') }}" method="GET" role="search" autocomplete="off" class="form-inline">

                        <input type="text" class="form-control" name="daterange" value="" placeholder="2022-01-21"/>
                        <input type="hidden" value="{{$id}}" name="id">


                        <button type="submit" class="btn btn-info btn-default">Fetch Report</button>

                        <!-- <a type="button" href="{{url('team')}}" class="btn btn-danger btn-default">Clear</a> -->
                    </form>
                </div>

            </div>
        </div>


        @endif
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading mypnl_heading">
                        <span>Click Up Report</span>

                    </div>
                    <!-- /.panel-heading -->

                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                @forelse ($columns as $column)
                                <th class="text-center">{{$column}}</th>
                                @empty
                                <th class="text-center">No Data Found</th>
                                @endforelse

                            </tr>

                        </thead>
                        <tbody>

                            @forelse($result as $keyy => $value)
                            <tr>
                                <td class="text-center">{{\Carbon\Carbon::parse($keyy)->format('d-M-Y') }}</td>
                                @for ($i = 0; $i < count($value); $i++) <td class="text-center">
                                    @php
                                    $data = explode(",",$value[$i] );
                                    @endphp
                                    <a href="#" class="popup" id="{{$data[1]}}" data-toggle="tooltip" data-placement="top" title="">{{ $data[0] }}</a>
                                    </td>
                                    @endfor


                            </tr>
                            @empty

                            <tr>
                                <td colspan="13">There are no data.</td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>



                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>

    <!-- /.row -->
</div>


<!--model-->
<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Update status</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="recordForm" action="{{url('update-click-up-report')}}">
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">Time:</label>
                        <input type="number" class="form-control" id="time" required="" name="time">
                        <input type="hidden" class="form-control" id="click_up_report_id" name="click_up_report_id">
                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">Status:</label>
                        <select class="form-control" aria-label="Default select example" name="daily_status_id" id="daily_status_id" required="">
                            <option selected value="">--please select--</option>
                        </select>
                    </div>


                    <div class="form-group" id="reason_div">

                    </div>
                    <div class="form-group">
                    </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Save" class="action-button btn btn-success col-md-3 pull-right" id="record_submit" />
                </form>

            </div>
        </div>
    </div>
</div>

<!--end model-->

@section('script')
<script>
    $('#myModal').on('hidden.bs.modal', function(e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
    });

    $('.popup').on('click', function() {
        var token = $('input[name="_token"]').attr('value');
        var id = $(this).attr('id');
        $('#click_up_report_id').val(id);
        $('#myModal').modal('toggle');
        $.ajax({
            type: 'GET',
            url: base_url + '/get_daily_perfomance',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'X-CSRF-Token': token
            },

            success: function(result) {

                typee = '<option value="">--select--</option>';
                result.data.forEach(element => {
                    typee += "<option value=" + element.id + ">" + element.title + "</option>"
                });

                $('#daily_status_id').html(typee);




            }
        })

    })


    $(function() {
        $('input[name="daterange"]').datepicker(
        {
            dateFormat: 'yy-mm-dd',
            maxDate: new Date()
           
        }

    );
        // $('input[name="daterange"]').daterangepicker({
        //     startDate: moment().startOf('hour'),
        //     endDate: moment().startOf('hour').add(23, 'hour'),
        //     maxDate: new Date(),
        //     // format: 'YYYY-MM-DD'
        // });
    });

    $(document).on('change', '#daily_status_id', function() {
        var token = $('input[name="_token"]').attr('value');
        var data = {
            id: $(this).children(":selected").attr("value")
        };
        $.ajax({
            type: 'POST',
            url: base_url + '/check_daily_perfomance',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-Token': token
            },

            success: function(result) {
                if (result.data.need_a_reason == 1) {
                    $('#reason_div').html('<label for="message-text" class="col-form-label">Reason:</label><textarea class="form-control" id="reason" name="reason" required=""></textarea>');
                } else {
                    $('#reason_div').html('');
                }



            }
        })

    });

    $(document).on("click", "#record_submit", function() {
        $('#recordForm').submit(function(e) {

            e.preventDefault();
            var token = $('input[name="_token"]').attr('value');
            var form = $(this);
            var url = form.attr('action');

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                headers: {
                    'X-CSRF-Token': token
                },
                contentType: false,
                processData: false,
                data: new FormData(this),
                success: function(data) {

                    if (data.status == "success") {

                        toastr.success("Record insert successfully");
                        window.location.reload();



                    }

                }
            });
        });
    });
</script>
@endsection
@endsection