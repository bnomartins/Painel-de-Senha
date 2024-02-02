<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Clinico;
use Illuminate\Auth\Access\Response;

class ClinicoPolicy
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
        return $user->access === 'Médico' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function isMedic(User $user): Response
    {
        return $user->access === 'Médico' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function store(User $user, Clinico $clinico): Response
    {
        return ($user->access === 'Médico' || $user->access === 'Admin')
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }

    public function update(User $user, Clinico $clinico): bool
    {
        return (($user->access === 'Médico' && $user->id === $clinico->user_id) || $user->access === 'Admin')
        // ? Response::allow()
        // : Response::deny('Você não tem permissão')
        ;

    }

    public function delete(User $user, Clinico $clinico): bool
    {
        return (($user->access === 'Médico' && $user->id === $clinico->user_id) || $user->access === 'Admin');

    }

}
