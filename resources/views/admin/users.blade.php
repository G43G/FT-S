@extends('pages.admin')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="12u">
                <div class="table-wrapper">
                    @isset($adminUsers)
                        @if($adminUsers->count() > 5)
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
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>E-Mail</td>
                                <td>Username</td>
                                <td>Role</td>
                                <td>Additional Info</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @isset( $adminUsers )
                                @foreach( $adminUsers as $adminUser )
                                    <tr>
                                        <td>{{ $adminUser->userID }}</td>
                                        <td>{{ $adminUser->name }}</td>
                                        <td>{{ $adminUser->surname }}</td>
                                        <td>{{ $adminUser->email }}</td>
                                        <td>{{ $adminUser->username }}</td>
                                        <td>{{ $adminUser->role }}</td>
                                        <td class="user-tooltip-link tooltip-link" title="Please wait..." id="{{ 'user-' . $adminUser->userID }}">SHOW</td>
                                        <td><a href="#"  class="user-edit edit anchor" title="Edit User" data-id="{{ $adminUser->userID }}" data-anchor="#admin-form"><i class="fa fa-edit"></i></a></td>
                                        <td><a href="{{ asset('/admin-panel/users/delete-user-' . $adminUser->userID) }}" title="Delete User" class="user-delete delete"><i class="fa fa-trash"></i></a></td>
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
        <form method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="6u">
                    <input type="text" value="" id="user-name" name="user-name" placeholder="First Name" />
                </div>
                <div class="6u">
                    <input type="text" value="" id="user-surname" name="user-surname" placeholder="Last Name" />
                </div>
            </div>
            <div class="row">
                <div class="6u">
                    <input type="text" value="" id="user-username" name="user-username" placeholder="Username" />
                </div>
                <div class="6u">
                    <input type="text" value="" id="user-email" name="user-email" placeholder="E-Mail" />
                </div>
            </div>
            <div class="row">
                <div class="6u">
                    <input type="password" id="user-password" name="user-password" placeholder="Password" />
                </div>
                <div class="6u">
                    <select id="user-role" name="user-role">
                        <option value="0">Role</option>
                        @isset( $roles )
                            @foreach( $roles as $role )
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="6u">
                    <input onfocus="(this.type='date')" onblur="(this.type='text')" value="" id="user-birthday" name="user-birthday" placeholder="Date of Birth" class="input-switch" />
                </div>
                <div class="6u">
                    <input type="text" value="" id="user-city" name="user-city" placeholder="City" />
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <textarea id="user-bio" name="user-bio" placeholder="Additional Information"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="12u user-button-holder button-holder">
                    <input type="button" class="button" id="insert-user-button" name="insert-user-button" onclick="insertUser();" value="Insert New User" />
                </div>
            </div>
        </form>
    </div>
@endsection
