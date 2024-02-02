<template>

<button
    class="my-2 mx-4 px-2 border-4 border-indigo-700 text-indigo-700 hover:bg-indigo-600 hover:text-white rounded shadow-lg text-lg font-bold p-2"
    :class="{'bg-emerald-300' : form.chamar && refDesativar != true ,
        'text-emerald-800': form.chamar && refDesativar != true ,
        'animate-pulse': form.chamar && refDesativar != true,
        'border-emerald-800' : form.chamar && refDesativar != true}"
    @click="abrirModal"
    :disabled="refDesativar"
    >
    <span v-if="form.chamar">
        <i class="fa-solid fa-bullhorn fa-xl" ></i>
    </span>
    <span v-else>
        <i class="fa-solid fa-bullhorn fa-xl" ></i>
    </span>

</button>
<!-- meu id: {{ page.props.auth.user.id }} -  -->
<!-- id trigista: {{ props.atendimento.triagem ?  props.atendimento.triagem[0].user_id : 'tnot'  }} -  -->
<!-- id medico: {{ props.atendimento.clinico ?  props.atendimento.clinico[0].user_id : 'cnot'  }}========= -->
<!-- {{ props.atendimento }} -->
<!-- {{  props.atendimento.triagem  }} -->
<!-- {{  props.atendimento.triagem[0] ? 'tok' : 'tnok'  }} -->
<Modal :show="confirmar" @close="closeModal">


  <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
    <h1 class="text-center m-auto text-3xl font-bold" >
      Painel de Senha - Chamar Senha
    </h1>
  </div>


    <div class="px-6 border rounded text-xl w-full">
      <div class="bg-emerald-100 py-20"  v-show="form.chamar === true">
        <p class="text-center font-bold animate-bounce text-emerald-600 my-5" style="font-size:9vh; line-height: 1.1em;">
          Chamando Paciente <br> {{ form.paciente_nome }}
        </p>
        <p class="text-center font-bold text-emerald-600 my-5" style="font-size:5vh; line-height: 1.1em;">
          Local:<br>{{ $page.props.auth.user.room }}

        </p>
      </div>

      <div class="py-20"  v-show="form.chamar === false">
        <p class="text-center font-bold text-red-500 my-5" style="font-size:8vh; line-height: 1.1em;">
          Clique no botão abaixo para chamar
        </p>
      </div>

      <!-- <p>
        Paciente: {{ form.paciente_nome }} <br>
        Atendimento id: {{ form.id }} <br>
        Profisional_id: {{ $page.props.auth.user.id }} <br>
        Profisional: {{ $page.props.auth.user.name }} <br>
        Sala: {{ $page.props.auth.user.room }} <br>
        chamar: {{ form.chamar }}
      </p> -->
      <!-- <p class="text-red-500 font-bold text-3xl text-center">Enquanto você ficar nessa tela a senha será chamada</p> -->
    <form @submit.prevent="chamarSenha()" class="w-full">

        <div class="flex items-center justify-center p-6 border-t border-solid border-slate-200 rounded-b">
          <button class="text-white bg-red-500 hover:bg-red-400
          active:bg-red-600 font-bold text-4xl px-4 py-2 rounded outline-none focus:outline-none
            mr-1 my-5 ease-linear transition-all"
          type="submit"
          :disabled="form.processing"
          :class="{ 'opacity-25': form.processing }"
          v-show="form.chamar === false"
          >
            Chamar
          </button>

            <br>

          <button class="text-white bg-red-500 hover:bg-red-400
          active:bg-red-600 font-bold text-4xl px-4 py-2 rounded outline-none focus:outline-none
            mr-1 my-5 ease-linear transition-all"
          type="submit"
          :disabled="form.processing"
          :class="{ 'opacity-25': form.processing }"
          v-show="form.chamar === true"
          >
            <i v-if="form.processing">Salvando</i>
            <i v-else >
              Parar de Chamar
            </i>
          </button>

          <!-- {{ form }} -->
        </div>

      </form>
  </div>
</Modal>
  </template>

<script setup>
import { Link, useForm, usePage} from "@inertiajs/vue3";
import Modal from '@/Components/Modal.vue'
import Aviso from '@/Components/Aviso.vue'
import { nextTick, ref, computed } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';

const page = usePage()

const user = computed(() => page.props.auth.user)

//
const props = defineProps({
  paciente: {
    type: Object
  },
  atendimento: {
    type: Object
  }
})

// Paciente: {{ form.name }} <br>
// Atendimento id: {{ form.id }} <br>
// chamar: {{ form.chamar }}

const refDesativar = ref(false)

// Controle de Formulário
const form = useForm({
  atendimento_id: props.atendimento.id,
  paciente_id: props.paciente.id,
  paciente_nome: props.paciente.nome,
  user_local: user.room,


  chamar: props.atendimento.chamar ? true : false,


})



if(props.atendimento.triagem[0]){

  // {{ props.atendimento.clinico ?  props.atendimento.clinico[0].user _id : 'cnot'  }}=========
  // props.atendimento.clinico ?  props.atendimento.clinico[0].user_id : 'cnot'

  // if(props.atendimento.clinico[0]){
  if(props.atendimento.clinico[0]){

      if(page.props.auth.user.id === props.atendimento.clinico[0].user_id || page.props.auth.user.id === props.atendimento.triagem[0].user_id){
        refDesativar.value = false
      } else {
        refDesativar.value = true
      }

  } else {
    refDesativar.value = false
  }
} else {
  refDesativar.value = false
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

// Funções do Módulo ImagemAux
  function chamarSenha(){


    form.chamar = !form.chamar
    form.post(route('senhas.store'), {
        only: ['pacientes'],
        preserveState: true
        });
      }



  </script>
