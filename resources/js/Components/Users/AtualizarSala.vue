<template>
<div class="block px-4 py-2 text-gray-700 hover:bg-blue-600 hover:text-white text-md">
  <button
  class="w-full text-left"
  @click="abrirModal"
  >
    Sala de Atendimento
  </button>
</div>

 <!-- <Modal :show="confirmar" @close="closeModal"> -->
  
  <Modal :show="
    (!moment(new Date()).isSameOrAfter($page.props.auth.user.updated_at, 'day')
    && ($page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Médico' || $page.props.auth.user.access == 'Triagem') )
    || confirmar"
    @close="closeModal"
  >

    <div class="py-8 border-b border-solid border-slate-200 rounded-t text-red-600">
      <h1 class="text-center m-auto text-2xl font-bold" >
        Favor insira a sala atual que você se encontra
      </h1>
    </div>


      <div class="mx-2 px-6 border rounded text-md w-full">

      <form @submit.prevent="atualizarSala()" class="w-full">
      <!-- <form @submit.prevent="submit"> -->
          <div>
              <label class="font-bold text-md text-gray-600" for="nome">Sala</label>

              <select
                id="sala"
                name="sala"
                class="w-full rounded h-12 text-md text-gray-500 font-bold"
                v-model="form.room"
              >
                <!-- <option value="{{ $page.auth.user.sala }}">{{ Auth::user()->id }}</option> -->
                <option :value="$page.props.auth.user.room">{{ $page.props.auth.user.room }}</option>
                <optgroup></optgroup>
                <option value="Consultório 01">Consultório 01</option>
                <option value="Consultório 02">Consultório 02</option>
                <option value="Consultório 03">Consultório 03</option>
                <option value="Consultório 04">Consultório 04</option>
                <option value="Consultório 05">Consultório 05</option>
                <option value="Consultório 06">Consultório 06</option>
                <option value="Consultório 07">Consultório 07</option>
                <option value="Consultório 08">Consultório 08</option>
                <option value="Consultório 09">Consultório 09</option>
                <option value="Consultório 10">Consultório 10</option>
                <option value="Triagem 01">Triagem 01</option>
                <option value="Triagem 02">Triagem 02</option>
                <option value="Triagem 03">Triagem 03</option>
                <option value="Triagem 04">Triagem 04</option>
                <option value="Triagem 05">Triagem 05</option>
                <option value="Triagem 06">Triagem 06</option>
                <option value="Triagem 07">Triagem 07</option>
                <option value="Triagem 08">Triagem 08</option>
                <option value="Triagem 09">Triagem 09</option>
                <option value="Triagem 10">Triagem 10</option>
              </select>

              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                  {{ form.errors.room }}
              </div>

              <!-- <InputError class="mt-2" :message="form.errors.sala" /> -->
          </div>




          <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
            <button class="text-white bg-red-500 hover:bg-red-400
            active:bg-red-600 font-bold text-md px-4 py-2 rounded outline-none focus:outline-none
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
  import Aviso from '@/Components/Aviso.vue'
  import { nextTick, ref } from 'vue';
  import DangerButton from '@/Components/DangerButton.vue';
  import moment from 'moment'

  // Controle de Formulário
  const form = useForm({
    room: '',
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

  // Funções do Módulo Ambulatoorial
    function atualizarSala(){

      // if(form.sala != '' && form.email != '' && form.access != '' && form.password != ''){

        form.put(route('rooms.update'), {
          onSuccess: () => (
            closeModal()
            ),
          });
        }

  //   }



    </script>
