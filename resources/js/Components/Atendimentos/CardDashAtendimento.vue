<template>

<div class=" mt-4 grid lg:grid-cols-3 sm:grid-cols-2 p-4 gap-10 ">
    <!--Grid starts here--> 
    <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
    <div>
        <div class="text-sm text-gray-400 ">Pacientes Cadastrados</div>
        <div class="flex items-center pt-1">
        <div class="text-2xl font-medium text-gray-600 ">{{ npacientes }}</div>
        </div>
    </div>
    <div class="text-blue-500">
        <i class="fa-solid fa-hospital-user fa-2xl"></i>
    </div>
    </div>

    <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
    <div>
        <div class="text-sm text-gray-400 ">Atendimentos Abertos</div>
        <div class="flex items-center pt-1">
        <div class="text-2xl font-medium text-gray-600 ">{{natendimentoaberto}}</div>
        </div>
    </div>
    <div class="text-yellow-500">
        <i class="fa-solid fa-id-card-clip fa-2xl"></i>
    </div>
    </div>


    <div class="flex items-center justify-between p-5 bg-white rounded shadow-sm">
    <div>
        <div class="text-sm text-gray-400 ">Atendimentos Concluídos</div>
        <div class="flex items-center pt-1">
        <div class="text-2xl font-medium text-gray-600 ">{{natendimentofinalizado}}</div>
        </div>
    </div>
    <div class="text-green-500">
        <i class="fa-solid fa-id-card-clip fa-2xl"></i>
    </div>
    </div>


    </div>

</template>

  <script setup>
    import { Inertia } from "@inertiajs/inertia";
    import { Link, useForm } from "@inertiajs/vue3";
    import { nextTick, ref, onMounted } from 'vue';

defineProps({
    npacientes:
    {
        type: String
    },
    natendimentofinalizado:
    {
        type: String
    },
    natendimentoaberto:
    {
        type: String
    }
})

  </script>
