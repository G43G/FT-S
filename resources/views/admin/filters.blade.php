@extends('pages.admin')

@section('admin')
    <div class="container">
        <div class="row">
            <div class="12u">
                <div class="table-wrapper">
                    @isset( $adminFilters )
                        @if( $adminFilters->count() > 5 )
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
                            <td>Name</td>
                            <td>Class</td>
                            <td>Created</td>
                            <td>Updated</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        @isset( $adminFilters )
                            @foreach( $adminFilters as $adminFilter )
                                <tr>
                                    <td>{{ $adminFilter->id }}</td>
                                    <td>{{ $adminFilter->name }}</td>
                                    <td>{{ $adminFilter->class }}</td>
                                    <td>{{ date( 'd-M-Y', strtotime( $adminFilter->created_at ) ) }}</td>
                                    <td>{{ $adminFilter->updated_at === null ? '' : date( 'd-M-Y', strtotime( $adminFilter->updated_at ) ) }}</td>
                                    <td><a href="#" title="Edit Filter" class="filter-edit edit anchor" data-id="{{ $adminFilter->id }}" data-anchor="#admin-form"><i class="fa fa-edit"></i></a></td>
                                    <td><a href="{{ asset('/admin-panel/filters/delete-filter-' . $adminFilter->id) }}" title="Delete Filter" class="filter-delete delete"><i class="fa fa-trash"></i></a></td>
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
                    <input type="text" value="" id="filter-name" name="filter-name" placeholder="Name" />
                </div>
                <div class="6u">
                    <input type="text" value="" id="filter-class" name="filter-class" placeholder="Class" />
                </div>
            </div>
            <div class="row">
                <div class="12u filter-button-holder button-holder">
                    <input type="button" class="button" id="insert-filter-button" name="insert-filter-button" onclick="insertFilter();" value="Insert New Filter" />
                </div>
            </div>
        </form>
    </div>
@endsection
