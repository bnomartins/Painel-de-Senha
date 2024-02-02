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
        Inserir Resultado
      </h1>
    </div>

    <div class="mx-2 px-6 rounded text-md w-full bg-gray-200">

      <form @submit.prevent="editarExame()" class="w-full data" enctype="multipart/form-data">
            <div class="bg-gray-200 px-4 rounded-xl">
              <h1 class="font-bold text-md">
                  <b class="text-red-700 font-bold text-3xl">+</b>
                  Dados do Paciente
              </h1>

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
                  <label class="font-bold text-md" for="solicitante">Exame</label>
                  <input type="text" placholder="Digite o nome do solicitante" v-model="form.exame"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />

              </div>
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
                  <b class="text-red-700 font-bold text-3xl">+</b>Resultado
              </h1>


              <p v-for="(i, index) in props.exames" :key="i.id">
                <p v-for="p in i.procedimentos" :key="p.id" class="bg-white rounded-lg p-4 mt-4">

                  <b class="text-red-700 font-bold text-md">
                    Exame: {{ i.id }} - {{ p.procedimento }}
                  </b>

                <div class="m-2 p-2 rounded">
                  <input type="text" placholder="Digite o nome do solicitante" 
                  :value="p.procedimento"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />
                </div>
  

              <div class="m-2 p-2 rounded">
                  <input type="text" placholder="Digite o nome do solicitante" 
                  :value="i.observacao ? i.observacao : 'Sem Observação'"
                  class="w-full rounded h-12 text-md text-gray-500 font-bold"
                  disabled
                  />
              </div>

              <div class="m-2 p-2 rounded flex">
                <input
                type="file"
                  placholder="Digite o resultado"
                  @input="form.resultado = $event.target.files[0] "
                  @change="uploadImagem(i.id)"
                  class="rounded h-12 text-md text-gray-500 font-bold flex-column"
                />



              <a
                v-if="i.resultado"
                :href="'../storage/'+i.resultado"
                target="_blank"
                rel="noopener noreferrer"
                class="border border-4 border-emerald-600 text-emerald-600 font-bold text-md p-2 
                rounded-xl hover:bg-emerald-600 hover:text-white
                flex-column"
              >
                Resultado Já Emitido - {{ moment(i.updated_at).format('DD/MM/YYYY HH:MM:SS') }}
              </a>

              <a
                v-else
                rel="noopener noreferrer"
                class="border border-4 border-red-600 text-red-600 font-bold text-md p-2 
                rounded-xl hover:bg-red-600 hover:text-white
                flex-column"
              >
                Aguardando Inserção de Resultado
              </a>

            </div>

            </p>
            <hr class="border-4">

          </p>

              <div class="m-2 mt-6 p-2 rounded">
                  <label class="font-bold text-md" for="observacao">Observação</label>
                  <textarea
                    v-model="form.observacao"
                    rows="3"
                    class="w-full rounded text-gray-500 text-md font-bold"
                  />
                <!-- {{ form }} -->
              </div>
          </div>

        <ValidadorAssinatura :f="form"/>
        
        </form>
      </div>

    <!-- {{ exames }} -->

  </Modal>
    </template>
    
    <script setup>
  import { Link, useForm, router } from "@inertiajs/vue3";
  import Modal from '@/Components/Modal.vue'
  import Aviso from '@/Components/Aviso.vue'
  import { nextTick, ref } from 'vue';
  import DangerButton from '@/Components/DangerButton.vue';
  import moment from 'moment'
  import ValidadorAssinatura from '@/Components/Utils/ValidadorAssinatura.vue'
  // import moment from 'moment'

  // Funções do Módulo Exame
  const props = defineProps({
    exame: {
        type: Object
    },
    exames: {
      type: Object
    },
    paciente: {
      type: Object
    },
    solicitante: {
      type: Object
    }

  })

  const form = useForm({
    id: props.exame.id,

    nome: props.paciente.nome,
    cpf: props.paciente.cpf,

    dtUpdate: props.exame.updated_at,

    solicitante_nome: props.solicitante.name,
    clinico_id: props.exame.clinico_id,

    exame: props.exame.exame,

    url : props.exame.resultado,

    resultado: props.exame.resultado ? props.exame.resultado : '',
    observacao: props.exame.observacao,
    tipo: 'Edição',

  })

function editarExame(){

  form.post(route('exames.store', form.id),{
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => closeModal(),
    })

}

// Upload de Imagem
function uploadImagem(id){
  form.id = id

  // form.url = URL.createObjectURL(form.resultado)
  form.post(route('exames.upload'),{ forceFormData: true, only: ['exames'] });
  form.resultado = ''
  form.url = ''
}
// function editarExame(){
//     form.put(route('exames.update', form.id), {
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
