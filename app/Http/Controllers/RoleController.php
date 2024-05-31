<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /* public function __construct(){
        $this->middleware('permission:Ver Rol',['only'=> ['index']]);
        $this->middleware('permission:Crear Rol',['only'=> ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:Eliminar Rol',['only'=> ['destroy']]);
        $this->middleware('permission:Editar Rol',['only'=> ['update','edit']]);
    } */

    public function index(){
        $roles = Role::get();
        return view('role-permission.role.index',[
            'roles' => $roles
        ]);
    }
    public function create(){
        return view('role-permission.role.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=> [
                'required',
                'string',
                'unique:roles,name'
            ]
            ]);

        Role::create([
            'name'=> $request->name
        ]);

        return redirect('roles')->with('status','Rol creado exitósamente!');
    }

    public function edit(Role $role){
        return view('role-permission.role.edit',[
            'role' => $role
        ]);
    }
    public function update(Request $request, Role $role){
        $request->validate([
            'name'=> [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
            ]);

        $role->update([
            'name'=> $request->name
        ]);
    
        return redirect('roles')->with('status','Rol actualizado exitósamente!');
    }
    public function destroy($roleId){
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','Rol eliminado exitósamente!');
    }

    public function addPermissionsToRole($roleId){
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                                ->where('role_has_permissions.role_id', $role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('role-permission.role.add-permissions',[
            'role'=>$role,
            'permissions'=>$permissions,
            'rolePermissions'=>$rolePermissions
        ]);
    }
    public function givePermissionsToRole(Request $request, $roleId){
        $request->validate([
            'permission'=> 'required'
            ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
    
        return redirect()->back()->with('status','Permisos añadidos a rol exitósamente!');
    }
}
