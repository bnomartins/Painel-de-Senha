<?php

namespace App\Http\Controllers;

use App\Models\AmbulatorioAux;
use App\Models\Procedimento;
use App\Models\ProcedimentoGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class AmbulatorioAuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $grupos = ProcedimentoGrupo::all();
        $ambulatorioAuxs = AmbulatorioAux::all()->pluck('grupo');
        $procedimentos = Procedimento::query()
            ->when(Req::input('search'), function($query, $search){
               $query->where('codigo', 'like', $search.'%')
                ->orWhere('procedimento', 'like', '%'.$search.'%');
            })->orderBy('codigo', 'asc')
                ->paginate(30)
            ->withQueryString();
    
        // $imagems = [];
        // foreach($grupos_ex as $key=>$g){
        //     $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get();

        //     if($imagems === []){
        //         $imagems = $gp;
        //     } else {
        //         $imagems = [$imagems, ...$gp];
        //     }
        // }

            // STATUS:
            // Recepção - ao iniciar - Aguardando Triagem
            // Triagem - Aguardando atendimento medico/odonto
            // Atendimento Médico - aguardando atendimento ambulatorial e imagems

        return Inertia::render('AmbulatorioAuxes/index', ['procedimentos' => $procedimentos, 'grupos' => $grupos, 'ambulatorioAuxs' => $ambulatorioAuxs]);
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

            AmbulatorioAux::updateOrCreate(['grupo' => $grupo_id],[
                'grupo' => $grupo_id,
                'descricao' => $grupo_descricao,
                'disponivel' => true,
                'user_id' => Auth::id()
            ]);   

            //  return redirect()->route('imagemAuxs.index')->with('message', 'Consulta cadastrada com sucesso');
            return back()->with('message', 'Grupo ativado com sucesso');

        } else if ($request->input('grupo_desativar_id')) {

            $grupo_id = $request->input('grupo_desativar_id');

            AmbulatorioAux::where('grupo',$request->input('grupo_desativar_id'))->delete();   

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
    public function show(AmbulatorioAux $ambulatorioAux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmbulatorioAux $ambulatorioAux)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AmbulatorioAux $ambulatorioAux)
    {
        $request->validate([
            'imagem' => 'required|string|max:200',
            'descricao' => 'required'
        ]);
        $ambulatorioAux->imagem = $request->imagem;
        $ambulatorioAux->descricao = $request->descricao;
        $ambulatorioAux->disponivel = $request->disponivel;
        $ambulatorioAux->save();
        // return redirect()->route('imagemAuxs.index')->with('message', 'Os dados do imagemAux foram atualizados');
        return back()->with('message', 'Os dados do Procedimento foram atualizados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AmbulatorioAux $ambulatorioAux)
    {
        //
    }
}
