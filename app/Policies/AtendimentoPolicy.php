<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Atendimento;
use Illuminate\Auth\Access\Response;

class AtendimentoPolicy
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
    public function store(User $user, Atendimento $atendimento): Response
    {
        return ($user->access === 'Recepcionista' || $user->access === 'Admin')
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }

    public function update(User $user, Atendimento $atendimento): bool
    {
        return (($user->access === 'Recepcionista' && $user->id === $atendimento->user_id) || $user->access === 'Admin')
        // ? Response::allow()
        // : Response::deny('Você não tem permissão')
        ;

    }

    public function delete(User $user, Atendimento $atendimento): bool
    {
        return (($user->access === 'Recepcionista' && $user->id === $atendimento->user_id) || $user->access === 'Admin');

    }


}
