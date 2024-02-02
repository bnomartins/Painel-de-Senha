<template>
<!-- Aviso -->
<div class="fixed right-2 bottom-2 p-2 shadow-lg">



    <button
        class="w-full text-2xl bg-gray-300 text-gray-600 px-4 bg-opacity-0 font-bold"
        @click="()=>refSuporte = !refSuporte"
    >
        <span class="inline-flex
        items-center justify-center w-10 h-10 bg-blue-600 rounded-full">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 18" fill="currentColor">
                <path d="M18 4H16V9C16 10.0609 15.5786 11.0783 14.8284 11.8284C14.0783 12.5786 13.0609 13 12 13H9L6.846 14.615C7.17993 14.8628 7.58418 14.9977 8 15H11.667L15.4 17.8C15.5731 17.9298 15.7836 18 16 18C16.2652 18 16.5196 17.8946 16.7071 17.7071C16.8946 17.5196 17 17.2652 17 17V15H18C18.5304 15 19.0391 14.7893 19.4142 14.4142C19.7893 14.0391 20 13.5304 20 13V6C20 5.46957 19.7893 4.96086 19.4142 4.58579C19.0391 4.21071 18.5304 4 18 4Z" fill="currentColor"/>
                <path d="M12 0H2C1.46957 0 0.960859 0.210714 0.585786 0.585786C0.210714 0.960859 0 1.46957 0 2V9C0 9.53043 0.210714 10.0391 0.585786 10.4142C0.960859 10.7893 1.46957 11 2 11H3V13C3 13.1857 3.05171 13.3678 3.14935 13.5257C3.24698 13.6837 3.38668 13.8114 3.55279 13.8944C3.71889 13.9775 3.90484 14.0126 4.08981 13.996C4.27477 13.9793 4.45143 13.9114 4.6 13.8L8.333 11H12C12.5304 11 13.0391 10.7893 13.4142 10.4142C13.7893 10.0391 14 9.53043 14 9V2C14 1.46957 13.7893 0.960859 13.4142 0.585786C13.0391 0.210714 12.5304 0 12 0Z" fill="currentColor"/>
            </svg>
        </span>

        <span class="float-right text-red-500 font-bold mt-2 mr-2" :class="{'hidden': refSuporte}">X</span>

    </button>

    <div class="m-1 p-2 bg-white bg-opacity-80" :class="{'hidden' : refSuporte }">

        <div class="block w-30 border border-1 border-grey-lighter p-2 rounded-lg mb-2">
            <p>Abrir OS</p>
            <p>Dúvida</p>
            <p>Elógio</p>
            <p>Reclamação</p>
        </div>

        <div class="block w-30 border border-1 border-grey-lighter p-2 rounded-lg">
            <label class="block text-grey-darker text-sm w-full font-bold mb-2"
            for="observacao">Observação</label>

            <input class="appearance-none border rounded w-full opacity-50
            py-2 px-3 text-grey-darker text-xs" id="observacao" type="text"
            placeholder="">

            <label class="block text-grey-darker text-sm w-full font-bold mb-2"
            for="observacao">Observação</label>

            <input class="appearance-none border rounded w-full opacity-50
            py-2 px-3 text-grey-darker text-xs" id="observacao" type="text"
            placeholder="">

            <button
            class="w-full text-2xl bg-gray-100 text-gray-600 text-sm m-2 px-4 bg-opacity-50 font-bold border border-1 border-gray-400 rounded-md hover:bg-gray-200"
            @click="()=>refSuporte = !refSuporte"
            >
            Enviar
            </button>

        </div>



    </div>
</div>


</template>

<script setup>

import {ref} from 'vue'

const refSuporte = ref(true);

</script>
