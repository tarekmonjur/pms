@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Project
            <small> project create form.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects')}}"> View Projects</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('projects/create')}}" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" name="project_start_date" value="{{ old('project_start_date') }}" placeholder="Enter Project Start Date">
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
                                        <input type="text" class="form-control" name="project_end_date" value="{{ old('project_end_date') }}" placeholder="Enter Project End Date">
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
                                        <input type="file" class="form-control" name="project_document" value="{{ old('project_document') }}">
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
                                            <option value="">--- Select Project Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="progress">Progress</option>
                                            <option value="done">Done</option>
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
                                        <label for="address">User Full Address</label>
                                        <textarea class="form-control" name="address" placeholder="Enter address">{{ old('address') }}</textarea>
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