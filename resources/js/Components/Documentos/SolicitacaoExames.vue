<template>




  <button
    class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-md text-center"  
    @click.prevent="abrirModal"
  >
  <i class="fa fa-print" aria-hidden="true"></i>
      Prescrição
  </button>

  <Modal :show="confirmar" @close="closeModal">

      <div id="print" class="p-5 uppercase">

        <img :src="'../storage/'+atendimento[0].clinico[0].user.unidade.logotipo" alt="" style="width:1000px; margin: auto" >
        <table class="w-full"  style="border:1px solid black;margin-top:10px;width:100%">
            <tr style="border:1px solid;height:40px">
                <td style="border:1px solid;width:600px;padding-left:10px;">{{ atendimento[0].clinico[0].user.unidade.nome_fantasia }}</td>
                <td style="border:1px solid;width:200px;text-align:center">{{ moment(atendimento[0].created_at).format('DD/MM/YYYY') }}</td>
            </tr>
            <tr style="border:1px solid;height:40px">
                <td style="border:1px solid;padding-left:10px;">Prontuário: {{ atendimento[0].paciente.prontuario_id }}</td>
                <td style="border:1px solid;text-align:center">Impresso por 
                    {{ $page.props.auth.user.name.split(' ')[0] }} {{ $page.props.auth.user.name.split(' ')[1] }} <br>
                    {{ moment().format('DD/MM/YY') }} {{ moment().format('hh:mm') }}
                </td>
            </tr>
            <tr style="border:1px solid;height:40px">
                <td style="border:1px solid;padding-left:10px">Paciente: {{ atendimento[0].paciente.nome }}, {{ moment().diff(moment(atendimento[0].paciente.nascimento), 'year') }} anos</td>
                <td style="border:1px solid;text-align:center">

                    <vue-barcode  :value="atendimento[0].id" tag="img" :options="{ displayValue: false, height: 40 }" style="margin:auto"></vue-barcode>


                </td>
            </tr>
        </table>

        <h1 style="font-size:45px; margin:auto;margin-top:50px; font-size:30px; font-weight:bold;text-align:center">
            Solicitação de Exame
        </h1>
        
        <br>

        <!-- <p v-html="replaceWithBr()" style="margin-top:20px; font-size:30px;text-justify;line-height:60px;text-align:justify"></p> -->

        <ul class="text-2xl" style="font-size: 25px">
            <li v-for="m in exames" :key="m.id">{{ m.procedimentos[0].procedimento }} {{ m.observacao ? ' - '+m.observacao : '' }}</li>
        </ul>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        
        <span style="font-size:25px;display:block;font-weight:bold;text-align:center;text-decoration:underline">{{ refMedico }}</span>
        <span style="font-size:25px;display:block;font-weight:bold;text-align:center">{{ refConselho }} {{ refConselhoNumero }}</span>
        
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        
        <p style="border: 1px solid black; padding:5px;line-height:30px;font-size:20px">Assinatura digital: ICP Brasil dfsdfsdfadsfdsafdfdf465d4fd654f3s5d4f684df65d4f654sd6f54sda6f54ds6a5f4d6f54ads65f465d4fa65
          f4d65f4s65d4f65das4f654d65f4d65f4d6544</p>
        
      </div>
    
      
      <div class="flex justify-end">

      <button
        @click.prevent="print"
          class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg text-center"  
        >
        <i class="fa fa-print" aria-hidden="true"></i>
        Imprimir
      </button>
    </div>

  </Modal>
    </template>

    <script setup lang="ts">
    import { Link, useForm, usePage } from "@inertiajs/vue3";
    import Modal from '@/Components/Modal.vue'
    import Aviso from '@/Components/Aviso.vue'
    import { nextTick, ref, onMounted } from 'vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import { usePaperizer } from 'paperizer'
    import moment from "moment";
    import VueBarcode from '@chenfengyuan/vue-barcode';



    const page = usePage()

    // Funções do Módulo Unidade
    const props = defineProps({
      exames: {
          type: Object
      },
      atendimento: {
        type: Object
      }
  
    })
  


const { paperize } = usePaperizer('print', {
  styles: [
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'
  ]
})
const print = () => {
  paperize()
}

    const imprimir = () => {
        const printableContent = document.getElementById('areaImpressao')
          // const printWindow = window.open('', '', 'height=1000,width=1000')
          // printWindow.document.write(printableContent.innerHTML)
          // printWindow.print()      

          let contents = document.getElementById("areaImpressao").innerHTML;
                let frame1 = document.createElement('iframe');
                frame1.name = "frame1";
                frame1.style.position = "absolute";
                frame1.style.top = "-1000000px";
                frame1.style.backgroundColor = 'blue';
                document.body.appendChild(frame1);
                let frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                frameDoc.document.open();
                frameDoc.document.write('<html lang="en"><head><title>Fiche Client</title>');
                frameDoc.document.write('<link rel="stylesheet" type="text/css" href="/css/print.css"/>');
                frameDoc.document.write("</head><body style='background-color: red'>");
                frameDoc.document.write('');
                frameDoc.document.write(contents);
                frameDoc.document.write('</body></html>');
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    document.body.removeChild(frame1);
                }, 500);
                return false;



    }

    const refBarcode = ref('teste');

    const refConteudo = ref('');
    const refMedico = ref(props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].user.name : '');
    const refConselho = ref(props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].user.prestador[0] ? props.atendimento[0].clinico[0].user.prestador[0].conselho_regional: '' : '');
    const refConselhoNumero = ref(props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].user.prestador[0] ? props.atendimento[0].clinico[0].user.prestador[0].conselho_numero: '' : '');

    const replaceWithBr = () => {
    //   refConteudo.value = props.conteudo.replace(/\n/g, '<br>')
    //   refConteudo.value = refConteudo.value.replace(/\s\s/g, '&nbsp;&nbsp;')
    //   refConteudo.value = refConteudo.value.replace('#PACIENTE#', props.atendimento[0].paciente.nome.toUpperCase())
      return refConteudo.value
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

    <style scoped>
      .tabela1 {
        background-color: teal
      }
    </style>
  