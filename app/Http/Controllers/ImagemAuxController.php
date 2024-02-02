<?php

namespace App\Http\Controllers;

use App\Models\ExameAux;
use App\Models\Imagem_aux;
use App\Models\ImagemAux;
use App\Models\Procedimento;
use App\Models\ProcedimentoGrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
class ImagemAuxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $imagemAuxs = ImagemAux::all()->reverse();
        // $imagemAuxs = ImagemAux::paginate(5)
        //     ->through(fn($imagemAux) => [
        //         'id' => $imagemAux->id,
        //         'nome' => $imagemAux->nome,
        //         'cpf' => $imagemAux->cpf,
        //     ]);
        
        $grupos = ProcedimentoGrupo::all();
        $imagemAuxs = ImagemAux::all()->pluck('grupo');
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

        return Inertia::render('ImagemAuxes/index', ['procedimentos' => $procedimentos, 'grupos' => $grupos, 'imagemAuxs' => $imagemAuxs]);
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

            ImagemAux::updateOrCreate(['grupo' => $grupo_id],[
                'grupo' => $grupo_id,
                'descricao' => $grupo_descricao,
                'disponivel' => true,
                'user_id' => Auth::id()
            ]);   

            //  return redirect()->route('imagemAuxs.index')->with('message', 'Consulta cadastrada com sucesso');
            return back()->with('message', 'Grupo ativado com sucesso');

        } else if ($request->input('grupo_desativar_id')) {

            $grupo_id = $request->input('grupo_desativar_id');

            ImagemAux::where('grupo',$request->input('grupo_desativar_id'))->delete();   

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
    public function show(ImagemAux $imagemAux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ImagemAux $imagemAux)
    {
        // return redirect()->route('imagemAuxs.index', ['imagemAux' => $imagemAux]);
        return redirect()->route('imagemAuxs.index', ['imagemAux' => $imagemAux]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ImagemAux $imagemAux)
    {

        // $pac = ImagemAux::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $request->validate([
            'imagem' => 'required|string|max:200',
            'descricao' => 'required'
        ]);
        $imagemAux->imagem = $request->imagem;
        $imagemAux->descricao = $request->descricao;
        $imagemAux->disponivel = $request->disponivel;
        $imagemAux->save();
        // return redirect()->route('imagemAuxs.index')->with('message', 'Os dados do imagemAux foram atualizados');
        return back()->with('message', 'Os dados do imagem foram atualizados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ImagemAux $imagemAux)
    {
        // $pac = ImagemAux::find($request->input('id'));
        // if($request->user()->cannot('update', $pac)){
        //     abort(403);
        // }

        $imagemAux->delete();
        // return redirect()->route('imagemAuxs.index')->with('message', 'Os dados do imagemAux foram removidos');
        return back()->with('message', 'Os dados do Imagem foram removidos');
    }
}
