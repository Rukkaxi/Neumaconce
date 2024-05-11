<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Models;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    // Mostrar una lista de usuarios
    // Mostrar una lista de usuarios
    // Mostrar una lista de usuarios
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }



    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create');
    }

    // Guardar el nuevo usuario en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            // Agrega aquí las reglas de validación necesarias
        ]);

        // Crear el usuario
        User::create($request->all());

        // Redireccionar a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar los detalles de un usuario específico
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit(User $user)
    {
        $roles = Role::all(); // Suponiendo que tienes un modelo Role para los roles
        return view('users.edit', compact('user', 'roles'));
    }

    // Actualizar el usuario en la base de datos
    public function update(Request $request, User $user)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            // Agrega aquí las reglas de validación necesarias
        ]);

        // Actualizar el usuario
        $user->update($request->all());

        // Redireccionar al usuario a la página deseada
        return redirect('http://127.0.0.1:8000/pages/users')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar un usuario de la base de datos
    public function destroy(User $user)
    {
        $user->delete();

        // Redireccionar a la lista de usuarios con un mensaje de éxito
        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
