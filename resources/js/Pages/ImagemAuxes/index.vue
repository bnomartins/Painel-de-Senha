<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Apoio ao Diagnóstico - Imagems
        </template>

        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="p-2 m-2 flex justify-end">
                    <input
                        v-model="form.search"
                        @keyup.enter="pesquisarImagemAux"
                        type="text"
                        placeholder="Pesquisar"
                        class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                    />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                            @click="pesquisarImagemAux()"
                            :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"                        
                        >
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                          </button>

                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                          @click="limparPesquisaImagemAux()"
                          :disabled="form.processing && form.searchClear "
                          :class="{'opacity-25': form.processing && form.searchClear}"
                        >
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>                        
                        </button>
                      </div>             
                    <!-- <CadastroImagemAux  /> -->
                    

                    <!-- <Edicao :imagemAux='form.imagemAux' v-if="form.modalEditar"/> -->



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

                            <table class="table max-h-30 mb-10 w-full ">
                                <thead class="divide-gray-200 w-full mb-4 bg-neutral-200">
                                    <tr class="w-full mb-4 bg-neutral-200">
                                        <td scope="col" class="px-6 py-3 text-left text-md text-gray-700 font-bold uppercase">Grupos</td>
                                    </tr>
                                </thead>
                                <tbody class="bg-grey-light flex flex-col items-left justify-between overflow-y-scroll w-full" style="height: 20vh;">

                                    <tr class="hover:bg-blue-100 bg-white divide-y text-gray-700 font-bold uppercase"
                                        v-for="g in grupos" :key="g.id"
                                    >
                                        <td class="px-6 whitespace-nowrap">{{g.grupo}}</td>
                                        <td>{{ g.descricao }}</td>
                                        <td class="text-right">

                                            <button class="ml-5 px-2 bg-blue-500 font-bold text-white rounded-md" @click.prevent="pesquisarGrupo(g.grupo)">Ver</button> 
                                            <button class="ml-5 px-2 bg-blue-500 font-bold text-white rounded-md" @click.prevent="ativarGrupo(g.grupo, g.descricao)" v-if="imagemAuxs ? !imagemAuxs.includes(g.grupo) : false">Ativar</button> 
                                            <button class="ml-5 px-2 bg-red-500 font-bold text-white rounded-md" @click.prevent="desativarGrupo(g.grupo)" v-if="imagemAuxs ? imagemAuxs.includes(g.grupo) : false">Desativar</button> 
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>

                            <table class="w-full">
                            <tr class="bg-neutral-200 w-full">
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">ID</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Codigo</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Procedimento</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Disponivel</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Ações</th>
                            </tr>
                            <tr v-for="(p, index) in procedimentos.data" :key="p.id"
                                class="hover:bg-blue-100 bg-white divide-y divide-gray-300"
                                :class="{'bg-blue-100': index%2===0}">
                                <td class="px-6 whitespace-nowrap">{{p.id}}</td>
                                <td class="px-6 whitespace-nowrap">{{p.codigo}} </td>
                                <td class="px-6 whitespace-nowrap">{{p.procedimento}}</td>
                                <td class="px-6 whitespace-nowrap">

                                    <div class="flex">
                                        <div class="flex-col">
                                            <span v-if="imagemAuxs ? (imagemAuxs.includes(p.codigo.substring(0,5))) : false">
                                                <Toggle :on="p.disponivel ? true : false" :id="p.id" @alterarStatus="statusToggle"/>
                                            </span>
                                            <span v-else class="bg-red-100 text-red-500 font-bold rounded-md shadow-md px-2">
                                                Não Ativado
                                            </span>
                                        </div>
                                    </div>

                                </td>

                                <td class="px-2 py-2 text-md float-right">

                                    <EdicaoImagemAux  :imagemAux="{id: p.id, codigo: p.codigo, procedimento: p.procedimento,  disponivel: p.disponivel}" />

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
        <Aviso />
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3';
import { Inertia, usePage } from "@inertiajs/inertia";

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import Toggle from '@/Components/Toggle.vue'
import CadastroImagemAux from '../../Components/ImagemAuxes/Cadastro.vue'
import EdicaoImagemAux from '../../Components/ImagemAuxes/Edicao.vue'
import ExcluirImagemAux from '../../Components/ImagemAuxes/Excluir.vue'

const props = defineProps({
    procedimentos: {
        type: Object
    },

    imagemAux:{
        type: Object
    },

    imagemAuxs:{
        type: Object
    },
    grupos: {
        type: Object
    },
})

const form = useForm({
      search: '',
      searchClear: false,
      imagemAux: {
        id: '',
        imagem: '',
        descricao: '',
        disponivel: true,
      },

      grupo_id: '',
      grupo_descricao: '',
      
      grupo_desativar_id: '',

      toggle_id: '',
      toggle_disponivel: false


  
  })

function statusToggle(disponivel, id){

    form.toggle_id = id
    form.toggle_disponivel = disponivel
    
    form.post(route('imagemAuxes.store'), {
        only: ['procedimentos'],
        toggle_id: form.toggle_id,
        toggle_disponivel: form.toggle_disponivel,
        onSuccess: () => {
            form.reset()
        }
    })
       
}

function pesquisarImagemAux(){
    form.searchClear = false
    form.get(route('imagemAuxes.index'), {
        search: form.search
    })
}

function pesquisarGrupo(grupo){
    form.search = grupo
    form.get(route("imagemAuxes.index"),{
        search: form.search,
        onSuccess: () => {
            form.reset
        }
    })
}

function ativarGrupo(grupo, descricao){
    form.grupo_id = grupo
    form.grupo_descricao = descricao
    form.post(route('imagemAuxes.store'), {
            grupo_id: form.grupo_id,
            grupo_descricao: form.grupo_descricao,
            onSuccess: () => {
                form.reset
            }            
        })
}

function desativarGrupo(grupo){
    form.grupo_desativar_id = grupo
    form.post(route('imagemAuxes.store'), {
            grupo_desativar_id: form.grupo_desativar_id,
            onSuccess: () => {
                form.reset
            }            
        })
}

function limparPesquisaImagemAux(){
    form.searchClear = true
    form.search = ''

    form.get(route('imagemAuxes.index'), {
        search: form.search
    })
}


</script>
