<template>
    <div class="flex justify-center align-center">

        <button
            class="px-2 mx-4 my-2 text-xl font-bold text-indigo-700 bg-transparent border border-indigo-700 rounded shadow-lg hover:bg-indigo-600 hover:text-white "
            @click="abrirModal">
            Ver Produtos
        </button>

    </div>

    <Modal :show="confirmar" @close="closeModal">


        <div class="py-8 text-gray-600 border-b border-solid rounded-t border-slate-200">
            <h1 class="m-auto text-2xl font-bold text-center">
                Cadastro de Produto
            </h1>
        </div>


        <div class="w-full px-6 mx-2 rounded text-md ">

            <form @submit.prevent="cadastrarProduto()" class="w-full">

                <aviso />

                <!-- Dados Paciente -->
                <div class="w-full mt-2 bg-grey-lightest">
                    <div class="container py-2 mx-auto min-w-min">
                        <div
                            class="mx-auto bg-white border border-2 shadow w-6/6 lg:w-6/6 sm:min-w-sm rounded-xl border-grey-lighter">
                            <div class="flex px-8 py-4 text-xl font-bold text-black border border-2 border-grey-lighter">

                                <div class="flex-shrink-0 w-1/5 pl-10 text-blue-500 h-30 w-30">

                                    <label for="foto" class="w-full text-center">

                                        <img class="w-20 h-20" :src="foto ? foto : '../storage/img/stq.png'" alt="">
                                    </label>
                                </div>

                                Estoque: {{ identificacao }}
                            </div>


                            <div class="px-8">
                                <div class="px-8 py-2 m-2 text-lg font-bold border border-2 rounded-md border-grey-lighter">
                                    Descrição: {{ descricao }}
                                </div>

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
                                            Descricao Resumida</th>
                                        <th scope="col"
                                            class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                            Quantidade Atual</th>
                                        <th scope="col"
                                            class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                            Quantidade Mínima</th>
                                        <th scope="col"
                                            class="px-6 py-3 font-bold text-center text-gray-700 uppercase text-md text-clip">
                                            Ações</th>
                                    </tr>
                                    <tbody>

                                        <tr v-for="(p, index) in estoque" :key="p.id"
                                            class="divide-y divide-gray-200 hover:bg-blue-100">
                                            <td class="px-6 py-4 m-auto">
                                                <img class="w-10 h-10 m-auto"
                                                    :src="p.produto.foto ? p.produto.foto : '../storage/img/prd.png'"
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
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>

                {{ estoque }}

                <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200">
                    <button class="px-4 py-2 mr-2 text-xl font-bold text-white bg-blue-600 hover:bg-blue-400 rounded-xl"
                        type="submit" :disabled="form.processing || refAtendimentosAberto"
                        :class="{ 'opacity-25': form.processing || refAtendimentosAberto }">
                        <i v-if="form.processing">Consultando</i>
                        <i v-else>
                            Salvar
                        </i>
                    </button>

                    <button class="px-4 py-2 text-xl font-bold bg-yellow-500 hover:bg-yellow-300 rounded-xl" type="submit"
                        @click.prevent="limparFormulario">
                        <i>
                            Limpar
                        </i>
                    </button>

                </div>

            </form>
        </div>
    </Modal>
</template>

<script setup>
import { Link, router, useForm } from "@inertiajs/vue3";
import Modal from '@/Components/Modal.vue'
import { nextTick, ref } from 'vue';
import { Inertia } from "@inertiajs/inertia";
import VueBarcode from '@chenfengyuan/vue-barcode';

const props = defineProps({
    foto: { type: Object },
    estoque: { type: Object },
    identificacao: { type: Object },
    descricao: { type: Object },
}
)


// Controle de Formulário
const form = useForm({
    foto: '',
    identificacao: '',
    descricao: '',
})

function cadastrarProduto() {
    if (form.identificacao != '' && form.descricao != '') {
        form.post(route('estoques.store'), {
            onSuccess: () => closeModal(),
        })
    }
}


const limparFormulario = () => {
    form.id = ''

    form.foto = ''

    form.produto = ''
    form.descricao_resumida = ''
    form.descricao_detalhada = ''
    form.composicao = ''
    form.especie = ''
    form.unidade = ''
    form.patrimonio = ''
    form.validade = ''
    form.especificacao = ''
    form.url = ''

    // form.get(route('atendimentos.index'))
}

// Controle do Modal
const confirmar = ref(false);

const abrirModal = () => {
    confirmar.value = true;
};

const closeModal = () => {
    confirmar.value = false;
    form.reset()
};

function previewImage(e) {
    const file = e.target.files[0];
    form.url = URL.createObjectURL(file);
}

</script>
<script>
import { mask } from 'vue-the-mask'

export default {
    directives: { mask }
}


</script>