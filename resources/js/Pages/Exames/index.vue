<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Exames
        </template>

        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="p-2 m-2 flex justify-end">
                    <input
                        v-model="form.search"
                        @keyup.enter="pesquisarExame"
                        type="text"
                        placeholder="Pesquisar"
                        class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                    />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                            @click="pesquisarExame()"
                            :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"
                        >
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                          </button>

                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                          @click="limparPesquisaExame()"
                          :disabled="form.processing && form.searchClear "
                          :class="{'opacity-25': form.processing && form.searchClear}"
                        >
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>
                        </button>
                      </div>

                    <!-- <Edicao :exame='form.exame' v-if="form.modalEditar"/> -->



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
                            
                        <table class="w-fulldivide-y divide-gray-200 table-auto w-full">
                            <tr class="bg-neutral-200">

                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Nº Solicitação</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Paciente</th>
                                <!-- <th class="px-2 py-2 text-md font-bold text-left">Exame</th> -->
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Solicitado por</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Data Hora</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Ações</th>
                            </tr>
                            <tr v-for="(p, index) in exames" :key="p.id"
                                :class="{'bg-blue-100': index%2===0}">
                                <td class="px-2 py-2 text-md text-left">{{ p[0].clinico_id }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ p[0].clinico.atendimento.paciente.nome }}</td>
                                <!-- <td class="px-2 py-2 text-md text-left">--{{ p[0].clinico.exames }}</td> -->
                                <td class="px-2 py-2 text-md text-left">{{ p[0].user_solicitacao.name }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS') }}</td>
                                <td class="px-2 py-2 text-md float-right">


                                    <EdicaoExame
                                        :exames="p[0].clinico.exames"
                                        :paciente="p[0].clinico.atendimento.paciente"
                                        :solicitante="p[0].user_solicitacao"
                                        :exame="{
                                            id: p[0].id, exame: '',
                                            updated_at: moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS'),
                                            clinico_id: p[0].clinico_id ,resultado: p[0].resultado, observacao: p[0].observacao
                                        }"

                                    />

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button> -->

                                    <!-- <ExcluirExame :id="p.id"/> -->

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirExame(p.id)"
                                    >
                                        Excluir
                                    </button> -->
                                </td>
                            </tr>
                            </table>
                        </div>

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
import CadastroExame from '../../Components/Exames/Cadastro.vue'
import EdicaoExame from '../../Components/Exames/Edicao.vue'
import ExcluirExame from '../../Components/Exames/Excluir.vue'
import moment from 'moment'
const props = defineProps({
    exames: {
        type: Object
    },
    exame:{
        type: Object
    }
})

const form = useForm({
      search: '',
      searchClear: false,
      exame: {
        id: '',
        status: '',
        observacao: ''
      }

  })


function pesquisarExame(){
    form.searchClear = false
    form.get(route('exames.index'), {
        search: form.search
    })
}

function limparPesquisaExame(){
    form.searchClear = true
    form.search = ''

    form.get(route('exames.index'), {
        search: form.search
    })
}


</script>
