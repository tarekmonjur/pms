@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Welcome {{ config('app.name', 'PMS') }}
            <small>Dashboard reporting.</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Projects</span>
                        <span class="info-box-number">{{$total_project}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pending Projects</span>
                        <span class="info-box-number">{{$total_pending_project}}</span>
                    </div>
                </div>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total In-progress Projects</span>
                        <span class="info-box-number">{{$total_progress_project}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Complete Projects</span>
                        <span class="info-box-number">{{$total_complete_project}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Tasks</span>
                        <span class="info-box-number">{{$total_task}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pending Tasks</span>
                        <span class="info-box-number">{{$total_pending_task}}</span>
                    </div>
                </div>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total In-progress Tasks</span>
                        <span class="info-box-number">{{$total_progress_task}}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Complete Tasks</span>
                        <span class="info-box-number">{{$total_complete_task}}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <section class="content">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title text-center">Project and Tasks Status</h3>
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Project Title</th>
                                <th>Start/End Date</th>
                                <th>Status</th>
                                <th>Pending</th>
                                <th>Progress</th>
                                <th>Postponed</th>
                                <th>Done</th>
                                <th>Total</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($projects as $project)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><a target="_blank" href="{{url('projects/'.$project->id)}}">{{$project->project_title}}</a></td>
                                    <td>Start - {{$project->project_start_date}} <br> End - {{$project->project_end_date}}</td>
                                    <td>
                                        <label class="label @if($project->project_status == "pending") label-warning @elseif($project->project_status == "progress") label-info @elseif($project->project_status == "done") label-success @endif">{{$project->project_status}}</label>
                                    </td>
                                    <td><label class="label label-warning">{{$project->tasks->where('task_status','pending')->count()}}</label></td>
                                    <td><label class="label label-info">{{$project->tasks->where('task_status','progress')->count()}}</label></td>
                                    <td><label class="label label-danger">{{$project->tasks->where('task_status','postponed')->count()}}</label></td>
                                    <td><label class="label label-success">{{$project->tasks->where('task_status','done ')->count()}}</label></td>
                                    <td><label class="label label-primary">{{$project->tasks->count()}}</label></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Project Title</th>
                                <th>Start/End Date</th>
                                <th>Status</th>
                                <th>Pending</th>
                                <th>Progress</th>
                                <th>Postponed</th>
                                <th>Done</th>
                                <th>Total</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection