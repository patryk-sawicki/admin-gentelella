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
                    <div class="x_content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <th scope="row">{{$role->id}}</th>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        {{--<a href="{{ route('admin.quizzes.show', ['quiz' => $quiz->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>--}}
                                        <a onclick="showQuiz({{$role->id}});" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.roles.edit', ['admin' => $role->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <a onclick="deleteConfirmation('<?php echo url('admin/roles/'.$role->id); ?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="showRoleContainer"></div>

    @push('after-scripts')
        @include('admin::scripts.deleteConfirmation')
    @endpush

@endsection