<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Imagem;
use Illuminate\Auth\Access\Response;

class ImagemPolicy
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
        return $user->access === 'Imagem' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function isImagem(User $user): Response
    {
        return $user->access === 'Imagem' || $user->access === 'Admin'
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }
    public function store(User $user, Imagem $imagem): Response
    {
        return ($user->access === 'Imagem' || $user->access === 'Admin')
        ? Response::allow()
        : Response::deny('Você não tem permissão');

    }

    public function update(User $user, Imagem $imagem): bool
    {
        return (($user->access === 'Imagem' && $user->id === $imagem->user_id) || $user->access === 'Admin')
        // ? Response::allow()
        // : Response::deny('Você não tem permissão')
        ;

    }

    public function delete(User $user, Imagem $imagem): bool
    {
        return (($user->access === 'Imagem' && $user->id === $imagem->user_id) || $user->access === 'Admin');

    }

}
