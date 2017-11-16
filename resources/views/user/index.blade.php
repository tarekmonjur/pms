@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage User
            <small> show all system users.</small>
        </h1>
        <span class="breadcrumb"><a class="btn btn-success pull-right" href="{{url('/user/create')}}"> Add User</a></span>
    </section>

    <section class="content">
        <div class="box box-success">
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
                            <th>Hospital Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile No</th>
                            <th>Photo</th>
                            <th>Address</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->fullname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->hospital->hospital_name}}</td>
                                <td>{{$user->department->department_name}}</td>
                                <td>{{$user->designation}}</td>
                                <td>{{$user->mobile_no}}</td>
                                <td><img width="60px" src="{{$user->fullphoto}}" alt=""></td>
                                <td>{{$user->address}}</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="{{url('user/edit/'.$user->id)}}">Edit</a>
                                    <a onclick="return ckDelete()" class="btn btn-sm btn-danger" href="{{url('user/delete/'.$user->id)}}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>SL</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Hospital Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Mobile No</th>
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