<template>
    <Head title="Triagem" />

    <AuthenticatedLayout>
        <template #header>
            Triagem
        </template>
        <FilaAtendimento
            :atendimento="atendimento"
            :atendimentos="atendimentos"
            :titulo=" 'Triagem'"

            :npacientes="npacientes"
            :natendimentoaberto="natendimentoaberto"
            :natendimentofinalizado="natendimentofinalizado"
            :procedimentos="procedimentos"
        />

<!--  -->
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3';
import FilaAtendimento from '../../Components/Atendimentos/FilaAtendimento.vue'
import { InertiaProgress } from '@inertiajs/progress'

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
    atendimento:{
        type: Object
    },
    procedimentos: {
        type: Object
    }
})

InertiaProgress.init({
  // The delay after which the progress bar will
  // appear during navigation, in milliseconds.
  delay: 250,

  // The color of the progress bar.
  color: 'orange',

  // Whether to include the default NProgress styles.
  includeCSS: true, //this

  // Whether the NProgress spinner will be shown.
  showSpinner: false,
})


</script>
