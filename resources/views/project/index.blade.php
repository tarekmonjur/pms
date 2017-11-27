@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Project
            <small> show all projects.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects/create')}}"> Create Project</a>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Project Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Project Doc</th>
                        <th>Project Details</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{url('projects/'.$project->id)}}">{{$project->project_title}}</a></td>
                            <td>{{$project->project_start_date}}</td>
                            <td>{{$project->project_end_date}}</td>
                            <td>
                                <label class="label @if($project->project_status == "initiate") label-primary @elseif($project->project_status == "pending") label-warning @elseif($project->project_status == "progress") label-info @elseif($project->project_status == "done") label-success @endif">{{$project->project_status}}</label>
                            </td>
                            <td>@if($project->project_doc)<a target="_blank" href="{{asset('uploads/projects/'.$project->project_doc)}}">view doc</a>@else No doc @endif</td>
                            <td>{{$project->project_details}}</td>
                            <td>{{$project->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-success" href="{{url('projects/'.$project->id.'/edit')}}">Edit</a>
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this project?', 'delete_{{$project->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('projects/'.$project->id)}}" id="delete_{{$project->id}}">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                    </form>
                                </div>
                                <div class="btn-group">

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Project Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Project Doc</th>
                        <th>Project Details</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection