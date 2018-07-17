<?php

namespace LiteCode\AdminGentelella\App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LiteCode\AdminGentelella\App\Models\Admin as User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);
        $this->middleware('permission:admin-read');
        $this->middleware('permission:admin-create', ['only' => ['create','store']]);
        $this->middleware('permission:admin-update', ['only' => ['edit','update']]);
        $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $admins = User::orderBy('id','DESC')->paginate(5);
        return view('admin::pages.admins.index',compact('admins'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin::pages.admins.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            //'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        if(@$request->input('roles')) {
            $user->assignRole($request->input('roles'));
        }

        return redirect()->route('admin.admins.index')
            ->with('success','User created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $admin->roles->pluck('name','name')->all();


        return view('admin::pages.admins.edit',compact('admin','roles','userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'sometimes|required|email|unique:admins,email,'.$id,
            'password' => 'same:confirm-password',
            //'roles' => 'required'
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);
        $user->update($input);


        if(@$request->input('roles')){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
        }



        return redirect()->route('admin.admins.index')
            ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
