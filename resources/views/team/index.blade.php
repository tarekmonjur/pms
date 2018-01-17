@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            <ol class="breadcrumb" style="left: 0px!important;">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="{{url('/teams')}}">Manage Teams</a></li>
                @if(canAccess("teams/create"))
                    <a class="btn btn-primary breadcrumb-btn pull-right" href="{{url('/teams/create')}}"> Create Teams</a>
                @endif
            </ol>
        </h1>
    </section>

    <?php
    $edit = (canAccess("teams/edit"))?true:false;
    $delete = (canAccess("teams/delete"))?true:false;
    ?>

    <section class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Team Name</th>
                        <th>Team Details</th>
                        <th>Team Members</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$team->team_name}}</td>
                            <td>{{$team->team_details}}</td>
                            <td>
                                @foreach($team->members as $member)
                                   {{$loop->iteration}}. {{$member->user->fullname}} <br>
                                @endforeach
                            </td>
                            <td>{{$team->created_at->format('Y-m-d')}}</td>
                            <td>
                                <div class="btn-group">
                                    @if($edit == true)
                                    <a class="btn btn-xs btn-success" href="{{url('teams/'.$team->id.'/edit')}}">Edit</a>
                                    @endif
                                    @if($delete == true)
                                    <a onclick="return confirmDelete('delete', 'Are you sure delete this team?', 'delete_{{$team->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                    <form method="post" action="{{url('teams/'.$team->id)}}" id="delete_{{$team->id}}">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>SL</th>
                        <th>Team Name</th>
                        <th>Team Details</th>
                        <th>Team Members</th>
                        <th>Created</th>
                        <th width="80px">Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection