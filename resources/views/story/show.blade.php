@extends('layouts.layout')
@section('content')

    <style>
        .comment_edit{display: none;}
        .task_event{cursor: pointer; padding: 5px;}
        label.error{color:red;}
    </style>

    <section class="content-header">
        <h1>
            <a href="{{url('projects/'.$project->id)}}">{{$project->project_title}}</a>
            <small> show project task details.</small>
            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#add_story_modal"> Add Story</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Project Stories List</h4>
                    </div>
                    <div class="list-group">
                        @foreach($project->stories as $story_info)
                            <a href="{{url('stories/'.$story_info->id)}}" style="color: #fff!important;">
                                <div  class="list-group-item list-group-item-action flex-column align-items-start @if($story_info->story_status == "done") bg-green @elseif($story_info->story_status == "pending") bg-yellow @elseif($story_info->story_status == "progress") bg-aqua @elseif($story_info->story_status == "postponed") bg-red @endif">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1" style="font-weight: bold">{{$loop->iteration.'. '.$story_info->story_title}}</h5>
                                    </div>
                                    <p class="mb-1">{{$story_info->story_details}}</p>
                                   <div class="btn-group">
                                        <a target="_blank" href="{{url('tasks/create?project_id='.$project->id.'&story_id='.$story->id)}}" class="btn btn-default btn-xs">Create Task</a>
                                        <a href="#" class="btn btn-default btn-xs" onclick="editStory('{{$story_info->id}}')">Edit</a>
                                        <a href="#" class="btn btn-default btn-xs" onclick="dataDelete('{{$story_info->id}}', '{{url('stories/'.$story_info->id)}}', 'story')">Delete</a>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{--show calender--}}
            <div class="col-md-9">

                <div class="list-group" style="border-radius: 0px">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h4 style="margin: 0px">Show all task of {{$story->story_title}}</h4>
                        </div>
                    </a>

                    @foreach($story->tasks as $task)
                    <a style="cursor: pointer; color: #fff!important;" onclick="getTask('{{$task->id}}')">
                        <div class="list-group-item list-group-item-action flex-column align-items-start @if($task->task_status == "done") bg-green @elseif($task->task_status == "pending") bg-yellow @elseif($task->task_status == "progress") bg-aqua @elseif($task->task_status == "postponed") bg-red @endif">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1" style="font-weight: bold">{{$loop->iteration}} . {{$task->task_title}}</h5>
                            </div>
                            <p>{{$task->task_details}}</p>

                            <div class="btn-group">
                                <a href="{{url('tasks/'.$task->id.'/edit')}}" class="btn btn-default btn-xs">Edit</a>
                                <a href="#" onclick="dataDelete('{{$task->id}}', '{{url('tasks/'.$task->id)}}', 'task')" class="btn btn-default btn-xs">Delete</a>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    {{--show task comment--}}
    <div class="modal" id="modal-default">
        <div class="modal-dialog" id="task_body"></div>
    </div>

    {{--add story modal--}}
    <div class="modal" id="add_story_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Project Story</h4>
                </div>
                <form id="add_story_form" method="post" action="{{url('stories')}}">
                <input type="hidden" value="{{$project->id}}" name="project_id">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="project_title">Story Title</label>
                                    <input type="text" class="form-control" name="story_title" placeholder="Enter Story Title">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="story_details">Story Details</label>
                                    <select name="story_status" class="form-control">
                                        <option value="">-- Select Status ---</option>
                                        <option value="pending">Pending</option>
                                        <option value="progress">Progress</option>
                                        <option value="postponed">Postponed</option>
                                        <option value="done">Done</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="story_details">Story Details</label>
                                    <textarea class="form-control" name="story_details" placeholder="Enter Story Details"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="story">Save Story</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{--edit story--}}
    <div class="modal" id="edit_story_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" id="edit_story"></div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/jquery-validate-1.17.0.js')}}"></script>
    <script>
        var baseUrl = '{{url('/')}}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // get task comments and show popup
        function getTask(task_id) {
            $.ajax({
                url: baseUrl+'/tasks/'+task_id,
                type: 'get',
                dataType: 'html',
                success:function (data) {
                    $("#task_body").html(data);
                    $('#modal-default').modal();
                },
                error: function (error) {
                    $("#task_body").html("<h2>Connection Problem.</h2>");
                }
            });
        }

        // show edit task comment
        function commentEdit(comment_id) {
            $("#comment_"+comment_id).hide();
            $("#comment_edit_"+comment_id).show();
        }

        // cancel task comment edit
        function commentCancel(comment_id) {
            $("#comment_"+comment_id).show();
            $("#comment_edit_"+comment_id).hide();
        }

        // delete task comments
        function commentDelete(task_id, comment_id) {
            swal({
                title: 'Are you sure delete this comment?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#c82333',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    url: baseUrl+'/tasks/'+task_id+'/comments/'+comment_id,
                    type: 'delete',
                    dataType: 'html',
                    success:function (data) {
                        $("#task_body").html(data);
                    },
                    error: function (error) {
                        $("#task_body").html("<h2>Connection Problem.</h2>");
                    }
                });
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'your stuff is safe.',
                        'error'
                    )
                }
            });
        }

         //show edit story popup
        function editStory(story_id){
            $.ajax({
                url: baseUrl+'/stories/'+story_id+'/edit',
                type: 'get',
                processData: false,
                contentType: false,
                dataType: 'html',
                success:function (data) {
                    $("#edit_story").html(data);
                    $('#edit_story_modal').modal();
                },
                error: function (error) {
                    $("#edit_story").html("<h2>Connection Problem.</h2>");
                }
            });
            return false;
        }


        // delete task comments
        function dataDelete(task_id, url, msg) {
            swal({
                title: 'Are you sure delete this '+msg+'?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#218838',
                cancelButtonColor: '#c82333',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then(function () {
                $.ajax({
                    url: url,
                    type: 'delete',
                    dataType: 'html',
                    success:function (data) {
                        location.reload();
                    },
                    error: function (error) {
                        location.reload();
                    }
                });
            }, function (dismiss) {
                if (dismiss === 'cancel') {
                    swal(
                        'Cancelled',
                        'your stuff is safe.',
                        'error'
                    )
                }
            });
        }


        $(function () {

            // add task comments
            $(document).on("submit","#add_comment", function(e){
                e.preventDefault();
                var form = document.querySelector("#add_comment");
                var formData = new FormData(form);
//                console.log(formData);
                $.ajax({
                    url: baseUrl+'/tasks/0/comments',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    data: formData,
                    success:function (data) {
                        $("#task_body").html(data);
                    },
                    error: function (error) {
                        $("#task_body").html("<h2>Connection Problem.</h2>");
                    }
                });
            });

            // update task comments
            $(document).on("submit",".comment_update", function(e){
                var id = "#comment_update_"+$(this).attr('id');
                var form = document.querySelector(id);
                form.event.preventDefault();
                var formData = new FormData(form);

                $.ajax({
                    url: baseUrl+'/tasks/'+0+'/comments/'+0,
                    type: 'put',
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    data: formData,
                    success:function (data) {
                        $("#task_body").html(data);
                    },
                    error: function (error) {
                        $("#task_body").html("<h2>Connection Problem.</h2>");
                    }
                });
            });

            //Task calender
            var date = new Date();
            var d    = date.getDate(),
                m    = date.getMonth(),
                y    = date.getFullYear();

            $('#calendar').fullCalendar({
                header    : {
                    left  : 'prev,next today',
                    center: 'title',
                    right : 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week : 'week',
                    day  : 'day'
                },
                //Random default events
                events: <?php echo $tasks;?>,
                eventClick:  function(event, jsEvent, view) {
                    getTask(event.task_id);
                },
            });


            $("#add_story_form, #edit_story_form").validate({
                rules: {
                    story_title: "required",
                    story_status: "required",
                    story_details: "required",
                    story_title: {
                        required: true,
                        maxlength: 255
                    }
                },
            });



        });
    </script>
@endsection