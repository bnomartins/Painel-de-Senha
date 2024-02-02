<template>
  <!-- <CardPaciente :paciente="p.paciente :tipo='Cadastro/Tabela'  "/> -->

  <div class="flex items-center" :class="{'ml-10': tipo==='Cadastro'}">
    <div class="flex-shrink-0"  :class="{'h-30 w-30': tipo==='Cadastro', 'h-20 w-20': tipo !=='Cadastro'}">

      <label for="foto" >

          <img
              class="rounded-full shadow-lg"
              :class="{'h-32 w-32': tipo==='Cadastro', 'h-20 w-20': tipo !=='Cadastro'}"
              :src=" paciente.foto ? '../storage/'+paciente.foto : '../storage/img/user.png'"
              alt=""
          >
      </label>

      <input class="hidden" id="foto" type="file" v-if="tipo === 'Cadastro' ">



    </div>
    <div class="ml-10 text-gray-700 p-2 rounded-l-2xl font-bold shadow-lg px-4 border border-grey-lighter" :class="{'bg-pink-50': paciente.sexo === 'Feminino', 'bg-gray-100': paciente.sexo !== 'Feminino'}">
      <div class="text-sm font-bold w-56">
            Nome: {{ paciente.nome_social ? paciente.nome_social : paciente.nome }}
            <span class="bg-red-100 border border-1 border-red-500 rounded-xl px-2 text-red-600 font-bold"
            v-if="paciente.aborh">
            {{ paciente.aborh.replace('P', '+').replace('N', '-') }}
          </span>

        </div>
        <div class="text-sm font-bold" v-show="paciente.nascimento">

            Dt. Nasc.: {{ paciente.nascimento ? moment(paciente.nascimento).format('DD/MM/YYYY') : ''}} -
            {{  moment().year() - moment(paciente.nascimento).year() }} anos
        </div>
        <div class="text-sm font-bold">
            Prontuário: {{ paciente.prontuario_id}}
        </div>

        <div class="text-sm font-bold">
            N.º Atend.: {{ triagem[0] ? triagem[0].id : '' }}
        </div>

        <div class="text-sm font-bold">
            Mãe: {{ paciente.mae }} - Pai: {{ paciente.pai }}
        </div>
    </div>

    <div class="ml-5 text-gray-700 p-2 rounded-l-2xl font-bold shadow-lg px-4 border border-grey-lighter" :class="{'bg-pink-50': paciente.sexo === 'Feminino', 'bg-gray-100': paciente.sexo !== 'Feminino'}">
      <span class="font-bold text-sm text-center">Sinais Vitais</span>
      <div class="text-sm font-bold">
          Temp.: {{ triagem[0] ? triagem[0].temperatura : '' }} <span class="text-gray-600 text-sm">ºC</span>
          <span v-if="triagem[0] ? triagem[0].temperatura >= 38 && triagem[0].temperatura !== null : false"
            class="text-sm< px-2 font-bold text-red-600 animate-pulse bg-red-100"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>
              </div>
              <div class="text-sm font-bold">
                  Sat. O²: {{ triagem[0] ? triagem[0].saturacao_o2 : '' }}<span class="text-gray-600 text-sm">SpO²</span>
                  <span v-if="triagem[0] ? triagem[0].saturacao_o2 <= 93 && triagem[0].saturacao_o2 !== null : false"
                  class="text-sm< px-2 font-bold text-red-600 animate-pulse bg-red-100"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>
              </div>
              <div class="text-sm font-bold">
                  Freq. Resp.: {{ triagem[0] ? triagem[0].frequencia_respiratoria : '' }} <span class="text-gray-600 text-sm">mrm</span>
                  <span v-if="triagem[0] ? (triagem[0].frequencia_respiratoria <= 16 && triagem[0].frequencia_respiratoria !== null && paciente.sexo == 'Masculino')
                  || (triagem[0].frequencia_respiratoria <= 18 && triagem[0].frequencia_respiratoria !== null && paciente.sexo == 'Feminino') : false"
                  class="text-sm< px-2 font-bold text-red-600 animate-pulse bg-red-100"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>
              </div>
              <div class="text-sm font-bold">
                  Freq. Card.: {{ triagem[0] ? triagem[0].frequencia_cardiaca : '' }} <span class="text-gray-600 text-sm">bpm</span>
                  <span v-if="triagem[0] ? triagem[0].frequencia_cardiaca > 90 && triagem[0].frequencia_cardiaca !== null
                  || triagem[0].frequencia_cardiaca > 100 && triagem[0].frequencia_cardiaca !== null : false"
                  class="text-sm< px-2 font-bold text-red-600 animate-pulse bg-red-100"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>
              </div>
              <div class="text-sm font-bold">
                  Pressão Art.: {{ triagem[0] ? triagem[0].pressao_arterial_sistolica+'/'+triagem[0].pressao_arterial_diastolica : '' }} <span class="text-gray-600 text-sm">mmHg</span>
                  <span v-if="
                    triagem[0] ? triagem[0].pressao_arterial_sistolica > 135
                    && triagem[0].pressao_arterial_diastolica > 85 : false"
                    class="text-sm< px-2 font-bold text-red-600 animate-pulse bg-red-100"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                </span>                  
              </div>
              <div class="text-sm font-bold">
                Glicemia Cap.: {{ triagem[0] ? triagem[0].glicemia_capilar : '' }} <span class="text-gray-600 text-sm">mg/dL</span>
                <span v-if="triagem[0] ? triagem[0].glicemia_capilar > 100  && triagem[0].glicemia_capilar !== null ||triagem[0].frequencia_cardiaca < 70 && triagem[0].glicemia_capilar !== null : false"
                class="text-sm< px-2 font-bold text-red-600 animate-pulse bg-red-100"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </span>

        </div>
        </div>
        <div class="ml-5 text-gray-700 p-2 rounded-l-2xl font-bold ">

          <ChartRadar 
            :labels="['Temp. ºC', 'SAT. SpO²', 'FR mrm', 'FC bpm', 'GC mg/dL', 'PA-Sist.', 'PA-Dist.']" 
            :data="[triagem[0] ? triagem[0].temperatura : 0, triagem[0] ? triagem[0].saturacao_o2 : 0, triagem[0] ? triagem[0].frequencia_respiratoria : 0, triagem[0] ? triagem[0].frequencia_cardiaca : 0, triagem[0] ? triagem[0].glicemia_capilar : 0, triagem[0] ? triagem[0].pressao_arterial_sistolica : 0, triagem[0] ? triagem[0].pressao_arterial_diastolica : 0]"
            :data2="[38, 18, 100, 0 ,30, 100, 100, 80]"
            :name="'Sinais Vitais'"
          />


        </div>
        </div>
        <div class="text-sm font-bold"
          :class="{
            'bg-red-100 border border-2 border-red-500 text-red-600 p-1 pl-4 my-2 rounded-md shadow-lg' : triagem[0].classificacao === 'VERMELHO',
            'bg-orange-100 border border-2 border-orange-500 text-orange-600 p-1 pl-4 my-2 rounded-md shadow-lg' : triagem[0].classificacao === 'LARANJA',
            'bg-yellow-100 border border-2 border-yellow-500 text-yellow-600 p-1 pl-4 my-2 rounded-md shadow-lg' : triagem[0].classificacao === 'AMARELO',
            'bg-blue-100 border border-2 border-blue-500 text-blue-600 p-1 pl-4 my-2 rounded-md shadow-lg' : triagem[0].classificacao === 'AZUL',
            'bg-green-100 border border-2 border-green-500 text-green-600 p-1 pl-4 my-2 rounded-md shadow-lg' : triagem[0].classificacao === 'VERDE',
            'bg-gray-100 border border-2 border-gray-500 text-gray-600 p-1 pl-4 my-2 rounded-md shadow-lg' :
              triagem[0].classificacao !== 'Vermelho' ||
              triagem[0].classificacao !== 'Laranja' ||
              triagem[0].classificacao !== 'Amarelo' ||
              triagem[0].classificacao !== 'Azul' ||
              triagem[0].classificacao !== 'Verde',
          }
            "
          v-if="triagem[0] ? triagem[0].classificacao !== null : false"
          >
            Classificação: {{ triagem[0] ? triagem[0].classificacao : '' }}
          <div>
            Alergia.: 
            <Multiselect
              class="appearance-none w-full pb-2 px-3 text-grey-darker 
                  border border-1 border-black rounded-md
              "                                        
              v-model="refAlergia"
              mode="tags"
              :close-on-select="true"
              :searchable="true"
              :object="true"
              :create-option="true"
              :options="[
                  ]"
                  disabled
              />
              
          </div>
          <div>
            Observação.: {{ triagem[0] ? triagem[0].observacao : '' }}
          </div>
</div>

</template>

<style src="@vueform/multiselect/themes/default.css"></style>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import Modal from '@/Components/Modal.vue'
import Aviso from '@/Components/Aviso.vue'
import { nextTick, ref } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import moment from 'moment'
import ChartRadar from '../../Components/Triagems/ChartRadar.vue'
import Multiselect from '@vueform/multiselect'

const props = defineProps({
  paciente: {
    Type: Object
  },
  triagem: {
    Type: Object
  },
  tipo: {
    Type: String
  }
})

const refAlergia = ref(props.triagem[0] ? props.triagem[0].alergia ? JSON.parse(props.triagem[0].alergia) : [] : [])


</script>
