@extends('layout.template')

@section('title')
    Search Results
@endsection

@section('main')
    <section id="search" class="two">
        <div class="container">
            <div class="row">
                <div class="form-holder">
                    <form method="post" action="{{'/results'}}">
                        {{ csrf_field() }}
                        <input type="text" id="search-keyword" name="search-keyword" placeholder="Search" />
                        <label for="search-button" class="snap-search-label">
                            <i class="fa fa-search"></i>
                        </label>
                        <input type="button" title="Search" id="search-button" name="search-button" class="search-button" onclick="search();" />
                    </form>
                </div>
                <div class="content-holder">
                    <div class="search-title-holder">
                        <h3>Search Results</h3>
                    </div>
                    @if( count( $userResults ) > 0 || count( $snapResults ) > 0 )
                        @isset( $userResults )
                            <div class="12u">
                                <div class="users-holder">
                                    @if(count( $userResults ) > 0 )
                                        @foreach( $userResults as $userResult )
                                            <div class="user">
                                                @if( session()->has('user') && session()->get('user')[0]->username === $userResult->username )
                                                    <a href="{{ asset('/profile') }}">
                                                @else
                                                    <a href="{{ asset('/' . $userResult->username) }}">
                                                @endif
                                                    <img src="{{ asset($userResult->image) }}" alt="user-profile-image" />
                                                </a>
                                                <span class="user-info">{{ $userResult->name . ' ' . $userResult->surname }}</span>
                                                <div class="user-overlay">
                                                    <span class="user-username">{{ $userResult->username }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endisset
                        @isset( $snapResults )
                            <div class="snaps-holder">
                                <div class="row">
                                    @if(count( $snapResults ) > 0 )
                                        @foreach( $snapResults as $snapResult )
                                            <div class="6u">
                                                <article class="item">
                                                    <a href="{{ asset('/snap/' . $snapResult->snapID) }}" class="image fit">
                                                        <img src="{{ asset($snapResult->path) }}" alt="snap-image" />
                                                        <div class="filter-overlay" style="{{ !$snapResult->filter ? 'background-color: transparent;' : 'background-color: '.substr( $snapResult->class, 7 ).';' }}"></div>
                                                    </a>
                                                    <header class="snap-text">
                                                        <h3>{{ substr( strip_tags( $snapResult->text ), 0, 35 ) }}</h3>
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
                                                            <i class="icon fa-comment {{ session()->has('user') ? '' : 'no-comment' }}"></i>
                                                            <span class="snap-comments-count"></span>
                                                        </span>
                                                        </div>
                                                        <div class="snap-views-icon-holder">
                                                            <i class="icon fa-eye"></i>
                                                            <span class="snap-views-count"></span>
                                                        </div>
                                                        <div class="snap-privacy-icon-holder">
                                                            @if( $snapResult->status === 'public' )
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
                                                    <input type="hidden" class="hidden-snap-id" value="{{ $snapResult->snapID }}" />
                                                </article>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endisset
                    @else
                        <div class="12u">
                            <h5>There aren't any records associated with your search.</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection