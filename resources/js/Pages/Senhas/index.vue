<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <span style="font-size:5vh; line-height: 1.1em; font-weight:bold" class="text-gray-600">
                Painel de Senha
            </span>
        </template>

        <div 
            class="m-10 m-auto bg-white overflow-hidden shadow-sm sm:rounded-lg  animate-pulse text-center"
             
        >
            <div class="m-5 p-10 border-b border-gray-200 text-4xl font-bold">
                <p style="font-size: 8vh; line-height: 1.1em"  class="text-gray-600" v-show="refSenha.nome">
                    Paciente:
                </p>
                <p style="font-size: 20vh; line-height: 1.1em"  class="text-white" v-show="!refSenha.nome">
                    ...
                </p>

                <p style="font-size:9vh; line-height: 1.1em;" class="text-red-700" v-show="refSenha.nome">
                   {{  refSenha.nome }}
                </p>
            <br>
            <br>
                <p style="font-size:9vh; line-height: 1.1em;" v-show="refSenha.nome">
                    <p style="font-size: 8vh; line-height: 1.1em"  class="text-gray-600">
                        Local de Atendimento:
                    </p>
                    <p style="font-size:9vh; line-height: 1.1em;" class="text-red-700">
                        {{  refSenha.local }}                    
                    </p>
                </p>

            </div>
        </div>


        <span style="font-size:5vh; line-height: 1.1em; font-weight:bold" class="text-gray-600">
            Senhas Chamadas
        </span>

        <div class="w-full lg:max-w-full lg:flex flex flex-wrap" v-show="refSenha.nome">
            <div 
                class="m-2 border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white 
                rounded-b lg:rounded-b-none lg:rounded-r flex justify-center text-center my-5 p-4 rounded-lg text-red-400 basis-1/5
                items-center flex-1"
                v-for="s in filtroChamado(props.senhas)" :key="s.id"
            >
              <div class="my-2">
                <div class="font-bold text-4xl mb-2 text-red-600" style="font-size: 3vh; line-height: 1.1em" >
                    {{ s.atendimento.paciente.nome }}
                </div>
                <div class="font-bold text-4xl mb-2 text-gray-600" style="font-size: 3vh; line-height: 1.1em" >
                    {{ s.room }}
                </div>
              </div>

            </div>
          </div>
          
          <div class="w-full lg:max-w-full lg:flex flex flex-wrap flex-1 animate-pulse" v-show="!refSenha.nome">
            <div class="m-5 p-5 border-b border-gray-200 bg-white w-full text-center justify-center text-4xl font-bold">
                <p style="font-size: 10vh; line-height: 1.1em"  class="text-white m-auto" v-show="!refSenha.nome">
                    ...
                </p>
            </div>
          </div>


    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3';
import { Inertia, usePage } from "@inertiajs/inertia";
import {ref} from 'vue'

const refSenhas = ref([])
const refSenhasChamadas = ref([])
const refSenha = ref({
    nome: '',
    local: ''
})

const props = defineProps({
    senhas: {
        type: Object
    }
})


const form = useForm({
  })

// console.log(props.senhas)
// console.log(props.senhas)
  function filtroChamado(senhas){


    // console.log(props.senhas[0].room)
    refSenhasChamadas.value = senhas.filter(function(item) {
        return item.chamar === 0
    })
    refSenhas.value = senhas.filter(function(item) {
        return item.chamar === 1
    })
    return refSenhasChamadas.value
}

// console.log(filtroChamar())

// filtroChamar()

    let synth = window.speechSynthesis;   
  function talk(nome, local){

    // Lógica de alternância do refsenha;

    let t = `Favor, ${nome}, comparecer a ${local}`
    let voice = synth.getVoices();
    if(voice.length !== 0){
        console.log('talk')
        let msg = new SpeechSynthesisUtterance();
        // msg.voice = voices[1];
        msg.rate = 1;
        msg.pitch = 1;
        msg.text = t;
        msg.lang = 'pt-BR';
        synth.speak(msg);
    }
  }



//   function first(){
//   console.log('first')
// }
// function second(){
//   console.log('second')
// }
// let run = async ()=>{
//   await delay(2000);
//   first();
//   await delay(2000)
//   second();
// }
// run();

// const alternadorSenha = (senha) => {
//     const s = setTimeout(() => {
//         console.log('2', senha)
        
//     }, 10000);
// }


// setTimeout(() => {
    
// }, 1000);
let i = 0;
let j = 0;
console.log('sistema iniciado')

setInterval(function() {
    
    if(i > refSenhas.value.length-1) {
        i = 0
        j++
        
        if(j >= 2){
            router.reload({only: ['senhas']})
            // window.location.reload()
            j = 0
        }

        console.log('sistema recarregado')
    }

    if(refSenhas.value.length > 0 && j < 2){
        
        refSenha.value.nome = refSenhas.value[i].atendimento.paciente.nome
        refSenha.value.local = refSenhas.value[i].room
        console.log(refSenha.value.nome)
        talk(refSenha.value.nome, refSenha.value.local)
    }
    
    if(j >= 2){
        j = 0
    }


    i++

        // const element = array[index];
        // console.log('fdfdfd ---------')

}, 15000);

</script>
