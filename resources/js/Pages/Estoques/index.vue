<template>
    <Head title="Gerenciamento de Estoque" />

    <AuthenticatedLayout>
        <template #header>
            Gerenciamento de Estoque
        </template>

        <div class="m-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="flex justify-end p-2 m-2">
                    <input v-model="form.search" @keyup.enter="pesquisarEstoque" type="text" placeholder="Pesquisar"
                        class="h-10 my-2 mr-2 font-bold text-blue-500 rounded-md shadow-lg text-md"
                        :disabled="form.processing" :class="{ 'opacity-25': form.processing && !form.searchClear }" />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button"
                            class="px-3 my-2 font-bold text-white bg-blue-800 border border-gray-200 rounded-l-lg text-md hover:bg-blue-600"
                            @click="pesquisarEstoque()" :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }">
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                        </button>

                        <button type="button"
                            class="px-3 my-2 font-bold text-white bg-gray-700 border border-gray-200 text-md hover:bg-gray-500 rounded-r-md"
                            @click="limparPesquisaEstoque()" :disabled="form.processing && form.searchClear"
                            :class="{ 'opacity-25': form.processing && form.searchClear }">
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>
                        </button>
                    </div>



                </div>
                <div class="w-full col-span-2 bg-white center">
                    <CadastroEstoque :estoque="estoques" />
                </div>


                <div class="overflow-auto shadow-md rounded-xl">
                    <div class="w-full mx-auto whitespace-no-wrap">

                        <div class="flex items-center justify-between flex-auto col-span-2 p-2 bg-white rounded shadow-md">
                            <!-- <form @submit.prevent="submit" >
                                <div class="p-5">
                                    <label for="param">Enter your name:</label>
                                    <input type='text' name="param" v-model="form.param" class="px-2 ml-2 border rounded-lg">
                                    <button type="submit" class="px-2 py-1 ml-2 text-white bg-gray-500 border rounded-lg hover:bg-black">Generate PDF</button>
                                </div>
                            </form> -->

                            <Aviso />

                            <table class="w-full divide-y divide-gray-200 table-auto">
                                <tr class="bg-neutral-200">
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Identificação</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Descrição</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Ações</th>
                                </tr>
                                <tbody>

                                    <tr v-for="(p, index) in estoques.data" :key="p.id"
                                        class="divide-y divide-gray-200 hover:bg-blue-100">
                                        <td class="px-6 py-4">{{ p.identificacao }}</td>
                                        <td class="px-6 py-4">{{ p.descricao }}</td>
                                        <td class="px-6 py-4">
                                            <EstoqueProdutos :foto="p.foto" :identificacao="p.identificacao"
                                                :descricao="p.descricao" :estoque="p.estoque" />

                                            <Link :href="route('estoques.estoque', { id: p.id })"
                                                class="px-2 py-1 m-2 text-lg font-bold text-indigo-700 bg-white border border-indigo-700 rounded-md shadow-md hover:bg-indigo-800 hover:text-white">
                                            Estoque
                                            </Link>


                                            <!-- <button
                                        class="px-2 m-2 font-bold text-orange-800 bg-white border border-orange-800 rounded-md shadow-md hover:bg-orange-700 hover:text-white"
                                        >
                                        Imprimir
                                    </button> -->

                                            <!-- <ExcluirExame :id="p.id"/> -->

                                            <!-- <button
                                        class="px-2 m-2 font-bold text-red-700 bg-white border border-red-700 rounded-md shadow-md hover:bg-red-800 hover:text-white"
                                        @click.prevent="excluirExame(p.id)"
                                        >
                                        Excluir
                                    </button> -->

                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="p-2 m-2">
                            <Pagination :links="estoques.links" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import { Inertia, usePage } from "@inertiajs/inertia";

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import CadastroExame from '../../Components/Exames/Cadastro.vue'
import EdicaoExame from '../../Components/Exames/Edicao.vue'
import ExcluirExame from '../../Components/Exames/Excluir.vue'
import CadastroEstoque from '../../Components/Estoques/Cadastro.vue'
import EstoqueProdutos from '../../Components/Estoques/EstoqueProdutos.vue'
import VueBarcode from '@chenfengyuan/vue-barcode';

import moment from 'moment'
const props = defineProps({
    estoques: {
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


function pesquisarEstoque() {
    form.searchClear = false
    form.get(route('exames.index'), {
        search: form.search
    })
}

function limparPesquisaEstoque() {
    form.searchClear = true
    form.search = ''

    form.get(route('exames.index'), {
        search: form.search
    })
}


</script>
