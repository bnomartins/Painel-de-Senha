<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Atendimento Ambulatorial
        </template>

        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="p-2 m-2 flex justify-end">
                    <input
                        v-model="form.search"
                        @keyup.enter="pesquisarAmbulatorio"
                        type="text"
                        placeholder="Pesquisar"
                        class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                    />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                            @click="pesquisarAmbulatorio()"
                            :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"
                        >
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                          </button>

                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                          @click="limparPesquisaAmbulatorio()"
                          :disabled="form.processing && form.searchClear "
                          :class="{'opacity-25': form.processing && form.searchClear}"
                        >
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>
                        </button>
                      </div>

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
                                <th class="px-2 py-2 text-md font-bold text-left">Nº Solicitação</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Paciente</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Solicitado por</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Data Hora</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Ações</th>
                            </tr>

                            <tr v-for="(p, index) in ambulatorios" :key="index" :class="{'bg-blue-100': index%2===0}">
                               
                                <td scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">{{ p[0].clinico_id }}</td>
                                <td scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">{{ p[0].clinico.atendimento.paciente.nome }}</td>
                                <td scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">{{ p[0].user_solicitacao.name }}</td>
                                <td scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">{{ moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS') }}</td>
                                <td scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase float-right">

                                    <EdicaoAmbulatorio
                                        :ambulatorio="p"
                                        :paciente="p[0].clinico.atendimento.paciente"
                                        :solicitante="p[0].user_solicitacao"
                                        :procedimentos="p[0].procedimentos"
                                        :procedimento="{
                                            id: p[0].id, procedimento: p[0].procedimentos,
                                            updated_at: moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS'),
                                            clinico_id: p[0].clinico_id ,resultado: p[0].resultado, observacao: p[0].observacao
                                        }"

                                    />


                                    
                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button> -->

                                    <!-- <ExcluirAmbulatorio :id="p.id"/> -->

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirAmbulatorio(p.id)"
                                    >
                                        Excluir
                                    </button>
                                </td>
                            </tr> -->
                        </td>
                            <!-- {{ a.clinico_id }} -----------------------------
                                {{ a.clinico.atendimento.paciente.nome }} ----------------------------- -->
                                    <!-- {{ a.procedimentos }} -->
                                    <!-- {{ a.user_solicitacao.name }} ----------------------------- -->
                                    <!-- {{ a.updated_at }} ----------------------------- -->
                                    
                                    <!-- {{ ambulatorios }} -->
                                </tr>
                            <!-- <tr v-for="(p, index) in ambulatorios" :key="p.id"
                                :class="{'bg-gray-300': index%2===0}">
                                <td class="px-2 py-2 text-md text-left">{{ p.clinico_id }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ p.clinico.atendimento.paciente.nome }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ p.procedimentos[0].procedimento }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ p.user_solicitacao.name }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ moment(p.updated).format('DD/MM/YYYY HH:MM:SS') }}</td>
                                <td class="px-2 py-2 text-md float-right">

                                    <EdicaoAmbulatorio
                                        :paciente="p.clinico.atendimento.paciente"
                                        :solicitante="p.user_solicitacao"
                                        :procedimento="{
                                            id: p.id, procedimento: p.procedimentos,
                                            updated_at: moment(p.updated).format('DD/MM/YYYY HH:MM:SS'),
                                            clinico_id: p.clinico_id ,resultado: p.resultado, observacao: p.observacao
                                        }"

                                    />

                                    <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button> -->

                                    <!-- <ExcluirAmbulatorio :id="p.id"/> -->

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirAmbulatorio(p.id)"
                                    >
                                        Excluir
                                    </button>
                                </td>
                            </tr> -->
                            </table>
                        </div>

                    </div>
                </div>

                <!-- {{ ambulatorios }} -->
                <div class="m-2 p-2">
                    <!-- <Pagination :links="ambulatorios.links"/> -->
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
import EdicaoAmbulatorio from '../../Components/Ambulatorios/Edicao.vue'
import ExcluirAmbulatorio from '../../Components/Ambulatorios/Excluir.vue'
import moment from 'moment'
const props = defineProps({
    ambulatorios: {
        type: Object
    },
    ambulatorio:{
        type: Object
    }
})

const form = useForm({
      search: '',
      searchClear: false,
      ambulatorio: {
        id: '',
        procedimento: '',
        observacao: ''
      }

  })


function pesquisarAmbulatorio(){
    form.searchClear = false
    form.get(route('ambulatorios.index'), {
        search: form.search
    })
}

function limparPesquisaAmbulatorio(){
    form.searchClear = true
    form.search = ''

    form.get(route('ambulatorios.index'), {
        search: form.search
    })
}


</script>
