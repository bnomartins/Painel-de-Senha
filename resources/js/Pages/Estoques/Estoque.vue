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
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Produto</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Qtd. Atual</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Qtd. Mínima</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Lote</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Ações</th>
                                </tr>
                                <!-- {{ estoques }} -->
                                    <tbody v-for="(p, index) in estoques.data" :key="p.id" class="w-full">

                                    <tr
                                        class="w-full font-bold border border-b-2 border-gray-300 divide-y divide-gray-200 hover:bg-blue-100 "
                                        :class="{'bg-red-100 ring ring-2 ring-red-600 border-red-600 text-red-500': p.quantidade_limite > p.quantidade}"
                                        >

                                        <td class="px-6 py-4 m-auto">
                                            <img class="w-10 h-10 m-auto"
                                                :src="p.produto.foto ? p.produto.foto : '../storage/img/prd.png'" alt="">
                                            <span class="m-auto text-sm font-bold">
                                                {{ p.produto.codigo_barra }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ p.produto.produto }}</td>
                                        <td class="px-6 py-4">{{ p.quantidade }}</td>
                                        <td class="px-6 py-4">{{ p.quantidade_limite }}</td>
                                        <td class="px-6 py-4">

                                            <ul class="bg-red-200">
                                                <li v-for="(l, index) in p.lote" :key="index" class="mb-2 list-disc">
                                                    Lote: {{ l.lote }} Validade:{{ l.validade }} Qtd.:{{ l.quantidade }} Valor Unit.{{ l.valor_unitario }} 
                                                </li>
                                            </ul>

                                        </td>
                                        <td class="px-6 py-4">
                                            <VerProduto :produto="p" />

                                        </td>


                                    </tr>
                                    </tbody>

                                    <!-- <td class="px-6 py-4 m-auto">
                                        <img class="w-10 h-10 m-auto"
                                            :src="p.estoque.produto.foto ? p.estoque.produto.foto : '../storage/img/prd.png'"
                                            alt="">
                                        <span class="m-auto text-sm font-bold">
                                            {{ p.produto.codigo_barra }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ p.produto.produto }}</td>
                                    <td class="px-6 py-4">{{ p.produto.descricao_resumida }}</td>
                                    <td class="px-6 py-4">{{ p.quantidade }}</td>
                                    <td class="px-6 py-4">{{ p.quantidade_limite }}</td>
                                    <td class="px-6 py-4">
                                    </td> -->

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
import VerProduto from '../../Components/Estoques/VerProduto.vue'
import EstoqueProdutos from '../../Components/Estoques/EstoqueProdutos.vue'
import VueBarcode from '@chenfengyuan/vue-barcode';

import moment from 'moment'
const props = defineProps({
    estoques: {
        type: Object
    },
    id: {
        type: Object
    }
})

const form = useForm({
    search: '',
    searchClear: false,
    id: props.id

})

function limparPesquisaEstoque() {
    form.searchClear = true
    form.search = ''

    form.get(route('estoques.entrada', {id: props.id}), {
        search: form.search
    })
}


</script>
