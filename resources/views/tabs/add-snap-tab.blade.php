<div id="add-snap-tab-content" class="tabcontent">
    <div class="container">
        <form method="post" action="{{ asset('/profile/addSnap') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div id="snap-tab-upload-row">
                <div class="row">
                    <div class="12u">
                        <h3>1. CHOOSE AN IMAGE</h3>
                        <label class="green-label">Choose an image that you want to upload. Supported image formats are <b>.jpg</b>, <b>.jpeg</b> and <b>.png</b>.</label>
                        <label for="snapImgUpload" class="snap-upload-label">
                            <i class="fa fa-cloud-upload"></i> Image
                        </label>
                        <input type="file" name="snapImgUpload" id="snapImgUpload" />
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <div id="snap-tab-filter-row">
                <div class="row">
                    <div class="12u">
                        <h3>2. SELECT A FILTER</h3>
                        <label class="green-label">Select one of our filters. <b>(OPTIONAL)</b></label>
                        <div class="owl-carousel">
                            @isset( $snapFilters )
                                @foreach( $snapFilters as $filter )
                                    <div class="snap-filter">
                                        <img src="{{ asset('/img/main/filter-frame.png') }}" alt="filter-frame-image" />
                                        <div class="{{ $filter->class }}"></div>
                                        <label class="radio-filter-holder">
                                            <input type="radio" name="snapFilter" value="{{ $filter->id }}" />
                                            <span class="checkmark"></span>
                                            <span class="filter-label">{{ $filter->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <div id="snap-tab-text-row">
                <div class="row">
                    <div class="12u">
                        <h3>3. ADD TEXT</h3>
                        <label class="green-label">Add some text. Maximum number of characters is 100. <b>(OPTIONAL)</b></label>
                        <input type="text" name="snapText" id="snapText" placeholder="Optional text" />
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <div id="snap-tab-privacy-row">
                <div class="row">
                    <div class="12u">
                        <h3>4. PRIVACY SETTINGS</h3>
                        <label class="green-label">Set privacy settings for your snap. <br/> Public snaps will be visible to everyone and private snaps will be visible only to the registered users.</label>
                        <input type="radio" id="snapPublic" name="snapStatus" value="public" checked />
                        <label for="snapPublic"><i class="fa fa-globe"></i></label>
                        <input type="radio" id="snapPrivate" name="snapStatus" value="private" />
                        <label for="snapPrivate"><i class="fa fa-lock"></i></label>
                    </div>
                </div>
            </div>
            <div class="separator"></div>
            <div id="snap-tab-button-row">
                <div class="row">
                    <div class="12u">
                        <h3>5. UPLOAD</h3>
                        <label class="green-label">You are all set. Just click the button and add your snap!</label>
                        <input type="submit" name="snapPost" id="snapPost" value="ADD SNAP" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
