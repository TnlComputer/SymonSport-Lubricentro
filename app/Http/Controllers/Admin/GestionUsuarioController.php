<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GestionUsuarioController extends Controller
{
  // Mostrar listado paginado de usuarios
  public function index()
  {
    $users = User::paginate(10);  // Cambia la cantidad por página si quieres
    return view('admin.users.index', compact('users'));
  }

  // Mostrar formulario para crear usuario
  public function create()
  {
    $roles = ['admin', 'user'];
    return view('admin.users.create', compact('roles'));
  }

  // Guardar nuevo usuario
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'role' => 'required|string',  // Ajusta según tu sistema de roles
      'password' => 'required|string|min:6|confirmed',
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'role' => $request->role,
      'password' => bcrypt($request->password),
    ]);

    return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente');
  }

  // Mostrar formulario para editar usuario
  public function edit(User $user)
  {
    $roles = ['admin', 'user']; // o cargarlos desde tu sistema de roles
    return view('admin.users.edit', compact('user', 'roles'));
  }

  // Actualizar usuario
  public function update(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email,' . $user->id,
      'role' => 'required|string',
      'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    if ($request->filled('password')) {
      $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente');
  }

  // Eliminar usuario
  public function destroy(User $user)
  {
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente');
  }
}