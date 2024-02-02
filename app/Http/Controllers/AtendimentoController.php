<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Paciente;
use App\Models\Prontuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class AtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $paciente = Paciente::with('atendimentos')
        ->where('nome', 'like', $request->input('nome').'%')

            ->orWhere('cpf','=', $request->input('cpf'))->whereNotNull('cpf')
            ->orWhere('registro', '=', $request->input('registro'))->whereNotNull('registro')
            ->orWhere('cartao_sus', '=', $request->input('cartao_sus'))->whereNotNull('cartao_sus')
            ->get();

        $pacientes = Paciente::with('atendimentos')
            ->orderBy('created_at', 'desc')
            ->whereHas('atendimentos', function ($query){
                $query
                    ->where('nome', 'like', Req::input('search').'%')
                    ->orWhere('cpf', '=', Req::input('search'))->whereNotNull('cpf')
                    ->orWhere('registro', '=', Req::input('search'))->whereNotNull('registro')
                    ->orWhere('cartao_sus', '=', Req::input('search'))->whereNotNull('cartao_sus')
            // ->orWhere('nome','like', '%'.Req::input('search').'%')
            ;
        })
        // ->orderBy('nome', 'asc')
        ->paginate(10);

        $nPacientes = Paciente::all()->count();
        $nAtendimentoAberto = Atendimento::where('status', '<>', 'Finalizado')->where('dthrinicio', '>=' , date('Y-m-d'))->get()->count();
        $nAtendimentoFinalizado = Atendimento::where('status', '=', 'Finalizado')->where('dthrinicio', '>=', date('Y-m-d'))->get()->count();

        return Inertia::render('Atendimentos/index', ['pacientes' => $pacientes, 'paciente' => $paciente,
        'npacientes' => $nPacientes, 'natendimentoaberto' => $nAtendimentoAberto, 'natendimentofinalizado' => $nAtendimentoFinalizado]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Atendimentos/PreAtendimento', []);
    }


    public function iniciarAtendimento(Request $request){
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Verifica se existe paciente
        if($request->id){
            // Valida os dados para - atualização do paciente
            $request->validate([
                'cpf' => 'nullable|min:14|max:14',
                'nome' => 'required',
                'nascimento' => 'required|date',
                'sexo' => 'required',
                'mae' => 'required',
                'pai' => 'required',
                'contato_telefone1' => 'required',
            ], [
                'cpf.min' => 'CPF inválido',
                'cpf.max' => 'CPF inválido',
                'nascimento.date' => 'A data de nascimento informada é inválida',
                'required' => 'O campo :attribute é de preenchimento obrigatório',
            ]);
            // Valida os dados para - novo paciente
        } else {
            $request->validate([
                'cpf' => 'nullable|min:14|max:14|unique:pacientes',
                'nome' => 'required',
                'nascimento' => 'required|date',
                'sexo' => 'required',
                'mae' => 'required',
                'pai' => 'required',
                'contato_telefone1' => 'required',
            ], [
                'cpf.unique' => 'O CPF informado já havia sido cadastrado, favor pesquisar!',
                'cpf.min' => 'CPF inválido',
                'cpf.max' => 'CPF inválido',
                'registro.unique' => 'O número da certidão de nasciemnto já hávia sido cadastrado, favor pesquisar!',
                'cartao_sus.unique' => 'O número do Cartão Sus já havia sido cadastrado, favor pesquisar!',
                'required' => 'O campo :attribute é de preenchimento obrigatório',
            ]);
        }

            //pacienteAtendimentor se existe atendimento aberto e não concluído

            $pacienteAtendimento = Atendimento::with('paciente')
                ->where('finalizado', '<>', true)
            ->whereHas('paciente', function($query){
                    $query->where('cpf', '=', Req::input('cpf'))->whereNotNull('cpf')
                    ->orWhere('registro', '=', Req::input('registro'))->whereNotNull('registro')
                    ->orWhere('cartao_sus', '=', Req::input('cartao_sus'))->whereNotNull('cartao_sus');
                })
                ->get();

            // $pacienteAtendimento = Paciente::with('atendimentos')
            // ->where('cpf','=', $request->input('cpf'))->whereNotNull('cpf')
            // ->whereHas('atendimentos', function ($query){
            //     $query
            //     ->where('finalizado','not', 1);
            // })
            // ->orWhere('registro', '=', $request->input('registro'))->whereNotNull('registro')
            // ->orWhere('cartao_sus', '=', $request->input('cartao_sus'))->whereNotNull('cartao_sus')
            // ->get();

            $paciente = Paciente::
                where('cpf', '=', $request->input('cpf'))->whereNotNull('cpf')
                ->orWhere('registro', '=', $request->input('registro'))->whereNotNull('registro')
                ->orWhere('cartao_sus', '=', $request->input('cartao_sus'))->whereNotNull('cartao_sus')
                ->first();

        // tem atendimento aberto
            if(sizeOf($pacienteAtendimento) == 0){ // não tem paciente ou não tem atendimenot abertto

                $prontuario_id = $paciente ? $paciente->prontuario_id : Prontuario::create()->id;
                $foto = $paciente ? $paciente->foto : '';

                if ($request->hasFile('foto')) {
                    $foto = $request->file('foto')->store('foto', 'public');
                }

                $paciente = Paciente::updateOrCreate(
                    ['id' => $request->input('id'), 'cpf' => $request->input('cpf')],
                    [
                        'nome' => $request->input('nome'),
                        'nome_social' => $request->input('nome_social'),

                        'cpf' => $request->input('cpf'),
                        'registro' => $request->input('registro'),
                        'cartao_sus' => $request->input('cartao_sus'),
                        'rg_numero' => $request->input('rg_numero'),
                        'rg_orgao' => $request->input('rg_orgao'),
                        'rg_data' => $request->input('rg_data'),
                        'nascimento' => $request->input('nascimento'),

                        'raca' => $request->input('raca'),
                        'sexo' => $request->input('sexo'),
                        'aborh' => $request->input('aborh'),

                        'estado_civil' => $request->input('estado_civil'),
                        'conjuge' => $request->input('conjuge'),
                        'mae' => $request->input('mae'),
                        'pai' => $request->input('pai'),
                        'cep' => $request->input('cep'),

                        'endereco' => $request->input('endereco'),
                        'endereco_numero' => $request->input('endereco_numero'),
                        'endereco_complemento' => $request->input('endereco_complemento'),
                        'endereco_bairro' => $request->input('endereco_bairro'),
                        'endereco_cidade' => $request->input('endereco_cidade'),
                        'endereco_estado' => $request->input('endereco_estado'),

                        'contato_telefone1' => $request->input('contato_telefone1'),
                        'contato_telefone2' => $request->input('contato_telefone2'),
                        'contato_telefone3' => $request->input('contato_telefone3'),

                        'contato_email' => $request->input('contato_email'),

                        'prontuario_id' => $prontuario_id,

                        'foto' => $foto
                    ]);

                Atendimento::create(
                    [
                        'status' => $request->input('status'),
                        'paciente_id' => $paciente->id,
                        'user_id' => Auth::user()->id,
                        'dthrinicio' => Now(),
                    ]
                );

                return redirect()->route('atendimentos.index')
                    ->with('message', 'Abertura de atendimento realizado com sucesso');

            } else {

                return redirect()->route('atendimentos.index')
                    ->with('message', 'Já existe atendimento aberto para o paciente');
            }

        
        

    }

    public function docsSearch(Request $request)
    {

        $paciente = Paciente::with('atendimentos')
        ->where('cpf','=', $request->input('cpf'))->whereNotNull('cpf')
        ->orWhere('registro', '=', $request->input('registro'))->whereNotNull('registro')
        ->orWhere('cartao_sus', '=', $request->input('cartao_sus'))->whereNotNull('cartao_sus')
        ->get();

        return Inertia::render('Atendimentos/index', ['paciente' => $paciente]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Atendimento $atendimento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atendimento $atendimento)
    {
        return redirect()->route('atendimentos.index', ['paciente' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atendimento $atendimento)
    {
        // $request->validate([
        //     'senha' => 'required|string|max:200',
        // ]);
        // $atendimento->senha = $request->senha;
        // $atendimento->save();
        // return redirect()->route('atendimentos.index')->with('message', 'Atendimento atualizados com sucesso');
    }

    public function upload(Request $request){
        $fileName = '';
        // Upload de arquivo
        if ($request->hasFile('resultado')) {
            $fileName = $request->file('resultado')->store('resultado', 'public');
        }

        Atendimento::updateOrCreate(['id' => $request->input('id')],[
            'resultado' => $fileName,
            'user_id' => Auth::user()->id,
        ]);

        // return redirect()->route('exames.index')->with('message', 'O resultado do exame foi inserido');
        return back()->with('message', 'O upload do arquivo foi enviado com sucesso');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atendimento $atendimento, Request $request)
    {
        $at = Atendimento::find($request->input('id'));
        if($request->user()->cannot('update', $at)){
            abort(403);
        }

        $atendimento->delete();
        return redirect()->route('atendimentos.index')->with('message', 'Atendimento removido com sucesso');
    }
}
