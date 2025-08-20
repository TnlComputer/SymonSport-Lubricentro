<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Solo usuarios activos con paginación
        $users = User::where('activo', 1)->paginate(10); // 10 por página
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = ['admin', 'usuario'];
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,usuario',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['activo'] = 1;

        User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        $roles = ['admin', 'usuario'];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,usuario',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $user)
    {
        $user->update(['activo' => false]);
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario desactivado correctamente.');
    }

    public function vehiculos($id)
    {
        $user = \App\Models\User::with('vehiculos')->findOrFail($id);

        return response()->json($user->vehiculos);
    }
}
