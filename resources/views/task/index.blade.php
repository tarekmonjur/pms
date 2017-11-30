@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Tasks
            <small> show all project tasks.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects/'.$project_id.'/stories/'.$story_id.'/tasks/create')}}"> Create Task</a>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Task Title</th>
                        <th>Project</th>
                        <th>Story</th>
                        <th>Type</th>
                        <th>Start/End Date</th>
                        <th>Status</th>
                        <th>Task Doc</th>
                        <th>Task Details</th>
                        <th>Assign By</th>
                        <th>Assign To</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td><a href="{{url('projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}">{{$task->task_title}}</a></td>
                            <td>{{$task->project->project_title}}</td>
                            <td>{{$task->story->story_title}}</td>
                            <td>
                                <label class="label @if($task->task_type == "task") label-info @elseif($task->task_type == "bug") label-danger @elseif($task->task_type == "issue") label-warning @endif">{{$task->task_type}}</label>
                            </td>
                            <td>{{$task->task_start_date}}<br>{{$task->task_end_date}}</td>
                            <td>
                                <label class="label @if($task->task_status == "pending") label-warning @elseif($task->task_status == "progress") label-info @elseif($task->task_status == "postponed") label-danger @elseif($task->task_status == "done") label-success @endif">{{$task->task_status}}</label>
                            </td>
                            <td>@if($task->task_doc)<a target="_blank" href="{{asset('uploads/tasks/'.$task->task_doc)}}">view doc</a>@else No doc @endif</td>
                            <td>{{$task->task_details}}</td>
                            <td>@if($task->assignBy){{$task->assignBy->fullname}}@endif</td>
                            <td>@if($task->assignTo){{$task->assignTo->fullname}}@endif</td>
                            <td>{{$task->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-xs btn-success" href="{{url('tasks/'.$task->id.'/edit')}}">Edit</a>
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this task?', 'delete_{{$task->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}" id="delete_{{$task->id}}">
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
                        <th>Task Title</th>
                        <th>Project</th>
                        <th>Type</th>
                        <th>Start/End Date</th>
                        <th>Status</th>
                        <th>Task Doc</th>
                        <th>Task Details</th>
                        <th>Assign By</th>
                        <th>Assign To</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection