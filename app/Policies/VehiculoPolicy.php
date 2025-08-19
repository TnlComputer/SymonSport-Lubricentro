<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiculoPolicy
{
    use HandlesAuthorization;

    // Admins pueden todo
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    // Listado de vehículos
    public function viewAny(User $user)
    {
        return true; // cualquier usuario autenticado puede ver la lista
    }

    // Solo el dueño puede ver un vehículo específico
    public function view(User $user, Vehiculo $vehiculo)
    {
        return $user->id === $vehiculo->user_id;
    }

    public function create(User $user)
    {
        return true; // cualquier usuario autenticado puede crear
    }

    public function update(User $user, Vehiculo $vehiculo)
    {
        return $user->id === $vehiculo->user_id;
    }

    public function delete(User $user, Vehiculo $vehiculo)
    {
        return $user->id === $vehiculo->user_id;
    }
}
