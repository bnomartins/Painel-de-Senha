<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Paciente;
use Illuminate\Auth\Access\Response;

class PacientePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function show(User $user): Response
    {
        return $user->access === 'Recepcionista' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function isRecepcionista(User $user): Response
    {
        return $user->access === 'Recepcionista' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function store(User $user, Paciente $paciente): Response
    {
        return ($user->access === 'Recepcionista' || $user->access === 'Admin')
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }

    public function update(User $user, Paciente $paciente): bool
    {
        return (($user->access === 'Recepcionista' && $user->id === $paciente->user_id) || $user->access === 'Admin')
        // ? Response::allow()
        // : Response::deny('Você não tem permissão')
        ;

    }

    public function delete(User $user, Paciente $paciente): bool
    {
        return (($user->access === 'Recepcionista' && $user->id === $paciente->user_id) || $user->access === 'Admin');

    }

}
