<template>
  <div class="flex justify-center align-center">

    <button
      class="px-2 mx-4 my-2 text-xl font-bold text-indigo-700 bg-transparent border border-indigo-700 rounded shadow-lg hover:bg-indigo-600 hover:text-white "
      @click="abrirModal">
      Novo Estoque
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
              <div class="px-8 py-4 text-2xl font-bold text-black border border-2 border-grey-lighter">
                Dados Cadastrais
              </div>


              <div class="px-8">

                <div class="flex mb-4">
                  <div class="flex-shrink-0 w-1/5 pl-10 text-blue-500 h-30 w-30">

                    <label for="foto" class="w-full text-center">

                      <img class="w-20 h-20" :src="form.url ? form.url : '../storage/img/prd.png'" alt="">
                      <span v-if="!form.url" class="font-bold text-blue-500">
                        Adicionar
                      </span>
                      <span v-else class="font-bold text-green-500">
                        Adicionado
                      </span>
                    </label>

                    <input type="file" placholder="Digite o resultado" @input=" form.foto = $event.target.files[0]"
                      @change="previewImage" class="hidden" id="foto" />

                  </div>


                  <div class="w-full ml-5">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="codigo">Identificação do
                      Estoque</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                      placeholder="Estoque" v-model="form.identificacao" />

                  </div>

                </div>

              </div>
              <div class="px-8 py-4">
                <div class="flex mb-4">

                  <div class="w-full mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="patrimonio">Descrição</label>
                    <textarea class="w-full" rows="3" v-model="form.descricao"></textarea>
                  </div>

                </div>

                <div class="flex p-4 text-sm text-red-500 rounded-md bg-red-50" x-cloak x-show="showAlert"
                  x-data="{ showAlert: true }" v-if="form.hasErrors">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="flex-shrink-0 w-5 h-5 mr-3">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h4 class="font-bold">Pendência</h4>
                    <div class="mt-1">
                      <ul class="list-disc list-inside">
                        <li v-for="error, index in form.errors" :key="index">{{ error }}</li>
                      </ul>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>

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
  paciente: Object
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