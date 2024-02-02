<template>
  <div class="flex justify-center align-center">
    <button
      class="px-2 mx-4 my-2 text-lg font-bold text-indigo-700 bg-transparent border border-indigo-700 rounded shadow-lg hover:bg-indigo-600 hover:text-white"
      @click="abrirModal"
    >
      Ver Produto
    </button>
  </div>

  <Modal :show="confirmar" @close="closeModal">
    <div
      class="py-8 text-gray-600 border-b border-solid rounded-t border-slate-200"
    >
      <h1 class="m-auto text-2xl font-bold text-center">
        Produto - {{ produto.produto.produto }}
      </h1>
    </div>

    <div class="w-full px-6 mx-2 rounded text-md">

        <aviso />

        <!-- Dados Paciente -->
        <div class="w-full mt-2 bg-grey-lightest">
          <div class="container py-2 mx-auto min-w-min">
            <div
              class="mx-auto bg-white border border-2 shadow w-6/6 lg:w-6/6 sm:min-w-sm rounded-xl border-grey-lighter"
            >
              <div
                class="px-8 py-4 text-2xl font-bold text-black border border-2 border-grey-lighter"
              >
                Informações Cadastrais do Produto -
                {{ produto.produto.produto }}
              </div>

              <div class="w-full px-6 mx-2 rounded text-md">
                <!-- Dados Paciente -->
                <div class="w-full mt-2 bg-grey-lightest">
                  <div class="container py-2 mx-auto min-w-min">
                    <div
                      class="mx-auto bg-white border border-2 shadow w-6/6 lg:w-6/6 sm:min-w-sm rounded-xl border-grey-lighter"
                    >
                      <div class="px-8">
                        <div class="flex mb-4">
                          <div
                            class="flex-shrink-0 w-1/5 pl-10 text-blue-500 h-30 w-30"
                          >
                            <label for="foto" class="w-full text-center">
                              <img
                                class="w-20 h-20"
                                :src="
                                  produto.produto.foto
                                    ? produto.produto.foto
                                    : '../storage/img/prd.png'
                                "
                                alt=""
                              />
                            </label>
                          </div>

                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="codigo"
                              >Produto<span
                                class="text-lg font-bold text-red-700"
                                >*</span
                              ></label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="text"
                              placeholder="Produto"
                              :value="produto.produto.produto"
                              disabled
                            />
                          </div>

                          <div class="w-2/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="descricao_resumida"
                              >Descrição Resumida<span
                                class="text-lg font-bold text-red-700"
                                >*</span
                              ></label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="text"
                              placeholder="descricao_resumida"
                              :value="produto.produto.descricao_resumida"
                              disabled
                            />
                          </div>
                        </div>

                        <div class="w-full mr-1">
                          <label
                            class="block mb-2 text-lg font-bold text-grey-darker"
                            for="descricao"
                            >Descrição Detalhada<span
                              class="text-lg font-bold text-red-700"
                              >*</span
                            ></label
                          >
                          <textarea
                            class="w-full"
                            rows="3"
                            :value="produto.produto.descricao_detalhada"
                            disabled
                          ></textarea>
                        </div>
                      </div>
                      <div class="px-8 py-4">
                        <div class="flex mb-4">
                          <div class="w-1/2 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="composicao"
                              >Composição</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              id="composicao"
                              type="text"
                              :value="produto.produto.composicao"
                              disabled
                              />
                          </div>
                          <div class="w-1/2 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="especie"
                              >Espécie</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              id="especie"
                              type="text"
                              :value="produto.produto.especie"
                              disabled                            />
                          </div>
                          <div class="w-1/2 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="unidade"
                              >Unidade</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              id="unidade"
                              type="text"
                              :value="produto.produto.unidade"
                              disabled
                             list="list_unidade"
                            />
                          </div>
                        </div>

                        <div class="flex mb-4">
                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="patrimonio"
                              >Patrimônio</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="text"
                              :value="produto.produto.patrimonio"
                              disabled
                            />
                          </div>

                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="validade"
                              >Validade</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="date"
                              placeholder="Validade"
                              :value="produto.produto.validade"
                              disabled
                              />
                          </div>

                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="especificacao"
                              >Especificação</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="text"
                              :value="produto.produto.especificacao"
                              disabled
                              />
                          </div>
                        </div>

                        <div class="flex mb-4">
                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="estoque_id"
                              >Estoque</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="text"
                              :value="produto.identificacao_estoque.identificacao"
                              disabled
                            />

                          </div>

                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="quantidade_inicial"
                              >Quantidade Inicial</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="number"
                              min="0"
                              placeholder="Quantidade Inicial"
                              :value="produto.quantidade"
                              disabled
                            />
                          </div>
                          <div class="w-1/3 mr-1">
                            <label
                              class="block mb-2 text-lg font-bold text-grey-darker"
                              for="quantidade_limite"
                              >Quantidade Mínima</label
                            >
                            <input
                              class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                              type="number"
                              min="0"
                              placeholder="Quantidade Mínima"
                              :value="produto.quantidade_limite"
                              disabled                            />
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>

        <div
          class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200 text-red-500 font-bold"
        >
        Cadastrado por {{ produto.user.name }} - {{ moment(produto.produto.created_at).format('DD/MM/YY hh:mm:ss')}}
    </div>

</div>
  </Modal>
</template>

<script setup>
import { Link, router, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { nextTick, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import VueBarcode from "@chenfengyuan/vue-barcode";
import moment from 'moment'

const props = defineProps({
  produto: Object,
});

// Controle de Formulário
const form = useForm({
  foto: "",
  identificacao: "",
  descricao: "",
});

function cadastrarProduto() {
  if (form.identificacao != "" && form.descricao != "") {
    form.post(route("estoques.store"), {
      onSuccess: () => closeModal(),
    });
  }
}

const limparFormulario = () => {
  form.id = "";

  form.foto = "";

  form.produto = "";
  form.descricao_resumida = "";
  form.descricao_detalhada = "";
  form.composicao = "";
  form.especie = "";
  form.unidade = "";
  form.patrimonio = "";
  form.validade = "";
  form.especificacao = "";
  form.url = "";

  // form.get(route('atendimentos.index'))
};

// Controle do Modal
const confirmar = ref(false);

const abrirModal = () => {
  confirmar.value = true;
};

const closeModal = () => {
  confirmar.value = false;
  form.reset();
};

function previewImage(e) {
  const file = e.target.files[0];
  form.url = URL.createObjectURL(file);
}
</script>
<script>
import { mask } from "vue-the-mask";

export default {
  directives: { mask },
};
</script>
