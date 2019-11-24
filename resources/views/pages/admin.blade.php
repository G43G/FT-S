@extends('layout.template')

@section('title')
    Admin Panel
@endsection

@section('main')
    <section id="admin-header" class="three">
        <div class="container">
            <div class="row">
                <div class="12u">
                    <ul>
                        <li><a href="{{ asset('/admin-panel/users') }}" class="button {{ Request::path() === 'admin-panel/users' ? 'active' : '' }}">Users</a></li>
                        <li><a href="{{ asset('/admin-panel/roles') }}" class="button {{ Request::path() === 'admin-panel/roles' ? 'active' : '' }}">Roles</a></li>
                        <li><a href="{{ asset('/admin-panel/snaps') }}" class="button {{ Request::path() === 'admin-panel/snaps' ? 'active' : '' }}">Snaps</a></li>
                        <li><a href="{{ asset('/admin-panel/filters') }}" class="button {{ Request::path() === 'admin-panel/filters' ? 'active' : '' }}">Filters</a></li>
                        <li><a href="{{ asset('/admin-panel/comments') }}" class="button {{ Request::path() === 'admin-panel/comments' ? 'active' : '' }}">Comments</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="admin-body" class="four">

    @yield('admin')

    </section>
@endsection