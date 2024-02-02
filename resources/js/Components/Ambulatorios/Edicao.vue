<template>

  <button
      class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
      @click="abrirModal"
    >
      Atendimento
  </button>

  <Modal :show="confirmar" @close="closeModal">


        <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
          <h1 class="text-center m-auto text-2xl font-bold" >
            Atendimento
          </h1>
        </div>

        <div class="mx-2 px-6 rounded text-md w-full">

          <form @submit.prevent="editarProcedimento()" class="w-full">
            <div class="px-4 rounded-xl bg-gray-200">

              <h1 class="font-bold text-md">
                  <b class="text-red-700 font-bold text-3xl">+</b>
                  Dados do Paciente
              </h1>

              <input type="hidden" name="" >

              <div class="m-2 p-2 rounded">
                  <label class="font-bold text-md" for="nome">Nome</label>
                  <input type="text" placholder="Digite o nome" v-model="form.nome"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />

              </div>

              <div class="m-2 p-2 rounded">
                  <label class="font-bold text-md" for="cpf">CPF</label>
                  <input type="text" placholder="Digite a cpf" v-model="form.cpf"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />

              </div>
          </div>

            <div class="bg-gray-200 px-4 rounded-xl">
              <h1 class="font-bold text-md">
                  <b class="text-red-700 font-bold text-3xl">+</b>Solicitação
              </h1>

              <div class="m-2 p-2 rounded">
                  <label class="font-bold text-md" for="solicitante">Solicitante</label>
                  <input type="text" placholder="Digite o nome do solicitante" v-model="form.solicitante_nome"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />

              </div>

              <div class="m-2 p-2 rounded">
                  <label class="font-bold text-md" for="solicitante">Data Hora</label>
                  <input type="text" placholder="Digite o nome do solicitante" v-model="form.dtUpdate"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />
              </div>
          </div>

          <div class="bg-gray-200 px-4 rounded-xl">
            <h1 class="font-bold text-md">
                <b class="text-red-700 font-bold text-3xl">+</b>Procedimento
            </h1>

            <div class=" mt-5 p-3 m-auto w-full font-bold text-md border border-1 bg-gray-50 rounded-xl" >
              <div class="m-2 p-2 rounded">


                  <!-- Hemograma, Colesterol, Ureia e Creatinina, Papanicolau, Exame de Urina,
                  Exame de Fezes, Glicemia, Transaminases ALT/AST Transaminases TGP/TGO TSH/T4 Livre  -->
                 
                  <!-- {{ form.ambulatorio }} -->

                  <p v-for="(i, index) in form.ambulatorio" :key="i.id">
                    <p v-for="p in i.procedimentos" :key="p.id"  class="bg-white rounded-lg p-4 mt-4">

                      PROCEDIMENTO: {{ p.id }} - {{ p.procedimento }}

                      <div class="m-2 p-2 rounded">
                      <input type="text" placeholder="Solicitação" 
                      :value="i.medicamentos[0].descricao"
                      class="w-full rounded h-12 text-md text-gray-500 font-bold"
                      disabled
                      />
                  </div>

                  <div class="m-2 p-2 rounded">
                      <input type="text" placeholder="Observação da solicitação" 
                        :value="i.medicamentos[0].pivot.observacao"
                      class="w-full rounded h-12 text-md text-gray-500 font-bold"
                      disabled
                      />
                  </div>
                  <!-- {{  i }} -->
                  <div class="flex flex-row flex-wrap wrap justify-center">
                    <div class="items-center m-4">
                      <input
                      type="radio"
                      :id="'radio-procedimento-i-'+i.id"
                      :name="'radio-procedimento-'+p.id"
                      @change.prevent="atualizarProcedimento(i.id)"
                      value="iniciado"
                      class="w-6 h-6 text-red-600 bg-gray-200 border-gray-400 border-4 rounded focus:ring-red-500
                      dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      >
                      <label class="ml-2 text-md font-bold text-gray-900 dark:text-gray-300">
                          Iniciar Procedimento
                      </label>
                    </div>

                    <div class="items-center m-4">
                      <input
                      type="radio"
                      :id="'radio-procedimento-f-'+i.id"
                      :name="'radio-procedimento-'+p.id"
                      @change.prevent="atualizarProcedimento(i.id)"
                      value="finalizado"
                      class="w-6 h-6 text-red-600 bg-gray-200 border-gray-400 border-4 rounded focus:ring-red-500
                      dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      >
                      <label class="ml-2 text-md font-bold text-gray-900 dark:text-gray-300">
                          Finalizar Procedimento
                      </label>
                    </div>

                  </div>

                </p>
                <hr class="border-4">

              </p>
              </div>
            </div>


            <div class="m-2 mt-6 mb-12 p-2 rounded">
              <label class="font-bold text-md"> Anotação de Enfermagem
               </label>
              <textarea
                v-model="form.anotacao"
                rows="3"
                class="w-full rounded text-gray-500 text-md font-bold"
              ></textarea>

          </div>

          </div>
          <ValidadorAssinatura :f="form"/>

          
        </form>
      </div>
  </Modal>
    </template>
    
    <script setup>
  import { Link, useForm, router } from "@inertiajs/vue3";
  import Modal from '@/Components/Modal.vue'
  import Aviso from '@/Components/Aviso.vue'
  import { nextTick, ref } from 'vue';
  import DangerButton from '@/Components/DangerButton.vue';
  import ValidadorAssinatura from '@/Components/Utils/ValidadorAssinatura.vue'
  // import moment from 'moment'

  // Funções do Módulo Procedimento
  const props = defineProps({
    ambulatorio: {
      type: Array
    },
    procedimento: {
        type: Object
    },
    procedimentos: {
        type: Array
    },
    paciente: {
      type: Object
    },
    solicitante: {
      type: Object
    }

  })

  const form = useForm({
    id: props.procedimento.id,
    clinico_id: props.procedimento.clinico_id,

    ambulatorio: props.ambulatorio,

    nome: props.paciente.nome,
    cpf: props.paciente.cpf,

    dtUpdate: props.procedimento.updated_at,

    solicitante_nome: props.solicitante.name,
    clinico_id: props.procedimento.clinico_id,

    anotacao: props.ambulatorio[0].anotacao,
    procedimento_status: [],

  })

function editarProcedimento(){
    form.post(route('ambulatorios.store', form.id),{
        preserveState: true,
        preserveScroll: true,
    })
}

const atualizarProcedimento = (id) => {
  // alert(form.procedimento_status)
  // salvar no banco o horário do procedimento iniciado
  form.id = id

    form.post(route('ambulatorios.startProcedure', form.id),{
        preserveState: true,
        preserveScroll: true,
    })

}


  // Controle do Modal
  const confirmar = ref(false);

  const abrirModal = () => {
  confirmar.value = true;
  };

  const closeModal = () => {
    confirmar.value = false;
  };



  </script>
