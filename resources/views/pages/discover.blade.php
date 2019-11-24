@extends('layout.template')

@section('title')
    Discover
@endsection

@section('main')
    <section id="discover" class="two">
        <div class="container">
            <div class="row">
                <div class="form-holder">
                    <form method="post" action="{{ asset('/results') }}">
                        {{ csrf_field() }}
                        <input type="text" id="search-keyword" name="search-keyword" placeholder="Search" />
                        <label for="search-button" class="snap-search-label">
                            <i class="fa fa-search"></i>
                        </label>
                        <input type="button" title="Search" id="search-button" name="search-button" class="search-button" onclick="search();" />
                    </form>
                </div>
                <div class="content-holder">
                    <div class="user-title-holder">
                        <h3>Recent Users</h3>
                    </div>
                    @isset( $recentUsers )
                        <div class="users-holder">
                            <div class="row">
                                <div class="12u flex">
                                    @foreach( $recentUsers as $recentUser )
                                        <div class="user">
                                            @if( session()->has('user') )
                                                @if( $recentUser->userID === session()->get('user')[0]->id )
                                                    <a href="{{ asset('/profile') }}">
                                                        <img src="{{ asset($recentUser->image) }}" alt="user-profile-thumbnail-image" />
                                                    </a>
                                                @else
                                                    <a href="{{ asset('/' . $recentUser->username) }}">
                                                        <img src="{{ asset($recentUser->image) }}" alt="user-profile-thumbnail-image" />
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ asset('/' . $recentUser->username) }}">
                                                    <img src="{{ asset($recentUser->image) }}" alt="user-profile-thumbnail-image" />
                                                </a>
                                            @endif
                                            <span class="user-info">{{ $recentUser->name . ' ' . $recentUser->surname }}</span>
                                            <div class="user-overlay">
                                                <span class="user-username">{{ $recentUser->username }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endisset
                    @if( session()->has('user') )
                        @isset( $mostLikedSnaps )
                            <div class="snaps-title-holder">
                                <h3>Top 3 Most Liked Snaps</h3>
                            </div>
                            <div class="discovered-liked-snaps">
                                <div class="row">
                                    @if(count( $mostLikedSnaps ) > 0 )
                                        @foreach( $mostLikedSnaps as $mostLikedSnap )
                                            <div class="4u">
                                                <article class="item">
                                                    <a href="{{ asset('/snap/' . $mostLikedSnap->snapID) }}" class="image fit">
                                                        <img src="{{ asset($mostLikedSnap->path) }}" alt="snap-image" />
                                                        <div class="filter-overlay" style="{{ !$mostLikedSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $mostLikedSnap->class, 7 ).';' }}"></div>
                                                    </a>
                                                    <header class="snap-text">
                                                        <h3>{{ substr( strip_tags( $mostLikedSnap->text ), 0, 35 ) }}</h3>
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
                                                            @if( $mostLikedSnap->status === 'public' )
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
                                                    <input type="hidden" class="hidden-snap-id" value="{{ $mostLikedSnap->snapID }}" />
                                                </article>
                                            </div>
                                        @endforeach
                                    @else
                                        <h1>There aren't any snaps posted at the moment.</h1>
                                    @endif
                                </div>
                            </div>
                        @endisset
                        @isset( $mostCommentedSnaps )
                            <div class="snaps-title-holder">
                                <h3>Top 3 Most Commented Snaps</h3>
                            </div>
                            <div class="discover-commented-snaps">
                                <div class="row">
                                    @if(count( $mostCommentedSnaps ) > 0 )
                                        @foreach( $mostCommentedSnaps as $mostCommentedSnap )
                                            <div class="4u">
                                                <article class="item">
                                                    <a href="{{ asset('/snap/' . $mostCommentedSnap->snapID) }}" class="image fit">
                                                        <img src="{{ asset($mostCommentedSnap->path) }}" alt="snap-image" />
                                                        <div class="filter-overlay" style="{{ !$mostCommentedSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $mostCommentedSnap->class, 7 ).';' }}"></div>
                                                    </a>
                                                    <header class="snap-text">
                                                        <h3>{{ substr( strip_tags( $mostCommentedSnap->text ), 0, 35 ) }}</h3>
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
                                                            @if( $mostCommentedSnap->status === 'public' )
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
                                                    <input type="hidden" class="hidden-snap-id" value="{{ $mostCommentedSnap->snapID }}" />
                                                </article>
                                            </div>
                                        @endforeach
                                    @else
                                        <h1>There aren't any snaps posted at the moment.</h1>
                                    @endif
                                </div>
                            </div>
                        @endisset
                        @isset( $mostViewedSnaps )
                            <div class="snaps-title-holder">
                                <h3>Top 3 Most Viewed Snaps</h3>
                            </div>
                            <div class="discover-viewed-snaps">
                                <div class="row">
                                    @if(count( $mostViewedSnaps ) > 0 )
                                        @foreach( $mostViewedSnaps as $mostViewedSnap )
                                            <div class="4u">
                                                <article class="item">
                                                    <a href="{{ asset('/snap/' . $mostViewedSnap->snapID) }}" class="image fit">
                                                        <img src="{{ asset($mostViewedSnap->path) }}" alt="snap-image" />
                                                        <div class="filter-overlay" style="{{ !$mostViewedSnap->filter ? 'background-color: transparent;' : 'background-color: '.substr( $mostViewedSnap->class, 7 ).';' }}"></div>
                                                    </a>
                                                    <header class="snap-text">
                                                        <h3>{{ substr( strip_tags( $mostViewedSnap->text ), 0, 35 ) }}</h3>
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
                                                            @if( $mostViewedSnap->status === 'public' )
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
                                                    <input type="hidden" class="hidden-snap-id" value="{{ $mostViewedSnap->snapID }}" />
                                                </article>
                                            </div>
                                        @endforeach
                                    @else
                                        <h1>There aren't any snaps posted at the moment.</h1>
                                    @endif
                                </div>
                            </div>
                        @endisset
                    @else
                        <div class="12u no-auth">
                            <img src="{{ asset('/img/main/blur.jpg') }}" alt="no-access-image" />
                            <h3>You need to <a href="{{ asset('/auth') }}">LOG IN</a> to see Top 3 sections.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection