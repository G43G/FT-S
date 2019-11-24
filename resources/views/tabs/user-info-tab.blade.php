<div id="user-info-tab-content" class="tabcontent">
    @empty ( !$requestedUser->email )
        <p>E-Mail: <i><a href="mailto:{{ $requestedUser->email }}" title="Send Mail">{{ $requestedUser->email }}</a></i></p>
    @endempty
    @if( $requestedUser-> birthday == null && $requestedUser->city == null && $requestedUser->bio == null )
        <p>This user has no additional information.</p>
    @else
        @empty ( !$requestedUser->birthday )
            <p>Born: <i>{{ date('d-M-Y', strtotime($requestedUser->birthday)) }}</i></p>
        @endempty
        @empty ( !$requestedUser->city )
            <p>From: <i>{{$requestedUser->city }}</i></p>
        @endempty
        @empty ( !$requestedUser->bio )
            <p>{{ $requestedUser->bio }}</p>
        @endempty
    @endif
</div>
