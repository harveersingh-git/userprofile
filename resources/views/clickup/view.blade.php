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

                <div class="pull-left btn  mb-20">

                    <form action="{{ url('clickup-report/') }}" method="GET" role="search" autocomplete="off" class="form-inline">

                        <input type="text" class="form-control" name="daterange_search" value="{{Request::get('daterange_search')}}" id="daterange_search" placeholder="2022-01-24 to 2022-01-24" />
                        <input type="hidden" value="{{$id}}" name="id" id="team_id">


                        <button type="submit" class="btn btn-info btn-default">Search</button>

                    </form>
                </div>

                <div class="pull-right">

                    <form action="{{ url('click-up-time-sync') }}" method="GET" role="search" autocomplete="off" class="form-inline">
                        <input type="text" class="form-control" name="daterange" value="" placeholder="2022-01-21" />
                        <input type="hidden" value="{{$id}}" name="id" id="team_id">


                        <button type="submit" class="btn btn-info btn-default">Fetch Report</button>
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
                        <div class="col-lg-3 pull-right" style="margin-top: -7px;">
                            <select class="col-md-3  form-control" name="select_team" id="team" required="">
                                <option value="">--Please select for view report--</option>
                                @forelse($teams as $key=>$user)

                                <option value="{{$user['id']}}">{{$user['name']}}</option>


                                @empty
                                <p>No User Found</p>
                                @endforelse


                            </select>
                        </div>
                    </div>

                    <!-- /.panel-heading -->

                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                @forelse ($columns as $column)
                                @if($column=="Date")
                                <th class="text-center">{{$column}}</th>

                                @else
                                <th class="text-center" data-toggle="tooltip" data-placement="" title="{{$column}}">{{substr( $column, 0, 2)}}</th>

                                @endif
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
                                    <a href="#" style="color:{{($data[2]=='2')? 'red':''}}" class="popup" id="{{$data[1]}}" data-toggle="tooltip" data-placement="top" title="">{{ $data[0] }}</a>
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
<div class="modal " tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog update_status " role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-new">
                <button type="button" class="close btn_new_cross" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Status</h4>
            </div>
            <div class="modal-body">
                <form id="recordForm" action="{{url('update-click-up-report')}}">
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">Time:</label>
                        <input type="text" class="form-control" id="time" required="" name="time">
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
                <button type="submit" value="Save" class="action-button btn btn-info col-md-3 pull-right" id="record_submit"> Save</button>
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
        var time = $(this).text();
        $('#time').val(time);

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
        var token = $('input[name="_token"]').attr('value');
        var data = {
            team_id: $('#team_id').val()
        };
        $.ajax({
            type: 'GET',
            url: base_url + '/get_sync_dates',
            contentType: 'application/json',
            dataType: 'json',
            data: data,
            headers: {
                'X-CSRF-Token': token
            },

            success: function(result) {
                var array = [];
                if (result.data.length > 0) {
                    result.data.forEach(element => {
                        array.push(element.date);
                    });
                }

                $('input[name="daterange"]').datepicker({
                        dateFormat: 'yy-mm-dd',
                        maxDate: new Date(),
                        disableWeekends: true,

                        beforeShowDay: function(date) {
                            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

                            return [array.indexOf(string) == -1]
                        }

                    }

                );





            }
        })
        // var array = ["2022-01-20", "2022-01-19", "2022-01-17"]

        $('#daterange_search').daterangepicker({
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(23, 'hour'),
            maxDate: new Date(),
            locale: {
                format: 'YYYY-MM-DD',
                separator: " to "
            },

        });
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

    $('#team').on('change', function() {

        location.href = base_url + "/clickup-report/" + this.value;
    });
</script>
@endsection
@endsection