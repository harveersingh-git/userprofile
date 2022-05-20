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
            <div class="col-lg-2 col-md-6" style="height: 181px;">
                <div class="panel " style="background-color: {{$clientstatus['background_color']}};">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                @if(isset($clientstatus['icon']))
                                <i class="{{$clientstatus['icon']}} fa-5x" style="color:#fff"></i>
                                @elseif($clientstatus['image'])
                                <img src="{{asset('clientStatus/')}}/{{$clientstatus['image']}}" id="p1img1" width="80" height="80">


                                @else
                                <i class="fa fa-support fa-5x" style="color:#fff"></i>
                                @endif

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
            <div class="col-lg-2 col-md-6" style="height: 181px;">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$data['active_client']}}</div>
                                <div>Total Client</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/clients')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6" style="height: 181px;">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$data['total_services']}}</div>
                                <div>Total Services</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/services')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6" style="height: 181px;">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$data['total_users']}}</div>
                                <div>Total Resource</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('/users')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6" style="height: 181px;">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-table fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$data['banch_percent']}}</div>
                                <div>Bench %</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading " style="background-color: #f5f5f5 important;     font-weight: bold;">
                        <span>Experience<span>
                    </div>


                    <table class="table table-bordered table-responsive">

                        <thead>
                            <tr>
                                <th scope="col">EXP</th>
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

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading " style="background-color: #f5f5f5 important;     font-weight: bold;">
                        <span>Work Type<span>
                    </div>


                    <table class="table table-bordered table-responsive">

                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                @forelse( $data['work_type_count'] as $key=>$workType)
                                <th scope="col">{{$workType->title}}</th>
                                @empty
                                <th scope="col">No work Type found</th>
                                @endforelse
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Number of Users</th>
                                @forelse( $data['work_type_count'] as $key=>$workType)
                                <th scope="col"><a href="{{url('/users?work_status='.$workType->id)}}">{{count($workType->work_type_user_count)}}</a></th>
                                @empty
                                <th scope="col">No User found</th>
                                @endforelse
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
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #f5f5f5 important; font-weight: bold;">Resource Summary <span class="pull-right" style="margin-top: -7px;"><input class="form-control pull-right" id="myInput" type="text" placeholder="Search.."><span></div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th>Technology</th>
                                        <th class="text-center">Primary</th>
                                        <th class="text-center">Secondary</th>
                                        <th class="text-center">Learning</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($data['technology'] as $key => $technology)
                                    @php
                                    $allcount = $technology->primary_skills_user_count + $technology->secondary_skills_user_count +$technology->learning_skills_user_count;
                                    @endphp
                                    @if($allcount>0)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td class=""><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}">{{ $technology->value }}</a></td>
                                        <td class="text-center"><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}&type=1">{{ $technology->primary_skills_user_count }}</a></td>
                                        <td class="text-center"><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}&type=2">{{ $technology->secondary_skills_user_count }}</a></td>
                                        <td class="text-center"><a href="{{url('/users?skills%5B%5D=')}}{{$technology->value}}&type=3">{{ $technology->learning_skills_user_count }}</a></td>
                                        <td class="text-center">{{ $technology->active_skills_count }}</td>


                                    </tr>
                                    @endif

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

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #f5f5f5 important; font-weight: bold;">Client Summary <span class="pull-right" style="margin-top: -7px;"><input class="form-control pull-right" id="serach_client" type="text" placeholder="Search.."><span></div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="client_summary">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr. No.</th>
                                        <th>Clinet Name</th>
                                        <th class="text-center">Clinet Code</th>
                                        <th class="text-center">Number of Services</th>
                                        <!-- <th class="text-center">Hire Resource</th> -->
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($data['clinents'] as $key => $client)

                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <!-- <td class="text-center"><a href="{{url('/clients?client_search=')}}{{$client->client_name}}">{{$client->client_name }}</a></td>
                                        <td class="text-center"><a href="{{url('/clients?client_search=')}}{{$client->client_code}}">{{$client->client_code }}</a></td> -->
                                        <td class="text-center"><a href="{{url('/add-resource')}}/{{$client->id}}">{{$client->client_name }}</a></td>
                                        <td class="text-center"><a href="{{url('/add-resource')}}/{{$client->id}}">{{$client->client_code }}</a></td>
                                        <td class="text-center">
                                            {{$client->client_resource_count}}
                                            <!-- @forelse($client->client_resource as $key => $resource) -->
                                            <!-- <a href="{{url('/users?search=')}}{{isset($resource->working_resource['name'])?$resource->working_resource['name']:''}}"> {{isset($resource->working_resource['name'])?$resource->working_resource['name']:''}}</a> -->
                                            <!-- @empty
                                            <p>There are no resource.</p>
                                            @endforelse -->
                                        </td>
                                        <!-- <td class="text-center">
                                            {{count($client->client_resource)}} -->
                                        <!-- 
                                            @forelse($client->client_resource as $key => $resource)
                                            <a href="{{url('/users?search=')}}{{$resource->hire_resource['name']}}">{{$resource->hire_resource['name']}}</a>
                                            @empty
                                            <p>There are no resource.</p>
                                            @endforelse -->
                                        <!-- </td> -->


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
    $(document).ready(function() {
        var oTable = $('#dataTables-example').DataTable({
            "pageLength": 15,
            responsive: true,
            "lengthChange": false,

        });
        $("#myInput").on("keyup", function() {
            oTable.search(this.value).draw();

        });
    });

    $(document).ready(function() {
        var oTable = $('#client_summary').DataTable({
            "pageLength": 15,
            responsive: true,
            "lengthChange": false,

        });
        $("#serach_client").on("keyup", function() {
            oTable.search(this.value).draw();

        });
    });
</script>
@endsection
@endsection