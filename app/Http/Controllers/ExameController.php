<?php

namespace App\Http\Controllers;

use App\Models\Exame; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class ExameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

    $exames = Exame::
        with('clinico.atendimento.paciente','clinico.exames.procedimentos', 'clinico.exames.user', 'user_solicitacao')
        ->whereHas('clinico.atendimento.paciente', function ($query){
            $query
            ->where('nome','like','%'.Req::input('search').'%')
            // ->where('cpf', 'like', '%'.Req::input('search'))
            ;
        })
        ->orderBy('updated_at', 'asc')
        ->get()
        ->groupBy('clinico.atendimento.id')
        // ->paginate(15)->withQueryString()
        ;     

    // $exames = Exame::with('clinico.atendimento.paciente', 'exame_auxes', 'imagem_auxes', 'user_solicitacao')
    // // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
    //     ->whereHas('clinico.atendimento.paciente', function ($query){
    //         $query
    //         ->where('nome','like','%'.Req::input('search').'%')
    //         // ->where('cpf', 'like', '%'.Req::input('search'))
    //         ;
    //     })
    //     ->orderBy('updated_at', 'asc')
    //     ->paginate(15);

    //dd($exames);

    return Inertia::render('Exames/index', ['exames' => $exames]);
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
        // ],[
        //     'required' => 'O campo :attribute é de preenchimento obrigatório'
        // ]);

        $exames = Exame::where(['clinico_id' => $request->input('clinico_id')])->get();

            foreach ($exames as $e) {
                $e->update([
                    'observacao' => $request->input('observacao'),
                    'user_id' => Auth::user()->id,
                    'dthrfim' => date('Y-m-d h:i:s')
                ]);
            }

        // return redirect()->route('exames.index')->with('message', 'O resultado do exame foi inserido');
        return back()->with('message', 'O resultado do exame foi inserido');
    }

    /**
    * Display the specified resource.
    */
    public function show(Exame $exame)
    {
    //
    }

    public function upload(Request $request){
        $fileName = '';
        // Upload de arquivo
        if ($request->hasFile('resultado')) {
            $fileName = $request->file('resultado')->store('resultado', 'public');
        }

        Exame::updateOrCreate(['id' => $request->input('id')],[
            'resultado' => $fileName,
            'user_id' => Auth::user()->id,
            'dthrfim' => date('Y-m-d h:i:s')
        ]);

        // return redirect()->route('exames.index')->with('message', 'O resultado do exame foi inserido');
        return back()->with('message', 'deu certo, ihuu');        
    }

    /**
    * Show the form for editing the specified resource.
    */
    public function edit(Exame $exame)
    {
    return redirect()->route('exames.index', ['exame' => $exame]);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Exame $exame)
    {
        //
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request, Exame $exame)
    {
        $ex = Exame::find($request->input('id'));
        if($request->user()->cannot('update', $ex)){
            abort(403);
        }

        $exame->delete();
        // return redirect()->route('exames.index')->with('message', 'Os dados do exame foram removidos');
        return back()->with('message', 'Os dados do exame foram removidos');
    }
    }
