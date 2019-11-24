<div class="snap-comments-holder">
    @if( session()->has('user') )
        @isset( $snapComments )
        <div class="snap-comments">
            @if( !$snapComments->isEmpty() )
                @foreach( $snapComments as $snapComment )
                    <div class="comment-holder">
                        <div class="comment-image-holder">
                            @if( session()->has('user') && session()->get('user')[0]->id === $snapComment->user )
                                <a href="{{ asset('/profile') }}">
                                    <img src="{{ asset($snapComment->thumb_path) }}" alt="comment-user-thumbnail-image" class="comment-image"/>
                                </a>
                            @else
                                <a href="{{ asset($snapComment->username) }}">
                                    <img src="{{ asset($snapComment->thumb_path) }}" alt="comment-user-thumbnail-image" class="comment-image"/>
                                </a>
                            @endif
                        </div>
                        <div class="comment-content-holder">
                            <span class="user-comment-date">{{ $snapComment->username }} @ {{ !empty( $snapComment->commentNewDate ) ? date( 'd-M-Y | H:i', strtotime( $snapComment->commentNewDate ) ) . ' (updated)' : date( 'd-M-Y | H:i', strtotime( $snapComment->commentDate ) ) }}</span>
                            <span class="user-comment-text">{{ $snapComment->text }}</span>
                            @if( session()->has('user') && session()->get('user')[0]->id === $snapComment->user )
                                <span class="user-comment-edit">
                                    <a href="#" data-id="{{ $snapComment->commentID }}" title="Edit Comment" data-text="{{ $snapComment->text }}" style="visibility: visible; opacity: 1;" class="activate-edit-comment"><i class="icon fa-edit"></i></a>
                                    <a href="#" style="visibility: hidden; opacity: 0;" title="Cancel Comment Edit" class="cancel-edit-comment"><i class="icon fa-ban"></i></a>
                                </span>
                                <span class="user-comment-delete">
                                    <a href="#" title="Delete Comment" onclick="removeComment({{ $snapComment->commentID }}); return false;"><i class="icon fa-trash"></i></a>
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="comment-notice">
                    <h1>There are currently no comments on this snap.<br/> Be first to comment something.</h1>
                </div>
            @endif
        </div>
        <div class="snap-comments-form">
            <form>
                <div class="row">
                    <div class="12u">
                        <textarea id="commentText" name="commentText" placeholder="Comment"></textarea>
                        <input type="button" class="button comment-button" value="Comment" onclick="comment();" />
                    </div>
                </div>
            </form>
        </div>
        @endisset
    @else
        <div class="comment-notice">
            <h1>You must log in in order to comment and see comments. <br/> <a href="{{ asset('/auth') }}">LOG IN</a></h1>
        </div>
    @endif
</div>
