<template>

    <button
    class="m-2 px-2 bg-white border border-red-700 text-red-700  hover:bg-red-800 hover:text-white rounded-md shadow-md font-bold"
    @click="abrirModal"
      >
        Remover
    </button>

    <Modal :show="confirmar" @close="closeModal">


      <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
        <h1 class="text-center m-auto text-3xl font-bold" >
          Os dados do atendimento serão removidos permanentemente, você deseja continuar?
        </h1>
      </div>


      <div class="mx-2 px-6 rounded text-xl w-full bg-gray-100">

            <form @submit.prevent="excluirAtendimento(form.id)" class="w-full">
                <!-- <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
                </progress> -->

                <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                  <button class="text-white bg-red-500 hover:bg-red-400
                  active:bg-red-600 font-bold text-2xl px-4 py-2 rounded outline-none focus:outline-none
                    mr-1 mb-1 ease-linear transition-all duration-150"
                  type="submit"
                  :disabled="form.processing"
                  :class="{ 'opacity-25': form.processing }"
                  >
                    <i v-if="form.processing">Aguarde Excluindo</i>
                    <i v-else >
                      SIM
                    </i>
                  </button>
                </div>

              </form>


        </div>
    </Modal>
      </template>

    <script setup>
    import { Link, useForm } from "@inertiajs/vue3";
    import { nextTick, ref } from 'vue';
    import Modal from '@/Components/Modal.vue'
    import Aviso from '@/Components/Aviso.vue'

    const props = defineProps({
        id: {
            type: Number
        }
    })

    // Controle de Formulário
    const form = useForm({
      id: props.id

    })

    // Controle do Modal
    const confirmar = ref(false);

    const abrirModal = () => {
    confirmar.value = true;
    };

    const closeModal = () => {
      confirmar.value = false;
      form.reset();

    };

    // Funções do Módulo Atendimento

    function excluirAtendimento(id){
        form.delete(route('atendimentos.destroy', id),{
            onSuccess: () => (
              closeModal()
              ),
        })

}

      </script>
