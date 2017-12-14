@extends('layouts.layout')
@section('content')

    <section class="content-header">
        <h1>
            Edit Team
            <small> team create form.</small>
            @if(canAccess("teams"))
            <a class="btn btn-primary pull-right" href="{{url('/teams')}}"> View Teams</a>
            @endif
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" method="post" action="{{url('teams/'.$team->id)}}">
                        {{csrf_field()}}
                        {{method_field('put')}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('team_name') ? ' has-error' : '' }}">
                                        <label for="team_name">Team Name</label>
                                        <input type="text" class="form-control" name="team_name" value="{{ (old('team_name'))?:$team->team_name }}" placeholder="Enter Team Name">
                                        @if ($errors->has('team_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('team_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="team_details">Team Details</label>
                                        <textarea class="form-control" name="team_details" placeholder="Enter Team Details">{{ (old('team_details'))?:$team->team_details }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <a href="#" id="add_member" class="btn btn-info btn-sm pull-right">Add Member</a>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="40%">Department Name</th>
                                            <th width="40%">Member Name</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="table_member">
                                            @foreach($team->members as $member)
                                                <tr>
                                                    <td>
                                                        <select name="" id="" class="form-control">
                                                            @foreach($departments as $department)
                                                            <option value="{{$department->id}}" @if($member->user->department_id == $department->id) selected @endif>{{$department->department_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="user_ids[]" id="" class="form-control">
                                                            @foreach($member->user->department->users as $duser)
                                                                <option value="{{$duser->id}}">{{$duser->fullname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><a href='#' class='delete btn btn-sm btn-danger'>Delete</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create Team</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        var base_url = '{{url('/')}}';
        var departments = JSON.parse('<?php echo json_encode($departments)?>');
        console.log(departments);

        $(document).on("click", "#add_member", function (e) {
            e.preventDefault();

            var html = "";
            html += "<tr>";
            html += "<td><select class='department form-control'><option value=''>--- Select Department ---</option>";
            for(var data in departments){
                html += "<option value='"+departments[data].id+"'>"+departments[data].department_name+"</option>";
            }
            html += "</select></td>";

            html += "<td class='member'>";
            html += "<select class='form-control'><option value=''>--- Select Team Member ---</option></select>";
            html += "</td>";
            html += "<td><a href='#' class='delete btn btn-sm btn-danger'>Delete</a></td>";
            html += "</tr>";

            $("#table_member").append(html);
        });

        $(document).on("change", ".department", function () {
            var id = $(this).val();
            var jthis = $(this);

            $.ajax({
                url: base_url+'/teams/create',
                type: 'get',
                dataType: 'json',
                data: {department_id: id},
                success: function(data){
                    console.log(data);
                    var html = "";
                    html += "<select name='user_ids[]' class='form-control'>";
                    for(var user in data){
                        html += "<option value='"+data[user].id+"'>"+data[user].first_name+" "+data[user].last_name+"</option>";
                    }
                    html += "</select>";
                    jthis.parent().parent().children(".member").html(html);
                },
                error:function (error) {

                }

            })
        });


        $(document).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

    </script>
@endsection