@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Create Department
            <small> company department create form.</small>
            @if(canAccess("department"))
            <a class="btn btn-primary pull-right" href="{{url('/department')}}"> View Department</a>
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('department')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="company_name">Company Name</label>
                                        <select name="company_name" id="company_name" class="form-control">
                                            <option value="">--- Select Company Name ---</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('department_name') ? ' has-error' : '' }}">
                                        <label for="department_name">Department Name</label>
                                        <input type="text" class="form-control" name="department_name" value="{{ old('department_name') }}" placeholder="Enter Department Name">
                                        @if ($errors->has('department_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('department_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create Department</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection