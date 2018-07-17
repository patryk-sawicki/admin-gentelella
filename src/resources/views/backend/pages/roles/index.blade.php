@extends('admin::layouts.gentelella')

@section('title', 'Roles')

@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Roles</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>List roles <!--<small>basic table subtitle</small>--></h2>
                        <ul class="nav navbar-right ">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-md" title="Create New"><i class="fa fa-plus-circle"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="paginateRoles">

                                @include('admin::pages.roles.components.paginateRoles')

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="showRoleContainer"></div>

    @push('after-scripts')
        @include('admin::pages.roles.scripts.pagination')
        @include('admin::scripts.deleteConfirmation')
    @endpush

@endsection