
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li @if($menu == '') class="active" @endif ><a href="{{url('/')}}"><i class="fa fa-link"></i> Dashboard<span class="sr-only">(current)</span></a></li>
            <li @if($menu == 'projects') class="active" @endif ><a href="{{url('/projects')}}"><i class="fa fa-link"></i> Projects</a></li>
            @if(canAccess("users"))
                <li @if($menu == 'users') class="active" @endif ><a href="{{url('/users')}}"><i class="fa fa-link"></i> Users</a></li>
            @endif
            @if(canAccess("roles"))
                <li @if($menu == 'roles') class="active" @endif ><a href="{{url('/roles')}}"><i class="fa fa-link"></i> Role</a></li>
            @endif
            @if(canAccess("teams"))
                <li @if($menu == 'teams') class="active" @endif ><a href="{{url('/teams')}}"><i class="fa fa-link"></i> Teams</a></li>
            @endif
            @if(canAccess("company"))
                <li @if($menu == 'company') class="active" @endif ><a href="{{url('/company')}}"><i class="fa fa-link"></i> Companies</a></li>
            @endif
            @if(canAccess("department"))
                <li @if($menu == 'department') class="active" @endif ><a href="{{url('/department')}}"><i class="fa fa-link"></i> Department</a></li>
            @endif
        </ul>
    </section>
</aside>