<template>

  <button
      class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
      @click="abrirModal"
    >
      Editar
  </button>

  <Modal :show="confirmar" @close="closeModal">


    <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
      <h1 class="text-center m-auto text-2xl font-bold" >
        Gerenciamento da Unidade
      </h1>
    </div>

    <div class="mx-2 px-6 rounded text-md w-full bg-gray-100">

      <form @submit.prevent="editarUnidade()" class="w-full">

        <div id="myTabContent" class=" border border-grey-ligther rounded-lg">



          <div class=" p-4 rounded-lg"
          id="profile" role="tabpanel" aria-labelledby="profile-tab"
          >

          <div class="py-2 px-2 text-black text-2xl font-bold">
              Resumo
          </div>


              <div class="py-4 px-8">
                <div class="flex">
                  <div class="w-1/4 mr-1">

                    <div class="flex-shrink-0 h-30">

                      <label class="block text-grey-darker text-lg font-bold mb-2"
                      for="Logo">Logotipo</label>
  
                      <label for="foto" class="w-full text-center">

                          <img
                              class="h-30 w-40"
                              :src="form.url ? form.url : '../storage/img/user.png'"
                              alt=""
                          >
                          <span v-if="!form.url" class="text-blue-500 font-bold">
                            Adicionar
                          </span>
                          <span v-else class="text-green-500 font-bold">
                            Adicionado
                          </span>
                        </label>
                      <input
                      type="file"
                        placholder="Digite o resultado"
                        @input=" form.logotipo = $event.target.files[0] "
                        @change="previewImage"
                        class="hidden"
                        id="foto"
                      />
                        <span class="block font-bold text-red-400 text-sm">Medida Recomendada: 1000x84px</span>
                    </div>


                  </div>
                  <div class="w-3/4 mr-1">
                    <label class="block text-grey-darker text-lg font-bold mb-2"
                    for="queixa">Nome Fantasia</label>
                    <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                    placeholder="Nome Fantasia" rows="1"
                    v-model="form.nome_fantasia"
                    ></textarea>
                  </div>
                  
                </div>
                  <div class="mb-4">
                      <label class="block text-grey-darker text-lg font-bold mb-2"
                      for="cnpj">CNPJ</label>
                      <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                      type="text" placeholder=""
                      v-model="form.cnpj"   
                      v-mask="'##.###.###/####-##'"
                      >

                  </div>

                  <div class="flex mb-4">

                      <div class="w-1/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">CNES</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="cnes" type="text"
                          placeholder=""
                          v-model="form.cnes"  
                          v-mask="'########'"

                          >

                      </div>
                      <div class="w-3/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">Responsável</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="responsavel" type="text"
                          placeholder=""
                          v-model="form.responsavel"
                         >

                      </div>
                  </div>

                  <div class="flex mb-4">

                    <div class="w-1/2 mr-1">
                      <label class="block text-grey-darker text-lg font-bold mb-2"
                      for="observacao">Serviços</label>

                      <input class="appearance-none border rounded w-full
                      py-2 px-3 text-grey-darker" id="cnes" type="text"
                      placeholder=""
                      list="list_servicos"
                      v-model="form.servico"
                      @blur.prevent="adicionarServico"
                      >

                    <datalist id="list_servicos">

                      <option value="103 - Serviço de Atendimento Móvel de Urgências">103 - Serviço de Atendimento Móvel de Urgências</option>
                      <option value="104 - Regulação Assistêncial dos Serviços de Saúde">104 - Regulação Assistêncial dos Serviços de Saúde</option>
                      <option value="105 - Serviço de Atenção em Neurologia/ Neurocirurgia">105 - Serviço de Atenção em Neurologia/ Neurocirurgia</option>
                      <option value="107 - Serviço de Atenção a Saúde Auditiva">107 - Serviço de Atenção a Saúde Auditiva</option>
                      <option value="108 - Serviço de Atenção a Saúde do Trabalhador">108 - Serviço de Atenção a Saúde do Trabalhador</option>
                      <option value="110 - Serviço de Atenção a Saúde Reprodutiva">110 - Serviço de Atenção a Saúde Reprodutiva</option>
                      <option value="112 - Serviço de Atenção ao Pré-Natal e Nascimento">112 - Serviço de Atenção ao Pré-Natal e Nascimento</option>
                      <option value="113 - Serviço de Atenção Domiciliar">113 - Serviço de Atenção Domiciliar</option>
                      <option value="114 - Serviço de Atenção em Saúde Bucal">114 - Serviço de Atenção em Saúde Bucal</option>
                      <option value="115 - Serviço de Atenção Psicossocial">115 - Serviço de Atenção Psicossocial</option>
                      <option value="116 - Serviço de Atenção Cardiovascular/Cardiologia">116 - Serviço de Atenção Cardiovascular/Cardiologia</option>
                      <option value="117 - Serviço de Cirurgia Reparadora">117 - Serviço de Cirurgia Reparadora</option>
                      <option value="119 - Serviço de Controle de Tabagismo">119 - Serviço de Controle de Tabagismo</option>
                      <option value="120 - Serviço de Diagnóstico por Anatomia Patológica e/ou Citopatologia">120 - Serviço de Diagnóstico por Anatomia Patológica e/ou Citopatologia</option>
                      <option value="121 - Diagnóstico por Imagem">121 - Diagnóstico por Imagem</option>
                      <option value="122 - Serviço de Diagnóstico por Métodos Gráficos/Dinâmicos">122 - Serviço de Diagnóstico por Métodos Gráficos/Dinâmicos</option>
                      <option value="123 - Serviço de Dispensação de Órteses, Próteses e Materiais Especiais">123 - Serviço de Dispensação de Órteses, Próteses e Materiais Especiais</option>
                      <option value="125 - Serviço de Farmácia">125 - Serviço de Farmácia</option>
                      <option value="126 - Serviço de Fisioterapia">126 - Serviço de Fisioterapia</option>
                      <option value="127 - Serviço de Atenção à Obesidade">127 - Serviço de Atenção à Obesidade</option>
                      <option value="128 - Serviço de Hemoterapia">128 - Serviço de Hemoterapia</option>
                      <option value="130 - Atenção à Doença Renal Crônica">130 - Atenção à Doença Renal Crônica</option>
                      <option value="131 - Serviço de Oftalmologia">131 - Serviço de Oftalmologia</option>
                      <option value="132 - Serviço de Oncologia">132 - Serviço de Oncologia</option>
                      <option value="133 - Serviço de Pneumologia">133 - Serviço de Pneumologia</option>
                      <option value="134 - Serviço de Práticas Integrativas e Complementares">134 - Serviço de Práticas Integrativas e Complementares</option>
                      <option value="135 - Serviço de Reabilitação">135 - Serviço de Reabilitação</option>
                      <option value="139 - Serviço de Triagem Neonatal">139 - Serviço de Triagem Neonatal</option>
                      <option value="140 - Serviço de Urgência e Emergência">140 - Serviço de Urgência e Emergência</option>
                      <option value="141 - Serviço de Vigilância em Saúde ">141 - Serviço de Vigilância em Saúde </option>
                      <option value="142 - Serviço de Endoscopia">142 - Serviço de Endoscopia</option>
                      <option value="145 - Serviço de Diagnóstico por Laboratório Clínico">145 - Serviço de Diagnóstico por Laboratório Clínico</option>
                      <option value="149 - Transplante">149 - Transplante</option>
                      <option value="150 - Cirurgia Vascular">150 - Cirurgia Vascular</option>
                      <option value="151 - Medicina Nuclear">151 - Medicina Nuclear</option>
                      <option value="153 - Atenção Especializada no Processo Transexualizador">153 - Atenção Especializada no Processo Transexualizador</option>
                      <option value="154 - Serviço de Banco de Tecidos">154 - Serviço de Banco de Tecidos</option>
                      <option value="155 - Serviço de Traumatologia  Ortopedia">155 - Serviço de Traumatologia  Ortopedia</option>
                      <option value="157 - Serviço de Laboratorio de Protese Dentaria">157 - Serviço de Laboratorio de Protese Dentaria</option>
                      <option value="164 - Serviço de Órteses,Próteses e Materiais Especiais em Reabilitação">164 - Serviço de Órteses,Próteses e Materiais Especiais em Reabilitação</option>
                      <option value="165 - Atenção às Pessoas em Situação de Violência Sexual">165 - Atenção às Pessoas em Situação de Violência Sexual</option>
                      <option value="168 - Atenção Às Pessoas com Doenças Raras">168 - Atenção Às Pessoas com Doenças Raras</option>
                      <option value="169 - Serviço de Atenção em Urologia">169 - Serviço de Atenção em Urologia</option>
                      
                    </datalist>

                  </div>
                  <div class="w-3/4 mr-1">

                        <div class="border border-1 border-gray-300 m-1 my-2 py-3 rounded-md">
                          <span v-for="s in form.servicos" :key="s.id" class="block ml-4"> {{ s.id }} - {{ s.servico }} <button>xxx</button></span>
                        </div>
                      
                      </div>
                  </div>

                  <div class="flex mb-4">

                      <div class="w-2/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">Endereço</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="cnes" type="text"
                          placeholder=""
                          v-model="form.endereco"                          
                          >
                      </div>

                      <div class="w-1/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">Bairro</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="cnes" type="text"
                          placeholder=""
                          v-model="form.bairro"
                          >
                      </div>

                      <div class="w-1/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">Cidade</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="cnes" type="text"
                          placeholder=""
                          v-model="form.cidade"                          
                          >
                      </div>

                      <div class="w-1/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">Estado</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="cnes" type="text"
                          placeholder=""
                          v-model="form.estado"                          
                          >
                      </div>
                      <div class="w-1/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="observacao">CEP</label>

                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="responsavel" type="text"
                          placeholder=""
                          v-model="form.cep"                     
                         >

                      </div>
                  </div>

                  <div class="flex mb-4">
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="telefone1">Telefone 1</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="telefone1" type="tel"
                          v-model="form.telefone1"                          
                          v-mask="['(##) ####-####', '(##) #####-####']"

                          >
                      </div>
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="peso">Telefone 2</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="telefone2" type="tel"
                          v-model="form.telefone2"    
                          v-mask="['(##) ####-####', '(##) #####-####']"
                          >
                      </div>
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="peso">Telefone 3</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="telefone3" type="tel"
                          v-model="form.telefone3"                          
                          v-mask="['(##) ####-####', '(##) #####-####']"
                          >
                      </div>
                      <div class="w-1/2 ml-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="perimetro_cefalico">Email</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="email" type="email"
                          v-model="form.email"                                                    
                          >
                      </div>
                  </div>
                  <button class="float-right text-gray-400"
                    @click.prevent="() => refkey = !refkey"
                  >
                    <i class="fa fa-key" aria-hidden="true"></i>
                  </button>

                  <div class="flex mb-4" v-show="refkey">
                    <div class="w-full ml-1">
                      <label class="block text-grey-darker text-lg font-bold mb-2"
                      for="perimetro_cefalico">Chave</label>
                      <input class="appearance-none border rounded w-full
                      py-2 px-3 text-grey-darker" type="password" autocomplete="off"
                      v-model="form.chave_codigo"                                                    
                      >
                    </div>                    
                  </div>

                  <div class="flex rounded-md bg-red-50 p-4 text-sm text-red-500" x-cloak x-show="showAlert" x-data="{ showAlert: true }"
                  v-if="form.hasErrors"
                  >
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-3 h-5 w-5 flex-shrink-0">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                      </svg>
                      <div>
                        <h4 class="font-bold">Pendência</h4>
                        <div class="mt-1">
                          <ul class="list-inside list-disc">
                            <li v-for="error, index in form.errors" :key="index" >{{ error }}</li>
                          </ul>
                        </div>
                      </div>
                  </div>

              </div>

          </div>
        </div>

<!-- ---{{ unidade.servicos[0].pivot.unidade_id }} -->

        <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
          <button class="text-white bg-red-500 hover:bg-red-400
          active:bg-red-600 font-bold text-md px-4 py-2 rounded outline-none focus:outline-none
            mr-1 mb-1 ease-linear transition-all duration-150"
          type="submit"
          :="form.processing"
          :class="{ 'opacity-25': form.processing }"
          >
            <i v-if="form.processing">Editando</i>
            <i v-else >
              Salvar
            </i>
          </button>
        </div>

      </form>
    </div>

  </Modal>
    </template>

  <script setup>
  import { Link, useForm } from "@inertiajs/vue3";
  import Modal from '@/Components/Modal.vue'
  import Aviso from '@/Components/Aviso.vue'
  import { nextTick, ref, onMounted} from 'vue';
  import DangerButton from '@/Components/DangerButton.vue';

  // Funções do Módulo Unidade
  const props = defineProps({
    unidade: {
        type: Object
    },

  })

  const refkey = ref(false);

  onMounted(() => {
    if(props.unidade){
      props.unidade.servicos.forEach(s => {
        form.servicos.push({'id' : s.pivot.unidade_id, 'servico' : s.pivot.servico_id})
      });
      console.log('pronto')
    }
  })
    const form = useForm({
      id: props.unidade.id ,
      nome_fantasia: props.unidade.nome_fantasia ,
      cnpj: props.unidade.cnpj ,
      cnes: props.unidade.cnes ,
      responsavel: props.unidade.responsavel ,
      telefone1: props.unidade.telefone1 ,
      telefone2: props.unidade.telefone2 ,
      telefone3: props.unidade.telefone1 ,
      email: props.unidade.email ,
      logotipo: props.unidade.logotipo,
      chave_codigo: '',
      servico: '',
      servicos: [],
      url: props.unidade.logotipo ? '../storage/'+props.unidade.logotipo : ''
  })

  function previewImage(e) {
            const file = e.target.files[0];
            form.url = URL.createObjectURL(file);
        }


function adicionarServico() {

  if(form.servico) {
    const servico = form.servico.split(' - ')
    const serv = form.servicos.find(s => s.id === servico[0])
    if(serv == undefined){
      form.servicos.push({'id' : servico[0], 'servico' : servico[1]})
      form.servico = ''
    }
  }
}

function editarUnidade(){
  if(form.nome_fantasia != '' && form.cnpj != '' && form.cnes != '' ){
    form.post(route('unidades.store'),{
        forceFormData: true,
    })
  }
}

  // Controle do Modal
  const confirmar = ref(false);

  const abrirModal = () => {
  confirmar.value = true;
  };

  const closeModal = () => {
    confirmar.value = false;
  };



  </script>

  <script>
  import {mask} from 'vue-the-mask'
  
  export default {
    directives: {mask}
  }


</script>
