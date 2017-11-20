<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{url('/')}}" class="navbar-brand">{{ config('app.name', 'AFC LAB') }}</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li @if($menu == '') class="active" @endif ><a href="{{url('/')}}">Dashboard<span class="sr-only">(current)</span></a></li>
                    <li @if($menu == 'projects') class="active" @endif ><a href="{{url('/projects')}}">Manage Projects</a></li>
                    <li @if($menu == 'tasks') class="active" @endif ><a href="{{url('/tasks')}}">Manage Task</a></li>
                    <li @if($menu == 'users') class="active" @endif ><a href="{{url('/users')}}">Manage User</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if($auth->photo =='')
                            <img src="{{url('images/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            @else
                            <img src="{{$auth->fullphoto}}" class="user-image" alt="User Image">
                            @endif
                            <span class="hidden-xs">{{$auth->fullname}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                @if($auth->photo =='')
                                    <img src="{{url('images/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                @else
                                    <img src="{{$auth->fullphoto}}" class="img-circle" alt="User Image">
                                @endif

                                <p>
                                    {{$auth->fullname}} - {{$auth->designation}}
                                    <small>Member since {{$auth->created_at}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>