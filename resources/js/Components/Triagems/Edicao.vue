<template>

  <button
      class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
      @click="abrirModal"
      :disabled="form.status == 'Aguardando Atendimento Clínico'"
    >
      Atendimento
  </button>

  <Modal :show="confirmar" @close="closeModal">


    <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
      <h1 class="text-center m-auto text-2xl font-bold" >
        Triagem - Atendimento
      </h1>
    </div>

    <div class="mx-2 px-6 rounded text-xl w-full bg-gray-100">

      <form @submit.prevent="editarTriagem()" class="w-full">


        <div class="font-sans antialiased bg-grey-lightest">
          <!-- Content -->
          <div class="w-full bg-grey-lightest" style="padding-top: 1rem;">
              <div class="container mx-auto py-2">
              <div class="w-full mx-auto bg-white rounded shadow">
                      <div class="py-4 px-8 text-black text-xl border-b border-grey-lighter">
                      Dados Cadastrais - Paciente
                  </div>
                      <div class="py-4 px-8">
                          <div class="flex mb-4">
                            
                              <div class="w-1/2 mr-1">

                                  <label class="block text-grey-darker text-sm font-bold mb-2" 
                                  for="first_name">
                                    First Name
                                  </label>
                                  <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                  id="first_name" 
                                  type="text" 
                                  placeholder="Your first name">

                              </div>    

                              <div class="w-1/2 mr-1">

                                  <label class="block text-grey-darker text-sm font-bold mb-2" 
                                  for="first_name">
                                    First Name
                                  </label>
                                  <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                  id="first_name" 
                                  type="text" 
                                  placeholder="Your first name">

                              </div>    

                              <div class="w-1/2 mr-1">

                                  <label class="block text-grey-darker text-sm font-bold mb-2" 
                                  for="first_name">
                                    First Name
                                  </label>
                                  <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                  id="first_name" 
                                  type="text" 
                                  placeholder="Your first name">

                              </div>    

                          </div>

                          <div class="flex mb-4">
                            
                              <div class="w-1/2 mr-1">

                                  <label class="block text-grey-darker text-sm font-bold mb-2" 
                                  for="first_name">
                                    First Name
                                  </label>
                                  <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                  id="first_name" 
                                  type="text" 
                                  placeholder="Your first name">

                              </div>    

                              <div class="w-1/2 mr-1">

                                  <label class="block text-grey-darker text-sm font-bold mb-2" 
                                  for="first_name">
                                    First Name
                                  </label>
                                  <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                  id="first_name" 
                                  type="text" 
                                  placeholder="Your first name">

                              </div>    

                              <div class="w-1/2 mr-1">

                                  <label class="block text-grey-darker text-sm font-bold mb-2" 
                                  for="first_name">
                                    First Name
                                  </label>
                                  <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                  id="first_name" 
                                  type="text" 
                                  placeholder="Your first name">

                              </div>    

                          </div>

                          <div class="mb-4">

                              <label class="block text-grey-darker text-sm font-bold mb-2" 
                              for="email">Email Address</label>
                              <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="email" placeholder="Your email address">

                          </div>
                          <div class="mb-4">
                              <label class="block text-grey-darker text-sm font-bold mb-2" 
                              for="password">Password</label>
                              <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="password" type="password" placeholder="Your secure password">
                              <p class="text-grey text-xs mt-1">At least 6 characters</p>
                          </div>
                          <div class="flex items-center justify-between mt-8">
                              <button class="bg-blue hover:bg-blue-dark text-black font-bold py-2 px-4 rounded-full" 
                              type="submit">
                                  Sign Up
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>


          <div class="font-sans antialiased bg-grey-lightest">
            <!-- Content -->
            <div class="w-full bg-grey-lightest" style="padding-top: 1rem;">
                <div class="container mx-auto py-2">
                <div class="w-full mx-auto bg-white rounded shadow">
                        <div class="py-4 px-8 text-black text-xl border-b border-grey-lighter">
                        Dados Cadastrais - Paciente
                    </div>
                        <div class="py-4 px-8">
                            <div class="flex mb-4">
                              
                                <div class="w-1/2 mr-1">
  
                                    <label class="block text-grey-darker text-sm font-bold mb-2" 
                                    for="first_name">
                                      First Name
                                    </label>
                                    <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                    id="first_name" 
                                    type="text" 
                                    placeholder="Your first name">
  
                                </div>    
  
                                <div class="w-1/2 mr-1">
  
                                    <label class="block text-grey-darker text-sm font-bold mb-2" 
                                    for="first_name">
                                      First Name
                                    </label>
                                    <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                    id="first_name" 
                                    type="text" 
                                    placeholder="Your first name">
  
                                </div>    
  
                                <div class="w-1/2 mr-1">
  
                                    <label class="block text-grey-darker text-sm font-bold mb-2" 
                                    for="first_name">
                                      First Name
                                    </label>
                                    <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                    id="first_name" 
                                    type="text" 
                                    placeholder="Your first name">
  
                                </div>    
  
                            </div>
  
                            <div class="flex mb-4">
                              
                                <div class="w-1/2 mr-1">
  
                                    <label class="block text-grey-darker text-sm font-bold mb-2" 
                                    for="first_name">
                                      First Name
                                    </label>
                                    <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                    id="first_name" 
                                    type="text" 
                                    placeholder="Your first name">
  
                                </div>    
  
                                <div class="w-1/2 mr-1">
  
                                    <label class="block text-grey-darker text-sm font-bold mb-2" 
                                    for="first_name">
                                      First Name
                                    </label>
                                    <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                    id="first_name" 
                                    type="text" 
                                    placeholder="Your first name">
  
                                </div>    
  
                                <div class="w-1/2 mr-1">
  
                                    <label class="block text-grey-darker text-sm font-bold mb-2" 
                                    for="first_name">
                                      First Name
                                    </label>
                                    <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" 
                                    id="first_name" 
                                    type="text" 
                                    placeholder="Your first name">
  
                                </div>    
  
                            </div>
  
                            <div class="mb-4">
  
                                <label class="block text-grey-darker text-sm font-bold mb-2" 
                                for="email">Email Address</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="email" placeholder="Your email address">
  
                            </div>
                            <div class="mb-4">
                                <label class="block text-grey-darker text-sm font-bold mb-2" 
                                for="password">Password</label>
                                <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="password" type="password" placeholder="Your secure password">
                                <p class="text-grey text-xs mt-1">At least 6 characters</p>
                            </div>
                            <div class="flex items-center justify-between mt-8">
                                <button class="bg-blue hover:bg-blue-dark text-black font-bold py-2 px-4 rounded-full" 
                                type="submit">
                                    Sign Up
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            


          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="nome">Nome</label>
              <input type="text" placholder="Digite o nome" v-model="form.nome"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"
              disabled
              />
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.nome }}
              </div>
          </div>

          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="cpf">CPF</label>
              <input type="text" placholder="Digite a cpf" v-model="form.cpf"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"
              disabled
              />
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.cpf}}
              </div>
          </div>

          <div class="m-2 p-2 rounded">
              <label class="font-bold text-xl text-gray-600" for="observacao">Observação</label>
              <textarea placholder="Digite a observacao" rows="4" v-model="form.observacao"
              class="w-full rounded text-xl text-gray-500 font-bold"></textarea>
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.observacao}}
              </div>
          </div>

          <div class="m-2 p-2 rounded">


            <label for="countries" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">
                Classificação de Risco
            </label>
            <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                v-model="form.classificacao"
            >
                <option selected>Escolha uma classificação</option>
                <option value="">{{form.risco_id}}</option>
                <option value="Vermelho">Vermelho</option>
                <option value="Laranja">Laranja</option>
                <option value="Amarelo">Amarelo</option>
                <option value="Azul">Azul</option>
                <option value="Verde">Verde</option>
            </select>

            <label for="countries" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">
                Discriminação
            </label>
            <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                v-model="form.risco_id"
            >
                <option selected>Escolha uma classificação</option>
                <option value="1">Vermelho</option>
                <option value="2">Laranja</option>
                <option value="3">Amarelo</option>
                <option value="4">Azul</option>
                <option value="5">Verde</option>
            </select>

            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                {{ form.errors.classificacao}}
            </div>



              <!-- <label class="font-bold text-xl text-gray-600" for="classificacao">Classificacao</label>
              <input type="text" placholder="Digite a classificacao" v-model="form.classificacao"
              class="w-full rounded h-12 text-xl text-gray-500 font-bold"/>
              <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                  {{ form.errors.classificacao}}
              </div> -->
          </div>


          <ValidadorAssinatura :f="form"/>

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
import { Inertia } from "@inertiajs/inertia";
import ValidadorAssinatura from '@/Components/Utils/ValidadorAssinatura.vue';

  // Funções do Módulo Triagem
  const props = defineProps({
    atendimento: {
        type: Object
    },

  })

    const form = useForm({
      id: props.atendimento.id,
      nome: props.atendimento.nome,
      cpf:  props.atendimento.cpf,
      dthrinicio: '',
      status:  props.atendimento.status,
      observacao:  props.atendimento.observacao,
      classificacao:  props.atendimento.classificacao,
      risco_id: '',
      tipo: 'Edição',

  })

function editarTriagem(){
  if(form.nome != '' && form.cpf != '' && form.observacao != '' && form.classificacao != '' && form.risco_id != ''){
    form.post(route('triagems.store'),{
        preserveState: true,
        preserveScroll: true,
      onSuccess: () => {
        closeModal()
        // Inertia.get(route('triagems.index'));
    },
    })
  }
}
// function editarTriagem(){
//     form.put(route('Triagems.update', form.id), {
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
    // form.reset();
    // Inertia.get(route('triagems.index'));

  };



  </script>
