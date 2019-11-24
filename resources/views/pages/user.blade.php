@extends('layout.template')

@section('title')
    @isset( $requestedUser )
       User - {{ $requestedUser->username }}
    @endisset
@endsection

@section('main')
    @isset( $requestedUser )
        <section id="profile-header" class="four">
            <div class="container">
                <div class="row">
                    <div class="3u">
                        <div class="profile-image disabled">
                            <img src="{{ asset($requestedUser->thumb_path) }}" alt="user-profile-image"/>
                        </div>
                    </div>
                    <div class="9u">
                        <div class="profile-info">
                            <h3 class="profile-title">{{ $requestedUser->name }} {{ $requestedUser->surname }} / {{ $requestedUser->username }}</h3>
                            <div class="profile-body">
                                <p>Joined: {{ date('d-M-Y', strtotime($requestedUser->created_at)) }}</p>
                                @isset($userSnapsCount)
                                    @if($userSnapsCount !== 0)
                                        <p>Snaps: {{ $userSnapsCount }}</p>
                                    @else
                                        <p>Snaps: 0</p>
                                    @endif
                                @endisset
                                @isset($userCommentsCount)
                                    @if($userCommentsCount !== 0)
                                        <p>Comments: {{ $userCommentsCount }}</p>
                                    @else
                                        <p>Comments: 0</p>
                                    @endif
                                @endisset
                            </div>
                        </div>
                        <div class="tab-holder">
                            <button class="tab" id="user-snaps-tab"><span class="icon fa-photo"></span>Snaps</button>
                            <button class="tab" id="user-info-tab"><span class="icon fa-info-circle"></span>Info</button>
                            @if( session()->has('user') )
                                <button class="tab" id="send-message-tab"><span class="icon fa-paper-plane"></span>Send Message</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="profile-body" class="three">
            <div class="container">
                <div class="row">
                    <div class="tabcontent-holder">

                        <!-- Snaps Tab -->
                        @include ('tabs.user-snaps-tab')

                        <!-- Info Tab -->
                        @include ('tabs.user-info-tab')

                        <!-- Send Message Tab -->
                        @include ('tabs.send-message-tab')

                    </div>
                </div>
            </div>
        </section>
    @endisset
@endsection