<?php

namespace App\Http\Controllers;

use App\Models\ExameAux;
use App\Models\Procedimento;
use App\Models\ProcedimentoGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ExameAuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $exameAuxs = ExameAux::all()->reverse();
        // $exameAuxs = ExameAux::paginate(5)
        //     ->through(fn($exameAux) => [
        //         'id' => $exameAux->id,
        //         'nome' => $exameAux->nome,
        //         'cpf' => $exameAux->cpf,
        //     ]);
        $grupos = ProcedimentoGrupo::all();
        $exameAuxs = ExameAux::all()->pluck('grupo');
        $procedimentos = Procedimento::query()
            ->when(Req::input('search'), function($query, $search){
               $query->where('codigo', 'like', $search.'%')
                ->orWhere('procedimento', 'like', '%'.$search.'%');
            })->orderBy('codigo', 'asc')
                ->paginate(30)
            ->withQueryString();

            // STATUS:
            // Recepção - ao iniciar - Aguardando Triagem
            // Triagem - Aguardando atendimento medico/odonto
            // Atendimento Médico - aguardando atendimento ambulatorial e exames

        return Inertia::render('ExameAuxes/index', ['procedimentos' => $procedimentos, 'grupos' => $grupos, 'exameAuxs' => $exameAuxs]);
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

        if($request->input('toggle_id')){
            
            $toggle_id = $request->input('toggle_id');
            $toggle_disponivel = $request->input('toggle_disponivel');

            Procedimento::updateOrCreate(['id' => $toggle_id],[
                'disponivel' => $toggle_disponivel,
                'user_id' => Auth::id()
            ]);           

            //  return redirect()->route('imagemAuxs.index')->with('message', 'Consulta cadastrada com sucesso');
            return back()->with('message', 'Procedimento ativado com sucesso');

        } else if($request->input('grupo_id')){

            $grupo_id = $request->input('grupo_id');
            $grupo_descricao = $request->input('grupo_descricao');

            ExameAux::updateOrCreate(['grupo' => $grupo_id],[
                'grupo' => $grupo_id,
                'descricao' => $grupo_descricao,
                'disponivel' => true,
                'user_id' => Auth::id()
            ]);   

            //  return redirect()->route('imagemAuxs.index')->with('message', 'Consulta cadastrada com sucesso');
            return back()->with('message', 'Grupo ativado com sucesso');

        } else if ($request->input('grupo_desativar_id')) {

            $grupo_id = $request->input('grupo_desativar_id');

            ExameAux::where('grupo',$request->input('grupo_desativar_id'))->delete();   

            //  return redirect()->route('imagemAuxs.index')->with('message', 'Consulta cadastrada com sucesso');
            return back()->with('message', 'Grupo desativado com sucesso');
        } else {
            $request->validate([
                'codigo' => 'required|string|max:200',
                'descricao' => 'required',
            ]);

            Procedimento::updateOrCreate(['id' => $request->input('id')],[
                'codigo' => $request->input('codigo'),
                'descricao' => $request->input('descricao'),
                'disponivel' => $request->input('disponivel'),
                'user_id' => Auth::id(),
            ]);

            //  return redirect()->route('imagemAuxs.index')->with('message', 'Consulta cadastrada com sucesso');
            return back()->with('message', 'Procedimento cadastrado com sucesso');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ExameAux $exameAux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExameAux $exameAux)
    {
        // return redirect()->route('exameAuxs.index', ['exameAux' => $exameAux]);
        return redirect()->route('exameAuxs.index', ['exameAux' => $exameAux]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExameAux $exameAux)
    {

        // $pac = ExameAux::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $request->validate([
            'exame' => 'required|string|max:200',
            'descricao' => 'required'
        ]);
        $exameAux->exame = $request->exame;
        $exameAux->descricao = $request->descricao;
        $exameAux->disponivel = $request->disponivel;
        $exameAux->save();
        // return redirect()->route('exameAuxs.index')->with('message', 'Os dados do exameAux foram atualizados');
        return back()->with('message', 'Os dados do exame foram atualizados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ExameAux $exameAux)
    {
        // $pac = ExameAux::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $exameAux->delete();
        // return redirect()->route('exameAuxs.index')->with('message', 'Os dados do exameAux foram removidos');
        return back()->with('message', 'Os dados do Exame foram removidos');
    }
}
