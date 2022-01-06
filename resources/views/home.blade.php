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
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$data['current_month']}}</div>
                                <div>Recently Join</div>
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
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                @forelse($data['exprince'] as $key=>$val)

                                <div>{{$val['experience']}}Year - Users {{$val['total']}}</div>
                                @empty
                                <p>No users</p>

                                @endforelse
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
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">124</div>
                                <div>New Orders!</div>
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
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
                                <div>Support Tickets!</div>
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
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading " style="background-color: #f5f5f5 important; ">
                        <span>Resource Summary<span>
                    </div>
                    <!-- /.panel-heading -->
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Tech</th>
                                <th class="text-center">Primary</th>
                                <th class="text-center">Secondary</th>
                                <th class="text-center">Learming</th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse($data['technology'] as $key => $technology)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">{{ $technology->value }}</td>
                                <td class="text-center">{{ $technology->primary_skills_user_count }}</td>
                                <td class="text-center">{{ $technology->secondary_skills_user_count }}</td>
                                <td class="text-center">{{ $technology->learning_skills_user_count }}</td>



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

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading " style="background-color: #f5f5f5 important; ">
                        <span>Experience<span>
                    </div>
                    <!-- /.panel-heading -->
                   
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


                    <!-- <table class="table table-bordered table-responsive" >
                        <thead>
                        <tr>  <th class="text-center">#</th>
                                <th class="text-center">0-5</th>
                                <th class="text-center">5-10</th>
                                <th class="text-center">10-15</th>
                                <th class="text-center">15-20</th>
                                <th class="text-center">20-25</th>
                                
                            </tr>
                            <tr>
                                <th class="text-center">EXP</th>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>

                                
                            </tr>
                            <tr>
                                <th class="text-center">Number of User</th>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                                <td class="text-center">10</td>
                              
                             
                               
                            </tr>
                        </thead>
                      

                    </table> -->


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