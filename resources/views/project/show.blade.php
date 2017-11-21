@extends('layouts.layout')
@section('content')

    <style>
        .comment_edit{display: none;}
        .task_event{cursor: pointer; padding: 5px;}
    </style>

    <section class="content-header">
        <h1>
            {{$project->project_title}}
            <small> show project task details.</small>
            <a class="btn btn-primary pull-right" href="{{url('/projects')}}"> All Project</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h4 class="box-title">Project Task List</h4>
                    </div>
                    <div class="box-body">
                        @foreach($project->tasks as $task)
                            <div onclick="return getTask('{{$task->id}}')" style="cursor: pointer" class="external-event @if($task->task_status == "done") bg-green @elseif($task->task_status == "pending") bg-yellow @elseif($task->task_status == "progress") bg-aqua @elseif($task->task_status == "postponed") bg-red @endif">
                                {{$loop->iteration.'. '.$task->task_title}}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog" id="modal_body">

        </div>
    </div>

@endsection

@section('script')
    <script>
        var baseUrl = '{{url('/')}}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function getTask(task_id) {
            $.ajax({
                url: baseUrl+'/tasks/'+task_id,
                type: 'get',
                dataType: 'html',
                success:function (data) {
                    $("#modal_body").html(data);
                    $('#modal-default').modal();
                },
                error: function (error) {
                    $("#modal_body").html("<h2>Connection Problem.</h2>");
                }
            });
        }

        function commentEdit(comment_id) {
            $("#comment_"+comment_id).hide();
            $("#comment_edit_"+comment_id).show();
        }

        function commentCancel(comment_id) {
            $("#comment_"+comment_id).show();
            $("#comment_edit_"+comment_id).hide();
        }

        function commentUpdate(comment_id){
            var form = document.querySelector(comment_id);
            var formData = new FormData(form);
            console.log(formData);

            $.ajax({
                url: baseUrl+'/tasks/0/comments/0',
                type: 'post',
                processData: false,
                contentType: false,
                dataType: 'html',
                data: formData,
                success:function (data) {
                    $("#modal_body").html(data);
                },
                error: function (error) {
                    $("#modal_body").html("<h2>Connection Problem.</h2>");
                }
            });
            return false;
        }

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
                        $("#modal_body").html(data);
                    },
                    error: function (error) {
                        $("#modal_body").html("<h2>Connection Problem.</h2>");
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
                        $("#modal_body").html(data);
                    },
                    error: function (error) {
                        $("#modal_body").html("<h2>Connection Problem.</h2>");
                    }
                });
            });

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
                        $("#modal_body").html(data);
                    },
                    error: function (error) {
                        $("#modal_body").html("<h2>Connection Problem.</h2>");
                    }
                });
            });

            //Date for the calendar events (dummy data)
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
        })
    </script>
@endsection