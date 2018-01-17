<!-- Main Header -->
<header class="main-header">

    <a href="{{url('/')}}" class="logo">
        <span class="logo-lg">{{ config('app.name', 'PMS') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{$auth->fullphoto}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{$auth->fullname}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{$auth->fullphoto}}" class="img-circle" alt="User Image">
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
    </nav>
</header>