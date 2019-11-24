<div id="header" class="skel-layers-fixed">

    <div class="top">

        <!-- Logo -->
        <div id="logo">
            <span class="image avatar48"><img src="{{ asset('/') }}img/main/logo.png" alt="logo-image" /></span>
            <h1 id="title">snaPPic</h1>
            <p>Join, snap & enjoy</p>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                @if(session()->has('user'))
                    @if(session()->get('user')[0]->role == 'administrator')
                        @isset($navAdmins)
                            @foreach($navAdmins as $navAdmin)
                                <li><a href="{{ asset($navAdmin->path) }}" class="skel-layers-ignoreHref {{ Request::path() == $navAdmin->path ? 'active' : '' }}"><span class="icon {{ $navAdmin->icon }}">{{ ($navAdmin->name) }}</span></a></li>
                            @endforeach
                        @endisset
                    @else
                        @isset($navUsers)
                            @foreach($navUsers as $navUser)
                                <li><a href="{{ asset($navUser->path) }}" class="skel-layers-ignoreHref {{ Request::path() == $navUser->path ? 'active' : '' }}"><span class="icon {{ $navUser->icon }}">{{ ($navUser->name) }}</span></a></li>
                            @endforeach
                        @endisset
                    @endif
                @else
                    @isset($navs)
                        @foreach($navs as $nav)
                            <li><a href="{{ asset($nav->path) }}" class="skel-layers-ignoreHref {{ Request::path() == $nav->path ? 'active' : '' }}"><span class="icon {{ $nav->icon }}">{{ ($nav->name) }}</span></a></li>
                        @endforeach
                    @endisset
                @endif
            </ul>
        </nav>
    </div>

    @if(session()->has('user'))
        <div class="bottom">

            <!-- Logged user -->
            <p>Hi {{ session()->get('user')[0]->name }}!</p>

        </div>
    @endif

</div>