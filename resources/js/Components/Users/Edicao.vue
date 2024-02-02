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
        Gerenciamento de Usuário - Edição
      </h1>
    </div>

    <div class="mx-2 px-6 rounded text-md w-full bg-gray-100">

      <form @submit.prevent="editarUserAux()" class="w-full">

        <div class="flex gap-3 mt-5">

          <div class="w-1/4">
            <label class="font-bold text-md text-gray-600" for="nome">Nome</label>
            <input
                id="name"
                name="name"
                type="text"
                class="w-full rounded h-12 text-md text-gray-500 font-bold"
                v-model="form.name"
                :input="form.name = form.name.replace(/[^A-Z ]/g, '')"
                placeholder="Digite o nome do usuário"
                autofocus autocomplete="name"
            />
            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                {{ form.errors.name }}
            </div>

        </div>
      
        <div class="w-1/4">

          <label class="font-bold text-md text-gray-600" for="cpf">CPF</label>
          <input
              id="cpf"
              type="text"
              class="w-full rounded h-12 text-md text-gray-500 font-bold"
              placeholder="Digite o cpf do usuário"
              v-model="form.cpf"
              v-mask="'###.###.###-##'"
          />
            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                {{ form.errors.cpf }}
            </div>
            
          </div>

          <div class="w-1/4">

          <label class="font-bold text-md text-gray-600" for="email">Email</label>
          <input
              id="email"
              type="email"
              class="w-full rounded h-12 text-md text-gray-500 font-bold"
              placeholder="Digite o email do usuário"
              v-model="form.email"
          />
            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                {{ form.errors.email }}
            </div>
            
          </div>

        
          <div class="w-1/4">
            <label class="font-bold text-md text-gray-600" for="acesso">Acesso</label>
            <!-- <input id="access" type="access" class="mt-1 block w-full" v-model="form.access"  autocomplete="username" /> -->
            <select
            name="access"
              id="access"
              class="w-full rounded h-12 text-md text-gray-500 font-bold"
              v-model="form.access"
          >
              <option :value="form.access">{{form.access}}</option>
              <option value="Médico">Médico</option>
              <option value="Recepcionista">Recepcionista</option>
              <option value="Triagem">Triagem</option>
              <option value="Exame">Exame</option>
              <option value="Imagem">Imagem</option>
          </select>
          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
              {{ form.errors.access }}
          </div>

          <InputError class="mt-2" :message="form.errors.access" />
      </div>
      
    </div>

    <div class="flex gap-3 mt-5">
      
      <div class="w-1/2">
        <label class="font-bold text-md text-gray-600" for="acesso">Setor</label>
        <!-- <input id="access" type="access" class="mt-1 block w-full" v-model="form.access"  autocomplete="username" /> -->
        <select
            name="access"
            id="access"
            class="w-full rounded h-12 text-md text-gray-500 font-bold"
            v-model="form.sector"
        >
            <option value="">Selecione</option>
            <option value="Médico">Médico</option>
            <option value="Recepcionista">Recepcionista</option>
            <option value="Triagem">Triagem</option>
            <option value="Exame">Exame</option>
            <option value="Imagem">Imagem</option>
        </select>
        <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
            {{ form.errors.sector }}
        </div>
        
        <InputError class="mt-2" :message="form.errors.sector" />
      </div>
      
      <div class="w-1/2">
        <label class="font-bold text-md text-gray-600" for="acesso">Serviço</label>
        <!-- <input id="access" type="access" class="mt-1 block w-full" v-model="form.access"  autocomplete="username" /> -->
        <select
            name="access"
            id="access"
            class="w-full rounded h-12 text-md text-gray-500 font-bold"
            v-model="form.service"
        >
            <option value="">Selecione</option>
            <option value="Classificação de Risco">Classificação de Risco</option>
            <option value="Consultório Médico">Consultório Médico</option>
            <option value="Ambulatorial">Ambulatorial</option>
            <option value="Área Administrativa">Área Administrativa</option>
            <option value="Exame">Exame</option>
            <option value="Imagem">Imagem</option>

            <option value="Centro Abastecimento Farmacêutico">Centro Abastecimento Farmacêutico</option>
            <option value="Farmácia">Farmácia</option>
            <option value="Unidade de Terapia Intensiva">Unidade de Terapia Intensiva</option>
            <option value="Posto de Enfermagem">Posto de Enfermagem</option>
            <option value="Serviço de Diagnóstico">Serviço de Diagnóstico</option>
            <option value="Pronto Atendimento">Pronto Atendimento</option>
            <option value="Urgência e Emergência">Urgência e Emergência</option>
        </select>
        <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
          {{ form.errors.service }}
        </div>
        
        <InputError class="mt-2" :message="form.errors.service" />
      </div>
    </div>

    <div class="flex gap-3 mt-5">
      <div class="w-1/2">

        <label class="font-bold text-md text-gray-600" for="password">Senha</label>
        <input
            id="password"
            type="password"
            class="w-full rounded h-12 text-md text-gray-500 font-bold"
            v-model="form.password"  autocomplete="new-password"
            placeholder="Digite a senha"
        />
        <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
            {{ form.errors.password }}
        </div>


      </div>
      <div class="w-1/2">
        <label class="font-bold text-md text-gray-600" for="password_confirmation">Confirme a senha</label>
        <input
            id="password_confirmation"
            type="password"
            class="w-full rounded h-12 text-md text-gray-500 font-bold"
            placeholder="Digite novamente a senha"
            v-model="form.password_confirmation"  autocomplete="new-password"
        />
        <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
            {{ form.errors.password_confirmation }}
        </div>
    </div>
    </div>

      <div class="flex gap-3 mt-5">

        <div class="w-2/6">
          <label class="font-bold text-md text-gray-600" for="password_confirmation">CBO</label>

            <input 
            class="w-full rounded h-12 text-md text-gray-500 font-bold"
            id="cnes" type="text"
            placeholder=""
            list="list_cbos"
            v-model="form.cbo_item" 
            @blur.prevent="extractCbo"
            >
          <datalist id="list_cbos">

            <option value="">Selecione</option>
            <option v-for="c in cbos" :key="c.id" :value="c.cbo+' - '+c.descricao">{{c.cbo}} - {{ c.descricao}}</option>
            
          </datalist>

        </div>

        <div class="W-1/6">
          <label class="font-bold text-md text-gray-600" for="conselho_regional">Conselho</label>
          <input
              id="conselho_regional"
              type="text"
              class="w-full rounded h-12 text-md text-gray-500 font-bold"
              v-model="form.conselho"
              list="list_conselhos"
          />

          <datalist id="list_conselhos">
            <option value="CRM">CRM - CONSELHO REGIONAL DE MEDICINA</option>
            <option value="COREN">COREN - CONSELHO REGIONAL DE ENFERMAGEM</option>
            <option value="CRP">CRP - CONSELHO REGIONAL DE PSICOLOGIA</option>
            <option value="CRO">CONSELHO REGIONAL DE ODONTOLOGIA</option>
            <option value="CRF">CONSELHO REGIONAL DE FISIOTERAPIA</option>
            <option value="CRN">CONSELHO REGIONAL DE NUTRIÇÃO</option>
          </datalist>
          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
              {{ form.errors.conselho }}
          </div>

        </div>

        <div class="W-1/6">
          <label class="font-bold text-md text-gray-600" for="conselho_numero">Conselho Estado</label>

          <select v-model="form.conselho_regional" class="rounded h-12 text-md text-gray-500 font-bold w-full">
            <option value=""></option>
            <option value="AC">AC</option>
            <option value="AL">AL</option>
            <option value="AP">AP</option>
            <option value="AM">AM</option>
            <option value="BA">BA</option>
            <option value="CE">CE</option>
            <option value="DF">DF</option>
            <option value="ES">ES</option>
            <option value="GO">GO</option>
            <option value="MA">MA</option>
            <option value="MT">MT</option>
            <option value="MS">MS</option>
            <option value="MG">MG</option>
            <option value="PA">PA</option>
            <option value="PB">PB</option>
            <option value="PR">PR</option>
            <option value="PE">PE</option>
            <option value="PI">PI</option>
            <option value="RJ">RJ</option>
            <option value="RN">RN</option>
            <option value="RS">RS</option>
            <option value="RO">RO</option>
            <option value="RR">RR</option>
            <option value="SC">SC</option>
            <option value="SP">SP</option>
            <option value="SE">SE</option>
            <option value="TO">TO</option>
          </select>

          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
              {{ form.errors.conselho_regional }}
          </div>

        </div>

        <div class="W-1/6">
          <label class="font-bold text-md text-gray-600" for="conselho_numero">Número do Conselho</label>
          <input
              id="conselho_numero"
              type="text"
              class="w-full rounded h-12 text-md text-gray-500 font-bold"
              v-model="form.conselho_numero"
          />
          <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
              {{ form.errors.conselho_numero }}
          </div>

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

    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
          <button class="text-white bg-red-500 hover:bg-red-400
          active:bg-red-600 font-bold text-md px-4 py-2 rounded outline-none focus:outline-none
            mr-1 mb-1 ease-linear transition-all duration-150"
          type="submit"
          :disabled="form.processing"
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
  import { nextTick, ref } from 'vue';
  import DangerButton from '@/Components/DangerButton.vue';

  // Funções do Módulo UserAux
  const props = defineProps({
    user: {
        type: Object
    },
    cbos: {
      type: Object
    }

  })

    const form = useForm({
      id: props.user.id ,
      name: props.user.name ,
      email: props.user.email ,
      access: props.user.access ,
      password: '',
      password_confirmation: '',
      cbo_codigo: '',
      cbo_descricao: '',
      cbo_item: props.user.prestador.length > 0 ? props.user.prestador[0].cbo_codigo+" - "+props.user.prestador[0].cbo_descricao : '',
      service: props.user.service,
      sector: props.user.sector,
      
      conselho: props.user.prestador.length > 0 ? props.user.prestador[0].conselho : '',
      conselho_regional: props.user.prestador.length > 0 ? props.user.prestador[0].conselho_regional : '',
      conselho_numero: props.user.prestador.length > 0 ? props.user.prestador[0].conselho_numero : '',
  })

function extractCbo(){
  if(form.cbo_item !== ''){
    form.cbo_codigo = form.cbo_item.split(' - ')[0];
    form.cbo_descricao = form.cbo_item.split(' - ')[1];
  }
}

function editarUserAux(){
  if(form.name != '' && form.email != '' && form.access != '' && form.password == form.password_confirmation){
    form.post(route('users.store'),{
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => closeModal(),
    })
  }
}
// function editarUserAux(){
//     form.put(route('userAuxs.update', form.id), {
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
  };

  </script>

<script>
import {mask} from 'vue-the-mask'

export default {
  directives: {mask}
}


</script>

