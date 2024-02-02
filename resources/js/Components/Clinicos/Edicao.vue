<template>

    <button
        class="m-2 px-2 bg-white border border-indigo-700 text-indigo-700  hover:bg-indigo-800 hover:text-white rounded-md shadow-md font-bold"
        @click="abrirModal"

        >
        Atendimento
    </button>

    <Modal :show="confirmar" @close="closeModal">


      <div class="py-8 border-b border-solid border-slate-200 rounded-t">
        <h1 class="text-center m-auto text-2xl font-bold" >
          Atendimento Clínico
        </h1>
      </div>

        <div class="mx-2 px-6 text-md w-full">

        <form @submit.prevent="editarClinico()"  enctype="multipart/form-data"  class="w-full">


            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">

            <ul class="flex flex-wrap -mb-px text-xl font-bold text-center text-blue-600"
            id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

                <li
                    class="mr-2 border border-blue-100 border-4 rounded-t-lg"
                    role="presentation"
                >
                    <button class="inline-block p-1 border-b-2 rounded-t"
                    id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false"
                    @click.prevent="alternaTab('paciente')"
                    >
                        Triagem
                    </button>
                </li>

                <li
                    class="mr-2 border border-blue-100 border-4 rounded-t-lg"
                    role="presentation"
                >
                    <button class="inline-block p-1 border-b-2 rounded-t"
                    id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false"
                    @click.prevent="alternaTab('clinico')"
                    >
                        Atendimento Clínico
                    </button>
                </li>

                <li
                    class="mr-2 border border-blue-100 border-4 rounded-t-lg"
                    role="presentation"
                >
                    <button class="inline-block p-1 border-b-2 rounded-t"
                    id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false"
                    @click.prevent="alternaTab('exame')"
                    >
                        Solicitação de Exames
                    </button>
                </li>

                <li
                    class="mr-2 border border-blue-100 border-4 rounded-t-lg"
                    role="presentation"
                >
                    <button class="inline-block p-1 border-b-2 rounded-t"
                    id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false"
                    @click.prevent="alternaTab('imagem')"
                    >
                        Solicitação de Imagem Diagnóstica
                    </button>
                </li>

                <li
                    class="mr-2 border border-blue-100 border-4 rounded-t-lg"
                    role="presentation"
                >
                    <button class="inline-block p-1 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard"
                    type="button" role="tab" aria-controls="dashboard"
                    @click.prevent="alternaTab('ambulatorial')"
                    aria-selected="false">
                        Procedimento Ambulatorial
                    </button>
                </li>
                <li
                class="mr-2 border border-blue-100 border-4 rounded-t-lg"
                    role="presentation"
                >
                    <button class="inline-block p-1 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="settings-tab" data-tabs-target="#settings"
                    type="button" role="tab" aria-controls="settings"
                    @click.prevent="alternaTab('alta')"
                    aria-selected="false">
                        Alta
                    </button>
                </li>

            </ul>
            </div>
            <div id="myTabContent">
                <div class=" p-4 rounded-lg bg-gray-100 dark:bg-gray-800"
                id="profile" role="tabpanel" aria-labelledby="profile-tab"
                v-if="refTabs.paciente"
                >

                <h1 class="font-bold text-xl">
                    <b class="text-red-700 font-bold text-md">+</b>Dados do Paciente
                </h1>

                <div class="m-2 p-2 rounded">
                    <label class="font-bold text-xl" for="nome">Nome</label>
                    <input type="text" placholder="Digite o nome" v-model="form.nome"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    disabled
                    />
                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                        {{ form.errors.nome }}
                    </div>
                </div>

                <div class="m-2 p-2 rounded">
                    <label class="font-bold text-xl" for="cpf">CPF</label>
                    <input type="text" placholder="Digite a cpf" v-model="form.cpf"
                    class="w-full rounded h-12 text-xl text-gray-500 font-bold"
                    disabled
                    />
                    <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                        {{ form.errors.cpf}}
                    </div>
                </div>


                <h3 class="font-bold text-xl">
                    <b class="text-red-700 font-bold text-md">+</b>Triagem
                </h3>


                <div class="m-2 p-2 rounded">
                    <label class="font-bold text-xl" for="classificacao">Classificação de Risco</label>
                    <textarea placholder="Digite o Classificacao"
                    rows="1"
                    v-model="form.classificacao"
                    class="w-full rounded text-2xl text-gray-500 font-bold"

                    :class="
                {
                    'bg-red-200 border border-4 border-red-600 rounded-md text-xl font-bold text-red-800' : form.classificacao === 'Vermelho',
                    'bg-orange-200 border border-4 border-orange-600 rounded-md text-xl font-bold text-orange-800' : form.classificacao === 'Laranja',
                    'bg-yellow-200 border border-4 border-yellow-600 rounded-md text-xl font-bold text-yellow-800' : form.classificacao === 'Amarelo',
                    'bg-green-200 border border-4 border-greend-600 rounded-md text-xl font-bold text-greend-800' : form.classificacao === 'Verde',
                    'bg-blue-200 border border-4 border-blue-600 rounded-md text-xl font-bold text-blue-800' : form.classificacao === 'Azul',
                }
                "
                disabled
                ></textarea>
            </div>

            <div class="m-2 p-2 rounded">
                <label class="font-bold text-xl" for="observacao_triagem">Observação</label>
                    <textarea placholder="Digite o Classificacao" rows="2" v-model="form.observacao_triagem"
                    class="w-full rounded text-2xl text-gray-500 font-bold" disabled></textarea>
                </div>

                </div>
                <div class=" p-4 rounded-lg bg-gray-100 dark:bg-gray-800"
                id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab"
                v-if="refTabs.clinico"
                >

                <h3 class="font-bold text-xl">
                <b class="text-red-700 font-bold text-md">+</b>Atendimento Clínico
            </h3>

            <div class="m-2 p-2 rounded">
                <label class="font-bold text-xl" for="diagnostico">Diagnóstico</label>
                <textarea placholder="Digite o Diagnóstico" rows="1" v-model="form.diagnostico"
                class="w-full rounded text-2xl text-gray-500 font-bold"></textarea>
            </div>

            <div class="m-2 p-2 rounded">
                <label class="font-bold text-xl" for="observacao">Observação</label>
                <textarea placholder="Digite a observacao" rows="3" v-model="form.observacao"
                class="w-full rounded text-2xl text-gray-500 font-bold"></textarea>
            </div>





        </div>
        
        <div class=" p-4 rounded-lg bg-gray-100 dark:bg-gray-800"
        id="settings" role="tabpanel" aria-labelledby="settings-tab"
        v-if="refTabs.exame"
        >

        <h3 class="font-bold text-xl">
            <b class="text-red-700 font-bold text-2xl">+</b> Solicitação de Exame
        </h3>
        <!-- Hemograma, Colesterol, Ureia e Creatinina, Papanicolau, Exame de Urina,
            Exame de Fezes, Glicemia, Transaminases ALT/AST Transaminases TGP/TGO TSH/T4 Livre  -->


            <div class="flex flex-row flex-wrap wrap">

                <div class="items-center m-4"  v-for="e in exames" :key="e.id">
                    <input
                    type="checkbox"
                    name="checkbox-exame"
                    v-model="form.exame"
                    :value="e.id"
                    :id="'checkbox-exame-'+e.id"
                        class="w-6 h-6 text-red-600 bg-gray-100 border-gray-400 border-4 rounded focus:ring-red-500
                        dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        >
                        <label :for="'checkbox-exame-'+e.id" class="ml-2 text-xl font-bold text-gray-900 dark:text-gray-300">
                            {{ e.exame }}
                        </label>
                    </div>



                </div>

                <div class="flex justify-center m-auto w-2/3 ">
                    <button class="h-max rounded-md p-2 m-4 bg-red-500 text-white font-bold text-md">
                        Imprimir Solicitação
                    </button>
                </div>

                <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border border-1 bg-gray-200 rounded-xl" >
xxx
                    <b class="font-bold">Exames Solicitados: </b>
                    <div v-for="e in exame" :key="e.id" class="text-gray-700 w-full ml-4 p-2">
                        <span v-for="aux in e.exame_auxes" :key="aux.id">
                            <b class="text-red-700 font-bold">•</b>
                            {{ aux.exame }} <span class="text-sm mx-4 text-red-400">{{ moment(e.updated_at).format('DD/MM/YYYY HH:mm:ss') }}</span>

                            <!-- :href="`/storage/${e.resultado}`" -->

                            <a
                            v-if="e.resultado"
                            :href="'../storage/'+e.resultado"
                            target="_blank"
                                rel="noopener noreferrer"
                                class="border border-4 border-emerald-600 text-emerald-600 font-bold text-md p-2 rounded-xl hover:bg-emerald-600 hover:text-white"
                            >
                                Disponível - {{ moment(e.updated_at).format('DD/MM/YYYY HH:mm:ss') }}
                            </a>


                        <span
                        v-else
                        class="px-2 border border-4 border-red-600 text-red-600 text-2xl rounded-md font-bold"
                        >
                        Indisponível
                    </span>

                </span>
            </div>
        </div>





            </div>
                <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-800"
                id="contacts" role="tabpanel" aria-labelledby="contacts-tab"
                v-if="refTabs.imagem"
                >

                <h3 class="font-bold text-xl">
                            <b class="text-red-700 font-bold text-2xl">+</b>Solicitação de Imagem
                        </h3>


                        <div class="flex flex-row flex-wrap wrap">
                        <!-- RX Tórax, RX Coluna, Pulmão, Seios da Face, Abdômen, Membros Inferiores, Menbros Superiores -->
                        <div class="items-center m-4"  v-for="e in imagems" :key="e.id">
                            <input
                            type="checkbox"
                            name="checkbox-imagem"
                            v-model="form.imagem"
                            :value="e.id"
                            :id="'checkbox-imagem-'+e.id"
                            class="w-6 h-6 text-red-600 bg-gray-100 border-gray-400 border-4 rounded focus:ring-red-500
                             dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label :for="'checkbox-imagem-'+e.id" class="ml-2 text-xl font-bold text-gray-900 dark:text-gray-300">
                                {{ e.imagem }}
                            </label>
                        </div>

                    </div>



                    <div class="flex justify-center m-auto w-2/3 ">
                        <button class="h-max rounded-md p-2 m-4 bg-red-500 text-white text-2xl">
                            Imprimir Solicitação
                        </button>
                    </div>


                    <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border border-1 bg-gray-200 rounded-xl" >

                        <b class="font-bold">Diagnóstico por Imagem Solicitados: </b>
                        <div v-for="i in image" :key="i.id" class="text-gray-700 w-full ml-4 p-2">
                            <span v-for="aux in i.imagem_auxes" :key="aux.id">
                                <b class="text-red-700 font-bold">•</b>
                                {{ aux.imagem }} <span class="text-sm mx-4 text-red-400">{{ moment(i.updated_at).format('DD/MM/YYYY HH:mm:ss') }}</span>

                                <a
                                v-if="i.resultado"
                                    :href="'../storage/'+i.resultado"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="border border-4 border-emerald-600 text-emerald-600 font-bold text-md p-2 rounded-xl hover:bg-emerald-600 hover:text-white"
                                >
                                    Disponível - {{ moment(i.updated_at).format('DD/MM/YYYY HH:mm:ss')}}
                                </a>

                            <span
                            v-else
                            class="px-2 border border-4 border-red-600 text-red-600 text-2xl rounded-md font-bold"
                            >
                            Indisponível
                        </span>

                    </span>
                </div>

            </div>






            </div>
                <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-800"
                id="contacts" role="tabpanel" aria-labelledby="contacts-tab"
                v-if="refTabs.ambulatorial"
                >



                <h3 class="font-bold text-xl">
                    <b class="text-red-700 font-bold text-md">+</b>Solicitação de Procedimento Ambulatorial
                </h3>


                <ul class="items-center w-full text-2xl font-medium text-gray-900 border border-gray-200
                rounded-lg  dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 "
                    >

                    <div class=" items-center pl-3 ">

                        <label class="font-bold text-xl" for="procedimento">Procedimento </label>
                        <select
                            name="proc"
                            id="proc"
                            class="text-xl w-full"
                            v-model="form.proc_procedimento"
                        >
                            <option v-for="p in procedimentos" :key="p.id" :value="p.id+' - '+p.procedimento">{{p.id+' - '+p.procedimento}}</option>
                        </select>
                        <br>

                        <label class="font-bold text-xl mx-3" for="proc_observacao">Observação </label>
                        <textarea
                            name="proc_observacao"
                            id="proc_observacao"
                            rows="2"
                            class="text-xl w-full"
                            v-model="form.proc_observacao"></textarea>

                        <button
                            class="w-full rounded-md p-2 bg-red-500 text-white text-xl"
                            @click.prevent="addProcedimento(form.proc_procedimento, form.proc_observacao)"
                        >
                            Adicionar Procedimento
                        </button>

                    </div>
                </li>
            </ul>

            <b class="font-bold mt-4 "><b class="text-red-700 font-bold text-md">+</b>Procedimentos Solicitados: </b>

                <ul v-for="(p, index) in form.ambulatorio" :key="p.id" class="text-gray-700 w-full ml-4 p-2">
                    <li>
                        - Procedimento: {{ p.proc+', Observação: '+p.observacao }}
                            <button @click.prevent="() => {  form.ambulatorio.splice(form.ambulatorio.indexOf(p), 1)  }"
                                class="bg-red-700 hover:bg-red-400  text-white px-2 py-1 rounded-xl text-md"
                            > Remover </button>
                    </li>
                </ul>

                <div class="flex justify-center m-auto w-2/3 ">
                    <button class="h-max rounded-md p-2 m-4 bg-red-500 text-white text-2xl" v-if="form.ambulatorio.length > 0">
                        Imprimir Solicitação do Procedimento
                    </button>
                </div>

                <div class="flex justify-center m-auto w-2/3 ">
                    <button class="h-max rounded-md p-2 m-4 bg-red-500 text-white text-xl">
                        Imprimir Solicitação
                    </button>
                </div>

        <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border border-1 bg-gray-200 rounded-xl" >



                <div
                    class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border border-1 bg-gray-200 rounded-xl"
                >

                <b class="font-bold"><b class="text-red-700 font-bold text-md">+</b>Procedimentos realizados: </b>
                <div v-for="a in ambulatorios" :key="a.id" class="text-green-700 w-full ml-4 p-2">
                        <b>Procedimento: {{ a.procedimentos[0].procedimento }} </b> - Concluído em {{ moment(a.dthrfim).format('DD/MM/YYYY HH:mm:ss') }}
                    </div>
                    
                    <p class="border border-2 border-gray-300 bg-gray-100 m-2 p-5 rounded-xl"><b>
                        Anotação da Enfermagem:</b> {{ ambulatorios[0] ? ambulatorios[0].anotacao : '' }}
                    </p>
                    <!-- {{ ambulatorios }} -->
                </div>
            </div>

            </div>
                <div class="p-4 rounded-lg bg-gray-100 dark:bg-gray-800"
                id="contacts" role="tabpanel" aria-labelledby="contacts-tab"
                v-if="refTabs.alta"
                >
                <h3 class="font-bold text-xl">
                    <b class="text-red-700 font-bold text-md">+</b>Alta
                </h3>

                <ul class="items-center w-full text-2xl font-medium text-gray-900 border border-gray-200
                rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input
                            type="radio"
                            v-model="form.alta"
                            value="Alta"
                                    :checked="form.alta == 'Alta'"
                                    name="radio-alta"
                                    id="radio-alta-1"
                                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                     dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2
                                     dark:bg-gray-600 dark:border-gray-500 w-6 h-6"

                                    >

                            <label for="radio-alta-1" class="w-full py-3 ml-2 text-xl font-medium">
                                Alta
                            </label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input
                            type="radio"
                            v-model="form.alta"
                            value="Alta após procedimento"
                            :checked="form.alta == 'Alta após procedimento'"
                            name="radio-alta"
                            id="radio-alta-2"
                            class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                            dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2
                            dark:bg-gray-600 dark:border-gray-500 w-6 h-6 focus:ring-red-500">

                            <label for="radio-alta-2" class="w-full py-3 ml-2 text-xl font-medium text-gray-900 dark:text-gray-300">
                                Alta após procedimento
                            </label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center pl-3">
                            <input
                            type="radio"
                            v-model="form.alta"
                            value="Retorno"
                            :checked="form.alta == 'Retorno'"
                            name="radio-alta"
                            id="radio-alta-3"
                                class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-blue-500
                                dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500
                                w-6 h-6 focus:ring-red-500"
                                >
                                <label for="radio-alta-3" class="w-full py-3 ml-2 text-xl font-medium text-gray-900 dark:text-gray-300">
                                    Retorno
                                </label>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                {{ form.errors.alta}}
            </div>

            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                {{ form.errors.diagnostico}}
            </div>
            <div class="bg-red-100 my-2 px-5 text-red-700 text-bold font-semibold text-md">
                {{ form.errors.observacao}}
            </div>

            <ValidadorAssinatura :f="form"/>

        <!-- <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b justify-center">
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
        </div> -->



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
    import ValidadorAssinatura from '@/Components/Utils/ValidadorAssinatura.vue'
    import moment from 'moment';

    // Funções do Módulo Clinico
    const props = defineProps({
      atendimento: {
          type: Object
      },
      exames: {
        type: Object
      },
      exame: {
        type: Object
      },
      imagems: {
        type: Object
      },
      image: {
        type: Object
      },
      procedimentos: {
        type: Object
      },
      ambulatorios: {
        type: Object
    }
})

    const refCont = ref(0)
    const refProcedimentos = ref([])
    const refTabs = ref({
        paciente: true,
        triagem: false,
        triagem: false,
        clinico: false,
        exame: false,
        imagem: false,
        ambulatorial: false,
        alta: false,
    })

    const alternaTab = (tab) => {
        if(tab == 'paciente') {
            refTabs.value.paciente = true
            refTabs.value.triagem = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = false
            refTabs.value.alta = false
        }

        if(tab == 'triagem') {
            refTabs.value.paciente = false
            refTabs.value.triagem = true
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = false
            refTabs.value.alta = false
        }

        if(tab == 'clinico') {
            refTabs.value.paciente = false
            refTabs.value.triagem = false
            refTabs.value.clinico = true
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = false
            refTabs.value.alta = false
        }

        if(tab == 'exame') {
            refTabs.value.paciente = false
            refTabs.value.triagem = false
            refTabs.value.clinico = false
            refTabs.value.exame = true
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = false
            refTabs.value.alta = false
        }

        if(tab == 'imagem') {
            refTabs.value.paciente = false
            refTabs.value.triagem = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = true
            refTabs.value.ambulatorial = false
            refTabs.value.alta = false
        }
        if(tab == 'ambulatorial') {
            refTabs.value.paciente = false
            refTabs.value.triagem = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = true
            refTabs.value.alta = false
        }
        if(tab == 'alta') {
            refTabs.value.paciente = false
            refTabs.value.triagem = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = false
            refTabs.value.alta = true
        }

    }
    // console.log(props.atendimento.clinico.exame);

    const form = useForm({
        id: props.atendimento.id,
        nome: props.atendimento.nome,
        cpf:  props.atendimento.cpf,

        clinico_id: props.atendimento.clinico_id,
        observacao: props.atendimento.observacao,
        diagnostico: props.atendimento.diagnostico,
        alta: props.atendimento.alta,

        classificacao: props.atendimento.classificacao,
        observacao_triagem: props.atendimento.observacao_triagem,

        dthrinicio: '',
        status: props.atendimento.status,
        exame: [],
        imagem: [],
        ambulatorio: [],
        tipo: 'Edição',
})

  function editarClinico(){
      form.post(route('clinicos.store'),{
        preserveState: true,
        preserveScroll: true,
      })
  }
  // function editarClinico(){
  //     form.put(route('Clinicos.update', form.id), {
  //       onSuccess: closeModal()
  //     });
  // }


  function addProcedimento(procedimento, observacao = ''){
    const id = procedimento.split(' - ')[0]
    const proc = procedimento.split(' - ')[1]

    form.proc_procedimento = ''
    form.proc_observacao = ''

    refCont.value++

    if(id !== ''){

        if(form.ambulatorio.length > 0){

            const consultaProcedimento =
            form.ambulatorio.filter(
                (item) =>  item.id === id
            )

            if(consultaProcedimento.length === 0){
                form.ambulatorio.push({id, proc, observacao})
            }


        } else {
            form.ambulatorio.push({id, proc, observacao})
            form.proc_procedimento = ''
            form.proc_observacao = ''
        }
    }
}

function removeProcedimento(id){
    refProcedimentos.value.remove
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
