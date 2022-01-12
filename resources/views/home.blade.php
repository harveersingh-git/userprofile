@extends('admin.layout.head')

@section('content')
@include('admin.layout.header')
<div id="page-wrapper" style="min-height: 336px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            @forelse( $data['client_status'] as $key=>$clientstatus)
            <div class="col-lg-3 col-md-6">
                <div class="panel " style="background-color: {{$clientstatus['background_color']}};">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x" style="color:#fff"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge" style="color: {{$clientstatus['font_color']}};">{{$clientstatus['client_status_count_count']}}</div>
                                <div style="color: {{$clientstatus['font_color']}};">{{$clientstatus['title']}}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/users?client_status=')}}{{$clientstatus->id}}">
                        <div class="panel-footer">
                            <span class="pull-left" style="color: {{$clientstatus['background_color']}};">View Details</span>
                            <span class="pull-right" style="color: {{$clientstatus['background_color']}};"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <p></p>
            @endforelse
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading " style="background-color: #f5f5f5 important;     font-weight: bold;">
                        <span>Experience<span>
                    </div>


                    <table class="table table-bordered table-responsive">

                        <thead>
                            <tr>
                                <th scope="row">EXP</th>
                                <th scope="col">0-3 Years</th>
                                <th scope="col">3-5 Years</th>
                                <th scope="col">5-10 Years</th>
                                <th scope="col">10+ Years</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Number of Users</th>
                                <td><a href="{{url('/users?exprince=0-3')}}">{{ $data['zeo_three']}}</a></td>
                                <td><a href="{{url('/users?exprince=3-5')}}">{{ $data['three_five']}}</a></td>
                                <td><a href="{{url('/users?exprince=5-10')}}">{{$data['five_ten']}}</a></td>
                                <td><a href="{{url('/users?exprince=10-plus')}}">{{ $data['ten_fifty']}}</a></td>
                            </tr>
                            <tr>

                        </tbody>
                    </table>






                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Resource Summary <span class="pull-right" style="margin-top: -7px;"><input class="form-control pull-right" id="myInput" type="text" placeholder="Search.."><span></div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th class="">Technology</th>
                                        <th class="text-center">Primary</th>
                                        <th class="text-center">Secondary</th>
                                        <th class="text-center">Learning</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($data['technology'] as $key => $technology)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td class=""><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}">{{ $technology->value }}</a></td>
                                        <td class="text-center"><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}&type=1">{{ $technology->primary_skills_user_count }}</a></td>
                                        <td class="text-center"><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}&type=2">{{ $technology->secondary_skills_user_count }}</a></td>
                                        <td class="text-center"><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}&type=3">{{ $technology->learning_skills_user_count }}</a></td>



                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="10">There are no data.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        </div>

    <!-- /.panel-heading -->


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
    // $(document).ready(function() {
    //     $("#myInput").on("keyup", function() {

    //         // var value = $(this).val().toLowerCase();
    //         dataTable.fnFilter(this.value);

    //         // $("#myTable tr").filter(function() {
    //         //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //         // });
    //     });
    // });
    $(document).ready(function() {
        var oTable = $('#dataTables-example').DataTable({
            responsive: true,
            "lengthChange": false
            // "bPaginate": false,
        });
        $("#myInput").on("keyup", function() {

            // var value = $(this).val().toLowerCase();
            oTable.search(this.value).draw();

        });
    });
  
</script>
@endsection
@endsection