@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            <ol class="breadcrumb" style="left: 0px!important;">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{url('/projects')}}">Project</a></li>
                <li><a href="{{url('/projects/'.$project_id)}}">{{$project->project_title or ''}}</a></li>
                <li><a href="{{url('/projects/'.$project_id.'/stories/'.$story_id)}}">{{$story->story_title or ''}}</a></li>
                <li><a href="{{url('/projects/'.$project_id.'/stories/'.$story_id.'/create')}}">Create Task</a></li>
                <a class="btn btn-primary breadcrumb-btn" href="{{url('/projects/'.$project_id.'/stories/'.$story_id.'/tasks')}}"> View Tasks</a>
            </ol>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('/projects/'.$project_id.'/stories/'.$story_id.'/tasks')}}" enctype="multipart/form-data">
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
                                                <option value="{{$project->id}}" @if($project->id == $project_id) selected @endif>{{$project->project_title}}</option>
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
                                    <div class="form-group {{ $errors->has('project_name') ? ' has-error' : '' }}">
                                        <label for="story_name">Story Name</label>
                                        <select name="story_name" id="story_name" class="form-control">
                                            <option value="">--- Select Story ---</option>
                                            @foreach($stories as $story)
                                                <option value="{{$story->id}}" @if($story->id == $story_id) selected @endif>{{$story->story_title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('story_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('story_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('task_type') ? ' has-error' : '' }}">
                                        <label for="task_type">Task Type</label>
                                        <select name="task_type" id="task_type" class="form-control">
                                            <option value="">--- Select Task Type ---</option>
                                            <option value="task" @if(old('task_type') == "task") selected @endif>Task</option>
                                            <option value="bug" @if(old('task_type') == "bug") selected @endif>Bug</option>
                                            <option value="issue" @if(old('task_type') == "issue") selected @endif>Issue</option>
                                        </select>
                                        @if ($errors->has('task_type'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('task_type') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('task_start_date') ? ' has-error' : '' }}">
                                        <label for="task_start_date">Task Start Date</label>
                                        <input type="text" class="form-control datepicker" name="task_start_date" value="{{ old('task_start_date') }}" placeholder="Enter Task Start Date">
                                        @if ($errors->has('task_start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('task_start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('task_end_date') ? ' has-error' : '' }}">
                                        <label for="task_end_date">Task End Date</label>
                                        <input type="text" class="form-control datepicker" name="task_end_date" value="{{ old('task_end_date') }}" placeholder="Enter Task End Date">
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
                                            <option value="pending" @if(old('task_type') == "pending") selected @endif>Pending</option>
                                            <option value="progress" @if(old('task_type') == "progress") selected @endif>In Progress</option>
                                            <option value="postponed" @if(old('task_type') == "postponed") selected @endif>Postponed</option>
                                            <option value="done" @if(old('task_type') == "done") selected @endif>Done</option>
                                        </select>
                                        @if ($errors->has('task_status'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('task_status') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                            <option value="">--- Select Assign By ---</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}" @if($auth->id == $user->id) selected @endif>{{$user->fullname}}</option>
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
                                            <option value="">--- Select Assign To ---</option>
                                            @foreach($members as $member)
                                                <option value="{{$member->id}}">{{$member->fullname}}</option>
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
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection


@section('script')
    <script>
        $(function(){
            $(document).on("change", "#project_name", function(){
                var project_id = $(this).val();
                project_id = (project_id)?project_id:0;
                $.ajax({
                    url: baseUrl+'/projects/'+project_id+'/edit',
                    type: 'get',
                    dataType: 'html',
                    success:function (data) {
                        $("#story_name").html(data);
                    },
                    error: function (error) {
                        $("#story_name").html("<option>Connection Problem.</option>");
                    }
                });
            });

        });
    </script>
@endsection