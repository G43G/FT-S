<div id="info-tab-content" class="tabcontent">
    <section id="profile-info">
        @empty ( !$loggedUser->email )
            <p>E-Mail: <i>{{ $loggedUser->email }}</i></p>
        @endempty
        @if( $loggedUser-> birthday === null && $loggedUser->city === null && $loggedUser->bio === null )
            <p>You don't have any additional information.</p>
        @else
            @empty ( !$loggedUser->birthday )
                <p>Born: <i>{{ date('d-M-Y', strtotime($loggedUser->birthday)) }}</i></p>
            @endempty
            @empty ( !$loggedUser->city )
                <p>From: <i>{{$loggedUser->city }}</i></p>
            @endempty
            @empty ( !$loggedUser->bio )
                <p>{{ $loggedUser->bio }}</p>
            @endempty
        @endif
    </section>
</div>