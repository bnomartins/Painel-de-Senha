<template>

  <button
      class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
      @click="abrirModal"
    >
      Atendimentos
  </button>

  <Modal :show="confirmar" @close="closeModal">


    <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
      <h1 class="text-center m-auto text-2xl font-bold" >
        Atendimento n.º {{procedimentos[0].id}}
      </h1>
      <div class="ml-10 text-lg">
        <p>
          <b>Nome:</b> {{ procedimentos[0].atendimentos.paciente.nome_social ? procedimentos[0].atendimentos.paciente.nome_social : procedimentos[0].atendimentos.paciente.nome}}
        </p>
        <p>
          <b>Data de Nasc.:</b> {{ procedimentos[0].atendimentos.paciente.nascimento }}
        </p>
        <p>
          <b>Prontuário:</b> {{ procedimentos[0].atendimentos.paciente.prontuario_id }}
        </p>
      </div>
    </div>
    <div class="m-4 px-6 rounded text-md w-full bg-gray-100">

      <table class="text-md p-4">
        <tr class="font-bold text-center border border-1px border-gray-500">
          <td class="border border-1px border-gray-500">PROCEDIMENTOS</td>
          <td class="border border-1px border-gray-500">DESCRIÇÃO</td>
          <td class="border border-1px border-gray-500">SOLIC.</td>
          <td class="border border-1px border-gray-500">PREST.</td>
          <td class="border border-1px border-gray-500">ATEND.</td>
          <td class="border border-1px border-gray-500">PREST.</td>
        </tr>
        <tr v-for="p in procedimentos" :key="p.id" class="text-center p-4">
          <td class="border border-1px border-gray-500 p-2 word-break:break-all">{{ p.procedimento }}</td>
          <td class="border border-1px border-gray-500 p-2 word-break:break-word text-left W-50">{{ p.descricao }}</td>
          <td class="border border-1px border-gray-500 p-2 word-break:break-all">{{ p.user_solicitacao ? p.user_solicitacao.name : '' }}</td>
          <td class="border border-1px border-gray-500 p-2 word-break:break-normal">{{ p.user_solicitacao.prestador[0] ? p.user_solicitacao.prestador[0].id : '' }}</td>
          <td class="border border-1px border-gray-500 p-2 word-break:break-all">{{ p.user_atendimento ? p.user_atendimento.name : '' }}</td>
          <td class="border border-1px border-gray-500 p-2 word-break:break-normal">{{ p.user_atendimento.prestador[0] ? p.user_atendimento.prestador[0].id : '' }}</td>
      </tr>
      </table>

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
    procedimentos: {
        type: Object
    },

  })

  //   const form = useForm({
  //     id: props.imagemAux.id,
  //     codigo: props.imagemAux.codigo,
  //     procedimento:  props.imagemAux.procedimento,
  //     disponivel:  props.imagemAux.disponivel,

  // })

// function editarImagemAux(){
//   if(form.codigo != '' && form.procedimento != ''){
//     form.put(route('imagemAuxes.update', form.id),{
//         preserveState: true,
//         preserveScroll: true,
//         onSuccess: () => closeModal(),
//     })
//   }
// }
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
