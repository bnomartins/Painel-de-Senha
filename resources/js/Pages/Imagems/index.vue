<template>
    <Head title="Diagnóstico por Imagem" />

    <AuthenticatedLayout>
        <template #header>
            Dignóstico por Imagem
        </template> 

        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="p-2 m-2 flex justify-end">
                    <input
                        v-model="form.search"
                        @keyup.enter="pesquisarImagem"
                        type="text"
                        placeholder="Pesquisar"
                        class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                    />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                            @click="pesquisarImagem()"
                            :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"
                        >
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                          </button>

                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                          @click="limparPesquisaImagem()"
                          :disabled="form.processing && form.searchClear "
                          :class="{'opacity-25': form.processing && form.searchClear}"
                        >
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>
                        </button>
                      </div>

                    <!-- <Edicao :imagem='form.imagem' v-if="form.modalEditar"/> -->



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
                                <th class="px-2 py-2 text-md font-bold text-left">Nº Solicitação</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Paciente</th>
                                <!-- <th class="px-2 py-2 text-md font-bold text-left">Imagem</th> -->
                                <th class="px-2 py-2 text-md font-bold text-left">Solicitado por</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Data Hora</th>
                                <th class="px-2 py-2 text-md font-bold text-left">Ações</th>
                            </tr>
                            <tr v-for="(p, index) in imagems" :key="p.id"
                                :class="{'bg-blue-100': index%2===0}">
                                <td class="px-2 py-2 text-md text-left">{{ p[0].clinico_id }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ p[0].clinico.atendimento.paciente.nome }}</td>
                                <!-- <td class="px-2 py-2 text-md text-left">{{ p[0].imagem_auxes[0].imagem }}</td> -->
                                <td class="px-2 py-2 text-md text-left">{{ p[0].user_solicitacao.name }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS') }}</td>
                                <td class="px-2 py-2 text-md float-right">

                                    <EdicaoImagem
                                        :imagems="p[0].clinico.imagems"
                                        :paciente="p[0].clinico.atendimento.paciente"
                                        :solicitante="p[0].user_solicitacao"
                                        :imagem="{
                                            id: p[0].id, imagem: '',
                                            updated_at: moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS'),
                                            clinico_id: p[0].clinico_id ,resultado: p[0].resultado, observacao: p[0].observacao,
                                        }"
                                    />

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button> -->

                                    <!-- <ExcluirImagem :id="p.id"/> -->

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirImagem(p.id)"
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
import CadastroImagem from '../../Components/Imagems/Cadastro.vue'
import EdicaoImagem from '../../Components/Imagems/Edicao.vue'
import ExcluirImagem from '../../Components/Imagems/Excluir.vue'
import moment from 'moment'
const props = defineProps({
    imagems: {
        type: Object
    },
    imagem:{
        type: Object
    }
})

const form = useForm({
      search: '',
      searchClear: false,
      imagem: {
        id: '',
        status: '',
        observacao: ''
      }

  })


function pesquisarImagem(){
    form.searchClear = false
    form.get(route('imagems.index'), {
        search: form.search
    })
}

function limparPesquisaImagem(){
    form.searchClear = true
    form.search = ''

    form.get(route('imagems.index'), {
        search: form.search
    })
}


</script>
