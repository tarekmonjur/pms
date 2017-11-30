<div class="box box-primary">
    @if($task->assignTo)
    <div class="box-header with-border">
        <div class="user-block">
            <img class="img-circle" src="@if($task->assignTo){{$task->assignTo->fullphoto}}@endif" alt="User Image">
            <span class="username"><a href="#">@if($task->assignTo){{$task->assignTo->fullname}}@endif</a></span>
        </div>
    </div>
    @endif
    <div class="box-footer box-comments">
        @foreach($task->comments as $comment)
            <div class="box-comment" id="comment_{{$comment->id}}">
                <img class="img-circle img-sm" src="{{$comment->user->fullphoto}}" alt="User Image">
                <div class="comment-text">
                    <span class="username">{{$comment->user->fullname}}
                        <span class="text-muted pull-right">{{$comment->created_at->format('d M Y')}}<br>
                            <a class="btn btn-primary btn-xs" onclick="commentEdit('{{$comment->id}}')">Edit</a>
                            <a class="btn btn-danger btn-xs" onclick="commentDelete('{{$task->id}}', '{{$comment->id}}')">Delete</a>
                        </span>
                    </span>
                    {!! $comment->comments !!}
                    @if($comment->attach)
                        <br>
                        <a target="_blank" href="{{$comment->fullattach}}">View Attachment</a>
                    @endif
                </div>
            </div>

            <div class="box-footer comment_edit" id="comment_edit_{{$comment->id}}">
                <form id="comment_update_{{$comment->id}}" onsubmit="return commentUpdate(event)" enctype="multipart/form-data">
                    <img class="img-responsive img-circle img-sm" src="{{$auth->fullphoto}}" alt="Alt Text">
                    <div class="img-push">
                        {{method_field('put')}}
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <textarea name="comments" class="mention form-control" placeholder="Enter your comment ...">{{$comment->comments}}</textarea>
                        <span class="text-danger">{{$errors->first('comments')}}</span>
                        <input type="file" class="form-control input-sm col-md-6" name="comment_document">
                        <span class="text-danger">{{$errors->first('comment_document')}}</span>
                        <input type="submit" class="btn btn-primary btn-xs" name="Save" value="Update Comment" style="margin-top: 5px">
                        <a class="btn btn-danger btn-xs" style="margin-top: 5px" onclick="commentCancel('{{$comment->id}}')">Cancel</a>
                        @if($comment->attach)
                            <a class="pull-right" target="_blank" href="{{$comment->fullattach}}">View Attachment</a>
                        @endif
                    </div>
                </form>
            </div>
        @endforeach
    </div>

    <div class="box-footer">
        <form id="add_comment" enctype="multipart/form-data">
            <img class="img-responsive img-circle img-sm" src="{{$auth->fullphoto}}" alt="Alt Text">
            <div class="img-push">
                <textarea name="comments" class="mention form-control" placeholder="Enter your comment ..."></textarea>
                <span class="text-danger">{{$errors->first('comments')}}</span>
                <input type="file" class="form-control input-sm" name="comment_document">
                <span class="text-danger">{{$errors->first('comment_document')}}</span>
                <input type="submit" class="btn btn-primary btn-xs" name="Save" value="Save Comment" style="margin-top: 5px">
            </div>
        </form>
    </div>
</div>