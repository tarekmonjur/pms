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
            {{$task->task_title}}
            <small> show all stories of project.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects/'.$task->project_id.'/stories/'.$task->id.'/tasks/create')}}"> Add Task</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="task_tabs">
                        <li class="active"><a href="#task" data-toggle="tab">Task</a></li>
                        <li><a href="#comment_tab" data-toggle="tab">Comments</a></li>
                        <li><a href="#task_activity" data-toggle="tab">Task Activity</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="task">
                            <div class="box-body no-padding">
                                <div class="list-group">
                                    <div  class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h4 class="mb-1" style="font-weight: bold">{{$task->task_title}}</h4>
                                        </div>
                                        <p class="mb-1">Start Date : {{$task->task_start_date}}</p>
                                        <p class="mb-1">End Date : {{$task->task_end_date}}</p>
                                        <p class="mb-1">Story Status : <label class="label @if($task->task_status == "pending") label-warning @elseif($task->task_status == "pending") label-primary @elseif($task->task_status == "postponed") label-danger @elseif($task->task_status == "done") label-success @endif">{{$task->task_status}}</label></p>
                                        <p class="mb-1">{{$task->details_details}}</p>
                                        <div class="btn-group">
                                            @if($task->task_doc)
                                                <a target="_blank" href="{{asset('uploads/tasks/'.$task->task_doc)}}" class="btn btn-success btn-xs">View Document</a>
                                            @endif
                                            <a href="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id.'/edit')}}" class="btn btn-primary btn-xs">Edit</a>
                                            <a href="#" class="btn btn-danger btn-xs" onclick="return confirmDelete('delete', 'Are you sure delete this task?', 'delete_task')">Delete</a>
                                            <form method="post" action="{{url('/projects/'.$task->project_id.'/stories/'.$task->story_id.'/tasks/'.$task->id)}}" id="delete_task">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="comment_tab">@include('task.comment')</div>

                        <div class="tab-pane" id="task_activity">
                            <div class="box box-primary">
                                <div class="post" style="padding: 10px">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                        <span class="username">
                                          <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>
                                </div>
                                <div class="post clearfix" style="padding: 10px">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                        <span class="username">
                                          <a href="#">Sarah Ross</a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

                $(this).find("textarea.mention").mentionsInput('val', function(text) {
                    alert(text);
                });

                $(this).find("textarea.mention").mentionsInput('getMentions', function(data) {
                    alert(JSON.stringify(data));
                });

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

        });


    </script>
@endsection
