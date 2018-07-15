@extends('admin::layouts.gentelella')

@section('title', 'Admins')

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


        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Role <!--<small>Click to validate</small>--></h2>
                <div class="nav navbar-right">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-md" title="All Admins"><i class="fa fa-bars"></i></a>
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-md" title="Create New"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <!-- start form for validation -->
                <form id="demo-form" action="{{ route('admin.roles.update', $role->id) }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{@$role->name??@@old('name')}}" id="name" class="form-control" placeholder="Name" required />
                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                    <br>
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <strong>Guards:</strong>
                        <div class="form-group">
                            @foreach(config('auth.guards') as $guard_name => $value)
                                <div class="form-check">
                                    <input class="form-check-input" value="{{$guard_name}}" name="guard_name" id="guard_name" type="radio"
                                    @if($guard_name == $role->guard_name) checked @endif>
                                    <label class="form-check-label">{{$guard_name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-9">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            @if ($errors->has('permission'))
                                <div class="alert alert-error" role="alert" style="z-index: 1001;">
                                    {{ $errors->first('permission') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" value="{{$permission->id}}" name="permission[]" id="permissions" type="checkbox"
                                        @if(in_array($permission->id, $rolePermissions)) checked @endif >
                                    <label class="form-check-label">{{$permission->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-default" title="All Quizzes">Cancel</a>

                </form>
                <!-- end form for validations -->

            </div>
        </div>
    </div>

    @push('after-scripts')
        @include('admin::scripts.deleteConfirmation')
    @endpush

@endsection