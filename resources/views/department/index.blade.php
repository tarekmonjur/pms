@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Department
            <small> show all companies department.</small>
            @if(canAccess("department/create"))
            <a class="btn btn-primary pull-right" href="{{url('/department/create')}}"> Create Department</a>
            @endif
        </h1>
    </section>

    <?php
    $edit = (canAccess("department/edit"))?true:false;
    $delete = (canAccess("department/delete"))?true:false;
    ?>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Department Name</th>
                        <th>Company Name</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$department->department_name}}</td>
                            <td>{{$department->company->company_name}}</td>
                            <td>{{$department->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    @if($edit == true)
                                    <a class="btn btn-sm btn-success" href="{{url('department/'.$department->id.'/edit')}}">Edit</a>
                                    @endif
                                    @if($delete == true)
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this company?', 'delete_{{$department->id}}')" class="btn btn-sm btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('department/'.$department->id)}}" id="delete_{{$department->id}}">
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
                        <th>Department Name</th>
                        <th>Company Name</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection