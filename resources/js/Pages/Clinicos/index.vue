<template>
    <Head title="Atendimento Clínico" />

    <AuthenticatedLayout>
        <template #header>
            Atendimento Clínico
        </template>




        <FilaAtendimento
            :atendimento="atendimento"
            :atendimentos="atendimentos"
            :titulo=" 'Clínico' "

            :npacientes="npacientes"
            :natendimentoaberto="natendimentoaberto"
            :natendimentofinalizado="natendimentofinalizado"

            />

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3';
import {computed} from 'vue'

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import CadastroTriagem from '../../Components/Clinicos/Cadastro.vue'
import EdicaoTriagem from '../../Components/Clinicos/Edicao.vue'
import ExcluirTriagem from '../../Components/Clinicos/Excluir.vue'
import ChamarSenha from '../../Components/Senhas/ChamarSenha.vue'
import FilaAtendimento from '@/Components/Atendimentos/FilaAtendimento.vue';

const page = usePage()

const user = computed(() => page.props.auth.user)

const props = defineProps({
    npacientes:{
        type: String
    },
    natendimentoaberto:{
        type: String
    },
    natendimentofinalizado:{
        type: String
    },

    atendimentos: {
        type: Object
    },
    exames: {
        type: Object
    },
    imagems: {
        type: Object
    },
    procedimentos: {
        type: Object
    }

})


const form = useForm({
      search: '',
      searchClear: false,
      clinico: {},
  })

function pesquisarClinico(){
    form.searchClear = false
    form.get(route('clinicos.index'), {
        search: form.search
    })
}

function limparPesquisaClinico(){
    form.searchClear = true
    form.search = ''

    form.get(route('clinicos.index'), {
        search: form.search
    })
}

</script>
