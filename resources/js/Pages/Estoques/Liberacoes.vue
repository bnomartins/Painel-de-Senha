<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      Entrada ao Estoque
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
                    class="flex mb-4 mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl shadow-md"
                  >
                    <div
                      class="flex-shrink-0 w-1/5 pl-10 text-blue-500 h-30 w-30"
                    >
                      <label for="foto" class="w-full text-center">
                        <img
                          class="w-15 h-20"
                          :src="form.url ? form.url : '../storage/img/nt.png'"
                          alt=""
                        />
                      </label>

                      <input
                        type="file"
                        placholder="Digite o resultado"
                        @input="form.documento_anexo = $event.target.files[0]"
                        @change="previewImage"
                        class="hidden"
                        id="foto"
                      />
                    </div>

                    <div class="w-1/6 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="nota"
                        >Ordem de Compra<span
                          class="text-lg font-bold text-red-700"
                          >*</span
                        ></label
                      >
                      <select
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        v-model="form.ordem_compra"
                      >
                        <option value=""></option>
                        <option value="SOLICITAÇÃO SEM ORDME DE COMPRA">
                          SOLICITAÇÃO SEM ORDEM DE COMPRA</option
                        >
                        <option value="CONTRATO DE FORNECIMENTO">
                          CONTRATO DE FORNECIMENTO</option
                        >
                        <option value="SUPRIMENTO DE CAIXA">
                          SUPRIMENTO DE CAIXA</option
                        >
                        <option value="ENTRADA DE DOAÇÃO">
                          ENTRADA DE DOAÇÃO</option
                        >
                      </select>
                    </div>

                    <div class="w-1/6 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="nota"
                        >Tipo de Doc.<span
                          class="text-lg font-bold text-red-700"
                          >*</span
                        ></label
                      >
                      <select
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        v-model="form.documento_tipo"
                      >
                        <option value=""></option>
                        <option value="BOLETO DE COBRANÇA"
                          >BOLETO DE COBRANÇA</option
                        >
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="COMODATO">COMODATO</option>
                        <option value="CONTRATO">CONTRATO</option>
                        <option value="DAE">DAE</option>
                        <option value="DAM">DAM</option>
                        <option value="DARF">DARF</option>
                        <option value="DEBITO EM CONTA CORRETE"
                          >DEBITO EM CONTA CORRETE</option
                        >
                        <option value="DUAM">DUAM</option>
                        <option value="DUPLICATA">DUPLICATA</option>
                        <option value="FUNDO FIXO">FUNDO FIXO</option>
                        <option value="NOTA FISCAL">NOTA FISCAL</option>
                        <option value="NOTA FISCAL COMPLEMENTAR"
                          >NOTA FISCAL COMPLEMENTAR</option
                        >
                        <option value="NOTA FISCAL DE AMOSTRA GRATIS"
                          >NOTA FISCAL DE AMOSTRA GRATIS</option
                        >
                        <option value="NOTA FISCAL DE BONIFICAÇÃO"
                          >NOTA FISCAL DE BONIFICAÇÃO</option
                        >
                        <option value="NOTA FISCAL DE DE DEMONSTRAÇÃO"
                          >NOTA FISCAL DE DE DEMONSTRAÇÃO</option
                        >
                        <option value="NOTA FISCAL DE DOAÇÃO"
                          >NOTA FISCAL DE DOAÇÃO</option
                        >
                        <option value="NOTA FISCAL DE EMPRESTIMO"
                          >NOTA FISCAL DE EMPRESTIMO</option
                        >
                        <option value="NOTA FISCAL DE FRETE"
                          >NOTA FISCAL DE FRETE</option
                        >
                        <option value="NOTA FISCAL DE SERVIÇO"
                          >NOTA FISCAL DE SERVIÇO</option
                        >
                        <option value="NOTA FISCAL FATURA"
                          >NOTA FISCAL FATURA</option
                        >
                        <option value="NOTA FISCAL TERCEIROS"
                          >NOTA FISCAL TERCEIROS</option
                        >
                        <option value="ORDEM DE COMPRA">ORDEM DE COMPRA</option>
                        <option value="ORDEM DE PAGAMENTO"
                          >ORDEM DE PAGAMENTO</option
                        >
                      </select>
                    </div>

                    <div class="w-1/6 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="cnpj"
                        >Fornecedor
                        <i
                          class="fa fa-search text-blue-500"
                          aria-hidden="true"
                        ></i>
                      </label>
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        id="cnpj"
                        type="text"
                        v-model="form.fornecedor"
                        list="list_fornecedores"
                        @blur.prevent="addFornecedor(form.fornecedor)"
                      />
                    </div>

                    <datalist id="list_fornecedores">
                      <option
                        v-for="f in fornecedores"
                        :key="f.id"
                        :value="
                          f.id +
                          ' - ' +
                          f.nome_fantasia +
                          ' - ' +
                          f.cnpj +
                          ' - ' +
                          f.razao_social
                        "
                        >{{ f.nome_fantasia }}</option
                      >
                    </datalist>

                    <input
                      class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                      id="fornecedor_id"
                      type="hidden"
                      v-model="form.fornecedor_id"
                    />

                    <input
                      class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                      id="fornecedor_id"
                      type="hidden"
                      v-model="form.fornecedor_nome_fantasia"
                    />

                    <div class="w-1/6 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="cnpj"
                        >CNPJ</label
                      >
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        id="cnpj"
                        type="text"
                        v-model="form.fornecedor_cnpj"
                        :disabled="form.fornecedor != ''"
                      />
                    </div>
                    <div class="w-1/6 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="razao_social"
                        >Razão Social</label
                      >
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        id="razao_social"
                        type="text"
                        v-model="form.fornecedor_razao_social"
                        :disabled="form.fornecedor != ''"
                      />
                    </div>
                  </div>
                </div>

                <div class="px-8">
                  <div
                    class="flex mb-4 mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl shadow-md"
                  >
                    <div class="w-1/3 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="documento_numero"
                        >Nº Documento<span
                          class="text-lg font-bold text-red-700"
                          >*</span
                        ></label
                      >
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        type="text"
                        v-model="form.documento_numero"
                      />
                    </div>

                    <div class="w-1/3 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="documento_serie"
                        >Série Documento</label
                      >
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        type="text"
                        v-model="form.documento_serie"
                      />
                    </div>

                    <div class="w-1/3 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="documento_emissao"
                        >Data de Emissão<span
                          class="text-lg font-bold text-red-700"
                          >*</span
                        ></label
                      >
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        type="date"
                        v-model="form.documento_emissao"
                      />
                    </div>

                    <div class="w-1/3 mr-1">
                      <label
                        class="block mb-2 text-lg font-bold text-grey-darker"
                        for="entrada"
                        >Data de Entrada<span
                          class="text-lg font-bold text-red-700"
                          >*</span
                        ></label
                      >
                      <input
                        class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                        type="date"
                        v-model="form.entrada"
                      />
                    </div>
                  </div>
                  <div
                    class="mb-4 mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl shadow-md"
                  >
                    <div class="flex mb-4">
                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="icms_base"
                          >Base ICMS</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.icms_base"
                        />
                      </div>

                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="icms_valor"
                          >Valor ICMS</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.icms_valor"
                        />
                      </div>

                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="icms_base_substituicao"
                          >Base ICMS Subst.:</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.icms_base_substituicao"
                        />
                      </div>

                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="icms_valor_substituicao"
                          >Valor ICMS Subst.:</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.valor_substituicao"
                        />
                      </div>
                    </div>

                    <div class="flex mb-4">
                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="frete_valor"
                          >Valor Frete</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.frete_valor"
                        />
                      </div>

                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="seguro_valor"
                          >Valor Seguro</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.seguro_valor"
                        />
                      </div>

                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="outras_despesas_valor"
                          >Outras Despesas</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.outras_despesas_valor"
                        />
                      </div>

                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="ipi_valor"
                          >Valor IPI</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.ipi_valor"
                        />
                      </div>
                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="ipi_valor"
                          >Valor Total<span
                            class="text-lg font-bold text-red-700"
                            >*</span
                          ></label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="number"
                          min="0"
                          v-model="form.valor_total"
                          :class="{
                            'ring-4 ring-red-300':
                              form.valor_total !== form.valor_conferencia,
                          }"
                        />
                      </div>
                    </div>
                  </div>

                  <div
                    class="mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                  >
                    <div class="flex flex-columns justify-between">
                      <b class="font-bold text-xl"
                        ><b class="text-red-700 font-bold text-xl">+</b
                        >Produtos(s) Solicitado(s):
                      </b>

                      <div class="flex mb-4">
                        <div class="w-full mr-1">
                          <input
                            class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                            type="text"
                            placeholder="Selecione o Estoque"
                            v-model="form.estoque"
                            @blur.prevent="addEstoque(form.estoque)"
                            :class="{
                              'ring-4 ring-red-300':
                                form.errors.identificacao_estoque,
                            }"
                            list="list_identificacao_estoques"
                          />

                          <input
                            type="hidden"
                            name=""
                            v-model="form.identificacao_estoque"
                          />
                          <datalist id="list_identificacao_estoques">
                            <option
                              v-for="i in identificacao_estoques"
                              :key="i.id"
                              :value="i.id + ' - ' + i.identificacao"
                              >{{ i.identificacao }}</option
                            >
                          </datalist>
                        </div>
                      </div>
                    </div>
                    <div class="flex mb-4">
                      <div class="w-1/3 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="patrimonio"
                          >Produto</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.produto"
                          :disabled="form.identificacao_estoque == ''"
                          list="list_produtos"
                        />
                        <datalist id="list_produtos">
                          <option
                            v-for="p in produtos"
                            :key="p.id"
                            :value="p.id + ' - ' + p.produto.produto"
                            >{{ p.produto.produto }}</option
                          >
                        </datalist>
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
                          v-model="form.validade"
                          :disabled="form.produto == ''"
                        />
                      </div>

                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="especificacao"
                          >Lote</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.lote"
                          :class="{
                            'ring-4 ring-red-300': form.errors.lote,
                          }"
                          :disabled="form.produto == ''"
                        />
                      </div>

                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="especificacao"
                          >Qtd.</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.quantidade"
                          :class="{
                            'ring-4 ring-red-300': form.errors.quantidade,
                          }"
                          :disabled="form.produto == ''"
                        />
                      </div>

                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="especificacao"
                          >Vl. Un.</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.valor_unitario"
                          :class="{
                            'ring-4 ring-red-300': form.errors.valor_unitario,
                          }"
                          :disabled="form.produto == ''"
                          @blur.prevent="addValorTotal"
                        />
                      </div>

                      <div class="w-1/5 mr-1">
                        <label
                          class="block mb-2 text-lg font-bold text-grey-darker"
                          for="especificacao"
                          >Sub Valor</label
                        >
                        <input
                          class="w-full px-3 py-2 border rounded appearance-none text-grey-darker"
                          type="text"
                          v-model="form.valor_subtotal"
                          :class="{
                            'ring-4 ring-red-300': form.errors.valor_subtotal,
                          }"
                          disabled
                        />
                      </div>
                      <div class="w-1/6 mr-1 flex">
                        <label
                          class="block text-grey-darker text-sm font-bold mb-2"
                          for="altura"
                        ></label>
                        <button
                          class="w-full p-2 text-2xl"
                          @click.prevent="
                            addProduto(
                              form.produto,
                              form.validade,
                              form.lote,
                              form.quantidade,
                              form.valor_conferencia,
                              form.valor_unitario,
                              form.valor_total
                            )
                          "
                          :disabled="form.produto == ''"
                        >
                          <i class="fas fa-plus text-red-500"></i>
                        </button>
                      </div>
                    </div>
                    <span
                      class="text-red-400"
                      v-if="form.identificacao_estoque == ''"
                      >É necessário selecionar o estoque para liberação dos
                      campos
                    </span>
                    <div class="flex mb-4">
                      <div
                        class="p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                        v-if="form.produtos.length > 0"
                      >
                        <!-- {{ form.produtos }} -->
                        <div
                          class="appearance-none border border-gray-200 rounded py-2 px-3 text-grey-darker shadow-lg bg-white w-full"
                        >
                          <table class="w-full">
                            <thead>
                              <tr
                                class="fonte-bold uppercase border border-2 border-gray-200"
                              >
                                <th>Código</th>
                                <th>produto</th>
                                <th>Validade</th>
                                <th>Lote</th>
                                <th>Quantidade</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr
                                v-for="(p, index) in form.produtos"
                                :key="p.produto_id"
                                class="text-gray-700 text-lg font-bold w-full ml-4 text-center"
                              >
                                <td>{{ p.produto_id }}</td>
                                <td>{{ p.produto_produto }}</td>
                                <td>{{ p.validade }}</td>
                                <td>{{ p.lote }}</td>
                                <td>{{ p.quantidade }}</td>
                                <td>
                                  <button
                                    @click.prevent="
                                      () => {
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
                                    "
                                    class="px-2 text-lg"
                                  >
                                    <i
                                      class="fa fa-trash text-red-400"
                                      aria-hidden="true"
                                    ></i>
                                  </button>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div
                        class="w-1/5 mr-1 text-red-600 font-bold"
                        v-if="form.produtos.length > 0"
                      >
                        <div class="w-full mr-1">
                          <label
                            class="block mb-2 text-lg font-bold text-grey-darker text-center px-3"
                            for="especificacao"
                            >Vl. Total</label
                          >
                          <input
                            class="w-full px-3 py-2 border rounded appearance-none text-grey-darker text-center font-bold"
                            type="text"
                            v-model="form.valor_conferencia"
                            disabled
                          />
                        </div>
                      </div>
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

          <span
            class="flex p-4 text-md text-red-500 rounded-md bg-red-50 font-bold"
            v-if="
              form.valor_conferencia != form.valor_total ||
              form.valor_conferencia == 0
            "
          >
            O valor total do documento é diferente do valor total dos itens
          </span>

          <div
            class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200"
          >
            <button
              class="px-4 py-2 mr-2 text-xl font-bold text-white bg-blue-600 hover:bg-blue-400 rounded-xl"
              type="submit"
              :disabled="
                form.processing ||
                (form.valor_conferencia != form.valor_total ||
                  form.valor_conferencia == 0)
              "
              :class="{
                'opacity-25':
                  form.processing ||
                  form.valor_conferencia != form.valor_total ||
                  form.valor_conferencia == 0,
              }"
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
  fornecedores: {
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

  produtos: [],
});

function cadastrarEntrada() {
  form.post(route("estoques.entrada"));
}

function updateEstoque(){

        form.get(route('estoques.entradaCadastro'),{
            only: ['produtos'],
            preserveState: true,
            preserveScroll: true,
        })

}

function addValorTotal() {
  if (form.valor_unitario !== "" && form.quantidade !== "") {
    form.valor_subtotal = form.quantidade * form.valor_unitario;
  } else {
    alert("* Campo de preenchimento obrigatório");
  }
}

function addFornecedor(fornecedor) {
  form.fornecedor_id = fornecedor.split(" - ")[0];
  form.fornecedor_nome_fantasia = fornecedor.split(" - ")[1];
  form.fornecedor_cnpj = fornecedor.split(" - ")[2];
  form.fornecedor_razao_social = fornecedor.split(" - ")[3];
}
function addEstoque(estoque) {
  form.identificacao_estoque = estoque.split(" - ")[0];
  updateEstoque()
}

function addProduto(
  produto,
  validade,
  lote,
  quantidade,
  valor_conferencia,
  valor_unitario,
  valor_total
) {
  const produto_id = produto.split(" - ")[0];
  const produto_produto = produto.split(" - ")[1];

  if (produto_id !== "" && form.quantidade > 0 && form.valor_unitario > 0) {
    if (form.produtos.length > 0) {
      const consultaProduto = form.produtos.filter(
        (item) => item.produto_id == produto_id && item.lote == lote
      );

      if (consultaProduto.length === 0) {
        form.produtos.push({
          produto_id,
          produto_produto,
          validade,
          lote,
          quantidade,
          valor_unitario,
          valor_total,
        });

        form.valor_conferencia =
          parseFloat(valor_conferencia, 2) +
          parseFloat(quantidade, 2) * parseFloat(valor_unitario, 2);
        console.log(form.valor_conferencia);

        form.produto = "";
        form.validade = "";
        form.lote = "";
        form.quantidade = "";
        form.valor_unitario = "";
        form.valor_subtotal = "";
      } else {
        alert(
          `O produto ${produto_produto} com o lote ${lote} já foi inserido`
        );

        form.produto = "";
        form.validade = "";
        form.lote = "";
        form.quantidade = "";
        form.valor_unitario = "";
        form.valor_subtotal = "";
      }
    } else {
      form.produtos.push({
        produto_id,
        produto_produto,
        validade,
        lote,
        quantidade,
        valor_unitario,
        valor_total,
      });

      form.valor_conferencia =
        parseFloat(valor_conferencia, 2) +
        parseFloat(quantidade, 2) * parseFloat(valor_unitario, 2);
      console.log(form.valor_conferencia);

      form.produto = "";
      form.validade = "";
      form.lote = "";
      form.quantidade = "";
      form.valor_unitario = "";
      form.valor_subtotal = "";
    }
  }
}

function previewImage(e) {
  const file = e.target.files[0];
  form.url = URL.createObjectURL(file);
}
</script>
