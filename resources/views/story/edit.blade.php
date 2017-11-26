<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Project Story</h4>
    </div>
    <form id="edit_story_form" method="post" action="{{url('stories/'.$story->id)}}">
        <input type="hidden" value="{{$story->project_id}}" name="project_id">
        <div class="modal-body">
            {{csrf_field()}}
            {{method_field('put')}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="project_title">Story Title</label>
                            <input type="text" class="form-control" name="story_title" value="{{$story->story_title}}" placeholder="Enter Story Title">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="story_details">Story Details</label>
                            <select name="story_status" class="form-control">
                                <option value="">-- Select Status ---</option>
                                <option value="pending" @if($story->story_status == 'pending') selected @endif>Pending</option>
                                <option value="progress" @if($story->story_status == 'progress') selected @endif>Progress</option>
                                <option value="postponed" @if($story->story_status == 'postponed') selected @endif>Postponed</option>
                                <option value="done" @if($story->story_status == 'done') selected @endif>Done</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="story_details">Story Details</label>
                            <textarea class="form-control" name="story_details" placeholder="Enter Story Details">{{$story->story_details}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="update_story">Update Story</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>