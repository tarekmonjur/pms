@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Role Permissions
            <small> role permission create form.</small>
            @if(canAccess("roles"))
            <a class="btn btn-primary pull-right" href="{{url('/roles')}}"> View Roles</a>
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('roles/'.$role->id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('role_name') ? ' has-error' : '' }}">
                                        <label for="project_title">Role Name</label>
                                        <input type="text" class="form-control" name="role_name" value="{{ (old('role_name'))?:$role->role_name }}" placeholder="Enter Role Name">
                                        @if ($errors->has('role_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('role_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_address">Role Description</label>
                                        <textarea class="form-control" name="role_description" placeholder="Enter Role Description">{{ (old('role_description'))?:$role->role_description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="all" onclick="checkAll()">
                                        select all
                                    </label>
                                </div>

                                <?php $permissions = getPermissionList();?>
                                @foreach($permissions as $permission)
                                    <div class="col-md-4">
                                        <h3>{{$loop->iteration}}. <storng>{{ucfirst($permission["name"])}}</storng></h3>
                                        @foreach($permission['permission'] as $key => $item)
                                            <div>
                                                <label style="margin-left: 15px">
                                                    <div class="icheckbox_flat-green"><input type="checkbox" name="permissions[]" value="{{$key}}" @if(in_array($key, @unserialize($role->role_permission))) checked @endif class="flat-red check"></div>
                                                    {{$item}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        function checkAll(){

            var checkAll = $('input.all');
            var checkboxes = $('input.check');

            if(checkAll.prop('checked')){
                checkboxes.iCheck('check');
            }else{
                checkboxes.iCheck('uncheck');
            }


        }
    </script>
@endsection