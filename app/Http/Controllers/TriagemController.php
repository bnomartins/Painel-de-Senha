<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Triagem;
use App\Models\Atendimento;
use App\Models\Medicamento;
use App\Models\Medicamentos;
use App\Models\RelProcAtend;
use App\Models\Risco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class TriagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $atendimentos = Atendimento::with('paciente')
        //     ->orderBy('created_at', 'asc')
        //     ->whereHas('paciente', function ($query){
        //     $query->where('cpf', 'like', '%'.Req::input('search'))
        //     // ->orWhere('nome','like', '%'.Req::input('search').'%')
        //     ;
        // })

        // procedimentos - cbos - prestador

        $atendimentos = Atendimento::with('paciente', 'triagem', 'clinico', 'triagem.risco')
        // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
            ->whereHas('paciente', function ($query){
                $query
                ->Where('cpf','like', Req::input('search').'%')
                ->orWhere('nome','like', '%'.Req::input('search').'%')
                // ->where('cpf', 'like', '%'.Req::input('search'))
                ;
            })


        ->orderBy('updated_at', 'asc')
        ->paginate(15);

        $nPacientes = Paciente::all()->count();
        $nAtendimentoAberto = Atendimento::where('status', '<>', 'Finalizado')->where('dthrinicio', '>=', date('Y-m-d'))->get()->count();
        $nAtendimentoFinalizado = Atendimento::where('status', '=', 'Finalizado')->where('dthrinicio', '>=', date('Y-m-d'))->get()->count();

        return Inertia::render('Triagems/index', ['atendimentos' => $atendimentos,
            'npacientes' => $nPacientes, 'natendimentoaberto' => $nAtendimentoAberto, 
            'natendimentofinalizado' => $nAtendimentoFinalizado
        ]);
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
            'queixa' => 'required',
            'classificacao' => 'required',
            'risco_id' => 'required'
        ], [
            'risco_id.required' => 'O campo discriminador é de preenchimento obrigatório',
            'required' => 'O campo :attribute é de preenchimento obrigatório',
        ]);
        // Triagem::create($request->all());

        
        $atendimento = Atendimento::find($request->input('atendimento_id'));
        $atendimento->status = 'Aguardando Atendimento Clínico';
        $atendimento->save();

        $alergia = '';
        if($request->input('alergia')){
            $alergia = json_encode($request->input('alergia'));
        }

        Triagem::updateOrCreate(['atendimento_id' => $request->input('atendimento_id')],
            [
                'queixa' => $request->input('queixa'),
                'alergia' => $alergia,
                'peso' => $request->input('peso'),
                'altura' => $request->input('altura'),
                'cintura' => $request->input('cintura'),
                'perimetro_cefalico' => $request->input('perimetro_cefalico'),
                'frequencia_respiratoria' => $request->input('frequencia_respiratoria'),
                'frequencia_cardiaca' => $request->input('frequencia_cardiaca'),
                
                'pressao_arterial_sistolica' => $request->input('pressao_arterial_sistolica'),
                'pressao_arterial_diastolica' => $request->input('pressao_arterial_diastolica'),

                'temperatura' => $request->input('temperatura'),
                'glicemia_capilar' => $request->input('glicemia_capilar'),
                'saturacao_o2' => $request->input('saturacao_o2'),
                'observacao' => $request->input('observacao'),

                'classificacao' => $request->input('classificacao'),

                'risco_id' => $request->input('risco_id'),
                'dthrfim' => Now(),
                'atendimento_id' => $atendimento->id,
                'user_id' => Auth::user()->id
            ]
        );


        //inserir na tabela relacionamento procedimtno com o atendimento


        if($request->input('peso') || $request->input('altura')){

            RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '01.01.04.002-4'],[
                'user_solicitacao_id' => Auth::user()->id,
                'user_atendimento_id' => Auth::user()->id,
                'atendimento_id' => $atendimento->id, 
                'procedimento' => '01.01.04.002-4',
                'descricao' => 'AVALIAÇÃO ANTROPOMÉTRICA',
                'local_origem' => Auth::user()->room,
                'servico_origem' => Auth::user()->service,
                'servico_destino' => Auth::user()->service,
                'local_atendimento' => Auth::user()->room,
                'finalizado' => true
            ]);
        }

        if($request->input('pressao_arterial_sistolica')){

            RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '03.01.10.003-9'],[
                'user_solicitacao_id' => Auth::user()->id,
                'user_atendimento_id' => Auth::user()->id,
                'atendimento_id' => $atendimento->id,
                'procedimento' => '03.01.10.003-9',
                'descricao' => 'AFERIÇÃO DE PRESSÃO ARTERIAL',
                'local_origem' => Auth::user()->room,
                'servico_origem' => Auth::user()->service,
                'servico_destino' => Auth::user()->service,
                'local_atendimento' => Auth::user()->room,
                'finalizado' => true
                ]);
        }

        if($request->input('glicemia_capilar')){

            RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '02.14.01.001-5'],[
                'user_solicitacao_id' => Auth::user()->id,
                'user_atendimento_id' => Auth::user()->id,
                'atendimento_id' => $atendimento->id,
                'procedimento' => '02.14.01.001-5',
                'descricao' => 'GLICEMIA CAPILAR',
                'local_origem' => Auth::user()->room,
                'servico_origem' => Auth::user()->service,
                'servico_destino' => Auth::user()->service,
                'local_atendimento' => Auth::user()->room,
                'finalizado' => true
                ]);
        }

        if($request->input('temperatura')){

            RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '03.01.10.025-0'],[
                'user_solicitacao_id' => Auth::user()->id,
                'user_atendimento_id' => Auth::user()->id,
                'atendimento_id' => $atendimento->id,
                'procedimento' => '03.01.10.025-0',
                'descricao' => 'AFERIÇÃO DE TEMPERATURA',
                'local_origem' => Auth::user()->room,
                'servico_origem' => Auth::user()->service,
                'servico_destino' => Auth::user()->service,
                'local_atendimento' => Auth::user()->room,
                'finalizado' => true
            ]);
        }

        RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '03.01.04.007-9'],[
            'user_solicitacao_id' => Auth::user()->id,
            'user_atendimento_id' => Auth::user()->id,
            'atendimento_id' => $atendimento->id,
            'procedimento' => '03.01.04.007-9',
            'descricao' => 'ESCUTA INICIAL / ORIENTAÇÃO (ACOLHIMENTO A DEMANDA ESPONTÂNEA)',
            'local_origem' => Auth::user()->room,
            'servico_origem' => Auth::user()->service,
            'servico_destino' => Auth::user()->service,
            'local_atendimento' => Auth::user()->room,
            'finalizado' => true
        ]);         

        RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '03.01.01.004-8'],[
            'user_solicitacao_id' => Auth::user()->id,
            'user_atendimento_id' => Auth::user()->id,
            'atendimento_id' => $atendimento->id,
            'procedimento' => '03.01.01.004-8',
            'descricao' => 'CONSULTA DE PROFISSIONAIS DE NIVEL SUPERIOR NA ATENÇÃO ESPECIALIZADA (EXCETO MÉDICO',
            'local_origem' => Auth::user()->room,
            'servico_origem' => Auth::user()->service,
            'servico_destino' => Auth::user()->service,
            'local_atendimento' => Auth::user()->room,
            'finalizado' => true
        ]);         

        RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '03.01.06.002-9'],[
            'user_solicitacao_id' => Auth::user()->id,
            'user_atendimento_id' => Auth::user()->id,
            'atendimento_id' => $atendimento->id,
            'procedimento' => '03.01.06.002-9',
            'descricao' => 'ATENDIMENTO DE URGÊNCIA C/OBSERVAÇÃO ATE 24 HORAS EM ATENÇÃO ESPECIALIZADA',
            'local_origem' => Auth::user()->room,
            'servico_origem' => Auth::user()->service,
            'servico_destino' => Auth::user()->service,
            'local_atendimento' => Auth::user()->room,
            'finalizado' => true
        ]);         

        //Atualizar a senha
        $senhaController = new SenhaController();
        $senhaController->call($atendimento->id);

        // return redirect()->route('triagems.index')->with('message', 'Triagem registrada com sucesso');
        return back()->with('message', 'Triagem registrada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Triagem $triagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Triagem $triagem)
    {
        return redirect()->route('triagem.index', ['triagem' => $triagem]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function atendimento(Request $request)
    {

        $riscos = Risco::all();
        $medicamentos = Medicamento::where('disponivel', '=', true)->get();

        // atualizar ou cadatrar uma triagem para iniciar atendimento e impedir outros profissionais de acessar o mesmo atendimento

        Triagem::updateOrCreate(['atendimento_id' => $request->input('id')],
            ['user_id' => Auth::user()->id]
        );
        Atendimento::updateOrCreate(['id' => $request->input('id')],[
            'status' => 'Em Atendimento - Triagem'
        ]);
        $atendimento = Atendimento::
            with('paciente', 'triagem', 'clinico', 'triagem.risco')
            ->where(['id' => $request->input('id')])->get();
        return Inertia::render('Triagems/atendimento', ['atendimento' => $atendimento, 'riscos' => $riscos, 'medicamentos' => $medicamentos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Triagem $triagem)
    {

        $tri = Triagem::find($request->input('id'));
        if($request->user()->cannot('update', $tri)){
            abort(403);
        }


        $request->validate([
            'classificacao' => 'required|string|max:200',
            'observacao' => 'required|string|max:500',
        ]);
        $triagem->classificacao = $request->classificacao;
        $triagem->observacao = $request->observacao;
        $triagem->save();
        // return redirect()->route('triagems.index')->with('message', 'Triagem atualizados com sucesso');
        return back()->with('message', 'Triagem atualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Triagem $triagem, Request $request)
    {
        $tri = Triagem::find($request->input('id'));
        if($request->user()->cannot('update', $tri)){
            abort(403);
        }

        $triagem->delete();
        // return redirect()->route('triagems.index')->with('message', 'Triagem removido com sucesso');
        return back()->with('message', 'Triagem removido com sucesso');
    }
}
