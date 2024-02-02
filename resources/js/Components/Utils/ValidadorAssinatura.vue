<!-- <ValidadorAssinatura :f="form"/> -->
<!-- import ValidadorAssinatura from '@/Components/Utils/ValidadorAssinatura.vue' -->

<template>
<div class="flex justify-center">

  <input type="text"
    placeholder="Digite a a sua assinatura"
    v-model="refAssinatura.assinatura"
    class="h-10 w-40 ml-2 px-2 bg-white text-gray-700 shadow-md font-bold text-xl text-cyan-700 font-bold"
    :class="{'border border-4 border-red-500': !refAssinatura.validado, 'border border-4 border-cyan-700': refAssinatura.validado}"

    autocomplete="off"
  >

  <button
  class="h-10 mr-2 px-2 bg-gray bg-cyan-700 text-white hover:bg-cyan-500 hover:text-white shadow-md font-bold text-md"
  @click.prevent="verificarAssinatura"
  >
  Assinatura
</button>

</div>

<div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b justify-center">
  <button class="text-white bg-red-500 hover:bg-red-400
  active:bg-red-600 font-bold text-xl px-4 py-2 rounded outline-none focus:outline-none
  mr-1 mb-1 ease-linear transition-all duration-150"
  type="submit"
  :disabled="f.processing || !refAssinatura.validado"
  :class="{ 'opacity-25': f.processing || !refAssinatura.validado }"
  >
  <i v-if="f.processing">Salvando</i>
  <i v-else >
      Salvar
  </i>
</button>

<!-- {{ form }} -->

</div>
  </template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { nextTick, ref } from 'vue';

const props = defineProps({
    f: {
        type: Object
    }
})

const refAssinatura = ref({
  assinatura: '',
  validado: false,
  recusada: false
})

const verificarAssinatura = () => {

  if(refAssinatura.value.assinatura === '123456'){
    refAssinatura.value.validado = true
  } else {
    refAssinatura.value.validado = false
  }


}




</script>
