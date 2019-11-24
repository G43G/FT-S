<div id="send-message-tab-content" class="tabcontent">
    <div class="container">
        <form method="post" action="{{ asset('/') . $requestedUser->username . '/send' }}">
            {{ csrf_field() }}
            <div class="row">
                <div class="12u">
                    <textarea id="messageContent" name="messageContent" placeholder="Message"></textarea>
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
