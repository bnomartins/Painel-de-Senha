<template>
  <!-- <CardPaciente :paciente="p.paciente :tipo='Cadastro/Tabela'  "/> -->

  <div class="flex items-center" :class="{'ml-10': tipo==='Cadastro'}">
    <div class="flex-shrink-0"  :class="{'h-30 w-30': tipo==='Cadastro', 'h-20 w-20': tipo !=='Cadastro'}">

      <label for="foto" class="">

          <img
              class="rounded-full"
              :class="{'h-32 w-32': tipo==='Cadastro', 'h-20 w-20': tipo !=='Cadastro'}"
              :src="paciente.foto ? '../storage/'+paciente.foto : '../storage/img/user.png'"
              alt=""
          >
      </label>

      <input class="hidden" id="foto" type="file" v-if="tipo === 'Cadastro' ">  


    </div>
    <div class="ml-4 text-gray-700 font-bold">
        <div class="text-md font-bold">
            Nome: {{ paciente.nome_social ? paciente.nome_social : paciente.nome }}
            <span class="bg-red-100 border border-1 border-red-500 rounded-xl px-2 text-red-600 font-bold" v-if="paciente.aborh">{{ paciente.aborh.replace('P', '+').replace('N', '-') }}</span>
        </div>
        <div class="text-md font-bold">
            Mãe: {{ paciente.mae }}
        </div>
        <div class="text-md font-bold">
            Pai: {{ paciente.pai }}
        </div>
        <div class="text-md font-bold">
            Prontuário: {{ paciente.prontuario_id}}
        </div>
        <div class="text-md font-bold" v-show="paciente.nascimento">

            Dt. Nasc.: {{ paciente.nascimento ? moment(paciente.nascimento).format('DD/MM/YYYY') : ''}} -
            {{  moment().year() - moment(paciente.nascimento).year() }} anos
        </div>
    </div>
</div>

</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import Modal from '@/Components/Modal.vue'
import Aviso from '@/Components/Aviso.vue'
import { nextTick, ref } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import moment from 'moment'
const props = defineProps({
  paciente: {
    Type: Object
  },
  tipo: {
    Type: String    
  }
})

</script>
