<template>
  <div class="flex justify-center align-center">

    <button
      class="px-2 mx-4 my-2 text-xl font-bold text-indigo-700 bg-transparent border border-indigo-700 rounded shadow-lg hover:bg-indigo-600 hover:text-white "
      @click="abrirModal">
      Novo Produto
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


                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="codigo">Produto<span class="text-lg font-bold text-red-700">*</span></label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                      placeholder="Produto" v-model="form.produto" />



                  </div>

                  <div class="w-2/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="descricao_resumida">Descrição
                      Resumida<span class="text-lg font-bold text-red-700">*</span></label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                      placeholder="descricao_resumida" v-model="form.descricao_resumida">


                  </div>

                </div>

                <div class="w-full mr-1">
                  <label class="block mb-2 text-lg font-bold text-grey-darker" for="descricao">Descrição Detalhada<span class="text-lg font-bold text-red-700">*</span></label>
                  <textarea class="w-full" v-model="form.descricao_detalhada" rows="3"></textarea>
                </div>

                <div class="w-full">
                  <!-- <div v-if="form.processing" class="w-full px-5 my-2 font-semibold text-green-700 bg-green-100 text-bold text-md animate-pulse">
                    Aguarde consultando ...
                </div>

                <div class="w-full px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md"
                v-if="refAtendimentosAberto">
                    Já existe atendimento aberto para o Documento informado
                </div>

                <div class="px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md">
                    {{ form.errors.cartao_sus }}
                </div>

                <div class="px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md">
                    {{ form.errors.registro }}
                </div>

                <div class="px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md">
                    {{ form.errors.cpf }}
                </div>

                <div class="px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md"
                v-if="refCartaoSUSInvalido">
                    O Número do Cartão SUS informado é Inválido
                </div>

                <div class="px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md"
                v-if="refRegistroInvalido">
                    O Número da Certidão de Nascimento é Inválida
                </div>

                <div class="px-5 my-2 font-semibold text-red-700 bg-red-100 text-bold text-md"
                v-if="refCpfInvalido">
                    O Número do CPF informado é Inválido
                </div> -->

                </div>

              </div>
              <div class="px-8 py-4">

                <div class="flex mb-4">
                  <div class="w-1/2 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="composicao">Composição</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="composicao"
                      type="text" v-model="form.composicao">
                  </div>
                  <div class="w-1/2 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="especie">Espécie</label>


                    <select name="especie" id="especie" class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" 
                    v-model="form.especie">
                      <option value=""></option>
                      <option value="01 - MATERIAL HOSPITALAR">01 - MATERIAL HOSPITALAR</option>
                      <option value="02 - MATERIAL DE HIGIENE LIMPEZA">02 - MATERIAL DE HIGIENE LIMPEZA</option>
                      <option value="03 - SEGURANÇA">03 - SEGURANÇA</option>
                      <option value="04 - MEDICAMENTOS">04 - MEDICAMENTOS</option>
                      <option value="05 - COMODATO/EMPRESTIMOS">05 - COMODATO/EMPRESTIMOS</option>
                    </select>

                  </div>
                  <div class="w-1/2 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="unidade">Unidade</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="unidade"
                      type="text" v-model="form.unidade" list="list_unidade">
                      <datalist id="list_unidade">
                        <option value="Un">Unidade</option>
                        <option value="CM">Metro</option>
                        <option value="M">Metro</option>
                        <option value="Kg">Kilograma</option>
                        <option value="g">grama</option>
                      </datalist>
                  </div>

                </div>

                <div class="flex mb-4">
                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="patrimonio">Patrimônio</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                      v-model="form.patrimonio">
                  </div>


                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="validade">Validade</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="date"
                      placeholder="Validade" v-model="form.validade">
                  </div>

                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="especificacao">Especificação</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                      v-model="form.especificacao" :class="{ 'ring-4 ring-red-300': form.errors.especificacao }">
                  </div>

                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="especificacao">Estoque</label>
                    <select name="especie" id="especie" class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" 
                    v-model="form.estoque"
                    @blur.prevent="()=> form.estoque_id = form.estoque.split(' - ')[0]"
                    >
                      <option value=""></option>
                      <option v-for="e in estoques" :value="e.id+' - '+e.identificacao" :key="e.id">{{ e.identificacao }}</option>
                    </select>
                    <input type="hidden" v-model="form.estoque_id"/>
                  </div>

                </div>

                <!-- <div class="flex mb-4">
                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="estoque_id">Estoque</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                      v-model="form.estoque_id"
                      list="list_estoques">
                    
                      <datalist id="list_estoques">
                        <option v-for="e in estoques" :key="e.estoques" :value="e.id+' - '+e.identificacao">{{e.identificacao}} - {{ e.descricao }}</option>
                      </datalist>
                    </div>

                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="quantidade_inicial">Quantidade Inicial</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="number" min="0"
                      placeholder="Quantidade Inicial" v-model="form.quantidade_inicial">
                  </div>
                  <div class="w-1/3 mr-1">
                    <label class="block mb-2 text-lg font-bold text-grey-darker" for="quantidade_limite">Quantidade Mínima</label>
                    <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="number" min="0"
                      placeholder="Quantidade Mínima" v-model="form.quantidade_limite">
                  </div>

                </div> -->

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
  paciente: {type: Object},
  estoques: {type: Object},
}
)


// Controle de Formulário
const form = useForm({
  foto: '',
  produto: '',
  descricao_resumida: '',
  descricao_detalhada: '',
  composicao: '',
  especie: '',
  unidade: '',
  patrimonio: '',
  validade: '',
  especificacao: '',
  estoque: '',
  estoque_id: '',
  quantidade_inicial: '',
  quantidade_limite: '',
})

function cadastrarProduto() {
  if (form.produto != '' && form.descricao_resumida != '') {
    form.post(route('produtos.store'), {
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