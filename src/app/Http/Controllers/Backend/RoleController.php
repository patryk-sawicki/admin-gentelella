<?php

namespace LiteCode\AdminGentelella\app\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['logout']]);
//        $this->middleware('role:Super Admin');
        $this->middleware('permission:role-read');
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-update', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            if($request->guard_name){
                $permissions = Permission::where('guard_name', $request->guard_name)->orderBy('name','ASC')->get();
                return view('admin::pages.roles.components.permissions',compact('permissions'));
            }
            if($request->page){
                $roles = Role::orderBy('id','DESC')->paginate(10);
                return view('admin::pages.roles.components.paginateRoles',compact('roles'))
                    ->with('i', ($request->input('page', 1) - 1) * 5);
            }

        }
        $roles = Role::orderBy('id','DESC')->paginate(10);
        return view('admin::pages.roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin::pages.roles.create',compact('permissions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//dd($request->all());
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required',
            //'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name'), 'guard_name' => $request->input('guard_name')]);
        if($request->input('permission')){
            $role->syncPermissions($request->input('permission'));
        }


        return redirect()->route('admin.roles.index')
            ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('admin::pages.roles.show',compact('role','rolePermissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('guard_name',$role->guard_name)->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();


        return view('admin::pages.roles.edit',compact('role','permissions','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {//dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'guard_name' => 'required',
            //'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->guard_name = $request->input('guard_name');
        $role->save();

        if($request->input('permission')) {
            $role->syncPermissions($request->input('permission'));
        }


        return redirect()->route('admin.roles.index')
            ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('admin.roles.index')
            ->with('success','Role deleted successfully');
    }
}