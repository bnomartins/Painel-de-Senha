<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Imagem; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;
class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(){
        $imagems = imagem::
            with('clinico.atendimento.paciente','clinico.imagems.procedimentos', 'user_solicitacao')
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



    // $imagems = Imagem::with('clinico.atendimento.paciente', 'imagem_auxes', 'imagem_auxes', 'user_solicitacao')
    // // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
    // ->whereHas('clinico.atendimento.paciente', function ($query){
    //     $query
    //     ->where('nome','like','%'.Req::input('search').'%')
    //     // ->where('cpf', 'like', '%'.Req::input('search'))
    //         ;
    //     })
    //     ->orderBy('updated_at', 'desc')
    //     ->paginate(15);

    //dd($imagems);

    return Inertia::render('Imagems/index', ['imagems' => $imagems]);
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
    //     'resultado' => 'required',
    //     'observacao' => 'required',
    // ],[
    //     'required' => 'O campo :attribute é de preenchimento obrigatório'
    // ]);

    $imagems = Imagem::where(['clinico_id' => $request->input('clinico_id')])->get();

        foreach($imagems as $i){
            $i->update([
                'observacao' => $request->input('observacao'),
                'user_id' => Auth::user()->id,
                'dthrfim' => date('Y-m-d h:i:s')
    
            ]);
        }

        // $im = Imagem::find($request->input('id'));
        // if($request->user()->cannot('update', $im)){
        //     abort(403);
        // }


    // return redirect()->route('imagems.index')->with('message', 'O resultado do diagnóstico por imagem foi inserido');
    return back()->with('message', 'O resultado do diagnóstico por imagem foi inserido');
}

public function upload(Request $request){
    $fileName = '';
    // Upload de arquivo
    if ($request->hasFile('resultado')) {
        $fileName = $request->file('resultado')->store('resultado', 'public');
    }

    Imagem::updateOrCreate(['id' => $request->input('id')],[
        'resultado' => $fileName,
        'user_id' => Auth::user()->id,
        'dthrfim' => date('Y-m-d h:i:s')
    ]);

    // return redirect()->route('exames.index')->with('message', 'O resultado do exame foi inserido');
    return back();        
}


/**
* Display the specified resource.
*/
public function show(Imagem $imagem)
{
//
}

/**
* Show the form for editing the specified resource.
*/
public function edit(Imagem $imagem)
{
return redirect()->route('imagems.index', ['imagem' => $imagem]);
}

/**
* Update the specified resource in storage.
*/
public function update(Request $request, Imagem $imagem)
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
public function destroy(Imagem $imagem, Request $request)
{

    $im = Imagem::find($request->input('id'));
    if($request->user()->cannot('update', $im)){
        abort(403);
    }

    $imagem->delete();
        // return redirect()->route('imagems.index')->with('message', 'Os dados do imagem foram removidos');
        return back()->with('message', 'Os dados do imagem foram removidos');
    }
}
