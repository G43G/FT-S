@extends('layout.template')

@section('title')
    Home
@endsection

@section('main')
    <section id="home" class="two">
        <div class="container">
            <div class="row">
                @if( session()->has('user') )
                    @isset( $allHomeSnaps )
                        @if(count( $allHomeSnaps ) > 0 )
                            @foreach( $allHomeSnaps as $allHomeSnap )
                                <div class="6u">
                                    <article class="item">
                                        <a href="{{ asset('/snap/' . $allHomeSnap->snapID) }}" class="image fit">
                                            <img src="{{ asset($allHomeSnap->path) }}" alt="snap-image" />
                                            <div class="filter-overlay" style="{{ !$allHomeSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $allHomeSnap->class, 7 ).';' }}"></div>
                                        </a>
                                        <header class="snap-text">
                                            <h3>{{ substr( strip_tags( $allHomeSnap->text ), 0, 35 ) }}</h3>
                                        </header>
                                        <header class="snap-icons">
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
                                            <div class="snap-privacy-icon-holder">
                                                @if( $allHomeSnap->status === 'public' )
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
                                        <input type="hidden" class="hidden-snap-id" value="{{ $allHomeSnap->snapID }}" />
                                    </article>
                                </div>
                            @endforeach
                            <div class="12u load-more-all-home-snaps-form-holder">
                                <form id="load-more-all-home-snaps-form" method="POST">
                                    <input type="button" id="load-more-all-home-snaps-button" name="load-more-all-home-snaps-button" class="load-more-button" value="Load More" data-id="{{ $allHomeSnap->snapID }}" />
                                </form>
                            </div>
                        @else
                            <h1>There aren't any snaps posted at the moment.</h1>
                        @endif
                    @endisset
                @else
                    @isset( $publicHomeSnaps )
                        @if( count( $publicHomeSnaps ) > 0)
                            @foreach( $publicHomeSnaps as $publicHomeSnap )
                                <div class="6u">
                                    <article class="item">
                                        <a href="{{ asset('/snap/'.$publicHomeSnap->snapID) }}" class="image fit">
                                            <img src="{{ asset($publicHomeSnap->path) }}" alt="snap-image" />
                                            <div class="filter-overlay" style="{{ !$publicHomeSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $publicHomeSnap->class, 7 ).';' }}"></div>
                                        </a>
                                        <header class="snap-text">
                                            <h3>{{ substr( strip_tags( $publicHomeSnap->text ), 0, 35 ) }}</h3>
                                        </header>
                                        <header class="snap-icons">
                                            <div class="snap-like-icon-holder">
                                                <i class="icon fa-heart"></i>
                                                <span class="snap-likes-count"></span>
                                            </div>
                                            <div class="snap-comments-icon-holder">
                                                <span class="icon-comment">
                                                    <i class="icon no-comment fa-comment"></i>
                                                    <span class="snap-comments-count"></span>
                                                </span>
                                            </div>
                                            <div class="snap-views-icon-holder">
                                                <i class="icon fa-eye"></i>
                                                <span class="snap-views-count"></span>
                                            </div>
                                            <div class="snap-privacy-icon-holder">
                                                @if( $publicHomeSnap->status === 'public' )
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
                                        <input type="hidden" class="hidden-snap-id" value="{{ $publicHomeSnap->snapID }}" />
                                    </article>
                                </div>
                            @endforeach
                            <div class="12u load-more-public-home-snaps-form-holder">
                                <form id="load-more-public-home-snaps-form" method="POST">
                                    <input type="button" id="load-more-public-home-snaps-button" name="load-more-public-home-snaps-button" class="load-more-button" value="Load More" data-id="{{ $publicHomeSnap->snapID }}" />
                                </form>
                            </div>
                        @else
                            <h1>There are no snaps displayed as their status is set to private. Create an account in order to see those snaps.</h1>
                        @endif
                    @endisset
                @endif
            </div>
        </div>
    </section>
@endsection