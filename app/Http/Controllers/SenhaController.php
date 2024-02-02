<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Senha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;

class SenhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $senhas = Senha::query()->where('chamar','=', false)->get();

        // $senhas = Senha::with('atendimento.paciente')
        //     ->where('chamar','=',false)->get();

        $senhas = Senha::with('atendimento.paciente')->orderBy('updated_at', 'desc')->get();

        // dd($senhas);
        return Inertia::render('Senhas/index', ['senhas' => $senhas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->input('atendimento_id')) {
    
            // atendimento_id: props.atendimento.id,
            // paciente_id: props.paciente.id,
            // paciente_nome: props.paciente.nome,
          
            // chamando: props.atendimento.chamar,

            $senha = Senha::query()
            ->where('atendimento_id','=', $request->input('atendimento_id'))
            ->where('user_id','=', Auth::user()->id)->get();

            // Se existir senha ele atualiza

            $atendimento = Atendimento::find($request->input('atendimento_id'));
            $atendimento->chamar = !$atendimento->chamar;

            if($request->input('chamar')){
                $atendimento->dthrfim = date('Y-m-d h:i:s');
            } else {
                $atendimento->dthrinicio = date('Y-m-d h:i:s');
            }

            $atendimento->update();

            Senha::updateOrCreate(['user_id' => Auth::user()->id, 'atendimento_id' => $atendimento->id], [
                    'chamar' => $atendimento->chamar,
                    'dthrinicio' => $atendimento->dthrinicio,
                    'dthrfim' => $atendimento->dthrfim,
                    'room' => Auth::user()->room, 
            ]);            

        }
    
        return back();

        // return redirect()->route('senhas.index')->with('message', 'O resultado do diagnóstico por senha foi inserido');
    

    }
    /**
     * Chamada para atualização de senha
     */
    public function call($atendimento_id){
        if($atendimento_id) {
    
            // atendimento_id: props.atendimento.id,
            // paciente_id: props.paciente.id,
            // paciente_nome: props.paciente.nome,
          
            // chamando: props.atendimento.chamar,

            $senha = Senha::query()
            ->where('atendimento_id','=', $atendimento_id)
            ->where('user_id','=', Auth::user()->id)->get();

            // Se existir senha ele atualiza

            $atendimento = Atendimento::find($atendimento_id);
            $atendimento->chamar = false;

            $atendimento->dthrinicio = date('Y-m-d h:i:s');

            $atendimento->update();

            Senha::updateOrCreate(['user_id' => Auth::user()->id, 'atendimento_id' => $atendimento->id], [
                    'chamar' => $atendimento->chamar,
                    'dthrinicio' => $atendimento->dthrinicio,
                    'dthrfim' => $atendimento->dthrfim,
                    'room' => Auth::user()->room, 
            ]);            
        }
    
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Senha $senha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Senha $senha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Senha $senha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Senha $senha)
    {
        //
    }
}
