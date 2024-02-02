<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Pacientes
        </template>

        <div class="flex-auto ">
            <div class="flex flex-col  sm:w-max-sm">


                <div class="bg-blue-100 min-w-screen">
                    <div class=" mt-4 grid lg:grid-cols-2 sm-grid-cols-1 p-4 py-1 gap-2">

                        <div class="m-1 border-b border-gray-200 flex justify-end">
                        </div>

                        <div class="m-1 border-b border-gray-200 flex justify-end">

                            <div class="flex justify-end w-min-sm">
                                <input
                                v-model="form.search"
                                @keyup.enter="pesquisarPaciente"
                                type="text"
                                placeholder="Palavra-Chave"
                                class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                                :disabled="form.processing"
                                :class="{ 'opacity-25': form.processing && !form.searchClear }"
                            />
        
        
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                                    @click="pesquisarPaciente()"
                                    :disabled="form.processing && !form.searchClear"
                                    :class="{ 'opacity-25': form.processing && !form.searchClear }"
                                >
                                    <span v-if="form.processing && !form.searchClear">Aguarde</span>
                                    <span v-else>Pesquisar</span>
                                  </button>
        
                                <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                                  @click="limparPesquisaPaciente()"
                                  :disabled="form.processing && form.searchClear "
                                  :class="{'opacity-25': form.processing && form.searchClear}"
                                >
                                    <span v-if="form.processing && form.searchClear">Aguarde</span>
                                    <span v-else>Limpar</span>
                                </button>
                              </div>
                            <CadastroPaciente  />
                                <!-- <Edicao :Triagem='form.Triagem' v-if="form.modalEditar"/> -->

                            </div>
                        <div>
                    </div>
                </div>

                <div class=" col-span-2 font-bold text-lg w-full">
                    <Aviso />

                    <span class=" text-black sm:text-blue-500 md:text-red-500 lg:text-orange-500 w-full">
                        x pacientes: sendo x aguardando atendimento e x finalizadost
                    </span>
                </div>

            <div class="col-span-2 flex flex-auto items-center justify-between
                p-2 bg-white rounded shadow-md">

                <table class=" divide-y divide-gray-200 table-auto w-full ">
                    <tr class="bg-neutral-200">
                        <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">ID</th>
                        <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Nome</th>
                        <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">CPF</th>
                        <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Ações</th>
                    </tr>
                <tbody>

                    <tr 
                        v-for="(p, index) in pacientes.data"
                        :key="p.id"
                        class="hover:bg-blue-100"
                    >
                        <td class="px-2 py-2 text-md font-bold text-left">{{p.id}}</td>
                        <td class="px-2 py-2 text-md font-bold text-left">{{p.nome}}</td>
                        <td class="px-2 py-2 text-md font-bold text-left">{{p.cpf}}</td>
                        <td class="px-2 py-2 text-md font-bold float-right">               
                                        
                            <EdicaoPaciente  :paciente="{id: p.id, nome: p.nome, cpf: p.cpf}" />

                            <!-- <button
                            class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                            >
                                Imprimir
                            </button> -->

                            <ExcluirPaciente :id="p.id"/>

                            <!-- <button
                            class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                            @click.prevent="excluirPaciente(p.id)"
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
    
    <div class="m-2 p-2">
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
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import CadastroPaciente from '../../Components/Pacientes/Cadastro.vue'
import EdicaoPaciente from '../../Components/Pacientes/Edicao.vue'
import ExcluirPaciente from '../../Components/Pacientes/Excluir.vue'
import FilaAtendimento from '../../Components/Atendimentos/FilaAtendimento.vue'

const props = defineProps({
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


function pesquisarPaciente(){
    form.searchClear = false
    form.get(route('pacientes.index'), {
        search: form.search
    })
}

function limparPesquisaPaciente(){
    form.searchClear = true
    form.search = ''

    form.get(route('pacientes.index'), {
        search: form.search
    })
}


</script>
