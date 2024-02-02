<?php

namespace App\Http\Controllers;

use App\Models\Procedimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ProcedimentoController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $procedimentos = Procedimento::all()->reverse();
        // $procedimentos = Procedimento::paginate(5)
        //     ->through(fn($procedimento) => [
        //         'id' => $procedimento->id,
        //         'nome' => $procedimento->nome,
        //         'cpf' => $procedimento->cpf,
        //     ]);
        $procedimentos = Procedimento::query()
            ->when(Req::input('search'), function($query, $search){
                $query->where('procedimento', 'like', '%'.$search.'%');
            })->orderBy('procedimento', 'asc')
                ->paginate(8)
            ->withQueryString();

            // STATUS:
            // Recepção - ao iniciar - Aguardando Triagem
            // Triagem - Aguardando atendimento medico/odonto
            // Atendimento Médico - aguardando atendimento ambulatorial e procedimentos

        return Inertia::render('Procedimentos/index', ['procedimentos' => $procedimentos]);
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
            'procedimento' => 'required|string|max:200',
            'descricao' => 'required',
        ]);
        Procedimento::create([
            'procedimento' => $request->input('procedimento'),
            'descricao' => $request->input('descricao'),
            'disponivel' => $request->input('disponivel'),
            'user_id' => Auth::id(),
        ]);
        //  return redirect()->route('procedimentos.index')->with('message', 'Consulta cadastrada com sucesso');
        return back()->with('message', 'Procedimento cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Procedimento $procedimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Procedimento $procedimento)
    {
        // return redirect()->route('procedimentos.index', ['procedimento' => $procedimento]);
        return redirect()->route('procedimentos.index', ['procedimento' => $procedimento]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Procedimento $procedimento)
    {

        // $pac = Procedimento::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $request->validate([
            'procedimento' => 'required|string|max:200',
            'descricao' => 'required'
        ]);
        $procedimento->procedimento = $request->procedimento;
        $procedimento->descricao = $request->descricao;
        $procedimento->disponivel = $request->disponivel;
        $procedimento->save();
        // return redirect()->route('procedimentos.index')->with('message', 'Os dados do procedimento foram atualizados');
        return back()->with('message', 'Os dados do procedimento foram atualizados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Procedimento $procedimento)
    {
        // $pac = Procedimento::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $procedimento->delete();
        // return redirect()->route('procedimentos.index')->with('message', 'Os dados do procedimento foram removidos');
        return back()->with('message', 'Os dados do Procediemnto foram removidos');
    }
}
