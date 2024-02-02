<template>

<div class="flex align-center justify-center">

    <button
    class="my-2 mx-4 px-2 bg-transparent
    border border-indigo-700 text-indigo-700
    hover:bg-indigo-600 hover:text-white rounded
    shadow-lg text-xl font-bold
    "
    @click="abrirModal"
    >
      Novo Atendimento
  </button>

</div>

<Modal :show="confirmar" @close="closeModal">


  <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
    <h1 class="text-center m-auto text-2xl font-bold" >
      Abertura de Atendimento
    </h1>
  </div>


  <div class="mx-2 px-6 rounded text-md w-full ">

    <form @submit.prevent="cadastrarAtendimento()" class="w-full">

      <aviso />
      
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
                        accept="image/*" capture="camera"                        placholder="Digite o resultado"
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
                          @blur.prevent="existePaciente('cpf')"
                        >

                    </div>

                    <div class="w-1/3 mr-1">
                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="registro">Certidão de Nasc.</label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                        type="text" placeholder="N.º Certidão de Nascimento"
                        v-model="form.registro"
                        v-mask="'######.##.##.####.#.#####.###.#######-##'"
                        @blur.prevent="existePaciente('registro')"
                        >


                    </div>

                    <div class="w-1/3 mr-1">
                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="cartao_sus">N.º Cartão SUS</label>
                        <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                        type="text" placeholder="Cartão SUS"
                        v-model="form.cartao_sus"
                        v-mask="'###############'"
                        @blur.prevent="existePaciente('cartao_sus')"
                        >
                    </div>
                </div>

                <div class="w-full">
                    <div v-if="form.processing" class="bg-green-100 my-2 px-5 text-green-700 text-bold font-semibold text-md animate-pulse w-full">
                        Aguarde consultando ...
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md w-full"
                    v-if="refAtendimentosAberto">
                        Já existe atendimento aberto para o Documento informado
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                        {{ form.errors.cartao_sus }}
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                        {{ form.errors.registro }}
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                        {{ form.errors.cpf }}
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md"
                    v-if="refCartaoSUSInvalido">
                        O Número do Cartão SUS informado é Inválido
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md"
                    v-if="refRegistroInvalido">
                        O Número da Certidão de Nascimento é Inválida
                    </div>

                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md"
                    v-if="refCpfInvalido">
                        O Número do CPF informado é Inválido
                    </div>

                </div>

                </div>
                <div
                  class="py-4 px-8"
                  :disabled="form.processing || refAtendimentosAberto || refInicio"
                  :class="{ 'opacity-25': form.processing ||  refAtendimentosAberto || refInicio}"
                >

                    <div class="flex mb-4">
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="Perimetro_cefalico">RG</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="rg_numero" type="number" min="0"
                          v-model="form.rg_numero"                         
                        >
                      </div>
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="rh_orgao">Órgão Exp.</label>
                          <input class="appearance-none border rounded w-full uppercase
                          py-2 px-3 text-grey-darker" id="rh_orgao" type="text"
                          v-model="form.rg_orgao"
                          placeholder="">
                      </div>
                      <div class="w-1/2 mr-1">
                          <label class="block text-grey-darker text-lg font-bold mb-2"
                          for="rh_data">Data Exp.</label>
                          <input class="appearance-none border rounded w-full
                          py-2 px-3 text-grey-darker" id="rh_data" type="date"
                          v-model="form.rg_data"                          
                        >
                      </div>
                  </div>

                    <div class="flex mb-4">
                        <div class="w-1/3 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="nome">Nome <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker uppercase"
                              type="text" placeholder="Nome"
                              v-model="form.nome"
                              :input="form.nome = form.nome.replace(/[^A-Za-z ]/g, '')"
                              :class="{'ring-4 ring-red-300' : form.errors.nome}"
                            >
                        </div>


                        <div class="w-1/3 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="nome_social">Nome Social</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker uppercase"
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
                            <select 
                              name="raca" 
                              id="raca" 
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
                              <select 
                                name="sexo" 
                                id="sexo" 
                                class="appearance-none border rounded w-full uppercase" 
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
                            <select 
                              name="sexo" 
                              id="sexo" 
                              class="appearance-none border rounded w-full" 
                              v-model="form.aborh"
                            >
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
                          </select>                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="conjuge">Conjuge</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker"
                            type="text"
                            v-model="form.conjuge"
                            :input="form.conjuge = form.conjuge.replace(/[^A-Za-z ]/g, '')"
                            placeholder="">
                        </div>

                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="registro">Nome da Mãe <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full uppercase
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
                            <input class="appearance-none border rounded w-full uppercase
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
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="endereco_cep" type="text"
                            v-model="form.endereco_cep"
                            v-mask="'##.###-###'"
                            >
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco">Endereço</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="endereco" type="text"
                            v-model="form.endereco"
                            >
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_numero">Número</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="endereco_numero" type="number" min="0"
                            v-model="form.numero"
                            >
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_complemento">Complemento</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="endereco_complemento" type="text"
                            v-model="form.endereco_complemento">
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_bairro">Bairro</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="endereco_bairro" type="text"
                            :input="form.endereco_bairro = form.endereco_bairro.replace(/[^A-Za-z ]/g, '')"
                            v-model="form.endereco_bairro">
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_cidade">Cidade</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="endereco_cidade" type="text"
                            :input="form.endereco_cidade = form.endereco_cidade.replace(/[^A-Za-z ]/g, '')"
                            v-model="form.endereco_cidade">
                        </div>
                        <div class="w-1/2 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="endereco_estado">Estado</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="endereco_estado" type="text"
                            :input="form.endereco_estado = form.endereco_estado.replace(/[^A-Za-z ]/g, '')"
                            v-model="form.endereco_estado">
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_telefone1">Telefone 1 <span class="text-red-700 font-bold text-lg">*</span></label>
                            <input class="appearance-none border rounded w-full uppercase
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
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="contato_telefone2" type="text"
                            v-model="form.contato_telefone2"
                            v-mask="['(##) ####-####', '(##) #####-####']"
                            >
                          </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_telefone3">Telefone 3</label>
                            <input class="appearance-none border rounded w-full uppercase
                            py-2 px-3 text-grey-darker" id="contato_telefone3" type="text"
                            v-mask="['(##) ####-####', '(##) #####-####']"
                            v-model="form.contato_telefone3">
                        </div>
                        <div class="w-1/4 mr-1">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="contato_email">Email</label>
                            <input class="appearance-none border rounded w-full uppercase
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
        <button class="bg-blue-600 hover:bg-blue-400 text-white
        text-xl font-bold py-2 px-4 rounded-xl mr-2"
        type="submit"
        :disabled="form.processing || refAtendimentosAberto"
        :class="{ 'opacity-25': form.processing ||  refAtendimentosAberto}"
        >
          <i v-if="form.processing">Consultando</i>
          <i v-else >
            Salvar
          </i>
        </button>

        <button class="bg-yellow-500 hover:bg-yellow-300
        text-xl font-bold py-2 px-4 rounded-xl"
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
</Modal>
  </template>

<script setup>
import { Link, router, useForm } from "@inertiajs/vue3";
import Modal from '@/Components/Modal.vue'
import { nextTick, ref } from 'vue';
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    paciente: Object
    }
)


// Controle de Formulário
const form = useForm({
    id: '',
    foto: '',
    url: '',
    cpf: '',
    registro: '',
    cartao_sus: '',
    rg_numero: '',
    rg_orgao: '',
    rg_data: '',
    nome: '',
    nome_social: '',
    nascimento: '',
    raca: '',
    sexo: '',
    aborh: '',
    estado_civil: '',
    conjuge: '',
    mae: '',
    pai: '',
    cep: '',
    endereco: '',
    endereco_numero: '',
    endereco_complemento: '',
    endereco_bairro: '',
    endereco_cidade: '',
    endereco_estado: '',
    contato_telefone1: '',
    contato_telefone2: '',
    contato_telefone3: '',
    contato_email: '',
    tipo: '',
    status: 'Aguardando Triagem'

})

const refInicio = ref(true)
const refAtendimentosAberto = ref(false)
const refCpfInvalido = ref(false)
const refRegistroInvalido = ref(false)
const refCartaoSUSInvalido = ref(false)

const limparFormulario = () => {
    form.id = ''

    form.foto = ''

    form.cpf = ''
    form.registro = ''
    form.cartao_sus = ''
    form.rg_numero = ''
    form.rg_orgao = ''
    form.rg_data = ''

    form.nome = ''
    form.nome_social = ''
    form.nascimento = ''
    form.raca = ''
    form.sexo = ''
    form.aborh = ''
    form.estado_civil = ''
    form.conjuge = ''
    form.mae = ''
    form.pai = ''
    form.cep = ''

    form.endereco = ''
    form.endereco_complemento = ''
    form.endereco_bairro = ''
    form.endereco_cidade = ''
    form.endereco_estado = ''

    form.contato_telefone1 = ''
    form.contato_telefone2 = ''
    form.contato_telefone3 = ''
    form.contato_email = ''
    form.url = ''

    form.tipo = ''

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

// Funções do Módulo Atendimento
  function cadastrarAtendimento(){

      form.post(route('atendimentos.store'), {
        forceFormData: true,
        onSuccess: () => (
          closeModal()
          ),
        });

  }

  function previewImage(e) {
            const file = e.target.files[0];
            form.url = URL.createObjectURL(file);
        }

  function existePaciente(tipo){
    if(tipo == 'cpf' && form.cpf !== ''){
        if(form.cpf.toString().length === 14){
            form.tipo = 'cpf'

        form.get(route('atendimentos.docsSearch'),{
            only: ['paciente', 'pacientes'],
            cpf: form.cpf,
            onSuccess: ()=>{
                form.id = props.paciente[0] ? props.paciente[0].id : ''
                form.nome = props.paciente[0] ? props.paciente[0].nome:''

                contarAtendimentoAberto(props.paciente)

            },
            preserveState: true
            //   onSuccess: () => closeModal(),
        })
        refCartaoSUSInvalido.value = false
        refCpfInvalido.value = false
        refRegistroInvalido.value = false
    } else {
        refCartaoSUSInvalido.value = false
        refCpfInvalido.value = true
        refRegistroInvalido.value = false

    }
}

    if(tipo == 'registro'  && form.registro !== ''){


        if(form.registro.toString().length > 0){
            form.tipo = 'registro'

        form.get(route('atendimentos.docsSearch'),{
            only: ['paciente', 'pacientes'],
            registro: form.registro,
            onSuccess: ()=>{
                form.id = props.paciente[0] ? props.paciente[0].id : ''
                form.nome = props.paciente[0] ? props.paciente[0].nome:''

                contarAtendimentoAberto(props.paciente)

            },
            preserveState: true
            //   onSuccess: () => closeModal(),
        })
        refCartaoSUSInvalido.value = false
        refCpfInvalido.value = false
        refRegistroInvalido.value = false
    } else {
        refCartaoSUSInvalido.value = false
        refCpfInvalido.value = false
        refRegistroInvalido.value = true

    }
}

    if(tipo == 'cartao_sus'  && form.cartao_sus !== ''){

        if(form.cartao_sus.toString().length == 15){

        form.tipo = 'cartao_sus'

            form.get(route('atendimentos.docsSearch'),{
            only: ['paciente'],
            cartao_sus: form.cartao_sus,
            onSuccess: ()=>{
                form.id = props.paciente[0] ? props.paciente[0].id : ''
                form.nome = props.paciente[0] ? props.paciente[0].nome:''

                contarAtendimentoAberto(props.paciente)

            },
            preserveState: true
            //   onSuccess: () => closeModal(),
        })
        refCartaoSUSInvalido.value = false
        refCpfInvalido.value = false
        refRegistroInvalido.value = false
    } else {
        refCartaoSUSInvalido.value = true
        refCpfInvalido.value = false
        refRegistroInvalido.value = false

    }
}


}

const contarAtendimentoAberto = (paciente) => {
    if(paciente[0]){
        if(paciente[0].atendimentos){
            const atend = paciente[0].atendimentos.filter(i => {
                return i.dthrfim == null
            });

            console.log(atend)

            if(atend.length > 0){
                refAtendimentosAberto.value = true
                refInicio.value = false
            } else {
                refAtendimentosAberto.value = false
                refInicio.value = false
            }

        } else {
            refAtendimentosAberto.value = false
            refInicio.value = false
        }
    } else {
    refAtendimentosAberto.value = false
    refInicio.value = false
}

}


</script>
<script>
import {mask} from 'vue-the-mask'

export default {
  directives: {mask}
}


</script>