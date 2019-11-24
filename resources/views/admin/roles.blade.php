@extends('pages.admin')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="12u">
                <div class="table-wrapper">
                    @isset( $adminRoles )
                        @if( $adminRoles->count() > 5 )
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
                                <td>Role</td>
                                <td>Created</td>
                                <td>Updated</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                        @isset( $adminRoles )
                            @foreach( $adminRoles as $adminRole )
                                <tr>
                                    <td>{{ $adminRole->id }}</td>
                                    <td>{{ $adminRole->name }}</td>
                                    <td>{{ date( 'd-M-Y', strtotime( $adminRole->created_at ) ) }}</td>
                                    <td>{{ $adminRole->updated_at === null ? '' : date( 'd-M-Y', strtotime( $adminRole->updated_at ) ) }}</td>
                                    <td><a href="#" class="role-edit edit anchor" title="Edit Role" data-id="{{ $adminRole->id }}" data-anchor="#admin-form"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="{{ asset('/admin-panel/roles/delete-role-' . $adminRole->id) }}" title="Delete Role" class="role-delete delete"><i class="fa fa-trash"></i></a></td>
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
                <div class="12u">
                    <input type="text" value="" id="role-name" name="role-name" placeholder="Role" />
                </div>
            </div>
            <div class="row">
                <div class="12u role-button-holder button-holder">
                    <input type="button" class="button" id="insert-role-button" name="insert-role-button" onclick="insertRole();" value="Insert New Role" />
                </div>
            </div>
        </form>
    </div>
@endsection
