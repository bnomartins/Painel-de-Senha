<template>

        <div class="flex-auto ">
            <div class="flex flex-col  sm:w-max-sm">

                <div class="bg-blue-100 min-h-screen  min-w-screen">
                    <div class=" mt-4 grid lg:grid-cols-2 sm-grid-cols-1 p-4 py-1 gap-2">

                        <div class="m-1 border-b border-gray-200 flex justify-end">
                        </div>

                        <div class="m-1 border-b border-gray-200 flex justify-end">

                            <div class="flex justify-end w-min-sm">
                                <input
                                    v-model="form.search"
                                    @keyup.enter="pesquisarTriagem"
                                    type="text"
                                    placeholder="Palavra-Chave"
                                    class=" h-10 my-2 mr-2 rounded-md shadow-lg
                                    text-blue-500 text-md font-bold"
                                    :disabled="form.processing"
                                    :class="{ 'opacity-25': form.processing && !form.searchClear }"
                                />


                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                                        @click="pesquisarTriagem()"
                                        :disabled="form.processing && !form.searchClear"
                                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                                    >
                                        <span v-if="form.processing && !form.searchClear">Aguarde</span>
                                        <span v-else>Pesquisar</span>
                                      </button>

                                    <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                                      @click="limparPesquisaTriagem()"
                                      :disabled="form.processing && form.searchClear "
                                      :class="{'opacity-25': form.processing && form.searchClear}"
                                    >
                                        <span v-if="form.processing && form.searchClear">Aguarde</span>
                                        <span v-else>Limpar</span>
                                    </button>
                                  </div>

                                <!-- <Edicao :Triagem='form.Triagem' v-if="form.modalEditar"/> -->

                            </div>
                        <div>
                    </div>
                </div>
                <div class="col-span-2 font-bold text-lg">
                    <Aviso />

                    <span class=" text-black sm:text-blue-500 md:text-red-500 lg:text-orange-500">

                        <CardDashAtendimento :npacientes="npacientes" :natendimentoaberto="natendimentoaberto" :natendimentofinalizado="natendimentofinalizado" />
                    </span>
            </div>
            <div class="col-span-2 flex flex-auto items-center justify-between
                p-2 bg-white rounded shadow-md">
                    <!-- <table class=" divide-y divide-gray-200 table-auto w-full "
                        v-if="atendimentos.total > 0"> -->
                    <table class="w-fulldivide-y divide-gray-200 table-auto w-full">
                    <thead>
                        <tr class="bg-neutral-200">
                            <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">
                                Chamar
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">
                                Paciente
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">
                                Ações
                            </th>
                        </tr>
                    </thead>

                    <tbody
                    >
                        <tr class="hover:bg-blue-100 bg-white divide-y divide-gray-200"
                        v-for="(p, index) in atendimentos.data"
                        :key="p.id"
                        v-show=" p.triagem[0]
                            ?
                                (p.clinico[0]
                                ?
                                    (p.clinico[0].user_id === $page.props.auth.user.id || p.triagem[0].user_id === $page.props.auth.user.id ? true : false)
                                : true)
                            :
                                true"
                        >

                        <!-- {{ p.clinico[0] ? p.clinico[0] : 'necas'}}
                        {{ p.clinico[0] ? p.clinico[0].user_id : 'necas'}} -->

                        <td class="px-6 py-4 whitespace-nowrap">
                            <ChamarSenha :paciente="p.paciente" :atendimento="p"/>

                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <CardPaciente :paciente="p.paciente" :tipo="'Tabela'"/>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
<!--
                            <span
                            class=" px-2 inline-flex text-lg leading-5 px-3 my-2 border border-2 border-green-300  font-bold
                            rounded-full bg-green-100 text-green-800 animate-pulse">
                            {{ p.status }}
                            </span><br> -->

                            <span
                            class=" px-2 inline-flex text-lg leading-5 px-3 my-2 border border-2 border-yellow-300  font-bold
                            rounded-full bg-yellow-100 text-yellow-800 animate-pulse">
                            {{ p.status }}
                            </span><br>

                            <!-- <span
                            class=" px-2 inline-flex text-lg leading-5 px-3 my-2 border border-2 border-red-300  font-bold
                            rounded-full bg-red-100 text-red-800 animate-pulse">
                            {{ p.status }}
                            </span> -->
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-lg font-bold"
                        >
                            <Link
                                :href=" titulo == 'Triagem' ? route('triagems.atendimento', {id: p.id}) : titulo == 'Clínico' ? route('clinicos.atendimento', {id: p.id}) : '' "
                                    class="m-2 px-2 py-1 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800
                                    hover:text-white rounded-md shadow-md font-bold text-lg"
                                    v-if="((p.clinico[0] ? p.clinico[0].user_id == $page.props.auth.user.id  : 
                                    ((p.triagem[0] ? p.triagem[0].user_id == $page.props.auth.user.id  : true))))"
                                    
                                    >
                                    <!-- v-if="(p.clinico[0] ? p.clinico[0].user_id == $page.props.auth.user.id  : true) || (p.triagem[0] ? p.triagem[0].user_id == 2  : true)" -->
                                    <!-- || (p.status !== 'Aguardando Atendimento Clínico' && titulo == 'Triagem') || (p.status == 'Aguardando Atendimento Clínico' && titulo == 'Clínico')"  -->
                                Iniciar Atendimento
                            </Link>

                        </td>
                        </tr>

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="m-2 p-2">
                    <Pagination :links="atendimentos.links"/>
                </div>
            </div>
        </div>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3';
import { Inertia, usePage } from "@inertiajs/inertia";
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import CadastroTriagem from '../../Components/Triagems/Cadastro.vue'
import EditarTriagem from '../../Components/Triagems/Edicao.vue'
import ExcluirTriagem from '../../Components/Triagems/Excluir.vue'
import ChamarSenha from '../../Components/Senhas/ChamarSenha.vue'
import CardPaciente from '../../Components/Pacientes/CardPaciente.vue'
import CardDashAtendimento from '../../Components/Atendimentos/CardDashAtendimento.vue'
import { InertiaProgress } from '@inertiajs/progress'
import {ref} from 'vue'
import moment from 'moment'

const props = defineProps({
    npacientes:{
        type: String
    },
    natendimentoaberto:{
        type: String
    },
    natendimentofinalizado:{
        type: String
    },

    atendimentos: {
        type: Object
    },
    atendimento:{
        type: Object
    },
    titulo: {
        type: String
    },
    procedimentos: {
        type: Object
    }
})

const form = useForm({
      search: '',
      searchClear: false,
      atendimento: {
        id: '',
        classificacao: '',
        observacao: ''
      }

  })

const refMenu = ref(false)

function pesquisarTriagem(){
    form.searchClear = false

    if(props.titulo == 'Triagem'){
        form.get(route('triagems.index'), {
            search: form.search
        })
    }

    if(props.titulo == 'Clínico'){
        form.get(route('clinicos.index'), {
            search: form.search
        })
    }

}

function limparPesquisaTriagem(){
    form.searchClear = true
    form.search = ''

    if(props.titulo == 'Triagem'){
        form.get(route('triagems.index'), {
            search: form.search
        })
    }

    if(props.titulo == 'Clínico'){
        form.get(route('clinicos.index'), {
            search: form.search
        })
    }
}


InertiaProgress.init({
  // The delay after which the progress bar will
  // appear during navigation, in milliseconds.
  delay: 250,

  // The color of the progress bar.
  color: 'orange',

  // Whether to include the default NProgress styles.
  includeCSS: true, //this

  // Whether the NProgress spinner will be shown.
  showSpinner: false,
})


</script>
