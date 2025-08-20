<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VehiculoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vehiculo::class, 'vehiculo');
    }

    public function index()
    {
        if (Auth::user()->is_admin) {
            // Admin ve todos los vehículos (activos e inactivos)
            $vehiculos = \App\Models\Vehiculo::with('user')
                ->join('users', 'vehiculos.user_id', '=', 'users.id')
                ->orderBy('users.nombre')
                ->select('vehiculos.*')
                ->get();
        } else {
            // Usuario normal solo ve sus vehículos activos
            $vehiculos = Auth::user()->vehiculos()->where('activo', true)->get();
        }

        return view('vehiculos.index', compact('vehiculos'));
    }

    public function create(Request $request)
    {
        $userId = $request->input('user_id');

        if (Auth::user()->is_admin) {
            // El admin debe seleccionar el usuario para el nuevo vehículo
            $usuarios = User::orderBy('nombre')->get();
            return view('vehiculos.create', compact('usuarios', 'userId'));
        }
        return view('vehiculos.create', compact('userId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'nullable|integer',
            'patente' => 'required|string|max:20|unique:vehiculos',
            'observaciones' => 'nullable|string',
            'user_id' => Auth::user()->is_admin ? 'required|exists:users,id' : '',
        ]);

        if (!Auth::user()->is_admin) {
            $data['user_id'] = Auth::id();
        }

        Vehiculo::create($data);

        // Redirigir según el tipo de usuario
        if (Auth::user()->is_admin) {
            return redirect()->route('vehiculos.index', ['user_id' => $data['user_id']])
                ->with('success', 'Vehículo creado correctamente.');
        }
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo creado correctamente.');
    }


    public function storeAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patente' => 'required|unique:vehiculos,patente',
            'marca' => 'required',
            'modelo' => 'required',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $vehiculo = Vehiculo::create($request->all());

        return response()->json([
            'success' => true,
            'vehiculo' => $vehiculo
        ]);
    }

    public function show(Vehiculo $vehiculo)
    {
        return view('vehiculos.show', compact('vehiculo'));
    }

    public function edit(Vehiculo $vehiculo)
    {
        if (Auth::user()->is_admin) {
            $usuarios = User::orderBy('nombre')->get();
            return view('vehiculos.edit', compact('vehiculo', 'usuarios'));
        }
        return view('vehiculos.edit', compact('vehiculo'));
    }

    public function update(Request $request, Vehiculo $vehiculo)
    {
        $rules = [
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'anio' => 'nullable|integer',
            'patente' => 'required|string|max:20|unique:vehiculos,patente,' . $vehiculo->id,
            'observaciones' => 'nullable|string',
        ];

        if (Auth::user()->is_admin) {
            $rules['user_id'] = 'required|exists:users,id';
        }

        $data = $request->validate($rules);

        if (!Auth::user()->is_admin) {
            // Asegura que el usuario normal no cambie el propietario
            unset($data['user_id']);
        }

        $vehiculo->update($data);

        // Redirigir según el tipo de usuario
        if (Auth::user()->is_admin) {
            return redirect()->route('vehiculos.index', ['user_id' => $vehiculo->user_id])
                ->with('success', 'Vehículo actualizado correctamente.');
        }
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->activo = false;
        $vehiculo->save();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado correctamente.');
    }
}
