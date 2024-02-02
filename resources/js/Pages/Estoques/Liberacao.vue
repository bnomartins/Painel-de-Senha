<template>
  <Head title="Liberação de Estoque" />

  <AuthenticatedLayout>
    <template #header>
      Liberação de Estoque
    </template>

    <div class="m-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
      <div class="m-5 border-b border-gray-200">
        <form @submit.prevent="cadastrarEntrada()" class="w-full">
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
                  Liberação de Estoque
                </div>

                <div class="px-8">
                  <div
                    class="w-full p-3 m-auto mt-5 font-bold bg-gray-200 border border-gray-50 text-md border-1 rounded-xl"
                  >
                    <div class="flex justify-between flex-columns">
                      <b class="text-xl font-bold"
                        ><b class="text-xl font-bold text-red-700">+</b
                        >Liberação:
                      </b>
                    </div>
                    <div class="flex mb-4">
                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="usuario"
                          >Id</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.usuario"
                          list="list_usuarios"
                          @blur.prevent="addUsuario(form.usuario)"
                        />
                        <datalist id="list_usuarios">
                          <option
                            v-for="u in usuarios"
                            :key="u.id"
                            :value="u.id + ' - ' + u.name"
                            >{{ u.name }}</option
                          >
                        </datalist>
                      </div>
                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="usuario"
                          >Nome</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.usuario_nome"
                          disabled
                        />
                      </div>
                      <div class="flex mb-4">
                        <div class="w-1/3 mr-1">
                          <label
                            class="block mb-2 text-lg font-bold text-grey-darker"
                            for="patrimonio"
                            >Estoque</label
                          >
                          <input
                            class="px-3 py-2 border rounded appearance-none text-grey-darker"
                            type="text"
                            placeholder="Selecione o Estoque"
                            v-model="form.estoque"
                            list="list_identificacao_estoques"
                            @blur.prevent="addEstoque(form.estoque)"
                          />
                          <!-- @blur.prevent="addEstoque(form.estoque)" -->

                          <datalist id="list_identificacao_estoques">
                            <option
                              v-for="e in estoques"
                              :key="e.id"
                              :value="e.id + ' - ' + e.identificacao"
                              >{{ e.identificacao }}</option
                            >
                          </datalist>
                        </div>
                      </div>

                      <div class="flex mb-4">
                        <div class="w-1/5 mr-1">
                          <label
                            class="block mb-2 text-lg font-bold text-grey-darker"
                            for="descricao"
                            >Descrição</label
                          >
                          <input
                            class="px-3 py-2 border rounded appearance-none text-grey-darker"
                            type="text"
                            placeholder="Selecione o Estoque"
                            v-model="form.estoque_descricao"
                            disabled
                          />
                          <!-- @blur.prevent="addEstoque(form.estoque)" -->

                          <input
                            type="hidden"
                            name=""
                            v-model="form.identificacao_estoque"
                          />
                        </div>
                      </div>

                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="acesso"
                          >Acesso</label
                        >

                        <select
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          v-model="form.acesso"
                        >
                          <option value=""></option>
                          <option value="Solicitar">Solicitar</option>
                          <option value="Atender">Atender</option>
                          <option value="Atender e Solicitar"
                            >Atender e Solicitar</option
                          >
                        </select>
                      </div>

                      <div class="flex mr-1 w-1/7">
                        <label
                          class="block mb-2 text-sm font-bold text-grey-darker"
                          for="altura"
                        ></label>
                        <button
                          class="w-full p-2 text-2xl"
                          @click.prevent="
                            addAcesso(
                              form.usuario_id,
                              form.usuario_nome,
                              form.estoque_id,
                              form.estoque_descricao,
                              form.acesso
                            )
                          "
                          :disabled="
                            form.usuario_id == '' ||
                            form.estoque_id == '' ||
                            form.acesso == ''
                          "
                        >
                          <i class="text-red-500 fas fa-plus"></i>
                        </button>
                      </div>
                    </div>

                    <div class="flex mb-4">
                      <div
                        class="w-full p-3 m-auto font-bold bg-gray-200 border border-gray-50 text-md border-1 rounded-xl"
                      >
                        <div
                          class="w-full px-3 py-2 bg-white border border-gray-200 rounded shadow-lg appearance-none text-grey-darker"
                          v-if="
                            usuario_estoque[0]
                              ? usuario_estoque[0].identificacao_estoque
                                  .length > 0
                              : false
                          "
                        >
                          <div
                            class="flex justify-between mt-1 flex-columns"
                            v-if="
                              usuario_estoque[0]
                                ? usuario_estoque[0].identificacao_estoque
                                    .length > 0
                                : false
                            "
                          >
                            <b class="text-xl font-bold text-green-800"
                              ><b class="text-xl font-bold text-red-700">+</b
                              >Acesso(s) já liberados
                            </b>
                          </div>

                          <table
                            class="w-full bg-emerald-100"
                            v-if="
                              usuario_estoque[0]
                                ? usuario_estoque[0].identificacao_estoque
                                    .length > 0
                                : false
                            "
                          >
                            <thead>
                              <tr
                                class="uppercase border border-2 border-gray-200 fonte-bold"
                              >
                                <th>Id</th>
                                <th>Usuário</th>
                                <th>Estoque</th>
                                <th>Identificação</th>
                                <th>Acesso</th>
                                <th>Revogar</th>
                              </tr>
                            </thead>

                            <tbody v-for="e in usuario_estoque" :key="e.id">
                              <tr
                                v-for="i in e.identificacao_estoque"
                                :key="i.id"
                                class="w-full ml-4 text-lg font-bold text-center text-gray-700"
                              >
                                <td>{{ e.id }}</td>
                                <td>{{ e.name }}</td>
                                <td>{{ i.id }}</td>
                                <td>{{ i.identificacao }}</td>
                                <td>{{ i.pivot.acesso }}</td>
                                <td>
                                  <button
                                    @click.prevent="
                                      revogacao(
                                        e.id,
                                        e.name,
                                        i.id,
                                        i.identificacao,
                                        i.pivot.acesso
                                      )
                                    "
                                    class="px-6 text-lg bg-red-200 border border-gray-400 rounded-lg border-1"
                                  >
                                    <i
                                      class="text-red-400 fa fa-trash"
                                      aria-hidden="true"
                                    ></i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div
                          class="w-full px-3 py-2 mt-2 bg-white border border-gray-200 rounded shadow-lg appearance-none text-grey-darker"
                          v-if="form.acessos.length > 0"
                        >
                          <div class="flex justify-between mt-5 flex-columns">
                            <b class="text-xl font-bold"
                              ><b class="text-xl font-bold text-red-700">+</b
                              >Acesso(s) para serem liberados
                            </b>
                          </div>

                          <table class="w-full bg-yellow-100">
                            <thead>
                              <tr
                                class="uppercase border border-2 border-gray-200 fonte-bold"
                              >
                                <th>Id</th>
                                <th>Usuário</th>
                                <th>Estoque</th>
                                <th>Descrição</th>
                                <th>Acesso</th>
                                <th>Revogar</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(a, index) in form.acessos"
                                :key="index"
                                class="w-full ml-4 text-lg font-bold text-center text-gray-700"
                              >
                                <td>{{ a.usuario_id }}</td>
                                <td>{{ a.usuario_nome }}</td>
                                <td>{{ a.estoque_id }}</td>
                                <td>{{ a.estoque_descricao }}</td>
                                <td>{{ a.acesso }}</td>
                                <td>
                                  <button
                                    @click.prevent="
                                      () => {
                                        form.acessos.splice(
                                          form.acessos.indexOf(p),
                                          1
                                        );
                                      }
                                    "
                                    class="px-6 text-lg bg-red-200 border border-gray-400 rounded-lg border-1"
                                  >
                                    <i
                                      class="text-red-400 fa fa-trash"
                                      aria-hidden="true"
                                    ></i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div
                    class="flex p-4 text-sm text-red-500 rounded-md bg-red-50"
                    x-cloak
                    x-show="showAlert"
                    x-data="{ showAlert: true }"
                    v-if="form.hasErrors"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                      class="flex-shrink-0 w-5 h-5 mr-3"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                        clip-rule="evenodd"
                      />
                    </svg>
                    <div>
                      <h4 class="font-bold">Pendência</h4>
                      <div class="mt-1">
                        <ul class="list-disc list-inside">
                          <li
                            v-for="(error, index) in form.errors"
                            :key="index"
                          >
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

          <div
            class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200"
          >
            <button
              class="px-4 py-2 mr-2 text-xl font-bold text-white bg-blue-600 hover:bg-blue-400 rounded-xl"
              type="submit"
              :disabled="form.processing"
            >
              <i v-if="form.processing">Consultando</i>
              <i v-else>
                Salvar
              </i>
            </button>

            <button
              class="px-4 py-2 text-xl font-bold bg-yellow-500 hover:bg-yellow-300 rounded-xl"
              type="submit"
              @click.prevent="limparFormulario"
            >
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
import { onUpdated } from "vue";

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
  usuarios: {
    type: Object,
  },
  usuario_estoque: {
    type: Object,
  },
  acessos: {
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

  identificacao_estoque: "",
  estoque: "",
  estoque_id: "",
  estoque_descricao: "",

  usuario: "",
  usuario_id: "",
  usuario_nome: "",

  acesso: "",

  remove_estoque_id: "",
  remove_estoque_identificacao: "",
  remove_usuario_id: "",
  remove_usuario_nome: "",
  remove_acesso: "",

  ordem_compra: "",
  documento_tipo: "",
  documento_numero: "",
  documento_serie: "",
  documento_emissao: "",
  documento_anexo: "",

  fornecedor: "",
  fornecedor_id: "",
  fornecedor_cnpj: "",
  fornecedor_nome_fantasia: "",
  fornecedor_razao_social: "",

  entrada: "",

  icms_base: "",
  icms_valor: "",
  icms_base_substituicao: "",
  icms_valor_substituicao: "",
  frete_valor: "",
  seguro_valor: "",
  outras_despesas_valor: "",
  ipi_valor: "",

  valor_subtotal: 0,
  valor_conferencia: 0,

  produto: "",
  validade: "",
  lote: "",
  quantidade: 0,
  valor_unitario: 0,
  valor_total: 0,

  url: "",

  acessos: [],
});

function cadastrarEntrada() {
  form.post(route("estoques.liberacao.cadastro"));
}

function addUsuario(usuario) {
  form.usuario_id = usuario.split(" - ")[0];
  form.usuario_nome = usuario.split(" - ")[1];
  // carregar as liberações do usuário
  form.get(route("estoques.liberacao"), {
    only: ["usuario_estoque"],
    preserveState: true,
    preserveScroll: true,
  });
}

function addEstoque(estoque) {
  // form.usuario_id = form.usuario.split(' - ')[0]
  // form.usuario_nome = form.usuario.split(' - ')[1]
  form.estoque_id = form.estoque.split(" - ")[0];
  form.estoque_descricao = form.estoque.split(" - ")[1];
}

function addAcesso(
  usuario_id,
  usuario_nome,
  estoque_id,
  estoque_descricao,
  acesso
) {
  if (usuario_id !== "" && estoque_id !== "") {
    if (form.acessos.length > 0) {
      const consultaAcessos = form.acessos.filter(
        (item) =>
          item.usuario_id == usuario_id &&
          item.estoque_id == estoque_id &&
          item.acesso == acesso
      );
      console.log("acesso", consultaAcessos);

      const consultaAutorizacao = props.usuario_estoque[0] 
      ?
      props.usuario_estoque[0].identificacao_estoque.filter(
        // (item) => item.id == usuario_id && item.identificacao_estoque.id.includes(estoque_id) == true
        (item) =>
          item.pivot.identificacao_estoque_id == estoque_id &&
          item.pivot.user_id == usuario_id &&
          item.pivot.acesso == acesso
        // (item) => console.log(item.pivot.identificacao_estoque_id, item.pivot.user_id, item.pivot.acesso)
      )
      :
      [];
      console.log("autorizado", consultaAutorizacao);

      if (consultaAcessos.length === 0 && consultaAutorizacao.length === 0) {
        form.acessos.push({
          usuario_id,
          usuario_nome,
          estoque_id,
          estoque_descricao,
          acesso,
        });

        form.estoque = "";
        form.estoque_id = "";
        form.estoque_descricao = "";
        form.acesso = "";
      } else {
        alert(
          `O acesso ${estoque_descricao} com o acesso ${acesso} já foi inserido`
        );

        form.estoque = "";
        form.estoque_id = "";
        form.estoque_descricao = "";
        form.acesso = "";
      }
    } else {
      const consultaAutorizacao = props.usuario_estoque[0]
        ? props.usuario_estoque[0].identificacao_estoque.filter(
            // (item) => item.id == usuario_id && item.identificacao_estoque.id.includes(estoque_id) == true
            (item) =>
              item.pivot.identificacao_estoque_id == estoque_id &&
              item.pivot.user_id == usuario_id &&
              item.pivot.acesso == acesso
            // (item) => console.log(item.pivot.identificacao_estoque_id, item.pivot.user_id, item.pivot.acesso)
          )
        : [];
      console.log("autorizado", consultaAutorizacao);
      if (consultaAutorizacao.length === 0) {
        form.acessos.push({
          usuario_id,
          usuario_nome,
          estoque_id,
          estoque_descricao,
          acesso,
        });

        form.estoque = "";
        form.estoque_id = "";
        form.estoque_descricao = "";
        form.acesso = "";
      } else {
        alert(
          `O acesso ${estoque_descricao} com o acesso ${acesso} já foi inserido`
        );

        form.estoque = "";
        form.estoque_id = "";
        form.estoque_descricao = "";
        form.acesso = "";
      }
    }
  }
}

function revogacao(
  usuario_id,
  usuario_nome,
  estoque_id,
  estoque_identificacao,
  acesso
) {
  form.remove_estoque_id = estoque_id;
  form.remove_estoque_identificacao = estoque_identificacao;
  form.remove_usuario_id = usuario_id;
  form.remove_usuario_nome = usuario_nome;
  form.remove_acesso = acesso;

  form.delete(route("estoques.revogacao"));
}
</script>
