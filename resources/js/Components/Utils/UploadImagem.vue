<template>
    <div class="flex-shrink-0 w-1/5 h-30 w-30 text-blue-500 pl-10">
  
        <label for="foto" class="w-full text-center">
  
            <img
                class="rounded-full h-20 w-20"
                alt=""
            >
            <span v-if="!form.url" class="text-blue-500 font-bold">
              Adicionar
            </span>
            <span v-else class="text-green-500 font-bold">
              Adicionado
            </span>
          </label>
        <input
        type="file"
          placholder="Digite o resultado"
          @input=" form.foto = $event.target.files[0] "
          class="hidden"
          id="foto"
        />
              
                  
      </div>                  

</template>

<script setup>

import {ref} from 'vue'

</script>
