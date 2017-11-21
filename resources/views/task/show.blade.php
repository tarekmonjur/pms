<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{$task->task_title}}</h4>
    </div>
    <div class="modal-body" style="background-color: #8080800a;">
        <ul class="timeline">
            <li class="time-label">
                <span class="@if($task->task_status == "done") bg-green @elseif($task->task_status == "pending") bg-yellow @elseif($task->task_status == "progress") bg-aqua @elseif($task->task_status == "postponed") bg-red @endif">
                    Task Deadline : Start - {{$task->task_start_date}} , End - {{$task->task_end_date}}
                </span>
            </li>
            <li>
                <i class="fa fa-envelope @if($task->task_status == "done") bg-green @elseif($task->task_status == "pending") bg-yellow @elseif($task->task_status == "progress") bg-aqua @elseif($task->task_status == "postponed") bg-red @endif"></i>
                <div class="timeline-item">
                    {{--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>--}}
                    <h3 class="timeline-header">Assign By - <a>{{$task->assignTo->fullname}}</a>, Assign To - <a>{{$task->assignTo->fullname}}</a></h3>
                    <div class="timeline-body">{{$task->task_details}}</div>
                </div>
            </li>

            @foreach($task->comments as $comment)
            <li class="time-label">
                <span class="@if($task->task_status == "done") bg-green @elseif($task->task_status == "pending") bg-yellow @elseif($task->task_status == "progress") bg-aqua @elseif($task->task_status == "postponed") bg-red @endif">
                   {{$comment->created_at->format('d M Y')}}
                </span>
            </li>
            <li>
                <img class="fa" width="30px" src="{{$comment->user->fullphoto}}" alt="">
                <div class="timeline-item" id="comment_{{$comment->id}}">
                    <h3 class="timeline-header"><a>{{$comment->user->fullname}}</a></h3>
                    <div class="timeline-body">
                        {{$comment->comments}}
                    </div>
                    <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs" onclick="commentEdit('{{$comment->id}}')">Edit</a>
                        <a class="btn btn-danger btn-xs" onclick="commentDelete('{{$task->id}}', '{{$comment->id}}')">Delete</a>
                        @if($comment->attach)
                            <a class="pull-right" target="_blank" href="{{$comment->fullattach}}">View Attachment</a>
                        @endif
                    </div>
                </div>

                <div class="timeline-item comment_edit" id="comment_edit_{{$comment->id}}">
                    <h3 class="timeline-header"><a>{{$comment->user->fullname}}</a></h3>

                    <div class="timeline-body">
                        <form id="comment_update_{{$comment->id}}" onsubmit="return commentUpdate('#comment_update_{{$comment->id}}')" enctype="multipart/form-data">
                            {{method_field('put')}}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <textarea name="comments" class="form-control">{{$comment->comments}}</textarea>
                            <span class="text-danger">{{$errors->first('comments')}}</span>
                            <input type="file" class="form-control" name="comment_document">
                            <span class="text-danger">{{$errors->first('comment_document')}}</span>
                            <div class="timeline-footer" style="margin-top: 5px">
                                <input type="submit" class="btn btn-primary btn-xs" name="Save" value="Update Comment">
                                <a class="btn btn-danger btn-xs" onclick="commentCancel('{{$comment->id}}')">Cancel</a>
                                @if($comment->attach)
                                    <a class="pull-right" target="_blank" href="{{$comment->fullattach}}">View Attachment</a>
                                @endif
                            </div>
                        </form>
                    </div>

                </div>
            </li>
            @endforeach

            <li>
                <i class="fa fa-comments bg-yellow"></i>
                <div class="timeline-item">
                    <h3 class="timeline-header"><a>Add Comment</a> ...</h3>

                    <div class="timeline-body">
                        <form id="add_comment" enctype="multipart/form-data">
                            <input type="hidden" name="task_id" value="{{$task->id}}">
                            <textarea name="comments" class="form-control"></textarea>
                            <span class="text-danger">{{$errors->first('comments')}}</span>
                            <input type="file" class="form-control" name="comment_document">
                            <span class="text-danger">{{$errors->first('comment_document')}}</span>
                            <div class="timeline-footer" style="margin-top: 5px">
                                <input type="submit" class="btn btn-primary btn-xs" name="Save" value="Save Comment">
                            </div>
                        </form>
                    </div>

                </div>
            </li>
        </ul>
    </div>
</div>