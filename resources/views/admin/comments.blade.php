@extends('pages.admin')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="12u">
                <div class="table-wrapper">
                    @isset( $adminComments )
                        @if( $adminComments->count() > 5 )
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
                                <td>Text</td>
                                <td>User</td>
                                <td>Created</td>
                                <td>Updated</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                        @isset( $adminComments )
                            @foreach( $adminComments as $adminComment )
                                <tr>
                                    <td>{{ $adminComment->commentID }}</td>
                                    <td>{{ $adminComment->text }}</td>
                                    <td>{{ $adminComment->user }}</td>
                                    <td>{{ date( 'd-M-Y', strtotime( $adminComment->created ) ) }}</td>
                                    <td>{{ $adminComment->updated === null ? '' : date( 'd-M-Y', strtotime( $adminComment->updated ) ) }}</td>
                                    <td><a href="#" title="Edit Comment" class="comment-edit edit anchor" data-id="{{ $adminComment->commentID }}" data-anchor="#admin-form"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="{{ asset('/admin-panel/comments/delete-comment-' . $adminComment->commentID) }}" title="Delete Comment" class="comment-delete delete"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="admin-form" class="comment-form container"></div>
@endsection
