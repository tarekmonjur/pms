@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Create Project
            <small> project create form.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects')}}"> View Projects</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('projects')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('project_title') ? ' has-error' : '' }}">
                                        <label for="project_title">Project Title</label>
                                        <input type="text" class="form-control" name="project_title" value="{{ old('project_title') }}" placeholder="Enter Project Title">
                                        @if ($errors->has('project_title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('project_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('project_start_date') ? ' has-error' : '' }}">
                                        <label for="project_start_date">Project Start Date</label>
                                        <input type="text" class="form-control datepicker" name="project_start_date" value="{{ old('project_start_date') }}" placeholder="Enter Project Start Date">
                                        @if ($errors->has('project_start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('project_start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('project_end_date') ? ' has-error' : '' }}">
                                        <label for="project_end_date">Project End Date</label>
                                        <input type="text" class="form-control datepicker" name="project_end_date" value="{{ old('project_end_date') }}" placeholder="Enter Project End Date">
                                        @if ($errors->has('project_end_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('project_end_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('project_document') ? ' has-error' : '' }}">
                                        <label for="project_document">Project Document</label>
                                        <input type="file" class="form-control" name="project_document">
                                        @if ($errors->has('project_document'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('project_document') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('project_status') ? ' has-error' : '' }}">
                                        <label for="project_status">Project Status</label>
                                        <select name="project_status" id="project_status" class="form-control">
                                            <option value="">--- Select Project Status ---</option>
                                            <option value="initiate" @if(old('project_status') == "initiate") selected @endif>Initiate</option>
                                            <option value="pending" @if(old('project_status') == "pending") selected @endif>Pending</option>
                                            <option value="progress" @if(old('project_status') == "progress") selected @endif>Progress</option>
                                            <option value="done" @if(old('project_status') == "done") selected @endif>Done</option>
                                        </select>
                                        @if ($errors->has('project_status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('project_status') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="project_details">Project Details</label>
                                        <textarea class="form-control" name="project_details" placeholder="Enter Project Details">{{ old('project_details') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection