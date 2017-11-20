@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Manage Tasks
            <small> show all project tasks.</small>
            <a class="btn btn-primary pull-right" href="{{url('/tasks/create')}}"> Create Task</a>
        </h1>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">

            </div>
        </div>
    </section>

@endsection