@extends('layouts.layout')
@section('content')

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
                            <div class="external-event @if($task->task_status == "done") bg-green @elseif($task->task_status == "pending") bg-yellow @elseif($task->task_status == "progress") bg-aqua @elseif($task->task_status == "postponed") bg-red @endif" data-toggle="modal" data-target="#modal-default"> {{$task->task_title}} </div>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body" style="background-color: #8080800a;">
                    <ul class="timeline">
                        <li class="time-label">
                            <span class="bg-red">
                                10 Feb. 2014
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-user bg-aqua"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                <h3 class="timeline-header"><a href="#">Support Team</a> ...</h3>
                                <div class="timeline-body">
                                    ...
                                    Content goes here
                                    <br>
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Edit</a>
                                    <a class="btn btn-danger btn-xs">Delete</a>
                                </div>
                            </div>
                        </li>

                        <li>
                            <i class="fa fa-comments bg-yellow"></i>
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Add Comment</a> ...</h3>
                                <div class="timeline-body">
                                    <textarea name="" id="" class="form-control"></textarea>
                                </div>
                                <div class="timeline-footer">
                                    <a class="btn btn-primary btn-xs">Save</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {

//            /* initialize the external events
//             -----------------------------------------------------------------*/
//            function init_events(ele) {
//                ele.each(function () {
//
//                    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
//                    // it doesn't need to have a start or end
//                    var eventObject = {
//                        title: $.trim($(this).text()) // use the element's text as the event title
//                    }
//
//                    // store the Event Object in the DOM element so we can get to it later
//                    $(this).data('eventObject', eventObject)
//
//                    // make the event draggable using jQuery UI
//                    $(this).draggable({
//                        zIndex        : 1070,
//                        revert        : true, // will cause the event to go back to its
//                        revertDuration: 0  //  original position after the drag
//                    })
//
//                })
//            }
//
//            init_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
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
//                events    : [
//                    {
//                        title          : 'All Day Event',
//                        start          : '2017,11,2',
//                        backgroundColor: '#f56954', //red
//                        borderColor    : '#f56954' //red
//                    },
//                    {
//                        title          : 'Long Event',
//                        start          : new Date(y, m, d - 5),
//                        end            : new Date(y, m, d - 2),
//                        backgroundColor: '#f39c12', //yellow
//                        borderColor    : '#f39c12' //yellow
//                    },
//                    {
//                        title          : 'Meeting',
//                        start          : new Date(y, m, d, 10, 30),
//                        allDay         : false,
//                        backgroundColor: '#0073b7', //Blue
//                        borderColor    : '#0073b7' //Blue
//                    },
//                    {
//                        title          : 'Lunch',
//                        start          : new Date(y, m, d, 12, 0),
//                        end            : new Date(y, m, d, 14, 0),
//                        allDay         : false,
//                        backgroundColor: '#00c0ef', //Info (aqua)
//                        borderColor    : '#00c0ef' //Info (aqua)
//                    },
//                    {
//                        title          : 'Birthday Party',
//                        start          : new Date(y, m, d + 1, 19, 0),
//                        end            : new Date(y, m, d + 1, 22, 30),
//                        allDay         : false,
//                        backgroundColor: '#00a65a', //Success (green)
//                        borderColor    : '#00a65a' //Success (green)
//                    },
//                    {
//                        title          : 'Click for Google',
//                        start          : new Date(y, m, 28),
//                        end            : new Date(y, m, 29),
//                        url            : 'http://google.com/',
//                        backgroundColor: '#3c8dbc', //Primary (light-blue)
//                        borderColor    : '#3c8dbc' //Primary (light-blue)
//                    }
//                ],
                editable  : false,
                droppable : false, // this allows things to be dropped onto the calendar !!!
                drop      : function (date, allDay) { // this function is called when something is dropped

                    // retrieve the dropped element's stored Event Object
                    var originalEventObject = $(this).data('eventObject')

                    // we need to copy it, so that multiple events don't have a reference to the same object
                    var copiedEventObject = $.extend({}, originalEventObject)

                    // assign it the date that was reported
                    copiedEventObject.start           = date
                    copiedEventObject.allDay          = allDay
                    copiedEventObject.backgroundColor = $(this).css('background-color')
                    copiedEventObject.borderColor     = $(this).css('border-color')

                    // render the event on the calendar
                    // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                    $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                    // is the "remove after drop" checkbox checked?
                    if ($('#drop-remove').is(':checked')) {
                        // if so, remove the element from the "Draggable Events" list
                        $(this).remove()
                    }

                }
            });
        })
    </script>
@endsection