<template>
<!-- Aviso -->
<div class="fixed right-2 bottom-2 p-2 shadow-lg">
            <button
                class="w-full text-2xl bg-gray-300 text-gray-600 px-4 bg-opacity-50 font-bold"
                @click="()=>refSuporte = !refSuporte"
            >
                ?
            </button>
            <div class="m-1 p-2  bg-opacity-75" :class="{'hidden' : refSuporte }">

                <div class="block w-30">
                    <label class="block text-grey-darker text-sm w-full font-bold mb-2"
                    for="observacao">Observação</label>

                    <input class="appearance-none border rounded w-full opacity-50
                    py-2 px-3 text-grey-darker text-xs" id="observacao" type="text"
                    placeholder="">
                </div>

                <div class="block w-30">

                    <label class="block text-grey-darker text-sm w-full font-bold mb-2"
                    for="observacao">Observação</label>

                    <input class="appearance-none border rounded w-full opacity-50
                    py-2 px-3 text-grey-darker text-xs" id="observacao" type="text"
                    placeholder="">
                </div>

                <button
                class="w-full text-2xl bg-gray-100 text-gray-600 text-sm m-2 px-4 bg-opacity-50 font-bold"
                @click="()=>refSuporte = !refSuporte"
                >
                Enviar
                </button>


            </div>
        </div>


</template>

<script setup>
import { computed, ref} from 'vue';
import { usePage } from '@inertiajs/vue3';

import {ref} from 'vue'

const refSuporte = ref(true);

</script>
