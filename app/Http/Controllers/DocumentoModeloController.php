<?php

namespace App\Http\Controllers;

use App\Models\DocumentoModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'documento_tipo' => 'required',
            'documento_titulo' => 'required',
            'documento_conteudo' => 'required'
        ],[
            'required' => 'O campo :attribuite é obrigatório'
        ]);


        $documentoModelo = DocumentoModelo::updateOrCreate(
            ['user_id' => Auth::user()->id, 'titulo' => $request->input('documento_titulo')],[
            'tipo' => $request->input('documento_tipo') ,
            'titulo' => $request->input('documento_titulo')  ,
            'conteudo' => $request->input('documento_conteudo') ,

            'user_id' => Auth::user()->id
        ]);
        return back()->with('message', 'Modelo de Documento registrado com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show(DocumentoModelo $documentoModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DocumentoModelo $documentoModelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DocumentoModelo $documentoModelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DocumentoModelo $documentoModelo)
    {
        //
    }
}
