@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage User
            <small> show all system users.</small>
            @if(canAccess("users/create"))
            <a class="btn btn-primary pull-right" href="{{url('/users/create')}}"> Create User</a>
            @endif
        </h1>
    </section>

    <?php
    $edit = (canAccess("users/edit"))?true:false;
    $delete = (canAccess("users/delete"))?true:false;
    ?>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                {{--<h3 class="box-title">Data Table With Full Features</h3>--}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile No</th>
                            <th>User Type</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Created</th>
                            <th width="80px">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->department->department_name}} <br> ( {{$user->department->company->company_name}} )</td>
                                <td>{{$user->designation}}</td>
                                <td>{{$user->mobile_no}}</td>
                                <td><label class="label label-info">{{$user->role->role_name}}</label></td>
                                <td><img width="60px" src="{{$user->fullphoto}}" alt=""></td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($edit == true)
                                        <a class="btn btn-sm btn-success" href="{{url('users/'.$user->id.'/edit')}}">Edit</a>
                                        @endif
                                        @if($delete == true)
                                        <a onclick="return confirmAction('delete', 'Are you sure delete this user?', '{{url('users/'.$user->id.'/delete')}}')" class="btn btn-sm btn-danger" href="#">Delete</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile No</th>
                            <th>User Type</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>

@endsection