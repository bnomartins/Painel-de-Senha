<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\EntradaAux;
use App\Models\Estoque;
use App\Models\Fornecedor;
use App\Models\IdentificacaoEstoque;
use App\Models\ItemSaida;
use App\Models\Lote;
use App\Models\Paciente;
use App\Models\Produto;
use App\Models\RelEstUser;
use App\Models\Saida;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as Req;
use Inertia\Inertia;

class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $estoques = IdentificacaoEstoque::orderBy('updated_at', 'desc')->paginate(30);
        $estoques = IdentificacaoEstoque::with('estoque.produto')
            // ->orderBy('nome', 'asc')
            ->paginate(10);

        return Inertia::render('Estoques/index', ['estoques' => $estoques]);
    }

    public function estoqueProdutos(Request $request)
    {
        // $estoques = IdentificacaoEstoque::with('estoque.produto')
        //     ->where('id', $request->input('id'))
        //     ->whereHas('estoque.produto', function ($query) {
        //         $query
        //             ->where('produto', 'like', '%' . Req::input('search') . '%')->whereNotNull('produto')
        //             ->orWhere('codigo_barra', 'like', '=' . Req::input('search') . '%')->whereNotNull('codigo_barra')
        //             ->orWhere('descricao_detalhada', 'like', '%' . Req::input('search') . '%')->whereNotNull('descricao_detalhada');
        //     })
        //     ->orderBy('updated_at', 'desc')
        //     ->paginate(10);

        $estoques = Estoque::with('produto', 'user', 'identificacao_estoque', 'lote')
            ->whereHas('identificacao_estoque', function ($query) {
                $query
                    ->where('id', '=', Req::input('id'))->whereNotNull('id');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return Inertia::render('Estoques/Estoque', ['estoques' => $estoques, 'id' > $request->input('id')]);
    }

    public function estoqueEntradas(Request $request)
    {
        // $estoques = IdentificacaoEstoque::with('estoque.produto')
        //     ->where('id', $request->input('id'))
        //     ->whereHas('estoque.produto', function ($query) {
        //         $query
        //             ->where('produto', 'like', '%' . Req::input('search') . '%')->whereNotNull('produto')
        //             ->orWhere('codigo_barra', 'like', '=' . Req::input('search') . '%')->whereNotNull('codigo_barra')
        //             ->orWhere('descricao_detalhada', 'like', '%' . Req::input('search') . '%')->whereNotNull('descricao_detalhada');
        //     })
        //     ->orderBy('updated_at', 'desc')
        //     ->paginate(10);


        // dd($estoque_liberado);

        $produtos = Estoque::with('produto', 'identificacao_estoque')
            ->whereHas('identificacao_estoque', function ($query) {

                $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');

                $query->where('id', '=', Req::input('identificacao_estoque'))->whereNotNull('id')->where('id', 'in', $estoque_liberado);
            })
            ->get();

        $fornecedor = Fornecedor::get();

        $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');
        $identificacao_estoques = IdentificacaoEstoque::whereIn('id', $estoque_liberado)->get();

        $produtos = Estoque::with('produto', 'identificacao_estoque')
            ->whereHas('identificacao_estoque', function ($query) {

                $query
                    ->where('id', '=', Req::input('identificacao_estoque'))->whereNotNull('id');
            })
            ->get();

        $estoques = Estoque::with('produto', 'user', 'identificacao_estoque')
            ->whereHas('identificacao_estoque', function ($query) {
                $query
                    ->where('id', '=', Req::input('id'))->whereNotNull('id');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);


        return Inertia::render('Estoques/Entrada', ['estoques' => $estoques, 'id' > $request->input('id'), 'produtos' => $produtos, 'identificacao_estoques' => $identificacao_estoques, 'fornecedores' => $fornecedor]);
    }


    public function solicitacao(Request $request)
    {
        $produtos = Estoque::with('produto', 'identificacao_estoque')
            ->whereHas('identificacao_estoque', function ($query) {

                $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');

                $query
                    // ->where('id', '=', Req::input('identificacao_estoque_origem'))->whereNotNull('id')
                    ->whereIn('id', $estoque_liberado);
            })
            ->get();

        $pacientes = Paciente::get();
        $setor = Setor::where('id', Auth::user()->id)->get();

        $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');
        $identificacao_estoques = IdentificacaoEstoque::whereIn('id', $estoque_liberado)->get();

        $produtos = Estoque::with('produto', 'identificacao_estoque')
            ->whereHas('identificacao_estoque', function ($query) {

                $query
                    ->where('id', '=', Req::input('identificacao_estoque_origem'))->whereNotNull('id');
            })
            ->get();

        $estoques = Estoque::with('produto', 'user', 'identificacao_estoque')
            ->whereHas('identificacao_estoque', function ($query) {
                $query
                    ->where('id', '=', Req::input('id'))->whereNotNull('id');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);


        return Inertia::render('Estoques/Solicitacao', ['estoques' => $estoques, 'id' > $request->input('id'), 'produtos' => $produtos, 'identificacao_estoques' => $identificacao_estoques, 'pacientes' => $pacientes, 'setor' => $setor]);
    }

    public function solicitacaoCadastro(Request $request)
    {
        // saida---
        // setor_id
        // paciente_id
        // identificacao_estoque_origem_id
        // identificacao_estoque_destino_id **
        // solicitacao_id
        // liberacao_id
        // cancelado_id
        // observacao

        // item_saida ---
        // saida_id
        // quantidade
        // estoque_id
        // lote
        // observacao







        $request->validate([
            'destinacao' => 'required',
            'identificacao_estoque_origem' => 'required',
            'produtos' => 'required',
        ], [
            'required' => 'O campo :attribute é de preenchimento obrigatório'
        ]);

        $saida_id = '';

        if ($request->input('destinacao') == 'Setor') {
            // pesquissar o estque com a quantidade e subtrair o valor
            // diminuir a quantidade do estoque 
            // diminuir a quantidade do lote
            // Monto a saída

            $saida_id = Saida::create([
                'setor' => $request->input('destinacao') == 'Setor' ? true : false,
                'setor_id' => $request->input('setor_id'),

                'paciente' => $request->input('destinacao') == 'Paciente' ? true : false,
                'paciente_id' => $request->input('paciente_id'),

                'estoque' => $request->input('destinacao') == 'Estoque' ? true : false,
                'identificacao_estoque_origem_id' => $request->input('identificacao_estoque_origem_id'),
                'identificacao_estoque_destino_id' => $request->input('identificacao_estoque_destino_id'),

                'observacao' => $request->input('observacao'),
                'status' => 'Aberto',
                'solicitacao_id' => Auth::user()->id
            ])->id;

            // saida---
            // setor_id
            // paciente_id
            // identificacao_estoque_origem_id
            // identificacao_estoque_destino_id **
            // solicitacao_id
            // liberacao_id
            // cancelado_id
            // observacao

            // item_saida ---
            // saida_id
            // quantidade
            // estoque_id
            // lote
            // observacao


            if ($request->input('produtos')) {
                foreach ($request->input('produtos') as $produto_solicitado) {
                    // $estoque = Estoque::where('id', $produto['produto_id'])->with('lote') ->get();
                    // // dd($estoque[0]->lote);
                    // dd($estoque[0]['lote']);
                    // dd((float)$estoque[0]->quantidade - (float) $produto['quantidade']);
                    $produto = Lote::where('estoque_id', $produto_solicitado['produto_id'])->orderBy('validade', 'desc')->get();

                    // dd($produto[0]->lote, $produto_solicitado[0]->quantidade);
                    // dd((float)$produto[0]->quantidade - (float) $produto['quantidade']);

                    //foreach para percorrer os lotes cadastrados
                    // item_saida ---
                    // saida_id
                    // quantidade
                    // estoque_id
                    // lote
                    // observacao
                    $quantidade1 = (float) $produto_solicitado['quantidade'];
                    $quantidade = (float) $produto_solicitado['quantidade'];

                    foreach ($produto as $lote) {
                        // saida item
                        $qtd = 0;
                        if ($lote->quantidade >= $quantidade && $quantidade > 0) {
                            $qtd = $lote->quantidade - $quantidade;
                            $lote->quantidade = $qtd;
                            $quantidade = 0;
                            $lote->update();

                            ItemSaida::create([
                                'saida_id' => $saida_id,
                                'estoque_id' => $lote->estoque_id,
                                'quantidade' => $qtd,
                                'lote' => $lote->lote
                            ]);

                            $estoque = Estoque::where('id', $produto_solicitado['produto_id'])->first();
                            $estoque->quantidade = (float) $estoque->quantidade - $quantidade;
                            $estoque->update();
                        }

                        if ($lote->quantidade < $quantidade && $lote->quantidade > 0 && $quantidade > 0) {
                            $qtd = $quantidade - $lote->quantidade;
                            $quantidade = $qtd;
                            $lote->quantidade = 0;
                            $lote->update();

                            ItemSaida::create([
                                'saida_id' => $saida_id,
                                'estoque_id' => $lote->estoque_id,
                                'quantidade' => $qtd,
                                'lote' => $lote->lote
                            ]);

                            $estoque = Estoque::where('id', $produto_solicitado['produto_id'])->first();
                            $estoque->quantidade = (float) $estoque->quantidade - $qtd;
                            $estoque->update();
                        }
                    }
                }
            }
        }

        if ($request->input('destinacao') == 'Paciente') {
            // diminuir a quantidade do estoque 
            // diminuir a quantidade do lote

        }

        if ($request->input('destinacao') == 'Estoque') {
            // 
            $request->validate([
                'identificacao_estoque_destino' => 'required',
            ], [
                'required' => 'O campo :attribute é de preenchimento obrigatório'
            ]);

            // Cadastrar o produto do estouqe de origem para o estoque de destino com a quatidade especificada
            // subtrair do estoques 
            //      qtd lote > qtd solicitada (-)
            //      qtd lote < qtd.solicitada (tudo) identificar a diferença
            //           qtd lote - sobra 
            // 

        }



        // $produtos = Estoque::with('produto', 'identificacao_estoque')
        //     ->whereHas('identificacao_estoque', function ($query) {

        //         $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');

        //         $query->where('id', '=', Req::input('identificacao_estoque'))->whereNotNull('id')->where('id', 'in', $estoque_liberado);
        //     })
        //     ->get();

        // $pacientes = Paciente::get();
        // $setor = Setor::where('id', Auth::user()->id)->get();

        // $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');
        // $identificacao_estoques = IdentificacaoEstoque::whereIn('id', $estoque_liberado)->get();

        // $produtos = Estoque::with('produto', 'identificacao_estoque')
        //     ->whereHas('identificacao_estoque', function ($query) {

        //         $query
        //             ->where('id', '=', Req::input('identificacao_estoque'))->whereNotNull('id');
        //     })
        //     ->get();

        // $estoques = Estoque::with('produto', 'user', 'identificacao_estoque')
        //     ->whereHas('identificacao_estoque', function ($query) {
        //         $query
        //             ->where('id', '=', Req::input('id'))->whereNotNull('id');
        //     })
        //     ->orderBy('updated_at', 'desc')
        //     ->paginate(10);


        return back()->with('message', 'Solicitação realizada com sucesso, Solicitação n.º ' . $saida_id);
    }

    public function estoqueLiberacao(Request $request)
    {
        // $estoques = IdentificacaoEstoque::orderBy('updated_at', 'desc')->paginate(30);

        $estoques = IdentificacaoEstoque::get();

        // $usuario_estoque = User::with('identificacaoEstoque')->where('id', 1)->get();
        $usuario_estoque = User::with('identificacaoEstoque')->whereHas('identificacaoEstoque', function ($query) {
                $estoque_liberado = RelEstUser::where('usuario_id', Req::input('usuario_id'))->pluck('usuario_id');
                $query->whereIn('usuario_id', $estoque_liberado);
            })
            ->get();



            // $estoques = IdentificacaoEstoque::
            //     with('usuario')
            //         // Consultar o usuário 
            //     ->get()
            // ->orderBy('nome', 'asc')
        ;
        // dd($usuario_estoque);

        $usuarios = User::get();

        return Inertia::render('Estoques/Liberacao', ['estoques' => $estoques, 'usuarios' => $usuarios, 'usuario_estoque' => $usuario_estoque]);
    }

    public function estoqueLiberacaoCadastro(Request $request)
    {

        $request->validate(
            [
                'acessos' => 'required'
            ],
            [
                'required' => 's campos de preechimento obrigatório!'
            ]
        );

        //cadastrar o relacionamento usuario x estoque x acesso

        if ($request->input('acessos')) {

            foreach ($request->input('acessos') as $e) {

                // inserir se não tiver - e se tiver atualizar

                //inserir lote atualizado
                RelEstUser::updateOrCreate(
                    [
                        'usuario_id' => $e['usuario_id'],
                        'identificacao_estoque_id' => $e['estoque_id']
                    ],
                    [
                        'identificacao_estoque_id' => $e['estoque_id'],
                        'usuario_id' => $e['usuario_id'],
                        'acesso' => $e['acesso'],

                        'user_id' => Auth::user()->id,
                    ]
                );
            }

            return back()->with('message', 'Relacionamento Estoque x Usuário realizado com sucesso');
        }

        $estoques = IdentificacaoEstoque::get();

        $usuarios = User::get();

        return Inertia::render('Estoques/Liberacao', ['estoques' => $estoques, 'usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function revogacao(Request $request)
    {
        $request->validate([
            'remove_estoque_id' => 'required',
            'remove_estoque_identificacao' => 'required',
            'remove_usuario_id' => 'required',
            'remove_usuario_nome' => 'required',
            'remove_acesso' => 'required',
        ]);


        RelEstUser::where(['identificacao_estoque_id' => $request->input('remove_estoque_id'), 'user_id' => $request->input('remove_usuario_id'), 'acesso' => $request->input('remove_acesso')])->delete();
        return back()->with('message', 'Acesso do usuário ' . $request->input('remove_usuario_nome') . ' revogado para o estoque ' . $request->input('remove_estoque_identificacao'));
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
            'identificacao' => 'Required',
            'descricao' => 'Required',
        ], [
            'required' => 'O campo :attribute é de preenchimento obrigatório',
        ]);

        $estoques = IdentificacaoEstoque::where('identificacao', '=', $request->input('identificacao'))->whereNotNull('identificacao')->orWhere('descricao', '=', $request->input('descricao'))->whereNotNull('descricao')
            ->first();

        $foto = $estoques ? $estoques->foto : '';


        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('img', 'public');
        }

        $estoques_id = $estoques ? $estoques->id : '';

        $estoques = IdentificacaoEstoque::updateOrCreate(['id' => $estoques_id], [
            'foto' => $foto,
            'identificacao' => $request->input('identificacao'),
            'descricao' => $request->input('descricao'),
            'user_id' => Auth::user()->id,
        ]);


        // echo str_pad(id , 8 , '0' , STR_PAD_LEFT);
        // 
        // verificar digitos e completar com os 0


        return back()->with('message', 'Estoque cadastrado com sucesso');
    }


    public function estoqueEntradaCadastro(Request $request)
    {

        // Validações
        $request->validate([
            'ordem_compra' => 'Required',
            'documento_tipo' => 'Required',
            'documento_numero' => 'Required',
            'documento_serie' => 'Required',
            'documento_emissao' => 'Required',

            'fornecedor_cnpj' => 'Required',
            'fornecedor_razao_social' => 'Required',

            'identificacao_estoque' => 'Required',
            'produtos' => 'Required',
            'entrada' => 'Required',

            'valor_total' => 'Required',
        ], [
            'required' => 'O campo :attribute é de preenchimento obrigatório',
        ]);

        $fornecedor_id = '';

        // dd($request->all());

        // Cadastrar Fornecedor
        if ($request->input('fornecedor_id') == '') {
            $fornecedor_id = Fornecedor::updateOrCreate([
                'cnpj' => $request->input('fornecedor_cnpj')
            ], [
                'cnpj' => $request->input('fornecedor_cnpj'),
                'razao_social' => $request->input('fornecedor_razao_social'),
                'nome_fantasia' => $request->input('fornecedor_nome_fantasia'),
                'user_id' => Auth::user()->id
            ])->id;
        } else {
            $fornecedor_id = $request->input('fornecedor_id');
        }

        // Veriicar se já existe entrada
        //  Consultar entrada pelo número de documento
        $entrada = Entrada::where('documento_numero', $request->input('documento_numero'))
            ->where('documento_serie', $request->input('documento_serie'))
            ->where('fornecedor_id', $fornecedor_id)->first();


        $entrada_id = 0;

        if (empty($entrada)) {
            // Se não existir cadastrar a entrada e pegar o id

            $documento_anexo = '';

            if ($request->hasFile('documento_anexo')) {
                $documento_anexo = $request->file('documento_anexo')->store('img', 'public');
            }

            $entrada_id = Entrada::create(
                [
                    'ordem_compra' => $request->input('ordem_compra'),
                    'documento_tipo' => $request->input('documento_tipo'),
                    'documento_numero' => $request->input('documento_numero'),
                    'documento_serie' => $request->input('documento_serie'),
                    'documento_emissao' => $request->input('documento_emissao'),
                    'documento_anexo' => $documento_anexo,
                    'entrada' => $request->input('entrada'),

                    'icms_base' => $request->input('icms_base'),
                    'icms_valor' => $request->input('icms_valor'),
                    'icms_base_substituicao' => $request->input('icms_base_substituicao'),
                    'icms_valor_substituicao' => $request->input('icms_valor_substituicao'),
                    'frete_valor' => $request->input('frete_valor'),
                    'seguro_valor' => $request->input('seguro_valor'),
                    'ipi_valor' => $request->input('ipi_valor'),
                    'outras_despesas_valor' => $request->input('outras_despesas_valor'),
                    'valor_total' => $request->input('valor_total'),

                    'observacao' => $request->input('observacao'),

                    'fornecedor_id' => $fornecedor_id,
                    'user_id' => Auth::user()->id,
                ]
            )
                ->id;

            // dd($request->all());

            if ($request->input('produtos')) {

                foreach ($request->input('produtos') as $e) {

                    // Verificar se existe lote
                    //   Se existir soma, se não cadastrar
                    $lote = Lote::where('estoque_id', $e['produto_id'])
                        ->where('lote', $e['lote'])
                        ->first();

                    // Existe o produto com o lote, então soma se com a solicitação
                    //  acrescenta a quantidade
                    //  Média do valor_unitario
                    // dd($lote);
                    $quantidade = 0;
                    $valor_medio = 0;
                    if (!empty($lote)) {
                        $quantidade = $lote->quantidade;
                        $valor_medio = $lote->valor_unitario;

                        $valor_medio = (($valor_medio + $e['valor_unitario']) / 2);
                        $quantidade = $quantidade + $e['quantidade'];
                    } else {
                        $quantidade = $e['quantidade'];
                        $valor_medio = $e['valor_unitario'];
                    }

                    //inserir lote atualizado
                    Lote::updateOrCreate(
                        ['lote' => $e['lote'], 'estoque_id' => $e['produto_id'], 'fornecedor_id' => $fornecedor_id],
                        [
                            'lote' => $e['lote'],
                            'validade' => $e['validade'],
                            'quantidade' => $quantidade,
                            'valor_unitario' => $valor_medio,

                            'estoque_id' => $e['produto_id'],
                            'fornecedor_id' => $fornecedor_id,

                            'user_id' => Auth::user()->id,
                        ]
                    );
                    EntradaAux::create(
                        [
                            'lote' => $e['lote'],
                            'validade' => $e['validade'],
                            'quantidade' => $e['quantidade'],
                            'valor_unitario' => $e['valor_unitario'],

                            'estoque_id' => $e['produto_id'],
                            'entrada_id' => $entrada_id,
                            'fornecedor_id' => $fornecedor_id,

                            'user_id' => Auth::user()->id,
                        ]
                    );

                    $quantidade_estoque = Estoque::where('id', $e['produto_id'])
                        ->first();

                    Estoque::where('id', $e['produto_id'])
                        ->update([
                            'quantidade' => $quantidade_estoque->quantidade + $quantidade,
                            'valor_unitario' => $quantidade_estoque->valor_unitario + $valor_medio,
                            'user_id' => Auth::user()->id
                        ]);
                }

                return back()->with('message', 'Produtos cadastrados com sucesso, Entrada n.º' . $entrada_id);
            }
        } else {
            // Já existe entrada 
            return back()->with('message', 'Já existe entrada registrada para o documento n.º ' . $request->input('documento_numero') . ' (Fornecedor: ' . $request->input('fornecedor_nome_fantasia') . ')');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Estoque $estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estoque $estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estoque $estoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estoque $estoque)
    {
        //
    }
}
