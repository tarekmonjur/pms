@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            <ol class="breadcrumb" style="left: 0px!important;">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="{{url('/projects')}}">Manage Projects</a></li>
                @if(canAccess("projects/create"))
                <a class="btn btn-primary breadcrumb-btn" href="{{url('/projects/create')}}"> Create Project</a>
                @endif
            </ol>
        </h1>
    </section>

    <?php
    $edit = (canAccess("projects/edit"))?true:false;
    $delete = (canAccess("projects/delete"))?true:false;
    ?>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Project Title</th>
                        <th>Project Teams</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
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
                            <td>
                                @if($project_team = $project->teams($project->project_team))
                                   @foreach($project_team as $team)
                                       {{$loop->iteration}} . <a href="{{url('teams')}}">{{$team->team_name}}</a><br>
                                   @endforeach
                                @endif
                            </td>
                            <td>{{$project->project_start_date}}</td>
                            <td>{{$project->project_end_date}}</td>
                            <td>
                                <label class="label @if($project->project_status == "initiate") label-primary @elseif($project->project_status == "pending") label-warning @elseif($project->project_status == "progress") label-info @elseif($project->project_status == "done") label-success @endif">{{$project->project_status}}</label>
                            </td>
                            <td>{{$project->project_details}}</td>
                            <td>{{$project->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    @if($edit == true)
                                    <a class="btn btn-xs btn-success" href="{{url('projects/'.$project->id.'/edit')}}">Edit</a>
                                    @endif

                                    @if($delete == true)
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this project?', 'delete_{{$project->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('projects/'.$project->id)}}" id="delete_{{$project->id}}">
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
                        <th>Project Title</th>
                        <th>Project Teams</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
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