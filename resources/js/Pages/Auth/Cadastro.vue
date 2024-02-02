<template>

    <button
        class="my-2 mx-4 px-2 bg-transparent border border-indigo-700 text-indigo-700 hover:bg-indigo-600 hover:text-white rounded shadow-lg text-4xl float-right font-bold"
        @click="abrirModal"
      >
        +
    </button>

    <Modal :show="confirmar" @close="closeModal">


      <div class="py-8 border-b border-solid border-slate-200 rounded-t text-gray-600">
        <h1 class="text-center m-auto text-3xl font-bold" >
          Cadastro de Usuário
        </h1>
      </div>


        <div class="mx-2 px-6 border rounded text-2xl w-full">

        <form @submit.prevent="cadastrarUser()" class="w-full">
        <!-- <form @submit.prevent="submit"> -->
            <div>
                <label class="font-bold text-xl text-gray-600" for="nome">Nome</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    v-model="form.name"
                    placeholder="Digite o nome do usuário"
                     autofocus autocomplete="name"
                />
                <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                    {{ form.errors.name }}
                </div>

                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
            </div>

            <div class="mt-3">
                <label class="font-bold text-xl text-gray-600" for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    placeholder="Digite o email do usuário"
                    v-model="form.email"  autocomplete="username"
                />
                <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                    {{ form.errors.email }}
                </div>

                <!-- <InputError class="mt-2" :message="form.errors.email" /> -->
            </div>

            <div class="mt-3">
                <label class="font-bold text-xl text-gray-600" for="acesso">Acesso</label>
                <!-- <input id="access" type="access" class="mt-1 block w-full" v-model="form.access"  autocomplete="username" /> -->
                <select
                    name="access"
                    id="access"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    v-model="form.access"
                >
                    <option value="">Selecione</option>
                    <option value="Médico">Médico</option>
                    <option value="Recepcionista">Recepcionista</option>
                    <option value="Triagem">Triagem</option>
                    <option value="Exame">Exame</option>
                    <option value="Imagem">Imagem</option>
                </select>
                <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                    {{ form.errors.access }}
                </div>

                <InputError class="mt-2" :message="form.errors.access" />
            </div>

            <div class="mt-3">
                <label class="font-bold text-xl text-gray-600" for="password">Senha</label>
                <input
                    id="password"
                    type="password"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    v-model="form.password"  autocomplete="new-password"
                    placeholder="Digite a senha"
                />
                <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                    {{ form.errors.password }}
                </div>

                <!-- <InputError class="mt-2" :message="form.errors.password" /> -->
            </div>

            <div class="mt-3">
                <label class="font-bold text-xl text-gray-600" for="password_confirmation">Confirme a senha</label>
                <input
                    id="password_confirmation"
                    type="password"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    placeholder="Digite novamente a senha"
                    v-model="form.password_confirmation"  autocomplete="new-password"
                />
                <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-xl">
                    {{ form.errors.password_confirmation }}
                </div>

                <!-- <InputError class="mt-2" :message="form.errors.password_confirmation" /> -->
            </div>



            <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
              <button class="text-white bg-red-500 hover:bg-red-400
              active:bg-red-600 font-bold text-xl px-4 py-2 rounded outline-none focus:outline-none
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

    // Controle de Formulário
    const form = useForm({
      status: '',
      name: '',
      email: '',
      access: '',
      password: '',
      password_confirmation: ''
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
      function cadastrarUser(){

        // if(form.name != '' && form.email != '' && form.access != '' && form.password != ''){

          form.post(route('users.store'), {
            onSuccess: () => (
              closeModal()
              ),
            });
          }

    //   }



      </script>
