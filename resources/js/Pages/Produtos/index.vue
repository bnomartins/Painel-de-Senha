<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Produtos
        </template>

        <div class="m-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="m-5 border-b border-gray-200">

                <div class="flex justify-end p-2 m-2">
                    <input v-model="form.search" @keyup.enter="pesquisarExame" type="text" placeholder="Pesquisar"
                        class="h-10 my-2 mr-2 font-bold text-blue-500 rounded-md shadow-lg text-md"
                        :disabled="form.processing" :class="{ 'opacity-25': form.processing && !form.searchClear }" />


                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button type="button"
                            class="px-3 my-2 font-bold text-white bg-blue-800 border border-gray-200 rounded-l-lg text-md hover:bg-blue-600"
                            @click="pesquisarExame()" :disabled="form.processing && !form.searchClear"
                            :class="{ 'opacity-25': form.processing && !form.searchClear }">
                            <span v-if="form.processing && !form.searchClear">Aguarde</span>
                            <span v-else>Pesquisar</span>
                        </button>

                        <button type="button"
                            class="px-3 my-2 font-bold text-white bg-gray-700 border border-gray-200 text-md hover:bg-gray-500 rounded-r-md"
                            @click="limparPesquisaExame()" :disabled="form.processing && form.searchClear"
                            :class="{ 'opacity-25': form.processing && form.searchClear }">
                            <span v-if="form.processing && form.searchClear">Aguarde</span>
                            <span v-else>Limpar</span>
                        </button>
                    </div>



                </div>
                <div class="w-full col-span-2 bg-white center">
                    <CadastroProduto :produto="produto" :estoques="estoques" />
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
                                        EAN</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Produto</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Descrição Resumida</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Espécie</th>
                                    <th scope="col"
                                        class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                        Ações</th>
                                </tr>
                                <tbody>

                                <tr v-for="(p, index) in produtos.data" :key="p.id"
                                    class="divide-y divide-gray-200 hover:bg-blue-100" :class="{
                                        'bg-red-100 text-red-600 font-bold ring-1 ring-red-300': p.tarja == 'Tarja Vermelha',
                                        'bg-red-500 text-red-100 font-bold ring-1 ring-gray-300': p.tarja == 'Tarja Vermelha sob restrição',
                                        'bg-gray-200 text-gray-800 font-bold ring-1 ring-gray-300': p.tarja == 'Tarja Preta',
                                        'bg-emerald-100 text-emerald-700 font-bold ring-1 ring-gray-300': p.tarja == 'Venda Livre',
                                    }">
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <vue-barcode :value="p.codigo_barra" tag="img"
                                            :options="{ displayValue: false, height: 40 }"
                                            style="margin:auto"></vue-barcode>
                                        {{ p.codigo_barra }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-center">{{ p.produto }}</td>
                                    <td class="px-6 py-4 text-sm font-bold trucate text-center">{{ p.descricao_resumida }} {{ p.descricao_resumida }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-clip text-center">{{ p.especie }}</td>
                                    <td class="px-6 py-4">
                                        <!-- <EdicaoExame
                                        :exames="p[0].clinico.exames"
                                        :paciente="p[0].clinico.atendimento.paciente"
                                        :solicitante="p[0].user_solicitacao"
                                        :exame="{
                                            id: p[0].id, exame: '',
                                            updated_at: moment(p[0].updated).format('DD/MM/YYYY HH:MM:SS'),
                                            clinico_id: p[0].clinico_id ,resultado: p[0].resultado, observacao: p[0].observacao
                                        }"

                                    /> -->

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
                            <Pagination :links="produtos.links" />
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
import CadastroProduto from '../../Components/Produtos/Cadastro.vue'
import VueBarcode from '@chenfengyuan/vue-barcode';

import moment from 'moment'
const props = defineProps({
    produtos: {
        type: Object
    },
    estoques: {
        type: Object
    },
    id: {
        type: String
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


function pesquisarExame() {
    form.searchClear = false
    form.get(route('exames.index', {id: props.id}), {
        search: form.search
    })
}

function limparPesquisaExame() {
    form.searchClear = true
    form.search = ''

    form.get(route('exames.index', {id: props.id}), {
        search: form.search
    })
}


</script>
