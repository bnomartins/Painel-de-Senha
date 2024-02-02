<?php

namespace App\Http\Controllers;

use App\Models\RelUnidServ;
use App\Models\Servico;
use App\Models\Enc;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UnidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        $unidades = Unidade::where(['id' => Auth::user()->id])->with(['servicos'])->get()->toArray();
        // dd($user);
        return Inertia::render('Unidades/Index', ['unidades' => $unidades]);
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
        //validar
        $request->validate([
            'nome_fantasia' => 'Required',
            'cnpj' => 'Required',
            'cnes' => 'Required',
            'responsavel' => 'Required',
            'telefone1' => 'Required',
            'email' => 'Required',
        ],[
            'required' => 'O campo :attribute é de preenchimento obrigatório',
        ]);


        if ($request->hasFile('logotipo')) {
            $fileName = $request->file('logotipo')->store('img', 'public');
            
            Unidade::updateOrCreate(['id' => $request->input('id')],[
                'logotipo' => $fileName,
                'user_id' => Auth::user()->id,
            ]);            
        }

        if($request->input('chave_codigo')){
            $unidade = Unidade::updateOrCreate(['id' => $request->input('id')],[
                'chave_codigo' => $request->input('chave_codigo'),
                'user_id' => Auth::user()->id,    
            ]);
        }

        $unidade = Unidade::updateOrCreate(['id' => $request->input('id')],[
            'nome_fantasia' => $request->input('nome_fantasia'),
            'cnpj' => $request->input('cnpj'),
            'cnes' => $request->input('cnes'),
            'responsavel' => $request->input('responsavel'),
            'endereco' => $request->input('endereco'),
            'bairro' => $request->input('bairro'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
            'cep' => $request->input('cep'),
            'telefone1' => $request->input('telefone1'),
            'telefone2' => $request->input('telefone2'),
            'telefone3' => $request->input('telefone3'),
            'email' => $request->input('email'),
            'user_id' => Auth::user()->id,
        ]);
            
        $servicos = $request->input('servicos');
        
        if($servicos <> null){


            if(count($servicos) > 0){
                foreach ($servicos as $e) {

                    $unidade->servicos()->syncWithoutDetaching(
                    [
                        $e['id'] => ['user_id' => Auth::user()->id]
                    ]
                    );
                }
            }

        } 
        return back()->with('message', 'Unidade registrada com sucesso');
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Unidade $unidade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidade $unidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unidade $unidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unidade $unidade)
    {
        //
    }
}
