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
                <div class="panel "  style="background-color: {{$clientstatus['background_color']}};">
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
                    <a  href="{{url('/users?client_status=')}}{{$clientstatus->id}}">
                        <div class="panel-footer" >
                            <span class="pull-left"  style="color: {{$clientstatus['background_color']}};">View Details</span>
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
                        <tr>
                            <td>
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <th>Experience</th>
                                    </tr>
                                    <tr>
                                        <th>Number Of User</th>
                                    </tr>
                                    
                                </table>
                            </td>
                            @forelse($data['exprince'] as $key=>$val)
                            <td>
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td>{{$val['experience']}}Year's</td>
                                    </tr>
                                    <tr>
                                        <td>{{$val['total']}}</td>
                                    </tr>
                                   
                                </table>
                            </td>
                            @empty
                                <p></p>

                                @endforelse
                            
                        </tr>
                    </table>


                 

               
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading " style="background-color: #f5f5f5 important;     font-weight: bold;">
                        <span>Resource Summary<span>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="">Tech</th>
                                <th class="text-center">Primary</th>
                                <th class="text-center">Secondary</th>
                                <th class="text-center">Learming</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse($data['technology'] as $key => $technology)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="">{{ $technology->value }}</td>
                                <td class="text-center"><a href="{{url('/users?search=')}}{{$technology->value}}&tech={{$technology->id}}&type=1">{{ $technology->primary_skills_user_count }}</a></td>
                                <td class="text-center"><a href="{{url('/users?search=')}}{{$technology->value}}&tech={{$technology->id}}&type=2">{{ $technology->secondary_skills_user_count }}</a></td>
                                <td class="text-center"><a href="{{url('/users?search=')}}{{$technology->value}}&tech={{$technology->id}}&type=3">{{ $technology->learning_skills_user_count }}</a></td>



                            </tr>

                            @empty
                            <tr>
                                <td colspan="10">There are no data.</td>
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

       
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection