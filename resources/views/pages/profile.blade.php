@extends('layout.template')

@section('title')
    Profile
@endsection

@section('main')
    @isset( $loggedUser )
        <section id="profile-header" class="four">
            <div class="container">
                <div class="row">
                    <div class="3u">
                        <div class="profile-image">
                            <img src="{{ asset($loggedUser->thumb_path) }}" alt="profile-image"/>
                            @if( $loggedUser->image !== 1 )
                                <a href="{{ asset('/profile/deleteImage/' . $loggedUser->imageId) }}" title="Delete Profile Image">
                                    <i id="remove-btn" class="icon fa-trash-o"></i>
                                </a>
                            @else
                                <span id="popup-btn" class="icon fa-plus"></span>
                                <div id="popup" class="popup">
                                    <form method="post" action="{{ asset('/profile/uploadImage') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <label for="profileImgUpload">
                                            <i class="icon fa-file-photo-o"></i>
                                        </label>
                                        <input type="file" name="profileImgUpload" id="profileImgUpload" />
                                        <label for="profileImgBtn">
                                            <i class="icon fa-check-circle-o"></i>
                                        </label>
                                        <input type="submit" name="profileImgBtn" id="profileImgBtn" class="button" />
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="9u">
                        <div class="profile-info">
                            <h3 class="profile-title">{{ $loggedUser->name }} {{ $loggedUser->surname }} / {{ $loggedUser->username }}</h3>
                            <div class="profile-body">
                                <p>Joined: {{ date( 'd-M-Y', strtotime( $loggedUser->created_at ) ) }}</p>
                                @isset( $mySnapsCount )
                                    @if( $mySnapsCount !== 0 )
                                        <p>Snaps: {{ $mySnapsCount }}</p>
                                    @else
                                        <p>Snaps: 0</p>
                                    @endif
                                @endisset
                                @isset( $myCommentsCount )
                                    @if( $myCommentsCount !== 0 )
                                        <p>Comments: {{ $myCommentsCount }}</p>
                                    @else
                                        <p>Comments: 0</p>
                                    @endif
                                @endisset
                            </div>
                        </div>
                        <div class="tab-holder">
                            <button class="tab" id="add-snap-tab"><span class="icon fa-camera"></span>Add Snap</button>
                            <button class="tab" id="my-snaps-tab"><span class="icon fa-photo"></span>My Snaps</button>
                            <button class="tab" id="messages-tab"><span class="icon fa-envelope-o"></span>Messages</button>
                            <button class="tab" id="info-tab"><span class="icon fa-info-circle"></span>Info</button>
                            <button class="tab" id="edit-info-tab"><span class="icon fa-sliders"></span>Edit Info</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="profile-body" class="three">
            <div class="container">
                <div class="row">
                    <div class="tabcontent-holder">

                        <!-- Snap Tab -->
                        @include ('tabs.add-snap-tab')

                        <!-- My Snaps Tab -->
                        @include ('tabs.my-snaps-tab')

                        <!-- Messages Tab -->
                        @include ('tabs.messages-tab')

                        <!-- Info Tab -->
                        @include ('tabs.info-tab')

                        <!-- Edit Info Tab -->
                        @include ('tabs.edit-info-tab')

                    </div>
                </div>
            </div>
        </section>
    @endisset
@endsection