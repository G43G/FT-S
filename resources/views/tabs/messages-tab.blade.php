<div id="messages-tab-content" class="tabcontent">
    <div class="container">
        <div class="row">
            <div class="12u">
                @isset( $myThreads )
                    @if( !$myThreads->isEmpty() )
                        <dl class="accordion one">
                            @foreach( $myThreads as $myThread )
                                @if( $myThread->viewer === $loggedUser->username || $myThread->viewer === '0' )
                                    <div class="thread" id="thread-{{ $myThread->id }}">
                                        <dt>
                                            @if( $loggedUser->username == $myThread->thread_to )
                                                <p>Conversation with</p><a href="{{ asset('/') . $myThread->thread_from }}"> {{ $myThread->thread_from }}</a>
                                            @else
                                                <p>Conversation with</p><a href="{{ asset('/') . $myThread->thread_to }}"> {{ $myThread->thread_to }}</a>
                                            @endif
                                            <i class="icon fa-chevron-down toggle-thread"></i>
                                            <a href="{{ asset('/profile/deleteMessage/' . $myThread->id) }}" title="Delete Thread" class="delete-message"><i class="icon fa-trash"></i></a>
                                        </dt>
                                        <dd>
                                            @foreach( $myThread->messages as $message )
                                                <div class="{{ $loggedUser->username === $message->sender ? 'message-left' : 'message-right' }}">
                                                    <span class="message-sender">{{ $message->sender }} @ {{ date( 'd-M-Y | H:i', strtotime( $message->created_at ) ) }}</span>
                                                    <span class="message-text">{{ $message->text }}</span>
                                                </div>
                                        @endforeach
                                        <dd>
                                            <form method="post" action="{{ asset('/profile/reply/' . $myThread->id ) }}">
                                                {{ csrf_field() }}
                                                <textarea id="message-reply-{{ $myThread->id }}" name="message-reply-{{ $myThread->id }}" placeholder="Reply to this message"></textarea>
                                                <input type="button" value="Reply" onclick="replyMessage(this, {{ $myThread->id }})" />
                                            </form>
                                        </dd>
                                    </div>
                                @endif
                            @endforeach
                        </dl>
                    @endif
                @endisset
                <div class="compose-new-message">
                    <input type="button" class="button" value="Compose New Message" />
                    <div class="container compose-new-message-holder">
                        <form method="POST" action="{{ asset('/profile/sendMessage') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="12u">
                                    <input type="text" id="new-message-recipient" name="new-message-recipient" placeholder="E-mail or Username" />
                                </div>
                                <div class="12u">
                                    <textarea id="new-message-content" name="new-message-content" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="12u">
                                    <input type="submit" value="Send Message" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
