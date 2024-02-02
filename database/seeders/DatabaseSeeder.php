<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        \App\Models\Unidade::factory()->create([
            'nome_fantasia' => 'Hospital ProntXCenter'
        ]);
        \App\Models\Setor::factory(5)->create();
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'access' => 'Admin',
            'room' => 'Consultório 01',
            'password' => bcrypt('1234567890'),
            'unidade_id' => 1,
            'sector_id' => 1

        ]);
        \App\Models\Servico::factory(1)->create();
        \App\Models\Unidade::factory(1)->create();
        \App\Models\RelUnidServ::factory(5)->create();
        \App\Models\RelProcAtend::factory(5)->create();
        \App\Models\Paciente::factory(1)->create();
        \App\Models\Cbo::factory(2)->create();
        \App\Models\Prestador::factory(4)->create();
        \App\Models\Atendimento::factory(10)->create();
        \App\Models\Risco::factory(5)->create();
        \App\Models\Triagem::factory(5)->create();
        \App\Models\Clinico::factory(5)->create();
        \App\Models\ExameAux::factory(5)->create();
        \App\Models\Exame::factory(10)->create();
        \App\Models\ImagemAux::factory(5)->create();
        \App\Models\Imagem::factory(5)->create();
        \App\Models\Procedimento::factory(5)->create();
        \App\Models\Ambulatorio::factory(5)->create();
        \App\Models\AmbulatorioAux::factory(5)->create();
        \App\Models\ProcedimentoGrupo::factory(5)->create();
        \App\Models\Prescricao::factory(5)->create();
        \App\Models\Documento::factory(5)->create();
        \App\Models\DocumentoModelo::factory(5)->create();


        \App\Models\Produto::factory(10)->create();
        \App\Models\Fornecedor::factory(10)->create();
        \App\Models\IdentificacaoEstoque::factory(3)->create();
        \App\Models\Estoque::factory(3)->create();
        \App\Models\Entrada::factory(1)->create();
        \App\Models\Saida::factory(1)->create();
        \App\Models\ItemSaida::factory(10)->create();
        \App\Models\RelEstUser::factory(3)->create();
        \App\Models\Lote::factory(10)->create();
    }
}
