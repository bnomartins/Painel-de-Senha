<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function update(User $user, Request $request){
        $request->validate([
            'room' => 'Required'
        ],[
            'room' => 'O campo :attribute é de preenchimento obrigatório'
        ]);
        
        User::find(Auth::user()->id)
            ->update(['room' => $request->input('room')]);
        // dd($user);
        return back()->with('message', 'Informação da sala atualizada');

    }
}