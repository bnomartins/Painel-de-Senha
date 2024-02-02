<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Prontuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;

use Inertia\Inertia;


class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::query()
            ->when(Req::input('search'), function($query, $search){
                $query->where('nome', 'like', '%'.$search.'%')
                    ->OrWhere('cpf', '=', $search);
            })->orderBy('created_at', 'desc')
                ->paginate(8)
            ->withQueryString();

            // STATUS:
            // Recepção - ao iniciar - Aguardando Triagem
            // Triagem - Aguardando atendimento medico/odonto
            // Atendimento Médico - aguardando atendimento ambulatorial e exames

        return Inertia::render('Pacientes/index', ['pacientes' => $pacientes]);
    }

    public function searchDocumentos(Request $request)
    {
        $request->validate([
            'cpf' => 'min:11|max:11|unique:pacientes',
        ],[
            'cpf.min' => 'CPF inválido',
            'cpf.max' => 'CPF inválido',
            'cpf.unique' => 'O CPF informado já esta cadastrado, favor pesquisar e abrir atendimento',
        ]);

        $pacientes = Paciente::query()
            ->when(Req::input('search'), function($query, $search){
                $query->where('cpf', '=', $search)
                    ->OrWhere('registro', '=', $search)
                    ->OrWhere('rg_numero', '=', $search)
                    ;
            })->orderBy('created_at', 'desc')
                ->paginate(8)
            ->withQueryString();

            // STATUS:
            // Recepção - ao iniciar - Aguardando Triagem
            // Triagem - Aguardando atendimento medico/odonto
            // Atendimento Médico - aguardando atendimento ambulatorial e exames

        return Inertia::render('Pacientes/index', ['pacientes' => $pacientes]);
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
        $request->validate([
            'nome' => 'required|string|max:200',
            'cpf' => 'required|min:11|max:11|unique:pacientes'
        ]);
        $prontuario_id = Prontuario::create()->id;
        Paciente::create(['nome' => $request->nome, 'cpf' => $request->cpf, 'prontuario_id' => $prontuario_id]);
        //  return redirect()->route('pacientes.index')->with('message', 'Consulta cadastrada com sucesso');
        return back()->with('message', 'Consulta cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        // return redirect()->route('pacientes.index', ['paciente' => $paciente]);
        return redirect()->route('pacientes.index', ['paciente' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {

        // $pac = Paciente::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $request->validate([
            'nome' => 'required|string|max:200',
            'cpf' => 'required|min:11|max:11'
        ]);
        $paciente->nome = $request->nome;
        $paciente->cpf = $request->cpf;
        $paciente->save();
        // return redirect()->route('pacientes.index')->with('message', 'Os dados do paciente foram atualizados');
        return back()->with('message', 'Os dados do paciente foram atualizados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente, Request $request)
    {
        // $pac = Paciente::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $paciente->delete();
        // return redirect()->route('pacientes.index')->with('message', 'Os dados do paciente foram removidos');
        return back()->with('message', 'Os dados do paciente foram removidos');
    }
}
