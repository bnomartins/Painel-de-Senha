<?php

namespace App\Http\Controllers;

use App\Models\Ambulatorio;
use App\Models\AmbulatorioAux;
use App\Models\Clinico;
use App\Models\Atendimento;
use App\Models\Cid1;
use App\Models\Documento;
use App\Models\DocumentoModelo;
use App\Models\Exame;
use App\Models\ExameAux;
use App\Models\Imagem;
use App\Models\ImagemAux;
use App\Models\Medicamento;
use App\Models\Procedimento;
use App\Models\Senha;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\RelProcAtend;
use App\Models\RelProcMed;
use App\Models\RelUnidServ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as Req;

use Inertia\Inertia;

class ClinicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

            $exames = ExameAux::where('disponivel', '=', true)->get();
            $imagems = ImagemAux::where('disponivel', '=', true)->get();
            $procedimentos = AmbulatorioAux::where('disponivel', '=', true)->get();

            $atendimentos = Atendimento::with('clinico.exames.procedimentos', 'clinico.imagems.procedimentos', 'clinico.ambulatorios.procedimentos', 'paciente', 'triagem')
            // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
                ->whereHas('paciente', function ($query){
                        $query
                        ->Where('status','like', '%Clínico%')
                        ->where('nome','like','%'.Req::input('search').'%')
                        // ->where('cpf', 'like', '%'.Req::input('search'))
                        ;
                })


            ->orderBy('updated_at', 'desc')
            ->paginate(15);

            $nPacientes = Paciente::all()->count();
            $nAtendimentoAberto = Atendimento::where('status', '<>', 'Finalizado')->where('dthrinicio', '>=', date('Y-m-d'))->get()->count();
            $nAtendimentoFinalizado = Atendimento::where('status', '=', 'Finalizado')->where('dthrinicio', '>=', date('Y-m-d'))->get()->count();

            return Inertia::render('Clinicos/index', [
                'atendimentos' => $atendimentos, 
                'exames' => $exames, 'imagems' => $imagems, 'procedimentos' => $procedimentos,
                'npacientes' => $nPacientes, 'natendimentoaberto' => $nAtendimentoAberto, 'natendimentofinalizado' => $nAtendimentoFinalizado
            ]);

        }

        public function atendimento(Request $request){  
            
            $grupos_amb = AmbulatorioAux::all()->pluck('grupo')->toArray();

            $procedimentos = [];
            foreach($grupos_amb as $key=>$g){
                $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get()->toArray();

                if($procedimentos === []){
                    $procedimentos = $gp;
                } else {
                    $procedimentos = [$procedimentos, ...$gp];
                }
            }

            $grupos_ex = ExameAux::all()->pluck('grupo')->toArray();

            $exames = [];
            foreach($grupos_ex as $key=>$g){
                $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get()->toArray();

                if($exames === []){
                    $exames = $gp;
                } else {
                    $exames = [$exames, ...$gp];
                }
            }

            $grupos_im = ImagemAux::all()->pluck('grupo')->toArray();

            $imagems = [];
            foreach($grupos_im as $key=>$g){
                $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get()->toArray();

                if($imagems === []){
                    $imagems = $gp;
                } else {
                    $imagems = [$imagems, ...$gp];
                }
            }

            // $procedimentos = Procedimento::where(function($query) use($grupos){
            //     $query->orWhere('codigo', 'like', $grupos.'%');
            // })->get();
            
            // $exames = ExameAux::where('disponivel', '=', true)->get();
            // $imagems = ImagemAux::where('disponivel', '=', true)->get();
            // $procedimentos = Procedimento::where('disponivel', '=', true)->get();

            if(!$request->input('id')){
                abort(403);
            }

            Clinico::updateOrCreate(['atendimento_id' => $request->input('id')],[
                'user_id' => Auth::user()->id
            ]);
            Atendimento::updateOrCreate(['id' => $request->input('id')],[
                'status' => 'Em Atendimento - Clínico'
            ]);

            $paciente_id = Atendimento::find(['id', $request->input('id')])->first()->id;

            $consultas = Atendimento::with(
                'clinico.exames.procedimentos', 
                'clinico.exames.user', 
                'clinico.imagems.procedimentos', 
                'clinico.imagems.user', 
                'clinico.ambulatorios.procedimentos.user', 
                'paciente', 
                'triagem')
            // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
                ->where(['id' => $paciente_id])
                ->orderBy('updated_at', 'desc')
                ->get();

            $documentos = DocumentoModelo::where('cancelado', false)->where('user_id', Auth::user()->id)->orWhere('user_id', 1)->get();

            $atendimento = Atendimento::with(
                'clinico.exames.procedimentos',
                'clinico.exames.user',
                'clinico.imagems.procedimentos',
                'clinico.imagems.user',
                'clinico.ambulatorios.procedimentos.user', 
                'clinico.ambulatorios.medicamentos',
                'clinico.ambulatorios.user',
                'clinico.prescricaos.user', 
                'clinico.documentos.user', 
                'clinico.user.unidade', 
                'clinico.user.prestador', 
                'paciente', 
                'triagem')
            // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
                ->where(['id' => $request->input('id')])
                ->orderBy('updated_at', 'desc')
                ->get();

            $cid = Cid1::distinct()->get(['cid', 'descricao']);

            $medicamentos = Medicamento::where('disponivel', '=', true)->get();

            return Inertia::render('Clinicos/atendimento', [
                'atendimento' => $atendimento, 
                'consultas' => $consultas,
                'exames' => $exames, 'imagems' => $imagems, 'procedimentos' => $procedimentos,
                'cid' => $cid,
                'medicamentos' => $medicamentos,
                'documentos' => $documentos,
            ]);

        }

        public function procedimentosCid(Request $request){
            

            $grupos_amb = AmbulatorioAux::all()->pluck('grupo')->toArray();

            $procedimentos = [];
            foreach($grupos_amb as $key=>$g){
                $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get()->toArray();

                if($procedimentos === []){
                    $procedimentos = $gp;
                } else {
                    $procedimentos = [$procedimentos, ...$gp];
                }
            }

            $grupos_ex = ExameAux::all()->pluck('grupo')->toArray();

            $exames = [];
            foreach($grupos_ex as $key=>$g){
                $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get()->toArray();

                if($exames === []){
                    $exames = $gp;
                } else {
                    $exames = [$exames, ...$gp];
                }
            }

            $grupos_im = ImagemAux::all()->pluck('grupo')->toArray();

            $imagems = [];
            foreach($grupos_im as $key=>$g){
                $gp = Procedimento::where('codigo', 'like', $g."%")->where('disponivel', true)->get()->toArray();

                if($imagems === []){
                    $imagems = $gp;
                } else {
                    $imagems = [$imagems, ...$gp];
                }
            }

            // $procedimentos = Procedimento::where(function($query) use($grupos){
            //     $query->orWhere('codigo', 'like', $grupos.'%');
            // })->get();
            
            // $exames = ExameAux::where('disponivel', '=', true)->get();
            // $imagems = ImagemAux::where('disponivel', '=', true)->get();
            // $procedimentos = Procedimento::where('disponivel', '=', true)->get();

            if(!$request->input('id')){
                abort(403);
            }

            $paciente_id = Atendimento::find(['id', $request->input('id')])->first()->id;

            $consultas = Atendimento::with('clinico.exames.procedimentos', 'clinico.exames.user', 'clinico.imagems.procedimentos', 'clinico.imagems.user', 'clinico.ambulatorios.procedimentos.user', 'paciente', 'triagem')
            // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
                ->where(['id' => $paciente_id])
                ->orderBy('updated_at', 'desc')
                ->get();

            $atendimento = Atendimento::with('clinico.exames.procedimentos', 'clinico.exames.user', 'clinico.imagems.procedimentos', 'clinico.imagems.user', 'clinico.ambulatorios.procedimentos.user', 'paciente', 'triagem')
            // $atendimentos = Atendimento::with('clinico.imagems.imagem_auxes', 'paciente', 'triagem')
                ->where(['id' => $request->input('id')])
                ->orderBy('updated_at', 'desc')
                ->get();

            $cid = Cid1::distinct()->get(['cid', 'descricao']);


            $c = explode(' - ', $request->input('hipoteseDiagnostica'))[0];
            $cid1 = Cid1::where('cid', $c)->with('procedimentos')->get();

            return Inertia::render('Clinicos/atendimento', [
                'atendimento' => $atendimento, 
                'consultas' => $consultas,
                'exames' => $exames, 'imagems' => $imagems, 'procedimentos' => $procedimentos,
                'cid' => $cid,
                'cid1' => $cid1
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

        // Consultar se existe algum atendimnto clínico
        $clinico = Clinico::where(['atendimento_id' => $request->input('id')])->first();

        // Verifica permissão do usuário

        if($request->user()->cannot('update', $clinico) && $clinico !== null){
            abort(403);
        }

        // Validação do formulário
        // $request->validate([ 
        //     'alta' => 'required'
        // ], [
        //     'required' => 'O campo :attribute é de preenchimento obrigatório!'
        // ]);

        // Consulta atendimento
        $atendimento = Atendimento::find($request->input('id'));

        
        // Verificar se é alta ou não
        $alta = $request->input('alta_motivo');
        
        if(str_contains($alta, 'ALTA')){
            $atendimento->status = 'Finalizado';
            $atendimento->dthrfim = date('Y-m-d h:i:s');
            $atendimento->finalizado = 1;
            $atendimento->save();
        }
        
        $anamnese_antecedentes_morbidos = '';
        if($request->input('anamnese_antecedentes_morbidos')){
            $anamnese_antecedentes_morbidos = json_encode($request->input('anamnese_antecedentes_morbidos'));
        }

        // Atualiza ou cadastra um atendimento clínico
        $clinico = Clinico::updateOrCreate(['atendimento_id' => $atendimento->id],[

            //Anamnese
            'anamnese_queixa' => $request->input('anamnese_queixa'),
            'anamnese_historico_molestia' => $request->input('anamnese_historico_molestia'),
            'anamnese_historico_patologia' => $request->input('anamnese_historico_patologia'),
            'anamnese_historico_familiar' => $request->input('anamnese_historico_familiar'),
            'anamnese_antecedentes_morbidos' => $anamnese_antecedentes_morbidos,
            'anamnese_exame_fisico' => $request->input('anamnese_exame_fisico'),
            'anamnese_observacao' => $request->input('anamnese_observacao'),
            
            // Hipótese/Diagnóstica
            'diagnostico_hipotese1' => $request->input('diagnostico_hipotese1'),
            'diagnostico_hipotese1_observacao'=> $request->input('diagnostico_hipotese1_observacao'),
        
            'diagnostico_hipotese2'=> $request->input('diagnostico_hipotese2'),
            'diagnostico_hipotese2_observacao'=> $request->input('diagnostico_hipotese2_observacao'),
        
            'diagnostico_confirmado1' => $request->input('diagnostico_confirmado1'),
            'diagnostico_confirmado1_observacao' => $request->input('diagnostico_confirmado1_observacao'),
        
            'diagnostico_confirmado2' => $request->input('diagnostico_confirmado2'),
            'diagnostico_confirmado2_observacao' => $request->input('diagnostico_confirmado2_observacao'),
            
            'conduta' => $request->input('conduta'),
            'prognostico' => $request->input('prognostico'),
            'evolucao' => $request->input('evolucao'),

            'alta_motivo' => $request->input('alta_motivo'),
            'alta_observacao' => $request->input('alta_observacao'),
            'alta_data' => $request->input('alta_motivo') ? Now() : '',
        
            //

            'dthrfim' =>Now(),
            'atendimento_id' => $request->input('id'),
            'user_id' => Auth::user()->id
        ]);

        // Se existir exame [] cadastra ou atualiza

        if($request->input('exame')){

            foreach($request->input('exame') as $e){
                Exame::updateOrCreate(
                    ['procedimento_id' => $e['id'], 'clinico_id' => $clinico->id],
                    [
                        'observacao' => $e['observacao'],
                        'procedimento_id' => $e['id'],
                        'solicitacao_id' => Auth::user()->id,
                        'clinico_id' => $clinico->id
                    ]);

                    $codigo = Procedimento::where(['id' => $e['id']])->get()->value('codigo');


                    RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => $codigo],
                        [
                            'user_solicitacao_id' => Auth::user()->id,
                            'atendimento_id' => $atendimento->id,
                            'procedimento' => $codigo,
                            'descricao' => $e['proc'],
                            'local_origem' => Auth::user()->room,
                            'servico_origem' => Auth::user()->service,
                            'servico_destino' => 'Ambulatorial'
                        ]);     


            };
        }

        // Se existir imagem cadastra ou atualiza
        if($request->input('imagem')){

            foreach($request->input('imagem') as $e){
                Imagem::updateOrCreate(
                    ['procedimento_id' => $e['id'], 'clinico_id' => $clinico->id],
                    [
                        'observacao' => $e['observacao'],
                        'procedimento_id' => $e['id'],
                        'solicitacao_id' => Auth::user()->id,
                        'clinico_id' => $clinico->id
                    ]);

                    $codigo = Procedimento::where(['id' => $e['id']])->get()->value('codigo');

                    RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => $codigo],
                        [
                            'user_solicitacao_id' => Auth::user()->id,
                            'atendimento_id' => $atendimento->id,
                            'procedimento' => $codigo,
                            'descricao' => $e['proc'],
                            'local_origem' => Auth::user()->room,
                            'servico_origem' => Auth::user()->service,
                            'servico_destino' => 'Ambulatorial'
                        ]);   

                };
        }

        // Se existir atendimento ambulatorial cadastra ou atualiza

        if($request->input('ambulatorio')){

            foreach($request->input('ambulatorio') as $proc){
                foreach($proc as $e){

                    $ambulatorio = Ambulatorio::updateOrCreate(
                        ['procedimento_id' => $e['id'], 'clinico_id' => $clinico->id],
                        [
                            'observacao' => $e['observacao'],
                            'procedimento_id' => $e['id'],
                            'solicitacao_id' => Auth::user()->id,
                            'clinico_id' => $clinico->id
                        ]);


                        $codigo = Procedimento::where(['id' => $e['id']])->get()->value('codigo');

                        RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => $codigo],
                            [
                                'user_solicitacao_id' => Auth::user()->id,
                                'atendimento_id' => $atendimento->id,
                                'procedimento' => $codigo,
                                'descricao' => $e['proc'],
                                'local_origem' => Auth::user()->room,
                                'servico_origem' => Auth::user()->service,
                                'servico_destino' => 'Ambulatorial'
                            ]);     

                            // Se existir medicamento ao procedimento realizar o cadastra ou atualiza

                            foreach($e['medicamentos'] as $m){


                                //Verificando a disponibilidade do medicamneto no estoque

                                //adoiciona medicamento ao procedimento
                                RelProcMed::updateOrCreate(['ambulatorio_id' => $ambulatorio->id, 'medicamento_id' => $m['med']],[
                                    'ambulatorio_id' => $ambulatorio->id,
                                    'medicamento_id' => $m['id'],
                                    'observacao' => $m['observacao'],
                                    'user_id' => Auth::user()->id
                                ]);
                            }



                    };
                }
        }



        if($request->input('documento_conteudo')){

            Documento::updateOrCreate(
                ['clinico_id' => $clinico->id, 'id' => $request->input('documento_id')],
                [
                    'tipo' => $request->input('documento_tipo'),
                    'titulo' => $request->input('documento_titulo'),
                    'conteudo' => $request->input('documento_conteudo'),
                    'clinico_id' => $clinico->id,
                    'documento_modelo_id' => $request->input('documento_id'),
                    'user_id' => Auth::user()->id
                ]);
        }


        // Se existir prescricao cadastra ou atualiza

        if($request->input('medicamento')){

            foreach($request->input('medicamento') as $m){
                foreach($m as $e){
                    Prescricao::updateOrCreate(
                        ['medicamento' => $m['medicamento'], 'clinico_id' => $clinico->id],
                        [
                            'medicamento' => $m['medicamento'],
                            'observacao' => $m['observacao'],
                            'solicitacao_id' => Auth::user()->id,
                            'clinico_id' => $clinico->id,
                            'user_id' => Auth::user()->id
                        ]);

                        // RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => $codigo],
                        //     [
                        //         'user_solicitacao_id' => Auth::user()->id,
                        //         'atendimento_id' => $atendimento->id,
                        //         'procedimento' => $codigo,
                        //         'descricao' => $m['proc'],
                        //         'local_origem' => Auth::user()->room,
                        //         'servico_origem' => Auth::user()->service,
                        //         'servico_destino' => 'Ambulatorial'
                        //     ]);     
                    };
                }
        }


        RelProcAtend::updateOrCreate(['atendimento_id' => $atendimento->id, 'procedimento' => '03.01.01.007-2'],[
            'user_solicitacao_id' => Auth::user()->id,
            'user_atendimento_id' => Auth::user()->id,
            'atendimento_id' => $atendimento->id,
            'procedimento' => '03.01.01.007-2',
            'descricao' => 'CONSULTA MEDICA EM ATENÇÃO ESPECIALIZADA',
            'local_origem' => Auth::user()->room,
            'servico_origem' => Auth::user()->service,
            'servico_destino' => Auth::user()->service,
            'local_atendimento' => Auth::user()->room,
            'finalizado' => true
        ]);     

        // Atualiza a chamada da senha no painel de senha
        $senhaController = new SenhaController();
        $senhaController->call($atendimento->id);

        // return redirect()->route('clinicos.index')->with('message', 'Consulta registrada com sucesso');
        return back()->with('message', 'Atendimento clínico registrado com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Clinico $clinico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinico $clinico)
    {
        return redirect()->route('clinicos.index', ['clinico' => $clinico]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinico $clinico)
    {

        $clin = Clinico::find($request->input('clinico_id'));
        if($request->user()->cannot('update', $clin)){
            abort(403);
        }

        $request->validate([
            'diagnostico' => 'required|string|max:200',
            'observacao' => 'required|max:1000'
        ]);
        $clinico->diagnostico = $request->diagnostico;
        $clinico->observacao = $request->observacao;
        $clinico->save();
        // return redirect()->route('clinicos.index')->with('message', 'Os dados da consulta foram atualizados com sucesso');
        return back()->with('message', 'Os dados da consulta foram atualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinico $clinico, Request $request)
    {

        $clin = Clinico::find($request->input('clinico_id'));
        if($request->user()->cannot('update', $clin)){
            abort(403);
        }

        $clinico->delete();
        return back()->with('message', 'Os dados da consulta foram removidos');
    }
}
