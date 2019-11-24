<div id="footer">
    <!-- Copyright -->
    <ul class="copyright">
        <li>Copyright &copy; Bogdan Matorkić, snaPPic. All rights reserved.</li><li>Design: <a href="http://html5up.net" target="_blank" title="Template Author">HTML5 UP</a> & Bogdan Matorkić</li>
    </ul>
    <input type="hidden" id="hidden-user-id" name="hidden-user-id" value="{{ ( session()->has('user') ? session()->get('user')[0]->id : '' ) }}" />
    <input type="hidden" id="hidden-user-username" name="hidden-user-username" value="{{ ( session()->has('user') ? session()->get('user')[0]->username : '' ) }}" />
</div>
