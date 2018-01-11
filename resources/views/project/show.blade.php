@extends('layouts.layout')
@section('content')

    <style>
        .comment_edit{display: none;}
        .task_event{cursor: pointer; padding: 5px;}
        label.error{color:red;}
        .select2-container{width: 100%!important;}
    </style>

    <section class="content-header">
        <h1>
            <ol class="breadcrumb" style="left: 0px!important;">
                <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{url('/projects')}}">Project</a></li>
                <li class="active"><a href="{{url('/projects/'.$project->id)}}">{{$project->project_title}}</a></li>
                @if(canAccess("stories/create"))
                <a class="btn btn-primary breadcrumb-btn" href="#" data-toggle="modal" data-target="#add_story_modal"> Add Story</a>
                @endif
            </ol>
        </h1>
    </section>

    <?php
    $edit = (canAccess("stories/edit"))?true:false;
    $delete = (canAccess("stories/delete"))?true:false;
    ?>

    <section class="content">
        @if($errors->has('document'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{$errors->first('document')}}
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="story_tabs">
                        <li class="active"><a href="#project" data-toggle="tab">Project</a></li>
                        <li><a href="#story_tab" data-toggle="tab">All Stories</a></li>
                        <li><a href="#calender_view_tab" data-toggle="tab">Calender View</a></li>
                        <li><a href="#project_activity" data-toggle="tab">Project Activity</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="project">
                            <div class="box-body no-padding">
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action flex-column align-items-start @if($project->project_status == "initiate") label-primary @elseif($project->project_status == "pending") label-warning @elseif($project->project_status == "progress") label-info @elseif($project->project_status == "done") label-success @endif">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h4 class="mb-1" style="font-weight: bold">{{$project->project_title}}</h4>
                                            </div>
                                            <p class="mb-1">Project Team :
                                                @foreach($project->teams($project->project_team) as $team)
                                                    {{$loop->iteration}} . <a href="{{url('teams')}}" style="color: white">{{$team->team_name}}</a><br>
                                                @endforeach
                                            </p>
                                            <p class="mb-1">Start Date : {{$project->project_start_date}}</p>
                                            <p class="mb-1">End Date : {{$project->project_end_date}}</p>
                                            <p class="mb-1">Project Status : {{$project->project_status}}</p>
                                            <p class="mb-1">{{$project->project_details}}</p>
                                            <div class="btn-group">
                                                @if(canAccess("projects/edit"))
                                                <a href="{{url('projects/'.$project->id.'/edit')}}" class="btn btn-default btn-xs">Edit</a>
                                                @endif
                                                @if(canAccess("projects/delete"))
                                                <a href="#" class="btn btn-default btn-xs" onclick="storyDelete('{{url('projects/'.$project->id)}}', 'project')">Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <h4>Project Documents
                                    @if(canAccess("projects/create"))
                                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#upload_document_modal">Upload Document</a>
                                    @endif
                                </h4>
                                <div class="row">

                                    @foreach($project->documents as $document)
                                    <div class="col-md-2">
                                        <div class="thumbnail">
                                            <?php $ext = explode('.', $document->document); if(in_array($ext[1], ['jpg','jpeg','png','gif','psd'])){?>
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
                                                <p>{{$document->document}}</p>
                                                <p><strong>Project : </strong> <a href="{{url('projects/'.$document->project_id)}}">{{$project->project_title}}</a></p>
                                                @if($document->story)<p><strong>Story : </strong> <a
                                                            href="{{url('projects/'.$document->project_id.'/stories/'.$document->story_id)}}">{{$document->story->story_title}}</a></p>@endif
                                                @if($document->task)<p><strong>Task : </strong> <a
                                                            href="{{url('projects/'.$document->project_id.'/stories/'.$document->story_id.'/tasks/'.$document->task_id)}}">{{$document->task->task_title}}</a></p>@endif
                                                @if(canAccess("projects/delete"))
                                                <p><a onclick="confirmDelete('Delete', 'Are you sure delete this document?','document_{{$document->id}}')" class="btn btn-xs btn-danger" role="button">Delete</a></p>
                                                <form id="document_{{$document->id}}" action="{{url('projects/document/'.$document->id)}}" method="post">
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
                                            <th>Story Title</th>
                                            <th>Members</th>
                                            <th>Story Status</th>
                                            <th>Story Details</th>
                                            <th>Created</th>
                                            <th width="80px">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($project->stories as $pstory)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><a href="{{url('projects/'.$project->id.'/stories/'.$pstory->id)}}">{{$pstory->story_title}}</a></td>
                                                <td>
                                                    @if($story_member = $pstory->members($pstory->story_member))
                                                        @foreach($story_member as $member)
                                                            {{$loop->iteration}} . <a href="{{url('teams')}}">{{$member->fullname}}</a><br>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>
                                                    <label class="label @if($pstory->story_status == "pending") label-warning @elseif($pstory->story_status == "progress") label-info @elseif($pstory->story_status == "postponed") label-danger @elseif($pstory->story_status == "done") label-success @endif">{{$pstory->story_status}}</label>
                                                </td>
                                                <td>{{$pstory->story_details}}</td>
                                                <td>{{$pstory->created_at->format('Y-m-d')}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if($edit == true)
                                                        <a class="btn btn-xs btn-success" href="#" onclick="editStory('{{$pstory->project_id}}','{{$pstory->id}}')">Edit</a>
                                                        @endif
                                                        @if($delete == true)
                                                        <a class="btn btn-xs btn-danger" href="#" onclick="storyDelete('{{url('projects/'.$project->id.'/stories/'.$pstory->id)}}', 'story')">Delete</a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Story Title</th>
                                            <th>Members</th>
                                            <th>Story Status</th>
                                            <th>Story Details</th>
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

                        <div class="tab-pane" id="project_activity">
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
                <form id="add_story_form" method="post" action="{{url('projects/'.$project->id.'/stories')}}">
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
                                    <div class="form-group {{ $errors->has('story_member') ? ' has-error' : '' }}">
                                        <label for="story_member">Story Member</label>
                                        <select name="story_member[]" id="story_member" class="select2 form-control" multiple>
                                            @foreach($team_members as $member)
                                                <option value="{{$member->id}}">{{$member->first_name}} {{$member->last_name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('story_member'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('story_member') }}</strong>
                                            </span>
                                        @endif
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

    {{--upload document modal--}}
    <div class="modal" id="upload_document_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Project Document Upload</h4>
                </div>
                <form action="{{url('projects/document')}}" id="document_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$project->id}}" name="project_id">
                        <div class="form-group">
                            <label for="document_name">Document File Name</label>
                            <input type="text" name="document_name" class="form-control" placeholder="Enter document file name... (optional)">
                        </div>
                        <div class="form-group">
                            <label for="document">Upload Project Files</label>
                            <input type="file" name="document" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="story">Upload</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
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


        // delete task comments
        function storyDelete(url, msg) {
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


        var story_calender = <?php echo $calender_story;?>

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
                    events: story_calender,
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

            $("#document_form").validate({
                rules: {
                    document: {
                        required: true,
                    }
                },
            });



        });
    </script>
@endsection