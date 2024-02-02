<template>

<button
    class="my-2 mx-4 px-2 bg-transparent border border-indigo-700 text-indigo-700 hover:bg-indigo-600 hover:text-white rounded shadow-lg text-2xl font-bold"
    @click="abrirModal"
  >
    Novo
</button>

<Modal :show="confirmar" @close="closeModal">


  <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
    <h1 class="text-center m-auto text-3xl font-bold" >
      Cadastrar Consulta
    </h1>
  </div>


  <div class="mx-2 px-6 rounded text-xl w-full bg-gray-100">

    <form @submit.prevent="cadastrarTriagem()" class="w-full">
        <div class="m-2 p-2 rounded">
            <label class="font-bold text-xl text-gray-600" for="diagnostico">Diagnostico</label>
            <input type="text" placholder="Digite uma diagnostico" v-model="form.diagnostico"
            class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                {{ form.errors.diagnostico }}
            </div>
        </div>
        <div class="m-2 p-2 rounded">
            <label class="font-bold text-xl text-gray-600" for="observacao">observacao</label>
            <input type="text" placholder="Digite o observacao" v-model="form.observacao"
            class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                {{ form.errors.observacao }}
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
            <i v-if="form.processing">Salvando</i>
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
import { nextTick, ref } from 'vue';

// Controle de Formulário
const form = useForm({
  diagnostico: '',
  observacao: '',
  tipo: 'Cadastramento'

})

// Controle do Modal
const confirmar = ref(false);

const abrirModal = () => {
confirmar.value = true;
};

const closeModal = () => {
  confirmar.value = false;
  form.reset()
};

// Funções do Módulo Triagem
  function cadastrarTriagem(){

    if(form.diagnostico != '' && form.observacao != ''){

      form.post(route('clinicos.store'), {
        onSuccess: () => (
          closeModal()
          ),
        });
      }

  }



  </script>
