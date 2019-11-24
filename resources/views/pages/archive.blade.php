@extends('layout.template')

@section('title')
    @isset( $archiveSnaps )
        Archive
    @endisset
@endsection

@section('main')
    <section id="archive" class="two">
        <div>
            <h2>Archive</h2>
        </div>
        <div class="container">
            <div class="row">
                @isset( $archiveSnaps )
                    @foreach( $archiveSnaps as $archiveSnap )
                        <div class="6u">
                            <article class="item">
                                <a href="{{ asset('/snap/' . $archiveSnap->snapID) }}" class="image fit">
                                    <img src="{{ asset($archiveSnap->path) }}" alt="snap-image" />
                                    <div class="filter-overlay" style="{{ !$archiveSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $archiveSnap->class, 7 ).';' }}"></div>
                                </a>
                                <header class="snap-text">
                                    <h3>{{ substr( strip_tags( $archiveSnap->text ), 0, 35 ) }}</h3>
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
                                        @if( $archiveSnap->status === 'public' )
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
                                <input type="hidden" class="hidden-snap-id" value="{{ $archiveSnap->snapID }}" />
                            </article>
                        </div>
                    @endforeach
                    <div class="12u load-more-archive-snaps-form-holder">
                        <form id="load-more-archive-snaps-form" method="POST">
                            <input type="button" id="load-more-archive-snaps-button" name="load-more-archive-snaps-button" class="load-more-button" value="Load More" data-id="{{ $archiveSnap->snapID }}" />
                        </form>
                    </div>
                @endisset
            </div>
        </div>
    </section>
@endsection
