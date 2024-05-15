<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisionController extends Controller
{

    /* public function __construct()
    {
        $this->middleware('permission:Ver Permisos', ['only' => ['index']]);
        $this->middleware('permission:Crear Permiso', ['only' => ['create', 'store']]);
        $this->middleware('permission:Eliminar Permisos', ['only' => ['destroy']]);
        $this->middleware('permission:Editar Permisos', ['only' => ['update', 'edit']]);
    } */
    public function index()
    {
        $permissions = Permission::get();
        return view('role-permission.permission.index', [
            'permissions' => $permissions
        ]);
    }
    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permiso creado exitósamente!');
    }

    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit', [
            'permission' => $permission
        ]);
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,' . $permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permiso actualizado exitósamente!');
    }
    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'Permiso eliminado exitósamente!');
    }
}
