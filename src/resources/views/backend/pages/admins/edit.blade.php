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


        <div class="x_panel">
            <div class="x_title">
                <h2>Edit Admin <!--<small>Click to validate</small>--></h2>
                <div class="nav navbar-right">
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-default btn-md" title="All Admins"><i class="fa fa-bars"></i></a>
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-success btn-md" title="Create New"><i class="fa fa-plus-circle"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <!-- start form for validation -->
                <form id="demo-form" action="{{ route('admin.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                    @method('PUT')
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{@$admin->name??@@old('name')}}" id="name" class="form-control" placeholder="Name" required />
                    @if ($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                    @endif
                    <br>
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{@$admin->email??@old('email')}}" id="email" class="form-control" placeholder="Email" required />
                    @if ($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                    <br>
                    <label for="password">Password</label>
                    <input type="password" name="password" value="" id="password" class="form-control" placeholder="Password" />
                    @if ($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                    <br>
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="confirm-password" value="" id="confirm-password" class="form-control" placeholder="Confirm Password" />
                    <br>
                    <label>Roles</label>
                    <select name="roles[]" id="roles" placeholder="Roles" multiple class="form-control">
                        @foreach($roles as $role)
                            <option value="{{$role}}" @if(in_array($role,$userRole)) selected @endif >{{$role}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('admin.admins.index') }}" class="btn btn-default" title="All Quizzes">Cancel</a>

                </form>
                <!-- end form for validations -->

            </div>
        </div>
    </div>

    @push('after-scripts')
        @include('admin::scripts.deleteConfirmation')
    @endpush

@endsection