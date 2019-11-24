@extends('pages.admin')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="12u">
                <div class="table-wrapper">
                    @isset($adminSnaps)
                        @if($adminSnaps->count() > 5)
                            <div class="wrapper-paging">
                                <ul>
                                    <li><a class="paging-back"><i class="fa fa-arrow-left"></i></a></li>
                                    <li><a class="paging-this"><strong>0</strong> of <span>x</span></a></li>
                                    <li><a class="paging-next"><i class="fa fa-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        @endif
                    @endisset
                    <table class="table">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>Filter</td>
                                <td>Status</td>
                                <td>User</td>
                                <td>Additional Info</td>
                                <td>Created</td>
                                <td>Updated</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @isset( $adminSnaps )
                                @foreach( $adminSnaps as $adminSnap )
                                    <tr>
                                        <td>{{ $adminSnap->snapID }}</td>
                                        <td>{{ $adminSnap->filter }}</td>
                                        <td>{{ $adminSnap->status }}</td>
                                        <td>{{ $adminSnap->user }}</td>
                                        <td class="snap-tooltip-link tooltip-link" title="Please wait..." id="{{ 'snap-' . $adminSnap->snapID }}">SHOW</td>
                                        <td>{{ $adminSnap->created }}</td>
                                        <td>{{ $adminSnap->updated === null ? '' : date( 'd-M-Y', strtotime( $adminSnap->updated ) ) }}</td>
                                        <td><a href="#" title="Edit Snap" class="snap-edit edit anchor" data-id="{{ $adminSnap->snapID }}" data-anchor="#admin-form"><i class="fa fa-edit"></i></a></td>
                                        <td><a href="{{ asset('/admin-panel/snaps/delete-snap-' . $adminSnap->snapID) }}" title="Delete Snap" class="snap-delete delete"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="admin-form" class="container">
        <form method="POST" action="{{ asset('/admin-panel/snaps/insert-snap') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="6u">
                    <input type="file" value="" id="snap-image" name="snap-image" />
                </div>
                <div class="6u">
                    <select id="snap-user" name="snap-user">
                        <option value="0">User</option>
                        @isset( $users )
                            @foreach( $users as $user )
                                <option value="{{ $user->userID }}">{{ $user->username }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="6u">
                    <select id="snap-filter" name="snap-filter">
                        <option value="0">Filter</option>
                        @isset( $filters )
                            @foreach( $filters as $filter )
                                <option value="{{ $filter->id }}">{{ $filter->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="6u">
                    <select id="snap-status" name="snap-status">
                        <option value="0">Status</option>
                        <option value="private">Private</option>
                        <option value="public">Public</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <input type="text" id="snap-text" name="snap-text" placeholder="Text" />
                </div>
            </div>
            <div class="row">
                <div class="12u snap-button-holder button-holder">
                    <input type="submit" class="button" id="insert-snap-button" name="insert-snap-button" onclick="return insertSnap();" value="Insert New Snap" />
                </div>
            </div>
        </form>
    </div>
@endsection

