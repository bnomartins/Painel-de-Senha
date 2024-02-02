<template>
    <Head title="Atendimentos" />

    <AuthenticatedLayout>
        <template #header>
            Atendimentos
        </template>

        <div class="flex-auto ">
            <div class="flex flex-col  sm:w-max-sm">

                <div class="bg-blue-100 min-w-screen">
                    <div class=" mt-4 grid lg:grid-cols-2 sm-grid-cols-1 p-4 py-1 gap-2">

                        <div class="m-1 border-b border-gray-200 flex justify-end">
                        </div>

                        <div class="m-1 border-b border-gray-200 flex justify-end">

                            <input
                            v-model="form.search"
                            @keyup.enter="pesquisarAtendimento()"
                            type="text"
                            placeholder="Palavra-Chave"
                            class=" h-10 my-2 mr-2 rounded-md shadow-lg
                            text-blue-500 text-md font-bold "
                            :disabled="form.processing"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"
                        />


                        <div class="inline-flex rounded-md shadow-sm" role="group">
                            <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                                @click="pesquisarAtendimento()"
                                :disabled="form.processing && !form.searchClear"
                                :class="{ 'opacity-25': form.processing && !form.searchClear }"
                            >
                                <span v-if="form.processing && !form.searchClear">Aguarde</span>
                                <span v-else>Pesquisar</span>
                              </button>

                            <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                              @click="limparPesquisaAtendimento()"
                              :disabled="form.processing && form.searchClear "
                              :class="{'opacity-25': form.processing && form.searchClear}"
                            >
                                <span v-if="form.processing && form.searchClear">Aguarde</span>
                                <span v-else>Limpar</span>
                            </button>
                          </div>

                        </div>
                        <div class=" col-span-2 font-bold text-lg w-full">
                            <Aviso />
                            <CardDashAtendimento :npacientes="npacientes" :natendimentofinalizado="natendimentofinalizado" :natendimentoaberto="natendimentoaberto"/>
                        </div>

                        <div class="col-span-2 center w-full bg-white"> 
                            <CadastroAtendimento :paciente="paciente" :pacientes="pacientes"/>
                        </div>

                        <div class="col-span-2 flex flex-auto items-center justify-between
                        p-2 bg-white rounded shadow-md">


                        <table class="w-full divide-y divide-gray-200 table-auto"  v-if="pacientes">
                            <tr class="bg-neutral-200">
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Nome</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">CPF</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Status</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Ações</th>
                            </tr>
                            <tbody v-for="(p, index) in pacientes.data" :key="p.id"
                                class="text-md font-bold"
                                >

                                <tr v-for="a in p.atendimentos" :key="a.id">
                                    <td >
                                        <CardPaciente :paciente="p" :tipo="Tabela"/></td>
                                    <td >{{ p.cpf }}</td>
                                    <td >{{ a.status }}</td>


                                <!-- <td class="px-2 py-2 text-md text-left">
                                    {{p.nome}}
                                </td>
                                <td class="px-2 py-2 text-md text-left">{{p.cpf}}</td> -->
                                <!-- <td class="px-2 py-2 text-md text-left">{{p.atendimento.status}}</td> -->
                                <!-- <td class="px-2 py-2 text-md text-left">{{p.cpf}}</td> -->
                                <td class="px-2 py-2 text-md float-right">
                                    <AbrirAtendimento
                                        :paciente="p"
                                    />
<!--
                                    <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button>

                                    <ExcluirAtendimento :id="p.id"/> -->

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirAtendimento(p.id)"
                                    >
                                        Excluir
                                    </button> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="m-2 p-2"  v-if="pacientes">
                <Pagination :links="pacientes.links"/>
            </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3';
import { Inertia, usePage } from "@inertiajs/inertia";

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import CadastroAtendimento from '../../Components/Atendimentos/Cadastro.vue'
import AbrirAtendimento from '../../Components/Atendimentos/AbrirAtendimento.vue'
import ExcluirAtendimento from '../../Components/Atendimentos/Excluir.vue'
import CardPaciente from '../../Components/Pacientes/CardPaciente.vue'
import CardDashAtendimento from '../../Components/Atendimentos/CardDashAtendimento.vue'
import FilaAtendimento from '@/Components/Atendimentos/FilaAtendimento.vue';

const props = defineProps({
    npacientes:{
        type: String
    },
    natendimentofinalizado:{
        type: String
    },
    natendimentoaberto:{
        type: String
    },
    pacientes: {
        type: Object
    },
    paciente:{
        type: Object
    }
})


const form = useForm({
      search: '',
      searchClear: false,
      paciente: {
        id: '',
        nome: '',
        cpf: ''
      }
  })

function pesquisarAtendimento(){
    form.searchClear = false
    form.get(route('atendimentos.index'), {
        search: form.search
    })

}

function limparPesquisaAtendimento(){
    form.searchClear = true
    form.search = ''

    form.get(route('atendimentos.index'), {
        search: form.search
    })
}


</script>
