@extends('layouts.layout')
@section('content')

    <style>
        .comment_edit{display: none;}
        .task_event{cursor: pointer; padding: 5px;}
        label.error{color:red;}
    </style>

    <section class="content-header">
        <h1>
            <ol class="breadcrumb" style="left: 0px!important;">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{url('/projects')}}">Project</a></li>
                <li><a href="{{url('/projects/'.$story->project_id)}}">{{$story->project->project_title}}</a></li>
                <li><a href="{{url('/projects/'.$story->project_id.'/stories/'.$story->id)}}">{{$story->story_title}}</a></li>
                @if(canAccess("tasks/create"))
                <a class="btn btn-primary breadcrumb-btn" href="{{url('/projects/'.$story->project_id.'/stories/'.$story->id.'/tasks/create')}}"> Add Task</a>
                @endif
            </ol>
        </h1>
    </section>

    <?php
    $edit = (canAccess("tasks/edit"))?true:false;
    $delete = (canAccess("tasks/delete"))?true:false;
    ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="story_tabs">
                        <li class="active"><a href="#story" data-toggle="tab">Story</a></li>
                        @if(canAccess("stories/tasks"))
                        <li><a href="#story_tab" data-toggle="tab">All Tasks</a></li>
                        <li><a href="#calender_view_tab" data-toggle="tab">Calender View</a></li>
                        @endif
                        <li><a href="#story_activity" data-toggle="tab">Story Activity</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="story">
                            <div class="box-body no-padding">
                                <div class="list-group">
                                    <div  class="list-group-item list-group-item-action flex-column align-items-start @if($story->story_status == "postponed") label-danger @elseif($story->story_status == "pending") label-warning @elseif($story->story_status == "progress") label-info @elseif($story->story_status == "done") label-success @endif">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h4 class="mb-1" style="font-weight: bold">{{$story->story_title}}</h4>
                                            </div>
                                            <p class="mb-1">Start Date : {{$story_start}}</p>
                                            <p class="mb-1">End Date : {{$story_end}}</p>
                                            <p class="mb-1">Story Status : {{$story->story_status}}</p>
                                            <p class="mb-1">{{$story->story_details}}</p>
                                            <div class="btn-group">
                                                @if(canAccess("stories/edit"))
                                                <a href="#" class="btn btn-default btn-xs"  onclick="editStory('{{$story->project_id}}','{{$story->id}}')">Edit</a>
                                                @endif
                                                @if(canAccess("stories/delete"))
                                                <a href="#" class="btn btn-default btn-xs" onclick="return confirmDelete('delete', 'Are you sure delete this story?', 'delete_story')">Delete</a>
                                                <form method="post" action="{{url('/projects/'.$story->project_id.'/stories/'.$story->id)}}" id="delete_story">
                                                    {{csrf_field()}}
                                                    {{method_field('delete')}}
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if(canAccess("stories/create"))
                                                <form action="{{url('stories/document')}}" method="post" enctype="multipart/form-data" style="margin-top: 50px">
                                                    {{csrf_field()}}
                                                    <input type="hidden" value="{{$story->project_id}}" name="project_id">
                                                    <input type="hidden" value="{{$story->id}}" name="story_id">
                                                    <div class="form-group">
                                                        <label for="project_title">Upload Story Files</label>
                                                        <input type="file" name="document" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="submit" class="btn btn-default" value="Upload">
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>Story Documents</h4>
                                <div class="row">
                                    @foreach($story->documents as $document)
                                        <div class="col-md-2">
                                            <div class="thumbnail">
                                                <?php $ext = explode('.', $document->document); if(in_array($ext[1], ['jpg','jpeg','png','gif'])){?>
                                                <a target="_blank" href="{{asset('uploads/projects/'.$document->document)}}">
                                                    <img src="{{asset('uploads/projects/'.$document->document)}}" alt="">
                                                </a>
                                                <?php }else {?>
                                                <a target="_blank" href="{{asset('uploads/projects/'.$document->document)}}">
                                                    @if(in_array($ext[1], ['doc','docx']))
                                                        <i class="fa fa-file-word-o" style="font-size: 130px; margin-left: 10px"></i>
                                                    @elseif($ext[1] == 'pdf')
                                                        <i class="fa fa-file-pdf-o text-danger" style="font-size: 130px; margin-left: 10px"></i>
                                                    @elseif($ext[1] == 'pptx')
                                                        <i class="fa fa-file-powerpoint-o" style="font-size: 130px; margin-left: 10px"></i>
                                                    @endif
                                                </a>
                                                <?php }?>
                                                <div class="caption">
                                                    <p>{{$document->created_at}}</p>
                                                    @if(canAccess("stories/delete"))
                                                    <p><a onclick="confirmDelete('Delete', 'Are you sure delete this document?','document_{{$document->id}}')" class="btn btn-xs btn-danger" role="button">Delete</a></p>
                                                    <form id="document_{{$document->id}}" action="{{url('stories/document/'.$document->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        {{method_field('delete')}}
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                                        @if($edit == true)
                                                        <a class="btn btn-xs btn-success" href="{{url('projects/'.$story->project_id.'/stories/'.$story->id.'/tasks/'.$task->id.'/edit')}}">Edit</a>
                                                        @endif
                                                        @if($delete == true)
                                                        <a onclick="return confirmDelete('delete', 'Are you sure delete this task?', 'delete_{{$task->id}}')" class="btn btn-xs btn-danger" href="#">Delete</a>
                                                        <form method="post" action="{{url('projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}" id="delete_{{$task->id}}">
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

                        <div class="tab-pane" id="story_activity">
                            <div class="box box-primary">
                                @foreach($activities as $activity)
                                    <div class="post" style="padding: 10px">
                                        <div class="user-block" style="margin: 0px">
                                            @if(isset($activity->date["date"]))
                                                <span class="description" style="margin: 0px">Shared publicly - {{date("d M Y h:i:s",strtotime($activity->date["date"]))}}</span>
                                            @else
                                                <span class="description" style="margin: 0px">Shared publicly - {{date("d M Y h:i:s",strtotime($activity->date))}}</span>
                                            @endif
                                        </div>
                                        <p>{!! $activity->activity !!}</p>
                                    </div>
                                @endforeach
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