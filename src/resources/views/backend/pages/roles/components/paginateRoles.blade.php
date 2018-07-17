{{ $roles->links() }}
<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Guard name</th>
        <th>Permissions</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
        @foreach($roles as $role)
            <tr>
                <th scope="row">{{$role->id}}</th>
                <td style="width:140px">{{$role->name}}</td>
                <td><label class="badge badge-success">{{$role->guard_name}}</label></td>
                <td>
                    @foreach($role->permissions as $permission)
                        <label class="badge badge-success">{{$permission->name}}</label>
                    @endforeach
                </td>
                <td style="width:140px">
                    {{--<a href="{{ route('admin.quizzes.show', ['quiz' => $quiz->id]) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>--}}
                    <a onclick="showQuiz({{$role->id}});" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                    <a href="{{ route('admin.roles.edit', ['admin' => $role->id]) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteConfirmation('<?php echo url('admin/roles/'.$role->id); ?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
{{ $roles->links() }}