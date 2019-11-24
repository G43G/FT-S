@extends('layout.template')

@section('title')
    Snap
@endsection

@if( !empty( $singleSnap ) )
    @section('main')
        <section id="snap-single" class="four">
            <div class="snap-single-holder clearfix">
                <div class="snap-image-holder">
                    <div class="snap-image-overlay-holder">
                        <img src="{{ asset( $singleSnap->path ) }}" alt="snap-image" />
                        <div class="filter-overlay" style="{{ !$singleSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr($singleSnap->class, 7).';' }}"></div>
                    </div>
                    <div class="snap-image-info">
                        @if(session()->has('user'))
                            <div class="snap-like-icon-holder">
                                @isset( $snapUserLikes )
                                    @if( $snapUserLikes->isEmpty() )
                                        <span class="snap-button-holder">
                                            <button class="snap-like-button" title="Like This Snap" onclick="likeSnap();"><i class="icon fa-heart"></i></button>
                                        </span>
                                    @else
                                        <span class="snap-button-holder">
                                            <button class="snap-dislike-button" title="Dislike This Snap" onclick="dislikeSnap();"><i class="icon fa-heart"></i></button>
                                        </span>
                                    @endif
                                @endisset
                                @isset( $snapLikesCount )
                                    @if( $snapLikesCount === 0 )
                                        <span class="snap-likes-count">{{ $snapLikesCount }}</span>
                                    @else
                                        <span class="snap-likes-count"><a href="#" onclick="showLikeUsers(); return false;" title="Show Likes">{{ $snapLikesCount }}</a></span>
                                    @endif
                                @endisset
                            </div>
                            <div class="snap-comments-icon-holder">
                                <span class="icon-comment">
                                    <i class="icon fa-comment"></i>
                                    @isset( $snapCommentsCount )
                                        <span class="snap-comments-count">{{ $snapCommentsCount }}</span>
                                    @endisset
                                </span>
                            </div>
                        @else
                            <div class="snap-like-icon-holder">
                                <i class="icon fa-heart"></i>
                                @isset( $snapLikesCount )
                                    @if( $snapLikesCount === 0 )
                                        <span class="snap-likes-count">{{ $snapLikesCount }}</span>
                                    @else
                                        <span class="snap-likes-count"><span>{{ $snapLikesCount }}</span></span>
                                    @endif
                                @endisset
                            </div>
                            <div class="snap-comments-icon-holder">
                                <span class="icon-comment">
                                    <i class="icon fa-comment no-auth"></i>
                                    @isset( $snapCommentsCount )
                                        <span class="snap-comments-count">{{ $snapCommentsCount }}</span>
                                    @endisset
                                </span>
                            </div>
                        @endif
                        <div class="snap-privacy-icon-holder">
                            @if( $singleSnap->status === 'public' )
                                <span class="icon-privacy">
                                    <i class="icon fa-globe"></i>
                                </span>
                            @else
                                <span class="icon-privacy">
                                    <i class="icon fa-lock"></i>
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Comments -->
                    @include( 'components.comments' )

                </div>
                <div class="snap-info-holder">
                    @if( session()->has('user') && session()->get('user')[0]->id === $singleSnap->userID )
                        <h3><i class="icon fa-user"></i><a href="{{ asset('/profile') }}">{{ $singleSnap->username }}</a></h3>
                    @else
                        <h3><i class="icon fa-user"></i><a href="{{ asset( '/'.$singleSnap->username ) }}">{{ $singleSnap->username }}</a></h3>
                    @endif
                    @if( session()->has('user') )
                        <h3><i class="icon fa-calendar"></i><a href="{{ asset('/archive/'.substr( $singleSnap->snapDate, 0, -9 ) ) }}"><span>{{ date( 'd-M-Y', strtotime( $singleSnap->snapDate ) ) }}</span></a></h3>
                    @else
                        <h3><i class="icon fa-calendar"></i><span>{{ date( 'd-M-Y', strtotime( $singleSnap->snapDate ) ) }}</span></h3>
                    @endif
                        <h3><i class="icon fa-eye"></i><span>{{ $singleSnap->views }}</span></h3>
                    <p>{{ $singleSnap->text }}</p>
                    <span>{{ !empty( $singleSnap->snapNewDate ) ? 'Updated @ ' . date( 'd-M-Y | H:i', strtotime( $singleSnap->snapNewDate ) ) : '' }}</span>
                </div>
            </div>
            <input type="hidden" id="hidden-snap-id" name="hidden-snap-id" value="{{ $singleSnap->snapID }}" />
            <input type="hidden" id="hidden-user-id" name="hidden-user-id" value="{{ ( session()->has('user') ? session()->get('user')[0]->id : '' ) }}" />
        </section>
    @endsection
@else
    @section('redirect')
        <script>
            redirect();
        </script>
    @endsection
@endif

