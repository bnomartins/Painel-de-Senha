<template>

  <button
      class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
      @click="abrirModal"
    >
      Abrir Atendimento
  </button>

  <Modal :show="confirmar" @close="closeModal">


    <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
      <h1 class="text-center m-auto text-3xl font-bold" >
        Abertura de Atendimento
      </h1>
    </div>

      <div class="mx-2 px-6 rounded text-xl w-full bg-gray-100">

      <form @submit.prevent="abrirAtendimento()" class="w-full">

      <!-- Dados Paciente -->
      <div class="w-full bg-grey-lightest mt-2">
        <div class="container mx-auto py-2 min-w-min">
        <div class="w-6/6 lg:w-6/6 sm:min-w-sm mx-auto bg-white rounded-xl shadow  border border-2 border-grey-lighter">
            <div class="py-4 px-8 text-black text-2xl font-bold border border-2 border-grey-lighter">
                Dados Cadastrais
            </div>
                <div class="px-8">

                  <div class="flex mb-4">

                    <div class="flex-shrink-0 w-1/5 h-30 w-30 text-blue-500 pl-10">

                      <label for="foto" class="w-full text-center">

                          <img
                              class="rounded-full h-20 w-20"
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
                        @input=" form.foto = $event.target.files[0] "
                        @change="previewImage"
                        class="hidden"
                        id="foto"
                      />


                    </div>


                    <div class="w-1/3 mr-1">
                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="cpf">CPF</label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                          type="text" placeholder="CPF"
                          v-model="form.cpf"
                          v-mask="'###.###.###-##'"
                          disabled
                        >

                          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                              {{ form.errors.cpf }}
                          </div>
                          <i v-if="form.processing" class="bg-green-100 my-2 px-5 text-green-700 text-bold font-semibold text-md animate-pulse">
                            Aguarde consultando CPF ...
                          </i>

                          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md"
                          v-if="refAtendimentosAberto">
                              Já existe atendimento aberto para o CPF informado
                          </div>
                    </div>


                    <div class="w-1/3 mr-1">
                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="registro">Certidão de Nasc.</label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                        type="text" placeholder="N.º Certidão de Nascimento"
                        v-model="form.registro"
                        v-mask="'######.##.##.####.#.#####.###.#######-##'"
                        >
                          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                            {{ form.errors.registro }}
                          </div>
                    </div>

                    <div class="w-1/3 mr-1">
                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="registro">N.º Cartão SUS</label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                        type="text" placeholder="Cartão SUS"
                        v-model="form.cartao_sus"
                        v-mask="'###############'"
                        >
                          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                            {{ form.errors.cartao_sus }}
                          </div>
                    </div>
                  </div>

                </div>
                <div
                  class="py-4 px-8"
                  :disabled="form.processing || refAtendimentosAberto"
                  :class="{ 'opacity-25': form.processing ||  refAtendimentosAberto}"
                >


                    <div class="flex mb-4">
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="rg_numero">RG</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="rg_numero" type="number" min="0"
                          v-model="form.rg_numero"
                        >
                      </div>
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="rg_orgao">Órgão Exp.</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="rg_orgao" type="text"
                          v-model="form.rg_orgao"
                          >
                      </div>
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="rg_data">Data Exp.</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="rg_data" type="date"
                          v-model="form.rg_data"                          
                          >
                      </div>
                  </div>

                    <div class="flex mb-4">
                        <div class="w-1/3 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="nome">Nome <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                              type="text" placeholder="Nome"
                              v-model="form.nome"
                              :input="form.nome = form.nome.replace(/[^A-Za-z ]/g, '')"
                              :class="{'ring-4 ring-red-300' : form.errors.nome}"
                            >
                        </div>


                        <div class="w-1/3 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="nome_social">Nome Social</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            type="text" placeholder="Nome Social"
                            :input="form.nome_social = form.nome_social.replace(/[^A-Za-z ]/g, '')"
                            v-model="form.nome_social"
                            >
                        </div>

                        <div class="flex mb-4">
                          <div class="w-1/3 mr-1">
                              <label class="block text-grey-darker text-lg font-bold mb-2"
                              for="nascimento">Dt. Nasc. <span class="text-red-700 font-bold text-lg">*</span></label>
                              <input class="appearance-none border rounded w-full
                              py-2 px-3 text-grey-darker"
                              type="date"
                              v-model="form.nascimento"
                              :class="{'ring-4 ring-red-300' : form.errors.nascimento}"
                              >
                          </div>

                          <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="raca">Cor/Raça</label>
                            <select name="raca" id="raca" 
                            class="appearance-none border rounded w-full uppercase" 
                            v-model="form.raca"
                            :class="{'ring-4 ring-red-300' : form.errors.raca}"
                            >
                              <option value=""></option>
                              <option value="Branco">Branco</option>
                              <option value="Negro">Negro</option>
                              <option value="Pardo">Pardo</option>
                              <option value="Amarelo">Amarelo</option>
                              <option value="Indigena">Indigena</option>
                            </select>

                          </div>

                          <div class="w-1/4 mr-1">
                              <label class="block text-grey-darker text-lg font-bold mb-2"
                              for="sexo">Sexo <span class="text-red-700 font-bold text-lg">*</span></label>
                              <select name="sexo" id="sexo" class="appearance-none border rounded w-full"
                              v-model="form.sexo"
                              :class="{'ring-4 ring-red-300' : form.errors.sexo}"
                            >
                                <option value=""></option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                              </select>
                              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                              </div>
                            </div>


                          <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="aborh">ABO</label>
                            <select name="sexo" id="sexo" 
                              class="appearance-none border rounded w-full" 
                              v-model="form.aborh">
                              <option value=""></option>
                              <option value="OP">O+</option>
                              <option value="AP">A+</option>
                              <option value="BP">B+</option>
                              <option value="ABP">AB+</option>
                              <option value="ON">O-</option>
                              <option value="AN">A-</option>
                              <option value="BN">B-</option>
                              <option value="ABN">AB-</option>
                            </select>
                        </div>

                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="estado_civil">Estado Cívil</label>

                            <select name="estado_civil" id="estado_civil" 
                              class="appearance-none border rounded w-full" 
                              v-model="form.estado_civil">
                                <option value=""></option>
                                <option value="SOLTEIRO">SOLTEIRO</option>
                                <option value="CASADO">CASADO</option>
                                <option value="SEPARADO">SEPARADO</option>
                                <option value="DIVORCIADO">DIVORCIADO</option>
                                <option value="VIÚVO">VIÚVO</option>
                          </select>

                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="conjuge">Conjuge</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker"
                            type="text"
                            v-model="form.conjuge"
                            :input="form.conjuge = form.conjuge.replace(/[^A-Za-z ]/g, '')"
                            placeholder="">
                        </div>

                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="registro">Nome da Mãe <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker"
                            type="text"
                            :class="{'ring-4 ring-red-300' : form.errors.mae}"
                            v-model="form.mae"
                            :input="form.mae = form.mae.replace(/[^A-Za-z ]/g, '')"
                            placeholder="">
                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="registro">Nome do Pai <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker"
                            type="text"
                            v-model="form.pai"
                            :class="{'ring-4 ring-red-300' : form.errors.pai}"
                            :input="form.pai = form.pai.replace(/[^A-Za-z ]/g, '')"
                            placeholder="">
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_cep">CEP</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_cep" type="text"
                            v-model="form.endereco_cep"
                            v-mask="'##.###-###'"
                            >
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco">Endereço</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco" type="text"
                            v-model="form.endereco">
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_numero">Número</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_numero" type="text"
                            v-model="form.numero">
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_complemento">Complemento</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_complemento" type="text"
                            v-model="form.endereco_complemento">
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_bairro">Bairro</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_bairro" type="text"
                            v-model="form.endereco_bairro"
                            :input="form.endereco_bairro = form.endereco_bairro.replace(/[^A-Za-z ]/g, '')"
                            >
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_cidade">Cidade</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_cidade" type="text"
                            v-model="form.endereco_cidade"
                            :input="form.endereco_cidade = form.endereco_cidade.replace(/[^A-Za-z ]/g, '')"                            
                            >
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_estado">Estado</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_estado" type="text"
                            v-model="form.endereco_estado"
                            :input="form.endereco_estado = form.endereco_estado.replace(/[^A-Za-z ]/g, '')"                           
                            >
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_telefone1">Telefone 1 <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="contato_telefone1" type="text"
                            v-model="form.contato_telefone1"
                            :class="{'ring-4 ring-red-300' : form.errors.contato_telefone1}"
                            v-mask="['(##) ####-####', '(##) #####-####']"
                            >
                            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                            </div>
                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_telefone2">Telefone 2</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="contato_telefone2" type="text"
                            v-model="form.contato_telefone2"
                            v-mask="['(##) ####-####', '(##) #####-####']"                            
                            >
                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_telefone3">Telefone 2</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="contato_telefone3" type="text"
                            v-model="form.contato_telefone3"
                            v-mask="['(##) ####-####', '(##) #####-####']"                            
                            >
                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_email">Email</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="contato_email" type="email"
                            v-model="form.contato_email">
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
    </div>

          <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-white bg-red-500 hover:bg-red-400
            active:bg-red-600 font-bold text-2xl px-4 py-2 rounded outline-none focus:outline-none
              mr-1 mb-1 ease-linear transition-all duration-150"
            type="submit"
            :disabled="form.processing"
            :class="{ 'opacity-25': form.processing }"
            >
                <i v-if="form.processing">
                    Processando
                </i>

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
  import { nextTick, ref } from 'vue';
  import DangerButton from '@/Components/DangerButton.vue';

  // Funções do Módulo Atendimento
  const props = defineProps({
    paciente: {
        type: Object
    },

  })

    const form = useForm({
    id: props.paciente ? props.paciente.id : '',
    foto: props.paciente ? props.paciente.foto : '',
    url: '',
    cpf: props.paciente ? props.paciente.cpf : '',
    registro: props.paciente ? props.paciente.registro : '',
    cartao_sus: props.paciente ? props.paciente.cartao_sus : '',
    rg_numero: props.paciente ? props.paciente.rg_numero : '',
    rg_orgao: props.paciente ? props.paciente.rg_orgao: '',
    rg_data: props.paciente ? props.paciente.rg_data : '',
    nome: props.paciente ? props.paciente.nome : '',
    nome_social: props.paciente ? props.paciente.nome_social : '',
    nascimento: props.paciente ? props.paciente.nascimento : '',
    raca: props.paciente ? props.paciente.raca : '',
    sexo: props.paciente ? props.paciente.sexo : '',
    aborh: props.paciente ? props.paciente.aborh : '',
    estado_civil: props.paciente ? props.paciente.estado_civil : '',
    conjuge: props.paciente ? props.paciente.conjuge : '',
    mae: props.paciente ? props.paciente.mae : '',
    pai: props.paciente ? props.paciente.pai : '',
    cep: props.paciente ? props.paciente.cep : '',
    endereco: props.paciente ? props.paciente.endereco : '',
    endereco_numero: props.paciente ? props.paciente.endereco_numero : '',
    endereco_complemento: props.paciente ? props.paciente.endereco_complemento : '',
    endereco_bairro: props.paciente ? props.paciente.endereco_bairro : '',
    endereco_cidade: props.paciente ? props.paciente.endereco_cidade : '',
    endereco_estado: props.paciente ? props.paciente.endereco_estado : '',
    contato_telefone1: props.paciente ? props.paciente.contato_telefone1 : '',
    contato_telefone2: props.paciente ? props.paciente.contato_telefone2 : '',
    contato_telefone3: props.paciente ? props.paciente.contato_telefone3 : '',
    contato_email: props.paciente ? props.paciente.contato_email : '',
    status: 'Aguardando Triagem'

  })

function abrirAtendimento(){
  if(form.nome != '' && form.cpf != ''){
    form.post(route('atendimentos.store', form.id),{
      onSuccess: () => closeModal(),
    })
  }
}

function previewImage(e) {
            const file = e.target.files[0];
            form.url = URL.createObjectURL(file);
        }


// function abrirAtendimento(){
//     form.put(route('pacientes.update', form.id), {
//       onSuccess: closeModal()
//     });
// }

  // Controle do Modal
  const confirmar = ref(false);

  const abrirModal = () => {
  confirmar.value = true;
  };

  const closeModal = () => {
    confirmar.value = false;
    form.reset();
  };



  </script>

<script>
import {mask} from 'vue-the-mask'

export default {
  directives: {mask}
}


</script>
