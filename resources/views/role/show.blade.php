
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <?php $permissions = getPermissionList();?>
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <h4>{{$loop->iteration}}. <storng>{{ucfirst($permission["name"])}}</storng></h4>
                                @foreach($permission['permission'] as $key => $item)
                                    <div>
                                        <label style="margin-left: 15px">
                                            <input type="checkbox" name="permissions[]" value="{{$key}}" @if(in_array($key, @unserialize($role->role_permission))) checked @endif disabled>
                                            {{$item}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

