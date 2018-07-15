@extends('admin::layouts.gentelella')

@section('title', 'Admins')

@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Admins</h3>
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
                        <h2>List admins <!--<small>basic table subtitle</small>--></h2>
                        <ul class="nav navbar-right ">
                            <a href="{{ route('admin.admins.create') }}" class="btn btn-success btn-md" title="Create New"><i class="fa fa-plus-circle"></i></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <th scope="row">{{$admin->id}}</th>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        @if(!empty($admin->getRoleNames()))
                                            @foreach($admin->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$admin->created_at}}</td>
                                    <td>
                                        {{--<a href="{{ route('admin.quizzes.show', ['quiz' => $quiz->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>--}}
                                        <a onclick="showQuiz({{$admin->id}});" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('admin.admins.edit', ['admin' => $admin->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                        <a onclick="deleteConfirmation('<?php echo url('admin/admins/'.$admin->id); ?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        {{--<a onclick="document.getElementById('dQuiz_{{$quiz->id}}').submit();" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>--}}
                                        <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="post" style="display:none;" id="dQuiz_{{$admin->id}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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
    <div id="showQuizContainer"></div>

    @push('after-scripts')
        @include('admin::scripts.deleteConfirmation')
    @endpush

@endsection