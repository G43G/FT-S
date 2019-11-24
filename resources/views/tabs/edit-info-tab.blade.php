<div id="edit-info-tab-content" class="tabcontent">
    <div class="container">
        <form method="post" action="{{ asset('/profile/editProfile') }}">
            {{ csrf_field() }}
            <div class="row 50%">
                <div class="6u">
                    <input type="text" value="{{ $loggedUser->name }}" id="editName" name="editName" placeholder="First Name" />
                </div>
                <div class="6u">
                    <input type="text" value="{{ $loggedUser->surname }}" id="editSurname" name="editSurname" placeholder="Last Name" />
                </div>
            </div>
            <div class="row 50%">
                <div class="6u">
                    <input type="text" value="{{ $loggedUser->username }}" id="editUsername" name="editUsername" placeholder="Username" />
                </div>
                <div class="6u">
                    <input type="text" value="{{ $loggedUser->email }}" id="editEmail" name="editEmail" placeholder="E-Mail" />
                </div>
            </div>
            <div class="row 50%">
                <div class="6u">
                    <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password" />
                </div>
                <div class="6u">
                    <input type="password" id="newPassword" name="newPassword" placeholder="New Password" />
                </div>
            </div>
            <div class="row 50%">
                <div class="6u">
                    <input onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ $loggedUser->birthday }}" id="editBirthday" name="editBirthday" placeholder="Date of Birth" class="input-switch" />
                </div>
                <div class="6u">
                    <input type="text" value="{{ $loggedUser->city }}" id="editCity" name="editCity" placeholder="City" />
                </div>
            </div>
            <div class="row 50%">
                <div class="12u">
                    <textarea id="editBio" name="editBio" placeholder="Tell us something about yourself...">{{ $loggedUser->bio }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <input type="submit" value="Save Changes" />
                </div>
            </div>
        </form>
    </div>
</div>
