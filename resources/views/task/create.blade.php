@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Create Task
            <small> task create form.</small>
            <a class="btn btn-primary pull-right" href="{{url('/tasks')}}"> View Tasks</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('tasks/create')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('task_title') ? ' has-error' : '' }}">
                                        <label for="task_title">Task Title</label>
                                        <input type="text" class="form-control" name="task_title" value="{{ old('task_title') }}" autofocus placeholder="Enter Task Title">
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
                                                <option value="{{$project->id}}">{{$project->project_title}}</option>
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
                                            <option value="task">Task</option>
                                            <option value="bug">Bug</option>
                                            <option value="issue">Issue</option>
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
                                        <input type="text" class="form-control" name="task_start_date" value="{{ old('task_start_date') }}" placeholder="Enter Task Start Date">
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
                                        <input type="text" class="form-control" name="task_end_date" value="{{ old('task_end_date') }}" placeholder="Enter Task End Date">
                                        @if ($errors->has('task_end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('task_end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('task_details') ? ' has-error' : '' }}">
                                        <label for="task_details">Task Details</label>
                                        <textarea name="task_details" id="task_details" class="form-control" placeholder="Enter Task Details">{{old('task_details')}}</textarea>
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
                                            <option value="">--- Select User ---</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->fullname}}</option>
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
                                            <option value="">--- Select User ---</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->fullname}}</option>
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
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection