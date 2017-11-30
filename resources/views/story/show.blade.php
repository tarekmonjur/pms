@extends('layouts.layout')
@section('content')

    <style>
        .comment_edit{display: none;}
        .task_event{cursor: pointer; padding: 5px;}
        label.error{color:red;}
    </style>

    <section class="content-header">
        <h1>
            {{$story->story_title}}
            <small> show all stories of project.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects/'.$story->project_id.'/stories/'.$story->id.'/tasks/create')}}"> Add Task</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="story_tabs">
                        <li class="active"><a href="#story" data-toggle="tab">Story</a></li>
                        <li><a href="#story_tab" data-toggle="tab">All Tasks</a></li>
                        <li><a href="#calender_view_tab" data-toggle="tab">Calender View</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="story">
                            <div class="box-body no-padding">
                                <div class="list-group">
                                    <div  class="list-group-item list-group-item-action flex-column align-items-start @if($story->story_status == "postponed") label-danger @elseif($story->story_status == "pending") label-warning @elseif($story->story_status == "progress") label-info @elseif($story->story_status == "done") label-success @endif">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h4 class="mb-1" style="font-weight: bold">{{$story->story_title}}</h4>
                                        </div>
                                        <p class="mb-1">Start Date : {{$story_start}}</p>
                                        <p class="mb-1">End Date : {{$story_end}}</p>
                                        <p class="mb-1">Story Status : {{$story->story_status}}</p>
                                        <p class="mb-1">{{$story->story_details}}</p>
                                        <div class="btn-group">
                                            @if($story->story_doc)
                                                <a target="_blank" href="{{asset('uploads/projects/'.$story->story_doc)}}" class="btn btn-default btn-xs">View Document</a>
                                            @endif
                                            <a href="#" class="btn btn-default btn-xs"  onclick="editStory('{{$story->project_id}}','{{$story->id}}')">Edit</a>
                                            <a href="#" class="btn btn-default btn-xs" onclick="return confirmDelete('delete', 'Are you sure delete this story?', 'delete_story')">Delete</a>
                                            <form method="post" action="{{url('/projects/'.$story->project_id.'/stories/'.$story->id)}}" id="delete_story">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="story_tab">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Task Title</th>
                                            <th>Project</th>
                                            <th>Type</th>
                                            <th>Start/End Date</th>
                                            <th>Status</th>
                                            <th>Task Doc</th>
                                            <th>Task Details</th>
                                            <th>Assign By</th>
                                            <th>Assign To</th>
                                            <th>Created</th>
                                            <th width="80px">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($story->tasks as $task)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><a href="{{url('projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}">{{$task->task_title}}</a></td>
                                                <td>{{$task->project->project_title}}</td>
                                                <td>
                                                    <label class="label @if($task->task_type == "task") label-info @elseif($task->task_type == "bug") label-danger @elseif($task->task_type == "issue") label-warning @endif">{{$task->task_type}}</label>
                                                </td>
                                                <td>{{$task->task_start_date}}<br>{{$task->task_end_date}}</td>
                                                <td>
                                                    <label class="label @if($task->task_status == "pending") label-warning @elseif($task->task_status == "progress") label-info @elseif($task->task_status == "postponed") label-danger @elseif($task->task_status == "done") label-success @endif">{{$task->task_status}}</label>
                                                </td>
                                                <td>@if($task->task_doc)<a target="_blank" href="{{asset('uploads/tasks/'.$task->task_doc)}}">view doc</a>@else No doc @endif</td>
                                                <td>{{$task->task_details}}</td>
                                                <td>@if($task->assignBy){{$task->assignBy->fullname}}@endif</td>
                                                <td>@if($task->assignTo){{$task->assignTo->fullname}}@endif</td>
                                                <td>{{$task->created_at->format('Y-m-d')}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-success" href="{{url('projects/'.$story->project_id.'/stories/'.$story->id.'/tasks/'.$task->id.'/edit')}}">Edit</a>
                                                        <a onclick="return confirmDelete('delete', 'Are you sure delete this task?', 'delete_{{$task->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                                        <form method="post" action="{{url('projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}" id="delete_{{$task->id}}">
                                                            {{csrf_field()}}
                                                            {{method_field('delete')}}
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Task Title</th>
                                            <th>Project</th>
                                            <th>Type</th>
                                            <th>Start/End Date</th>
                                            <th>Status</th>
                                            <th>Task Doc</th>
                                            <th>Task Details</th>
                                            <th>Assign By</th>
                                            <th>Assign To</th>
                                            <th>Created</th>
                                            <th width="80px">Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="calender_view_tab">
                            <div class="box box-primary">
                                <div class="box-body no-padding">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--edit story--}}
    <div class="modal" id="edit_story_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" id="edit_story"></div>
    </div>

    {{--show task comment--}}
    <div class="modal" id="modal-default">
        <div class="modal-dialog" id="task_body"></div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/jquery-validate-1.17.0.js')}}"></script>
    <script>
        var baseUrl = '{{url('/')}}';
        var project_id = <?php echo $story->project_id;?>;
        var story_id = <?php echo $story->id;?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //show edit story popup
        function editStory(project_id, story_id){
            $.ajax({
                url: baseUrl+'/projects/'+project_id+'/stories/'+story_id+'/edit',
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

        var task_calender = <?php echo $calender_tasks;?>

        $(function () {

            $(document).on("click", '#story_tabs a[href="#calender_view_tab"]', function(){
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
                    events: task_calender,
//                    eventClick:  function(event, jsEvent, view) {
//                        getTask(project_id, story_id, event.task_id);
//                    },
                });
                $(this).tab('show');
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