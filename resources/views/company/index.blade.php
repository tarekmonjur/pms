@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Company
            <small> show all companies.</small>
            <a class="btn btn-primary pull-right" href="{{url('/company/create')}}"> Create Company</a>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$company->company_name}}</td>
                            <td>{{$company->company_address}}</td>
                            <td>{{$company->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-success" href="{{url('company/'.$company->id.'/edit')}}">Edit</a>
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this company?', 'delete_{{$company->id}}')" class="btn btn-sm btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('company/'.$company->id)}}" id="delete_{{$company->id}}">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Company Name</th>
                        <th>Company Address</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection