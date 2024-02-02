<template>
    <Head title="Gerenciamento de Unidade" />

    <AuthenticatedLayout>
        <template #header>
            Gerenciamento de Unidade
        </template>

        <div class="m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200"> 

                <div class="p-2 m-2 flex justify-end">
                    <input
                        v-model="form.search"
                        @keyup.enter="pesquisarUnidade"
                        type="text"
                        placeholder="Pesquisar"
                        class=" h-10 my-2 mr-2 rounded-md shadow-lg text-blue-500 text-md font-bold "
                        :disabled="form.processing"
                        :class="{ 'opacity-25': form.processing && !form.searchClear }"
                    />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-blue-800 hover:bg-blue-600 border border-gray-200 rounded-l-lg"
                            @click="pesquisarUnidade()"
                            :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }"
                        >
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                          </button>

                        <button type="button" class="px-3 my-2 text-md font-bold text-white bg-gray-700 hover:bg-gray-500 border border-gray-200 rounded-r-md"
                          @click="limparPesquisaUnidade()"
                          :disabled="form.processing && form.searchClear "
                          :class="{'opacity-25': form.processing && form.searchClear}"
                        >
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>
                        </button>
                      </div>
                    <CadastroUnidade  />


                    
                    
                    
                </div>
                
                <!-- <Edicao :user='form.user' v-if="form.modalEditar"/> -->

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
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Nome Fantasia</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">CNPJ</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">CNES</th>
                                <th scope="col" class="px-6 py-3 text-center text-md text-gray-700 font-bold uppercase">Ações</th>
                            </tr>

                            <tr v-for="(u, index) in unidades" :key="u.id"
                                class="hover:bg-blue-100 bg-white divide-y divide-gray-200"                            
                                :class="{'bg-gray-100': index%2===0}">
                                <td class="px-2 py-2 text-md text-left">{{ u.nome_fantasia }}</td>
                                <td class="px-2 py-2 text-md text-left text-blue-600 font-bold">{{ u.cnpj }}</td>
                                <td class="px-2 py-2 text-md text-left">{{ u.cnes }}</td>
                                <td class="px-2 py-2 text-md float-right">

                                    <EdicaoUnidade :unidade="u"

                                    />

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-orange-800 text-orange-800  hover:bg-orange-700 hover:text-white rounded-md shadow-md font-bold"
                                    >
                                        Imprimir
                                    </button> -->

                                    <ExcluirUnidade :id="u.id"/>

                                    <!-- <button
                                    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
                                    @click.prevent="excluirUnidade(u.id)"
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
import CadastroUnidade from '../../Components/Unidades/Cadastro.vue'
import EdicaoUnidade from '../../Components/Unidades/Edicao.vue'
import ExcluirUnidade from '../../Components/Unidades/Excluir.vue'
import moment from 'moment'
const props = defineProps({
    unidades: {
        type: Object
    },
    user:{
        type: Object
    }
})

const form = useForm({
      search: '',
      searchClear: false,
      user: {
        id: '',
        status: '',
        observacao: ''
      }

  })


function pesquisarUnidade(){
    form.searchClear = false
    form.get(route('unidade.index'), {
        search: form.search
    })
}

function limparPesquisaUnidade(){
    form.searchClear = true
    form.search = ''

    form.get(route('unidade.index'), {
        search: form.search
    })
}


</script>
