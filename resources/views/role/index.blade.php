@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            <ol class="breadcrumb" style="left: 0px!important;">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="{{url('/roles')}}">Manage Role Permissions</a></li>
                @if(canAccess("roles/create"))
                    <a class="btn btn-primary breadcrumb-btn pull-right" href="{{url('/roles/create')}}"> Create Role</a>
                @endif
            </ol>
        </h1>
    </section>

    <?php
    $edit = (canAccess("roles/edit"))?true:false;
    $delete = (canAccess("roles/delete"))?true:false;
    ?>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Role Name</th>
                        <th>Role Description</th>
                        <th>Created</th>
                        <th width="120px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$role->role_name}}</td>
                            <td>{{$role->role_description}}</td>
                            <td>{{$role->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-primary" href="#" onclick="viewPermission('{{url('roles/'.$role->id)}}')">View</a>
                                    @if($edit == true)
                                    <a class="btn btn-xs btn-success" href="{{url('roles/'.$role->id.'/edit')}}">Edit</a>
                                    @endif
                                    @if($delete == true)
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this role?', 'delete_{{$role->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('roles/'.$role->id)}}" id="delete_{{$role->id}}">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Role Name</th>
                        <th>Role Description</th>
                        <th>Created</th>
                        <th width="120px">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

    {{-- view role permission --}}
    <div class="modal" id="view_role_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document" id="view_role"></div>
    </div>

@endsection


@section('script')
    <script>
        var baseUrl = '{{url('/')}}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //show role permission popup
        function viewPermission(url){
            $.ajax({
                url: url,
                type: 'get',
                processData: false,
                contentType: false,
                dataType: 'html',
                success:function (data) {
                    $("#view_role").html(data);
                    $('#view_role_modal').modal();
                },
                error: function (error) {
                    $("#view_role").html("<h2>Connection Problem.</h2>");
                }
            });
            return false;
        }

    </script>
@endsection