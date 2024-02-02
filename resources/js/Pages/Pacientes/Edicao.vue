<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Pacientes
        </template>

        <div class="flex-auto ">
            <div class="flex flex-col">
      
                <div class="bg-blue-100 min-h-screen">
                    <div class=" mt-8 grid lg:grid-cols-3 sm:grid-cols-2 p-4 gap-10 ">

                            <h1 class="text-center m-auto text-3xl font-bold" >
                              Consulta
                            </h1>
                        
                        
                        
                            <form @submit.prevent="cadastrarClínico()" class="w-full">
                                <div class="m-2 p-2 rounded">
                                    <label class="font-bold text-xl text-gray-600" for="nome">Nome</label>
                                    <input type="text" placholder="Digite o nome" v-model="form.nome"
                                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
                                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                                        {{ form.errors.nome }}
                                    </div>
                                </div>
                        
                                <div class="m-2 p-2 rounded">
                                    <label class="font-bold text-xl text-gray-600" for="cpf">CPF</label>
                                    <input type="text" placholder="Digite a cpf" v-model="form.cpf"
                                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
                                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                                        {{ form.errors.cpf}}
                                    </div>
                                </div>
                        
                        
                                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                                  <button class="text-white bg-red-500 hover:bg-red-400
                                  active:bg-red-600 font-bold text-2xl px-4 py-2 rounded outline-none focus:outline-none
                                    mr-1 mb-1 ease-linear transition-all duration-150"
                                  type="submit"
                                  :disabled="form.processing"
                                  :class="{ 'opacity-25': form.processing }"
                                  >
                                    <i v-if="form.processing">Salvando</i>
                                    <i v-else >
                                      Salvar
                                    </i>
                                  </button>
                                </div>
                        
                              </form>
                        
                    </div>
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
import CadastroPaciente from '../../Components/Pacientes/Cadastro.vue'
import EdicaoPaciente from '../../Components/Pacientes/Edicao.vue'
import ExcluirPaciente from '../../Components/Pacientes/Excluir.vue'

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
