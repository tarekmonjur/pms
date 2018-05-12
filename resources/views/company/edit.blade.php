@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Edit Company
            <small> company update form.</small>
            @if(canAccess("company"))
            <a class="btn btn-primary pull-right" href="{{url('/company')}}"> View Company</a>
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('company/'.$company->id)}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="project_title">Company Name</label>
                                        <input type="text" class="form-control" name="company_name" value="{{ (old('company_name'))?:$company->company_name }}" placeholder="Enter Company Name">
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_address">Company Address</label>
                                        <textarea class="form-control" name="company_address" placeholder="Enter Company Details">{{ (old('company_address'))?:$company->company_address }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Company</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection