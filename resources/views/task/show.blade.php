@extends('layouts.layout')
@section('content')
    <link href="{{url('css/jquery.mentionsInput.css')}}" rel='stylesheet' type='text/css'>
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
                <li><a href="{{url('/projects/'.$task->project_id)}}">{{$task->project->project_title or ''}}</a></li>
                <li><a href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id)}}">{{$task->story->story_title or ''}}</a></li>
                <li><a href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}">{{$task->task_title}}</a></li>
                @if(canAccess("tasks/create"))
                <a class="btn btn-primary breadcrumb-btn" href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/create')}}"> Add Task</a>
                @endif
            </ol>
        </h1>
    </section>

    <?php
    $edit = (canAccess("tasks/edit"))?true:false;
    $delete = (canAccess("tasks/delete"))?true:false;
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
                    <ul class="nav nav-tabs" id="task_tabs">
                        <li class="active"><a href="#task" data-toggle="tab">Task</a></li>
                        <li><a href="#work_tab" data-toggle="tab">Work Summary</a></li>
                        <li><a href="#comment_tab" data-toggle="tab">Comments</a></li>
                        <li><a href="#task_activity" data-toggle="tab">Task Activity</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="task">
                            <div class="box-body no-padding">
                                <div class="list-group">
                                    <div  class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h4 class="mb-1" style="font-weight: bold">{{$task->task_title}}</h4>
                                            </div>
                                            <p class="mb-1">Start Date : {{$task->task_start_date}}</p>
                                            <p class="mb-1">End Date : {{$task->task_end_date}}</p>
                                            <p class="mb-1">Task Status : <label class="label @if($task->task_status == "pending") label-warning @elseif($task->task_status == "progress") label-primary @elseif($task->task_status == "paused") label-warning @elseif($task->task_status == "postponed") label-danger @elseif($task->task_status == "done") label-success @endif">{{$task->task_status}}</label></p>
                                            <p class="mb-1">Task Work Hour: <label class="label label-info">{{$task->task_work_hour}} hour</label></p>
                                            <p class="mb-1">Total Work Hour: <label class="label label-primary">
                                                    <?php $total_work_hour = explode('.',$task->works->sum('total_time'));
                                                        $total_work =  $total_work_hour[0].' hours, '.$total_work_hour[1].' minutes';
                                                        echo $total_work;
                                                    ?>
                                                </label></p>
                                            <p class="mb-1">{{$task->details_details}}</p>
                                            <div class="btn-group">
                                                @if(canAccess("tasks/edit"))
                                                <a class="btn btn-primary btn-xs" href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id.'/edit')}}">Edit</a>
                                                @endif
                                                @if(canAccess("tasks/delete"))
                                                <a href="#" class="btn btn-danger btn-xs" onclick="return confirmDelete('delete', 'Are you sure delete this task?', 'delete_task')">Delete</a>
                                                <form method="post" action="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}" id="delete_task">
                                                    {{csrf_field()}}
                                                    {{method_field('delete')}}
                                                </form>
                                                @endif
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn btn-xs btn-info" @if($task->task_status != "progress") href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id.'/tracking/start')}}" @else disabled @endif>Start Work</a>
                                                <a class="btn btn-xs btn-primary" @if($task->task_status == "progress") href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id.'/tracking/end')}}" @else disabled @endif>End Work</a>
                                                <a class="btn btn-success btn-xs" onclick="return confirmAction('done', 'Are you sure done this task?', '{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id.'/tracking/done')}}')" href="#">Done</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <h4>Task Documents
                                    @if(canAccess("tasks/create"))
                                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#upload_document_modal">Upload Document</a>
                                    @endif
                                </h4>
                                <div class="row">
                                    @foreach($task->documents as $document)
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
                                                    <p>{{$document->document}}</p>
                                                    @if($document->project)<p><strong>Project : </strong> <a
                                                                href="{{url('projects/'.$document->project_id)}}">{{$document->project->project_title}}</a></p>@endif
                                                    @if($document->story)<p><strong>Story : </strong> <a
                                                                href="{{url('projects/'.$document->project_id.'/stories/'.$document->story_id)}}">{{$document->story->story_title}}</a></p>@endif
                                                    @if($document->task)<p><strong>Task : </strong> <a
                                                                href="{{url('projects/'.$document->project_id.'/stories/'.$document->story_id.'/tasks/'.$document->task_id)}}">{{$document->task->task_title}}</a></p>@endif
                                                    @if(canAccess("tasks/delete"))
                                                        <p><a onclick="confirmDelete('Delete', 'Are you sure delete this document?','document_{{$document->id}}')" class="btn btn-xs btn-danger" role="button">Delete</a></p>
                                                        <form id="document_{{$document->id}}" action="{{url('tasks/document/'.$document->id)}}" method="post">
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

                        <div class="tab-pane" id="work_tab">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Task Start</th>
                                            <th>Task End</th>
                                            <th>Working</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($task->works as $work)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$work->start_time}}</td>
                                                    <td>{{$work->end_time}}</td>
                                                    <td>{{$work->total_time}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th colspan="3">Total Working Hour</th>
                                            <th>{{$total_work}}</th>
                                        </tr>
                                        <tr>
                                            <th>SL</th>
                                            <th>Task Start</th>
                                            <th>Task End</th>
                                            <th>Working</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="comment_tab">@include('task.comment')</div>

                        <div class="tab-pane" id="task_activity">
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
                <form action="{{url('tasks/document')}}" id="document_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$task->project_id}}" name="project_id">
                        <input type="hidden" value="{{$task->story_id}}" name="story_id">
                        <input type="hidden" value="{{$task->id}}" name="task_id">
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
    <script src='https://cdn.rawgit.com/jashkenas/underscore/1.8.3/underscore-min.js' type='text/javascript'></script>
    <script src="{{asset('js/jquery.elastic.js')}}"></script>
    <script src="{{asset('js/jquery.mentionsInput.js')}}"></script>
    <script>
        var baseUrl = '{{url('/')}}';
        var task_id = <?php echo $task->id;?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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


        // update task comments
        function commentUpdate(event) {
            var formData = new FormData(event.target);
            event.preventDefault();

            $.ajax({
                url: baseUrl + '/tasks/' + task_id + '/comments/' + 0,
                type: 'post',
                processData: false,
                contentType: false,
                dataType: 'html',
                data: formData,
                success: function (data) {
                    $("#comment_tab").html(data);
                },
                error: function (error) {
                    $("#comment_tab").html("<h2>Connection Problem.</h2>");
                }
            });

            return false;
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
                        $("#comment_tab").html(data);
                    },
                    error: function (error) {
                        $("#comment_tab").html("<h2>Connection Problem.</h2>");
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

        var teams = <?php echo $teams;?>

        $(function () {

            // add task comments
            $(document).on("submit","#add_comment", function(e){
                e.preventDefault();
                var form = document.querySelector("#add_comment");
                var formData = new FormData(form);
//                console.log(formData);

//                $(this).find("textarea.mention").mentionsInput('val', function(text) {
//                    alert(text);
//                });
//
//                $(this).find("textarea.mention").mentionsInput('getMentions', function(data) {
//                    alert(JSON.stringify(data));
//                });

                $.ajax({
                    url: baseUrl+'/tasks/'+ task_id +'/comments',
                    type: 'post',
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    data: formData,
                    success:function (data) {
                        $("#comment_tab").html(data);
                    },
                    error: function (error) {
                        $("#comment_tab").html("<h2>Connection Problem.</h2>");
                    }
                });
            });


            $('textarea.mention').mentionsInput({
                onDataRequest:function (mode, query, callback) {
                    var data = teams;

                    data = _.filter(data, function(item) { return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1 });

                    callback.call(this, data);
                }
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
