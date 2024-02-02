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
        Abertura de Atendiemnto
      </h1>
    </div>

    <div class="mx-2 px-6 rounded text-xl w-full bg-gray-100">

      <form @submit.prevent="editarAtendimento()" class="w-full">
          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="Nome">Nome</label>
              <input type="text" placholder="Digite o nome" v-model="form.nome"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.nome }}
              </div>
          </div>

          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="cpf">CPF</label>
              <input type="text" placholder="Digite o cpf" v-model="form.cpf"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.cpf}}
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

  // Funções do Módulo Atendimento
  const props = defineProps({
    paciente: {
        type: Object
    },

  })

    const form = useForm({
      id: props.paciente.id,
      nome: props.paciente.nome,
      cpf:  props.paciente.cpf,
      status: 'Aguardando Triagem',
      tipo: 'Edição',

  })

function editarAtendimento(){
  if(form.nome != '' && form.cpf != ''){
    form.put(route('pacientes.store', form.id),{
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => closeModal(),
    })
  }
}
// function editarAtendimento(){
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
  };



  </script>
