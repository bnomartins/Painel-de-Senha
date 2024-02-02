<?php

namespace App\Http\Controllers;

use App\Models\Faturamento;
use App\Models\RelProcAtend;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FaturamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atendimentos = RelProcAtend::with(['user_solicitacao.prestador', 'user_atendimento.prestador', 'atendimentos.paciente'])->get()
        ->groupBy('atendimento_id')
        ;
        return Inertia::render('Faturamentos/index', ['atendimentos' => $atendimentos]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Faturamento $faturamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faturamento $faturamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faturamento $faturamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faturamento $faturamento)
    {
        //
    }
}
