<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('home') }}">Virtual Employee</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="{{route('home')}}"><i class="fa fa-home fa-fw"></i> Home</a></li>
    </ul>

    <ul class="nav navbar-right navbar-top-links">
    <li class="sidebar-search">
                    <!--<div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>-->
                    <!-- /input-group -->
                </li>
                @if(Session::get('role')=="ADMIN")
                <li>
                    <a href="{{route('home')}}" class="{{ Request::segment(1) === 'home' ? 'active' : null }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="{{route('users')}}" class="{{ Request::segment(1) === 'users' ? 'active' : null }}"><i class="fa fa-users"></i> Users</a>
                </li>
                <li>
                    <a href="{{route('clients')}}" class="{{ Request::segment(1) === 'clients' ? 'active' : null }}"><i class="fa fa-users"></i> Clients</a>
                </li>

                <li>
                    <a href="{{route('team')}}" class="{{ Request::segment(1) === 'team' ? 'active' : null }}"><i class="fa fa-users"></i> Team Mgmt</a>
                </li>
               
                <li class="profile_box dropdown"> <a class= "dropdown-toggle" data-toggle="dropdown" href="#">Master <b class="caret"></b></a>

                    
                <ul class="dropdown-menu">
                            <li> <a href="{{route('skills-education')}}" class="{{ Request::segment(1) === 'skills-education' ? 'active' : null }}"><i class="fa fa-book"></i> Skills/education</a></li>
                            <li> <a href="{{route('client-type')}}" class="{{ Request::segment(1) === 'client-type' ? 'active' : null }}"><i class="fa fa-cogs"></i> Client Type</a>

                            <li> <a href="{{route('work-type')}}" class="{{ Request::segment(1) === 'work-type' ? 'active' : null }}"><i class="fa fa-cogs"></i> Work Type</a>
                            <li> <a href="{{route('client-status')}}" class="{{ Request::segment(1) === 'client-status' ? 'active' : null }}"><i class="fa fa-users"></i> Client Status</a></li>  
                            <li> <a href="{{route('daily-performance')}}" class="{{ Request::segment(1) === 'daily-performance' ? 'active' : null }}"><i class="fa fa-cogs"></i> Daily Performance</a></li>  

                        </li>



                        </ul>
                   
                </li>
                
                @endif

           <li><li>     

        <li class="dropdown navbar-inverse">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-comment fa-fw"></i> New Comment
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{ url('information') }}/{{ Auth::user()->id }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="{{ url('changePassword') }}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>



                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>
            </ul>
        </li>
    
    
    <li>

    <!-- <form class="navbar-form" role="search">
            <div class="input-group">
               <input type="text" class="form-control" placeholder="Search">
               <div class="input-group-btn">
                  <button type="submit" class="btn btn-default custom_search_height"><span class="glyphicon glyphicon-search"></span></button>
               </div>
            </div>
         </form> -->

    </li>
    
    
    
    </ul>
    <!-- /.navbar-top-links -->

    <!--<div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    
                </li>
               
               
                <li class="profile_box dropdown"> <a href="#"><i class="fa fa-ellipsis-h"></i> Master</a>

                    <div class="dropdown-content">
                        <ul>
                            <li> <a href="{{route('skills-education')}}" class="{{ Request::segment(1) === 'skills-education' ? 'active' : null }}"><i class="fa fa-book"></i> Skills/education</a></li>
                            <li> <a href="{{route('client-status')}}" class="{{ Request::segment(1) === 'client-status' ? 'active' : null }}"><i class="fa fa-users"></i> Client Status</a></li>
                            <li> <a href="{{route('work-type')}}" class="{{ Request::segment(1) === 'work-type' ? 'active' : null }}"><i class="fa fa-cogs"></i> Work Type</a>
                            </li>



                        </ul>
                    </div>
                </li>

               




            </ul>
        </div>
    </div>-->
</nav> 

