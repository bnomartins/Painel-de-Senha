<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Procedimento ambulatorial
        </template>

        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="p-2 m-2 flex justify-end">
                    <input
                        v-model="form.search"
                        @keyup.enter="pesquisarProcedimento"
                        type="text"
                        placeholder="Pesquisar"
                        class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                    />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                            @click="pesquisarProcedimento()"
                            :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"                        
                        >
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                          </button>

                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                          @click="limparPesquisaProcedimento()"
                          :disabled="form.processing && form.searchClear "
                          :class="{'opacity-25': form.processing && form.searchClear}"
                        >
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>                        
                        </button>
                      </div>             
                    <!-- <CadastroProcedimento  /> -->
                    

                    <!-- <Edicao :procedimento='form.procedimento' v-if="form.modalEditar"/> -->



                </div>


                <div>
                    <div class="mx-auto w-full whitespace-no-wrap">

                        <div class="bg-gray-100 shadow mx-auto">
                            <!-- <form @submit.prevent="submit" >
                                <div class="p-5">
                                    <label for="param">Enter your name:</label>
                                    <input type='text' name="param" v-model="form.param" class="px-2 ml-2 rounded-lg border">
                                    <button type="submit" class="px-2 py-1 ml-2 rounded-lg border bg-gray-500 text-white hover:bg-black">Generate PDF</button>
                                </div>
                            </form> -->
                            
                            <Aviso />

                            <table class="w-full">
                            <tr class="bg-gray-900 text-white">
                                <th class="px-2 py-2 text-md font-bold text-left">ID</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Procedimento</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Descrição</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Disponivel</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Ações</th>
                            </tr>
                            <tr v-for="(p, index) in procedimentos.data" :key="p.id"
                                :class="{'bg-blue-100': index%2===0}">
                                <td class="px-2 py-2 text-md text-left">{{p.id}}</td>
                                <td class="px-2 py-2 text-md text-left">{{p.procedimento}}</td>
                                <td class="px-2 py-2 text-md text-left">{{p.descricao}}</td>
                                <td class="px-2 py-2 text-md text-center font-bold text-emerald-600" v-if="p.disponivel">
                                    <div class="border border-4 border-emerald-600 rounded-xl p-2 font-bold">
                                        Disponível
                                    </div>
                                </td>
                                <td class="px-2 py-2 text-md text-center font-bold text-red-600" v-else>
                                    <div class="border border-4 border-red-600 rounded-xl p-2 font-bold">
                                        Indisponível
                                    </div>                                </td>
                                <td class="px-2 py-2 text-md float-right">
                                    <EdicaoProcedimento  :procedimento="{id: p.id, procedimento: p.procedimento, descricao: p.descricao,  disponivel: p.disponivel}" />

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-or2023ange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button> -->

                                    <ExcluirProcedimento :id="p.id"/>

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirProcedimento(p.id)"
                                    >
                                        Excluir
                                    </button> -->
                                </td>
                            </tr>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="m-2 p-2">
                    <Pagination :links="procedimentos.links"/>
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
import CadastroProcedimento from '../../Components/Procedimentos/Cadastro.vue'
import EdicaoProcedimento from '../../Components/Procedimentos/Edicao.vue'
import ExcluirProcedimento from '../../Components/Procedimentos/Excluir.vue'

const props = defineProps({
    procedimentos: {
        type: Object
    },
    procedimento:{
        type: Object
    }
})

const form = useForm({
      search: '',
      searchClear: false,
      procedimento: {
        id: '',
        exame: '',
        descricao: '',
        disponivel: true,
      }
  
  })


function pesquisarProcedimento(){
    form.searchClear = false
    form.get(route('procedimentos.index'), {
        search: form.search
    })
}

function limparPesquisaProcedimento(){
    form.searchClear = true
    form.search = ''

    form.get(route('procedimentos.index'), {
        search: form.search
    })
}


</script>
