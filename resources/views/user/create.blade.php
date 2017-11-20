@extends('layouts.layout')
@section('content')

<section class="content-header">
    <h1>
        Create User
        <small> user create form.</small>
        <a class="btn btn-primary pull-right" href="{{url('/users')}}"> View User</a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" method="post" action="{{url('users/create')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" autofocus placeholder="Enter first name">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" autofocus placeholder="Enter last name">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
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
                                <div class="form-group {{ $errors->has('user_type') ? ' has-error' : '' }}">
                                    <label for="user_type">User Role/Type</label>
                                    <select name="user_type" id="user_type" class="form-control">
                                        <option value="">--- Select User Role ---</option>
                                        <option value="director">Director</option>
                                        <option value="admin">Admin</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                    @if ($errors->has('user_type'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
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
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection