<template>
<!-- Aviso -->
<div class="flex rounded-md
ml-3 text-md font-normal fixed top-2 p-2 shadow-lg w-1/2
" x-cloak x-show="showAlert" x-data="{ showAlert: true }"
:class="{'bg-red-200 text-red-600 border border-red-400' : $page.props.auth.key_codigo == '0', 'bg-yellow-100 text-yellow-700 border border-yellow-700' : $page.props.auth.key_codigo == '1'}"
>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-3 h-5 w-5 flex-shrink-0">
          <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
        </svg>

        <div><b>Aviso</b> 
          {{ $page.props.auth.key_data }}
        </div>
        <button class="ml-auto" x-on:click="showAlert = false">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
          </svg>
        </button>
      </div>


</template>

<script setup>

import {ref} from 'vue'

const refSuporte = ref(true);

</script>
