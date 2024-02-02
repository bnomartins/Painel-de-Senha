<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\IdentificacaoEstoque;
use App\Models\Produto;
use App\Models\RelEstUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Req;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource. 
     */
    public function index()
    {
        $estoque_liberado = RelEstUser::where('usuario_id', Auth::user()->id)->pluck('identificacao_estoque_id');

        $estoques = IdentificacaoEstoque::
            whereIn('id', $estoque_liberado)
        ->get();
        
        $produtos = Produto::orderBy('updated_at', 'desc')->paginate(30);
        return Inertia::render('Produtos/index', ['produtos' => $produtos, 'estoques' => $estoques]);
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
            'produto' => 'Required',
            'descricao_resumida' => 'Required',
            'descricao_detalhada' => 'Required',
            'especie' => 'Required',
            'unidade' => 'Required',
            'estoque_id' => 'Required'

        ], [
            'required' => 'O campo :attribute é de preenchimento obrigatório',
        ]);

        // $produto = produto::where('produto', '=', $request->input('produto'))->whereNotNull('produto') 
        //     ->first();
            
        $produto = produto::with('estoque.identificacao_estoque')->
        whereHas('estoque.identificacao_estoque', function($query){
            $query->where('id', Req::input("estoque_id"));
        })->
        where('produto', $request->input('produto'))->whereNotNull('produto') 
            ->get();
        // $produto = produto::
        // whereHas('estoque', function($query){
        //     $query->where('id', Req::input('estoque_id'));
        // })->
        // where('produto', $request->input('produto'))->whereNotNull('produto') 
        //     ->first();

        // dd($produto);
        if (sizeof($produto) == 0){
            $foto = "";
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto')->store('img', 'public');
            }

            // $produto_id = $produto ? $produto->id : '';

            $produto = Produto::create([
                'foto' => $foto,
                'produto' => $request->input('produto'),
                'descricao_resumida' => $request->input('descricao_resumida'),
                'descricao_detalhada' => $request->input('descricao_detalhada'),
                'composicao' => $request->input('composicao'),
                'especie' => $request->input('especie'),
                'unidade' => $request->input('unidade'),
                'validade' => $request->input('validade'),
                'especificacao' => $request->input('especificacao'),
                'user_id' => Auth::user()->id,
            ]);

            
            $unidade = str_pad(Auth::user()->unidade_id, 3, '0', STR_PAD_LEFT);
            $codigo_barra = str_pad($produto->id, 10, '0', STR_PAD_LEFT);
            $codigo_barra = $unidade . "" . $codigo_barra;
            
            $produto = Produto::updateOrCreate(['id' => $produto->id], [
                'codigo_barra' => $codigo_barra,
                'user_id' => Auth::user()->id
            ]);

            // Adicionar produto ao estoque
            Estoque::updateOrCreate(['produto_id' => $produto->id],[
                'produto_id' => $produto->id,
                'identificacao_estoque_id' => (int) $request->input('estoque_id'),
                'quantidade_limite' => 0,
                'quantidade' => 0,
                'valor_unitario' => 0,
                'user_id' => Auth::user()->id,
            ]);

            return back()->with('message', 'Produto cadastrado com sucesso');
        } else {
            return back()->with('message', 'Produto já existente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
