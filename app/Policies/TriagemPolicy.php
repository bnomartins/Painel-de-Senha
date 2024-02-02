<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Triagem;
use Illuminate\Auth\Access\Response;

class TriagemPolicy
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
        return $user->access === 'Triagem' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function isTriagem(User $user): Response
    {
        return $user->access === 'Triagem' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function store(User $user, Triagem $triagem): Response
    {
        return ($user->access === 'Triagem' || $user->access === 'Admin')
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }

    public function update(User $user, Triagem $triagem): bool
    {
        return (($user->access === 'Triagem' && $user->id === $triagem->user_id) || $user->access === 'Admin')
        // ? Response::allow()
        // : Response::deny('Você não tem permissão')
        ;

    }

    public function delete(User $user, Triagem $triagem): bool
    {
        return (($user->access === 'Triagem' && $user->id === $triagem->user_id) || $user->access === 'Admin');

    }

}
