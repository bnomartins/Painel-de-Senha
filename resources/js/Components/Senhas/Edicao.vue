<template>

  <button
      class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
      @click="abrirModal"
    >
      Editar
  </button>

  <Modal :show="confirmar" @close="closeModal">


    <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
      <h1 class="text-center m-auto text-3xl font-bold" >
        Apoio ao Diagnóstico - Imagems
      </h1>
    </div>

    <div class="mx-2 px-6 rounded text-xl w-full bg-gray-100">

      <form @submit.prevent="editarImagemAux()" class="w-full">
          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="imagem">Imagem</label>
              <input type="text" placholder="Digite o imagem" v-model="form.imagem"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.imagem }}
              </div>
          </div>

          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="descricao">Descrição</label>
              <input type="text" placholder="Digite o descricao" v-model="form.descricao"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.descricao}}
              </div>
          </div>

          <div class="m-2 p-2 rounded">
            <label class="font-bold text-xl text-gray-600 mr-4" for="disponivel">Disponível</label>
            <input
              type="radio"
              name="radio-imagem"
              v-model="form.disponivel"
              value="1"
              :id="'radio-imagem-2'"
              class="w-6 h-6 text-red-600 bg-gray-100 border-gray-400 border-4 rounded focus:ring-red-500
              dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              :checked="form.disponivel"
             >

            <label class="font-bold text-xl text-gray-600 ml-20 mr-4" for="disponivel">Indisponível</label>
            <input
              type="radio"
              name="radio-imagem"
              value="0"
              v-model="form.disponivel"
              :id="'radio-imagem-2'"
              class="w-6 h-6 text-red-600 bg-gray-100 border-gray-400 border-4 rounded focus:ring-red-500
              dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
              :checked="form.disponivel == false"

             >

              <!-- <input type="text" placholder="Digite a disponivel" v-model="form.disponivel"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"/> -->
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.disponivel}}
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
          {{ form }}
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

  // Funções do Módulo ImagemAux
  const props = defineProps({
    imagemAux: {
        type: Object
    },

  })

    const form = useForm({
      id: props.imagemAux.id,
      imagem: props.imagemAux.imagem,
      descricao:  props.imagemAux.descricao,
      disponivel:  props.imagemAux.disponivel,

  })

function editarImagemAux(){
  if(form.nome != '' && form.cpf != ''){
    form.put(route('imagemAuxes.update', form.id),{
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => closeModal(),
    })
  }
}
// function editarImagemAux(){
//     form.put(route('imagemAuxs.update', form.id), {
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
