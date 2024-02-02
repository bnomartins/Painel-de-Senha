<?php

namespace App\Http\Controllers;

use App\Models\Ambulatorio;
use App\Models\AmbulatorioAux;
use App\Models\Atendimento;
use App\Models\Clinico;
use App\Models\Procedimento;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class AmbulatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index(){

        // $procedimentos = DB::table('procedimentos')
        // ->whereIn('codigo', 'like', $grupos."%")
        // ->get();
        
        // dd($grupos->toArray()); // 06.03

        // $procedimentos = Procedimento::where('codigo', 'like', '06.03%')->get();

        $ambulatorios = Ambulatorio::
            with('clinico.atendimento.paciente','procedimentos', 'medicamentos', 'user_solicitacao')
            ->whereHas('clinico.atendimento.paciente', function ($query){
                $query
                ->where('nome','like','%'.Req::input('search').'%')
                ->orWhere('cpf', 'like', '%'.Req::input('search'))
                ;
            })
            ->orderBy('updated_at', 'asc')
            ->get()
            ->groupBy('clinico.atendimento.id')
            // ->paginate(15)->withQueryString()
            ;            

        return Inertia::render('Ambulatorios/index', ['ambulatorios' => $ambulatorios]);
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
        // $request->validate([
        //     'resultado' => 'required|mimes:pdf|max:2048',
        //     'observacao' => 'required',
        // ],[
        //     'required' => 'O campo :attribute é de preenchimento obrigatório'
        // ]);

        $ambulatorios = Ambulatorio::where(['clinico_id' => $request->input('clinico_id')])->get();
 
            foreach ($ambulatorios as $amb) {

                $amb->update([
                    'anotacao' => $request->input('anotacao'),
                    'observacao' => $request->input('observacao'),
                    'user_id' => Auth::user()->id,
                    'dthrfim' => date('Y-m-d h:i:s')    
                ]);
            }

        // return redirect()->route('ambulatorios.index')->with('message', 'O resultado do ambulatorio foi inserido');
        return back()->with('message', 'O resultado do ambulatorio foi inserido com sucesso');
    }

    public function startProcedure(Ambulatorio $ambulatorio, Request $request){

        $ambulatorio = Ambulatorio::where(['id' => $request->input('id')])->first();
        
        // dd($request->input('procedimento_status'));
        
        if($request->input('procedimento_status') == 'iniciado'){

            $ambulatorio->update([
                'user_id' => Auth::user()->id,
                'dthrinicio' => date('Y-m-d h:i:s')
            ]);
            return back()->with('message', 'Procedimento Iniciado');

        } else {

            $ambulatorio->update([
                'user_id' => Auth::user()->id,
                'anotacao' => $request->input('anotacao'),
                'dthrfim' => date('Y-m-d h:i:s')
            ]);

            return back();

        }
        
        // dd($request->input('procedimento_status'));
    
    }

    /**
    * Display the specified resource.
    */
    public function show(Ambulatorio $ambulatorio)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Ambulatorio $ambulatorio)
    {
    return redirect()->route('ambulatorios.index', ['ambulatorio' => $ambulatorio]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Ambulatorio $ambulatorio)
    {
        //
    }

    public function atendimento(Request $request)
    {
        $atendimento = Atendimento::
            with('paciente', 'triagem', 'clinico', 'ambulatorio')
            ->where(['id' => $request->input('id')])->get();
        return Inertia::render('Triagems/atendimento', ['atendimento' => $atendimento]);
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request, Ambulatorio $ambulatorio)
    {
        $ex = Ambulatorio::find($request->input('id'));
        if($request->user()->cannot('update', $ex)){
            abort(403);
        }

        $ambulatorio->delete();
        // return redirect()->route('ambulatorios.index')->with('message', 'Os dados do ambulatorio foram removidos');
        return back()->with('message', 'Os dados do ambulatorio foram removidos com sucesso');
    }
    }
