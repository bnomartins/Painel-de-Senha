<?php

use App\Http\Controllers\AmbulatorioAuxController;
use App\Http\Controllers\AmbulatorioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\ClinicoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\DocumentoModeloController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\TriagemController;
use App\Http\Controllers\ExameAuxController;
use App\Http\Controllers\ExameController;
use App\Http\Controllers\FaturamentoController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\IdentificacaoEstoqueController;
use App\Http\Controllers\ImagemAuxController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SaidaController;
use App\Http\Controllers\SenhaController;
use App\Http\Controllers\UnidadeController;
use App\Models\AmbulatorioAux;
use App\Models\Entrada;
use App\Models\IdentificacaoEstoque;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users.index')
        ->middleware('can:isAdmin, App\Model\User');

    Route::get('users', [UserController::class, 'update'])->name('users.update')
        ->middleware('can:isAdmin, App\Model\User');

    Route::get('users', [UserController::class, 'destroy'])->name('users.destroy')
        ->middleware('can:isAdmin, App\Model\User');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/rooms', [RoomController::class, 'update'])->name('rooms.update');

    Route::resource('users', UserController::class)
        ->middleware('can:isAdmin, App\Model\User');

    Route::resource('unidades', UnidadeController::class);

    Route::resource('pacientes', PacienteController::class)
        ->middleware('can:isRecepcionista, App\Model\Paciente');

    Route::get('/atendimentos/docsSearch', [AtendimentoController::class, 'docsSearch'])
        ->name('atendimentos.docsSearch');

    Route::get('/atendimentos/count', [AtendimentoController::class, 'count'])
        ->name('atendimentos.count')
        // ->middleware('can:isRecepcionista, App\Model\Atendimento')
    ;
    Route::resource('atendimentos', AtendimentoController::class)
        ->middleware('can:isRecepcionista, App\Model\Atendimento');

    Route::get('/triagems/atendimento', [TriagemController::class, 'atendimento'])
        ->name('triagems.atendimento');

    Route::resource('triagems', TriagemController::class)
        ->middleware('can:isTriagem, App\Model\Triagem');


    Route::resource('senhas', SenhaController::class)
        // ->middleware('can:isAdmin, App\Model\Senhas')
    ;

});

require __DIR__ . '/auth.php';
