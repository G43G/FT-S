<div id="my-snaps-tab-content" class="tabcontent">
    <div class="container">
        <div class="row">
            @isset( $mySnaps )
                @if( count( $mySnaps ) > 0 )
                    @foreach( $mySnaps as $mySnap )
                        <div class="6u">
                            <article class="item">
                                <div class="snap-privacy">
                                    @if( $mySnap->status === 'public' )
                                        <i class="icon fa-globe"></i>
                                    @else
                                        <i class="icon fa-lock"></i>
                                    @endif
                                </div>
                                <a href="{{ asset('/snap/' . $mySnap->snapID) }}" class="image fit">
                                    <img src="{{ asset($mySnap->path) }}" alt="snap-image" />
                                    <div class="filter-overlay" style="{{ !$mySnap->filter ? 'background-color: transparent;' : 'background-color: '.substr($mySnap->class, 7).';' }}"></div>
                                </a>
                                <header class="snap-text">
                                    <h3>{{ substr( strip_tags( $mySnap->text ), 0, 35 ) }}</h3>
                                </header>
                                <header class="snap-icons">
                                    <a href="#" class="icon-edit" title="Edit Snap"><i class="icon fa-gear"></i></a>
                                    <div class="snap-like-icon-holder">
                                        <span class="snap-like-button-holder"></span>
                                        <span class="snap-likes-count"></span>
                                    </div>
                                    <div class="snap-comments-icon-holder">
                                        <span class="icon-comment">
                                            <i class="icon fa-comment"></i>
                                            <span class="snap-comments-count"></span>
                                        </span>
                                    </div>
                                    <div class="snap-views-icon-holder">
                                        <i class="icon fa-eye"></i>
                                        <span class="snap-views-count"></span>
                                    </div>
                                    <a href="{{ asset('/profile/removeSnap/' . $mySnap->snapId) }}" title="Delete Snap" class="icon-delete"><i class="icon fa-trash"></i></a>
                                </header>
                                <div class="snap-edit-overlay">
                                    <form>
                                        <div class="row">
                                            <div class="12u">
                                                <textarea id="updateSnapText-{{ $mySnap->snapID }}" name="updateSnapText-{{ $mySnap->snapID }}" placeholder="Optional text" >{{ $mySnap->text }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="12u">
                                                <input type="radio" id="updateSnapPublic-{{ $mySnap->snapID }}" name="updateSnapStatus-{{ $mySnap->snapID }}" value="public" {{ $mySnap->status === 'public' ? 'checked' : '' }} />
                                                <label for="updateSnapPublic-{{ $mySnap->snapID }}"><i class="fa fa-globe"></i></label>
                                                <input type="radio" id="updateSnapPrivate-{{ $mySnap->snapID }}" name="updateSnapStatus-{{ $mySnap->snapID }}" value="private" {{ $mySnap->status === 'private' ? 'checked' : '' }} />
                                                <label for="updateSnapPrivate-{{ $mySnap->snapID }}"><i class="fa fa-lock"></i></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="12u">
                                                <input type="button" name="submitUpdateSnap-{{ $mySnap->snapID }}" id="submitUpdateSnap-{{ $mySnap->snapID }}" class="button" title="Update Snap" onclick="updateSnap(this, {{ $mySnap->snapID }});" />
                                                <label for="submitUpdateSnap-{{ $mySnap->snapID }}">
                                                    <i class="icon fa-check"></i>
                                                </label>
                                                <a href="#" class="cancel-update-snap" title="Cancel Snap Edit"><i class="icon fa-ban"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <input type="hidden" class="hidden-snap-id" id="myHiddenSnapID-{{ $mySnap->user }}" name="myHiddenSnapID-{{ $mySnap->user }}" value="{{ $mySnap->snapID }}" />
                            </article>
                        </div>
                    @endforeach
                @else
                    <h1>You don't have any snaps yet. Try to post some.</h1>
                @endif
            @endisset
        </div>
    </div>
</div>
