@extends('layouts.layout')
@section('content')

<section class="content-header">
    <h1>
        Create User
        <small> user create form.</small>
    </h1>
    <span class="breadcrumb"><a class="btn btn-success pull-right" href="{{url('/user')}}"> View User</a></span>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"></h3>
                </div>
                <form role="form" method="post" action="{{url('user/create')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('hospital_id') ? ' has-error' : '' }}">
                                    <label for="hospital_id">Hospital Name</label>
                                    <select class="form-control" name="hospital_id">
                                        <option value=""> ---- Select Hospital -----</option>
                                        @foreach($hospitals as $hospital)
                                            <option value="{{$hospital->id}}">{{$hospital->hospital_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('hospital_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('hospital_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('department_id') ? ' has-error' : '' }}">
                                    <label for="department_id">Department Name</label>
                                    <select class="form-control" name="department_id">
                                        <option value=""> ---- Select Department -----</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('department_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" autofocus placeholder="Enter first name">
                                    @if ($errors->has('firstname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" autofocus placeholder="Enter last name">
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('designation') ? ' has-error' : '' }}">
                                    <label for="designation">Designation</label>
                                    <input type="text" class="form-control" name="designation" value="{{ old('designation') }}" autofocus placeholder="Enter designation">
                                    @if ($errors->has('designation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('designation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('mobile_no') ? ' has-error' : '' }}">
                                    <label for="mobile_no">Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_no" value="{{ old('mobile_no') }}" autofocus placeholder="Enter mobile no">
                                    @if ($errors->has('mobile_no'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus placeholder="Enter email address">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                    <label for="photo">Browse User Photo</label>
                                    <input type="file" class="form-control btn-primary" name="image">
                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
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