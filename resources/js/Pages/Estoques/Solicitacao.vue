<template>
  <Head title="Solicitacao ao Estoque" />

  <AuthenticatedLayout>
    <template #header>
      Solicitacao ao Estoque
    </template>

    <div class="m-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
      <div class="m-5 border-b border-gray-200">
        <form @submit.prevent="cadastrarSolicitacao()" class="w-full">
          <aviso />

          <!-- Dados Paciente -->
          <div class="w-full mt-2 bg-grey-lightest">
            <div class="container py-2 mx-auto min-w-min">
              <div
                class="mx-auto bg-white border border-2 shadow w-6/6 lg:w-6/6 sm:min-w-sm rounded-xl border-grey-lighter">
                <div class="px-8 py-4 text-2xl font-bold text-black border border-2 border-grey-lighter">
                  Solicitação de Produtos
                </div>

                <!-- 
                            destino da solicitação
                                paciente, estoque, setor

                            escolher estoque
                            escolher estoque destino
                            escolher pacientes
                            escolher setore
                            observacao
                            data e horario -->

                <!-- produtos -->

                <div class="px-8">
                  <div
                    class="flex w-full p-3 m-auto mt-5 mb-4 font-bold bg-gray-200 border shadow-md border-gray-50 text-md border-1 rounded-xl">
                    <div class="w-full mr-1 border">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="nota">Destinação<span
                          class="text-lg font-bold text-red-700">*</span></label>

                      <ul
                        class="items-center w-full text-sm font-bold text-gray-900 bg-white border border-gray-200 border-gray-800 rounded-lg sm:flex">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                          <div class="flex items-center pl-3">
                            <input id="horizontal-list-radio-license" type="radio" name="list-radio"
                              class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                              v-model="form.destinacao" value="Setor" />
                            <label for="horizontal-list-radio-license"
                              class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Setor
                            </label>
                          </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                          <div class="flex items-center pl-3">
                            <input id="horizontal-list-radio-id" type="radio" name="list-radio"
                              class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                              v-model="form.destinacao" value="Paciente" />
                            <label for="horizontal-list-radio-id"
                              class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Paciente</label>
                          </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                          <div class="flex items-center pl-3">
                            <input id="horizontal-list-radio-millitary" type="radio" name="list-radio"
                              class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                              v-model="form.destinacao" value="Estoque" />
                            <label for="horizontal-list-radio-millitary"
                              class="w-full py-3 ml-2 text-sm font-medium text-gray-900">Estoque</label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="px-8">
                  <div
                    class="flex w-full p-3 m-auto mt-5 mb-4 font-bold bg-gray-200 border shadow-md border-gray-50 text-md border-1 rounded-xl"
                    :class="{ hidden: form.destinacao != 'Setor' }">
                    <div class="w-1/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="cnpj">Setor</label>
                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="cnpj"
                        type="text" v-model="form.setor_id" />
                    </div>
                    <div class="w-3/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="cnpj">identificação</label>
                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="cnpj"
                        type="text" v-model="form.setor_identificacao" />
                    </div>
                  </div>
                </div>

                <div class="px-8">
                  <div
                    class="flex w-full p-3 m-auto mt-5 mb-4 font-bold bg-gray-200 border shadow-md border-gray-50 text-md border-1 rounded-xl"
                    :class="{ hidden: form.destinacao != 'Paciente' }">
                    <div class="w-1/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="paciente">Paciente
                        <i class="text-blue-500 fa fa-search" aria-hidden="true"></i>
                      </label>
                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="cnpj"
                        type="text" v-model="form.paciente" list="list_pacientes"
                        @blur.prevent="addPaciente(form.paciente)" />
                    </div>

                    <datalist id="list_pacientes">
                      <option v-for="f in pacientes" :key="f.id" :value="f.id + ' - ' + f.nome + ' - ' + f.cpf">{{ f.nome
                      }}</option>
                    </datalist>
                    <div class="w-3/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="cnpj">Nome</label>
                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="cnpj"
                        type="text" :value="form.paciente_nome" disabled />
                    </div>
                  </div>
                </div>

                <div class="px-8">
                  <div
                    class="flex w-full p-3 m-auto mt-5 mb-4 font-bold bg-gray-200 border shadow-md border-gray-50 text-md border-1 rounded-xl">

                    <div class="w-1/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="estoque">Estoque Origem
                        <i class="text-blue-500 fa fa-search" aria-hidden="true"></i>
                      </label>

                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                        placeholder="Selecione o Estoque" v-model="form.estoque_origem"
                        @blur.prevent="addEstoqueOrigem(form.estoque_origem)" :class="{
                          'ring-4 ring-red-300':
                            form.errors.identificacao_estoque_origem,
                        }" list="list_identificacao_estoques" />

                      <datalist id="list_identificacao_estoques">
                        <option v-for="i in identificacao_estoques" :key="i.id" :value="i.id + ' - ' + i.identificacao">{{
                          i.identificacao }}</option>
                      </datalist>
                    </div>
                    <div class="w-3/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="cnpj">Identificação</label>
                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="cnpj"
                        type="text" :value="form.identificacao_estoque_origem_nome" disabled />
                    </div>

                  </div>

                  <div
                    class="flex w-full p-3 m-auto mt-5 mb-4 font-bold bg-gray-200 border shadow-md border-gray-50 text-md border-1 rounded-xl"
                    :class="{ hidden: form.destinacao != 'Estoque' }">
                    >

                    <div class="w-1/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="estoque_destino">Estoque Destino
                        <i class="text-blue-500 fa fa-search" aria-hidden="true"></i>
                      </label>

                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                        placeholder="Selecione o Estoque" v-model="form.estoque_destino"
                        @blur.prevent="addEstoqueDestino(form.estoque_destino)" :class="{
                          'ring-4 ring-red-300':
                            form.errors.identificacao_estoque_destino,
                        }" list="list_identificacao_estoques" />

                      <datalist id="list_identificacao_estoques">
                        <option v-for="i in identificacao_estoques" :key="i.id" :value="i.id + ' - ' + i.identificacao">{{
                          i.identificacao }}</option>
                      </datalist>
                    </div>
                    <div class="w-3/4 mr-1">
                      <label class="block mb-2 text-lg font-bold text-grey-darker" for="cnpj">Identificação</label>
                      <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" id="cnpj"
                        type="text" :value="form.identificacao_estoque_destino_nome" disabled />
                    </div>

                  </div>


                </div>

                <div class="px-8">
                  <div
                    class="w-full p-3 m-auto mt-5 font-bold bg-gray-200 border border-gray-50 text-md border-1 rounded-xl"
                    >
                    <div class="flex justify-between flex-columns">
                      <b class="text-xl font-bold"><b class="text-xl font-bold text-red-700">+</b>Produto(s)
                        Solicitado(s):
                      </b>

                      <div class="flex mb-4">
                        <div class="w-full mr-1">
                          <!-- 
                            destino da solicitação
                                paciente, estoque, setor

                            escolher estoque
                            escolher estoque destino
                            escolher pacientes
                            escolher setore
                            observacao
                            data e horario -->

                          <!-- produtos -->
                        </div>
                      </div>
                    </div>
                    <div class="flex mb-4">
                      <div class="w-1/5 mr-1">
                        <label class="block mb-2 text-lg font-bold text-grey-darker" for="patrimonio">Produto
                          <i class="text-blue-500 fa fa-search" aria-hidden="true"></i>
                        </label>
                        <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                          v-model="form.produto" :disabled="form.identificacao_estoque_origem == ''"
                          @blur.prevent="addProd(form.produto)" list="list_produtos" />

                        <datalist id="list_produtos">
                          <option v-for="p in produtos" :key="p.id"
                            :value="p.id + ' - ' + p.produto.produto + ' - ' + p.quantidade">{{ p.produto.produto }}
                          </option>
                        </datalist>
                      </div>
                      <div class="w-3/5 mr-1">
                        <label class="block mb-2 text-lg font-bold text-grey-darker" for="patrimonio">Produto</label>
                        <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                          v-model="form.produto_nome" disabled list="list_produtos" />
                      </div>

                      <div class="w-1/5 mr-1">
                        <label class="block mb-2 text-lg font-bold text-grey-darker" for="especificacao">Qtd.</label>
                        <input class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                          v-model="form.quantidade" :class="{
                            'ring-4 ring-red-300': form.errors.quantidade,
                          }" :disabled="form.produto == ''"
                          @keyup="addQuantidade(form.produto_nome, form.produto_quantidade, form.quantidade)" />
                      </div>

                      <div class="flex mr-1 w-1/8">
                        <label class="block mb-2 text-sm font-bold text-grey-darker" for="altura"></label>
                        <button class="w-full p-1 px-4 text-2xl bg-red-200 border border-gray-400 rounded-lg border-1"
                          @click.prevent="
                            addProduto(form.produto, form.quantidade)
                            " :disabled="form.produto == ''">
                          <i class="text-red-500 fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                    <span class="text-red-400" v-if="form.identificacao_estoque_origem == ''">É necessário selecionar o
                      estoque
                      para liberação dos
                      campos
                    </span>
                    <div class="flex mb-4">
                      <div
                        class="w-full p-3 m-auto font-bold bg-gray-200 border border-gray-50 text-md border-1 rounded-xl"
                        v-if="form.produtos.length > 0">

                        <div
                          class="w-full px-3 py-2 bg-white border border-gray-200 rounded shadow-lg appearance-none text-grey-darker">

                          <table class="w-full">
                            <thead>
                              <tr class="uppercase border border-2 border-gray-200 fonte-bold">
                                <th>Código</th>
                                <th>produto</th>
                                <th>Quantidade</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="(p, index) in form.produtos" :key="p.produto_id"
                                class="w-full ml-4 text-lg font-bold text-center text-gray-700">
                                <td>{{ p.produto_id }}</td>
                                <td>{{ p.produto_nome }}</td>
                                <td>{{ p.quantidade }}</td>
                                <td>
                                  <button @click.prevent="() => {
                                    form.produtos.splice(
                                      form.produtos.indexOf(p),
                                      1
                                    );

                                    form.valor_conferencia =
                                      parseFloat(
                                        form.valor_conferencia,
                                        2
                                      ) -
                                      parseFloat(p.quantidade, 2) *
                                      parseFloat(p.valor_unitario, 2);
                                  }
                                    " class="px-2 text-lg">
                                    <i class="text-red-400 fa fa-trash" aria-hidden="true"></i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>

                    <div class="flex mb-4">
                      <div class="w-full mr-1">
                        <label class="block mb-2 text-lg font-bold text-grey-darker" for="observacao">Observação
                        </label>
                        <textarea class="w-full px-3 py-2 border rounded appearance-none text-grey-darker" type="text"
                          v-model="form.observacao"></textarea>
                      </div>
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
                          <li v-for="(error, index) in form.errors" :key="index">
                            {{ error }}
                          </li>
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
              type="submit" :disabled="form.processing" :class="{
                'opacity-25': form.processing,
              }">
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
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, router, Link } from "@inertiajs/vue3";
import { Inertia, usePage } from "@inertiajs/inertia";

import Pagination from "../../Components/Pagination.vue";
import Aviso from "@/Components/Aviso.vue";
import CadastroExame from "../../Components/Exames/Cadastro.vue";
import EdicaoExame from "../../Components/Exames/Edicao.vue";
import ExcluirExame from "../../Components/Exames/Excluir.vue";
import CadastroEstoque from "../../Components/Estoques/Cadastro.vue";
import VerProduto from "../../Components/Estoques/VerProduto.vue";
import EstoqueProdutos from "../../Components/Estoques/EstoqueProdutos.vue";
import VueBarcode from "@chenfengyuan/vue-barcode";

import moment from "moment";
const props = defineProps({
  identificacao_estoques: {
    type: Object,
  },
  estoques: {
    type: Object,
  },
  produtos: {
    type: Object,
  },
  pacientes: {
    type: Object,
  },
  setor: {
    type: Object,
  },
  id: {
    type: Object,
  },
});

const form = useForm({
  search: "",
  searchClear: false,
  id: props.id,

  identificacao_estoque_origem: "",
  identificacao_estoque_origem_id: "",
  identificacao_estoque_origem_nome: "",

  identificacao_estoque_destino: "",
  identificacao_estoque_destino_id: "",
  identificacao_estoque_destino_nome: "",

  estoque: "",
  estoque_origem: "",
  estoque_destino: "",

  destinacao: "",

  paciente: "",
  paciente_id: "",
  paciente_nome: "",
  paciente_cpf: "",

  setor_id: props.setor ? props.setor[0].id : '',
  setor_identificacao: props.setor ? props.setor[0].identificacao : '',

  produto: "",
  produto_id: "",
  produto_quantidade: "",

  quantidade: 0,
  obsevacao: '',

  url: "",

  produtos: [],
});

function cadastrarSolicitacao() {
  form.post(route("estoques.solicitacao.cadastro"));
}

function updateEstoque() {
  form.get(route("estoques.solicitacao"), {
    only: ["produtos"],
    preserveState: true,
    preserveScroll: true,
  });
}

function addPaciente(paciente) {
  if (paciente) {
    form.paciente_id = paciente.split(" - ")[0];
    form.paciente_nome = paciente.split(" - ")[1];
    form.paciente_cpf = paciente.split(" - ")[2];
  }
}
function addEstoqueOrigem(estoque) {
  if (estoque !== "") {
    form.estoque = estoque.split(" - ")[0];
    form.identificacao_estoque_origem = estoque.split(" - ")[0];
    form.identificacao_estoque_origem_id = estoque.split(" - ")[0];
    form.identificacao_estoque_origem_nome = estoque.split(" - ")[1];
    updateEstoque();
  }
}

function addEstoqueDestino(estoque) {
  if (estoque !== "") {
    form.estoque = estoque.split(" - ")[0];
    form.identificacao_estoque_destino = estoque.split(" - ")[0];
    form.identificacao_estoque_destino_id = estoque.split(" - ")[0];
    form.identificacao_estoque_destino_nome = estoque.split(" - ")[1];
  }
}

function addProd(produto) {
  if (produto !== "") {
    if (produto.split(' - ')[2] != 0) {
      form.produto = produto.split(" - ")[0];
      form.produto_id = produto.split(" - ")[0];
      form.produto_nome = produto.split(" - ")[1];
      form.produto_quantidade = produto.split(" - ")[2];
    } else {
      alert('Produto indisponível')
    }
  }
}

function addQuantidade(produto_nome, produto_quantidade, quantidade) {
  console.log(produto_nome, produto_quantidade, quantidade)
  if (parseFloat(quantidade) > parseFloat(produto_quantidade)) {
    alert('A quantidade solicitada não pode ser maior que a quantidade disponível do produto ' + produto_nome + ' de ' + produto_quantidade)
    // console.log('A quantidade solicitada é superior a quantidade disponível de '+produto.split(' - ')[2])
  }
}

function addProduto(produto, quantidade) {
  const produto_id = produto.split(" - ")[0];
  const produto_nome = form.produto_nome
  console.log(produto_nome)
  if (produto_id !== "" && quantidade > 0) {
    if (form.produtos.length > 0) {
      const consultaProduto = form.produtos.filter(
        (item) => item.produto_id == produto_id
      );

      if (consultaProduto.length === 0) {
        form.produtos.push({
          produto_id,
          produto_nome,
          quantidade,
        });

        form.produto = "";
        form.produto_nome = "";
        form.produto_id = "";
        form.produto_quantidade = "";
        form.quantidade = "";
      } else {
        alert(`O produto ${produto_nome} já foi inserido`);

        form.produto = "";
        form.produto_nome = "";
        form.produto_id = "";
        form.produto_quantidade = "";
        form.quantidade = "";
      }
    } else {
      form.produtos.push({
        produto_id,
        produto_nome,
        quantidade,
      });

      form.produto = "";
      form.produto_nome = "";
      form.produto_id = "";
      form.produto_quantidade = "";
      form.quantidade = "";
    }
  }
}
</script>
