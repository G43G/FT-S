<div id="user-snaps-tab-content" class="tabcontent">
    <div class="container">
        <div class="row">
            @isset( $userSnaps )
                @if( count( $userSnaps ) > 0)
                    @foreach( $userSnaps as $userSnap )
                        <div class="6u">
                            <article class="item">
                                <a href="{{ asset('/snap/' . $userSnap->snapID) }}" class="image fit">
                                    <img src="{{ asset($userSnap->path) }}" alt="snap-image" />
                                    <div class="filter-overlay" style="{{ !$userSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $userSnap->class, 7 ).';' }}"></div>
                                </a>
                                <header class="snap-text">
                                    <h3>{{ substr( strip_tags( $userSnap->text ), 0, 35 ) }}</h3>
                                </header>
                                <header class="snap-icons">
                                    <div class="snap-like-icon-holder">
                                        @if( session()->has('user') )
                                            <span class="snap-like-button-holder"></span>
                                        @else
                                            <i class="icon fa-heart"></i>
                                        @endif
                                        <span class="snap-likes-count"></span>
                                    </div>
                                    <div class="snap-comments-icon-holder">
                                        <span class="icon-comment">
                                            @if( session()->has('user') )
                                                <i class="icon fa-comment"></i>
                                            @else
                                                <i class="icon fa-comment no-auth"></i>
                                            @endif
                                            <span class="snap-comments-count"></span>
                                        </span>
                                    </div>
                                    <div class="snap-views-icon-holder">
                                        <i class="icon fa-eye"></i>
                                        <span class="snap-views-count"></span>
                                    </div>
                                    <div class="snap-privacy-icon-holder">
                                        @if( $userSnap->status === 'public' )
                                            <span class="icon-privacy">
                                                <i class="icon fa-globe"></i>
                                            </span>
                                        @else
                                            <span class="icon-privacy">
                                                <i class="icon fa-lock"></i>
                                            </span>
                                        @endif
                                    </div>
                                </header>
                                <input type="hidden" class="hidden-snap-id" value="{{ $userSnap->snapID }}" />
                            </article>
                        </div>
                    @endforeach
                @else
                    <h1>This user doesn't currently have any snaps or its snaps are set to private.</h1>
                @endif
            @endisset
        </div>
    </div>
</div>
