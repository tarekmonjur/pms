@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Edit Task
            <small> task update form.</small>
            <a class="btn btn-primary pull-right" href="{{url('/tasks')}}"> View Tasks</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('tasks')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('task_title') ? ' has-error' : '' }}">
                                        <label for="task_title">Task Title</label>
                                        <input type="text" class="form-control" name="task_title" value="{{ (old('task_title'))?:$task->task_title }}" autofocus placeholder="Enter Task Title">
                                        @if ($errors->has('task_title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('task_title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('project_name') ? ' has-error' : '' }}">
                                        <label for="project_name">Project Name</label>
                                        <select name="project_name" id="project_name" class="form-control">
                                            <option value="">--- Select Project ---</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}" @if($project->id == $task->project_id) selected @endif>{{$project->project_title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('project_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('project_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('task_type') ? ' has-error' : '' }}">
                                        <label for="task_type">Task Type</label>
                                        <select name="task_type" id="task_type" class="form-control">
                                            <option value="">--- Select Task Type ---</option>
                                            <option value="task" @if($task->task_type == "task") selected @endif>Task</option>
                                            <option value="bug" @if($task->task_type == "bug") selected @endif>Bug</option>
                                            <option value="issue" @if($task->task_type == "issue") selected @endif>Issue</option>
                                        </select>
                                        @if ($errors->has('task_type'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('task_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('task_start_date') ? ' has-error' : '' }}">
                                        <label for="task_start_date">Task Start Date</label>
                                        <input type="text" class="form-control datepicker" name="task_start_date" value="{{ (old('task_start_date'))?:$task->task_start_date }}" placeholder="Enter Task Start Date">
                                        @if ($errors->has('task_start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('task_start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('task_end_date') ? ' has-error' : '' }}">
                                        <label for="task_end_date">Task End Date</label>
                                        <input type="text" class="form-control datepicker" name="task_end_date" value="{{ (old('task_end_date'))?:$task->task_end_date }}" placeholder="Enter Task End Date">
                                        @if ($errors->has('task_end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('task_end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('task_status') ? ' has-error' : '' }}">
                                        <label for="task_status">Task Status</label>
                                        <select name="task_status" id="task_type" class="form-control">
                                            <option value="">--- Select Task Status ---</option>
                                            <option value="pending" @if($task->task_status == "pending") selected @endif>Pending</option>
                                            <option value="progress" @if($task->task_status == "progress") selected @endif>In Progress</option>
                                            <option value="postponed" @if($task->task_status == "postponed") selected @endif>Postponed</option>
                                            <option value="done" @if($task->task_status == "done") selected @endif>Done</option>
                                        </select>
                                        @if ($errors->has('task_status'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('task_status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('task_document') ? ' has-error' : '' }}">
                                        <label for="task_document">Task Document</label>
                                        <input type="file" class="form-control" name="task_document">
                                        @if ($errors->has('task_document'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('task_document') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top: 15px">
                                    @if($project->task_doc)
                                        <a href="{{asset('uploads/tasks/'.$project->task_doc)}}">View Task Document</a>
                                    @else
                                        <a href="#">No Task Document</a>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('task_details') ? ' has-error' : '' }}">
                                        <label for="task_details">Task Details</label>
                                        <textarea name="task_details" id="task_details" class="form-control" placeholder="Enter Task Details">{{(old('task_details'))?:$task->task_details}}</textarea>
                                        @if ($errors->has('task_details'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('task_details') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('assign_by') ? ' has-error' : '' }}">
                                        <label for="assign_by">Task Assign By</label>
                                        <select name="assign_by" id="assign_by" class="form-control">
                                            <option value="0">--- Select Assign By ---</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($user->id == $task->assign_by) selected @endif>{{$user->fullname}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('assign_by'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('assign_by') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('assign_to') ? ' has-error' : '' }}">
                                        <label for="assign_to">Task Assign To</label>
                                        <select name="assign_to" id="assign_to" class="form-control">
                                            <option value="0">--- Select Assign To ---</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($user->id == $task->assign_to) selected @endif>{{$user->fullname}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('assign_to'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('assign_to') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection