<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Exame;
use Illuminate\Auth\Access\Response;

class ExamePolicy
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
        return $user->access === 'Exame' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function isExame(User $user): Response
    {
        return $user->access === 'Exame' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function store(User $user, Exame $exame): Response
    {
        return ($user->access === 'Exame' || $user->access === 'Admin')
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }

    public function update(User $user, Exame $exame): bool
    {
        return (($user->access === 'Exame' && $user->id === $exame->user_id) || $user->access === 'Admin')
        // ? Response::allow()
        // : Response::deny('Você não tem permissão')
        ;

    }

    public function delete(User $user, Exame $exame): bool
    {
        return (($user->access === 'Exame' && $user->id === $exame->user_id) || $user->access === 'Admin');

    }

}
