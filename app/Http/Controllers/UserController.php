<?php

namespace App\Http\Controllers;

use App\Models\Cbo;
use App\Models\Prestador;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Request as Req;


class UserController extends Controller
{
    public function index()
    {

        $cbos = Cbo::where('disponivel', true)->get();

        $users = User::query()->with(['unidade', 'prestador.cbo'])
            ->when(Req::input('search'), function($query, $search){
                $query
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('access', 'like', '%'.$search.'%');
            })->orderBy('name', 'asc')
                ->paginate(10)
                ->withQueryString();


        return Inertia::render('Users/Index', [
            'users' => $users,
            'cbos' => $cbos
        ]);
    }

    public function store(Request $request)
    {

        if($request->id){
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'access' => 'required'
            ],[
                'required' => 'O campo :attribute é de preenchimento obrigatório',
                'email.email' => 'Email inválido', 
                'email.max' => 'Email inválido', 
                'email.unique' => 'Email já existente', 
            ]);
    
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'access' => 'required'
            ], [
                'required' => 'O campo :attribute é de preenchimento obrigatório',
                'email.email' => 'Email inválido', 
                'email.max' => 'Email inválido', 
                'email.unique' => 'Email já existente', 
            ]);
        }
            

        if($request->password){
            User::updateOrCreate(['email' => $request->input('email')], [
                'name' => $request->name,
                'password' => Hash::make($request->input('password')) 
            ]);
        }

        $user = User::updateOrCreate(['email' => $request->input('email')],[
            'email' => $request->email,
            'sector' => $request->input('setor'),
            'access' => $request->input('access'),
            'service' => $request->input('service')
        ]);


        

        if($request->input('cbo_item')){
            
            $cbo_codigo = explode(' - ', $request->input('cbo_item'))[0];
            $cbo_descricao = explode(' - ', $request->input('cbo_item'))[1];

            Prestador::updateOrCreate(['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'cbo_codigo' => $cbo_codigo,
                'cbo_descricao' => $cbo_descricao,
                'conselho' => $request->input('conselho'),
                'conselho_regional' => $request->input('conselho_regional'),
                'conselho_numero' => $request->input('conselho_numero')
            ]);
        }

        return redirect()->route('users.index')->with('message', 'Usuário cadastrado com sucesso');
    }

    public function update(Request $request, User $user)
    {
      //
    }

    public function destroy(User $user, Request $request)
    {
        $user->delete();
        return back()->with('message', 'Usuário removido com sucesso');
        // return redirect()->route('users.index')->with('message', 'User removido com sucesso');
    }

}
