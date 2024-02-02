<template>




  <button
    class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg text-center"  
    @click.prevent="abrirModal"
  >
  <i class="fa fa-print" aria-hidden="true"></i>
      Imprimir
  </button>

  <Modal :show="confirmar" @close="closeModal">

      <div id="print" class="p-5 uppercase">

        <img :src="'../storage/img/cabecalho.jpg'" alt="" style="width:1000px; margin: auto" >

        <h1 style="font-size:45px; margin:auto;margin-top:30px; font-size:30px; font-weight:bold;text-align:center">{{ tipo }} </h1>
        <br>

        <p v-html="replaceWithBr()" style="margin-top:20px; font-size:30px;text-justify;line-height:60px;text-align:justify"></p>
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
        
        <div style="border: 1px solid black; padding:5px;line-height:30px; margin-bottom:10px;font-weight:bold;font-size:20px;text-align:justify">
          <p>
            Este atestado médico é válido para fins previstos no Artigo 27 da Consolidação das Leis da Previdência Social - CLPS aprovada pelo Decreto nº89.312 de 23/01/1984 e será para justificar de 01 a 15 dias de afastamento do trabalho.
          </p>
          <p>
            Para gestantes, Art.7º, Item VXIII da Constituição Federal/88 e Art. 392 da CLT.
          </p>
        </div>
        
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

    const page = usePage()

    // Funções do Módulo Unidade
    const props = defineProps({
      tipo: {
          type: Object
      },
      conteudo: {
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

    const refConteudo = ref('');
    const refMedico = ref(props.atendimento[0].clinico[0].user.name);
    const refConselho = ref(props.atendimento[0].clinico[0].user.prestador[0].conselho_regional);
    const refConselhoNumero = ref(props.atendimento[0].clinico[0].user.prestador[0].conselho_numero);

    const replaceWithBr = () => {
      refConteudo.value = props.conteudo.replace(/\n/g, '<br>')
      refConteudo.value = refConteudo.value.replace(/\s\s/g, '&nbsp;&nbsp;')
      refConteudo.value = refConteudo.value.replace('#PACIENTE#', props.atendimento[0].paciente.nome.toUpperCase())
      refConteudo.value = refConteudo.value.replace('#CPF-RG-CERTIDAO#', 
      props.atendimento[0].paciente.cpf ? ' PORTADOR(A) DO CPF '+props.atendimento[0].paciente.cpf :  
      props.atendimento[0].paciente.rg ?  ' PORTADOR(A) DO RG '+props.atendimento[0].paciente.rg_numero+' - '+props.atendimento[0].paciente.rg_orgao : 
      props.atendimento[0].paciente.registro ? ' PORTADOR(A) DA CERTIDÃO DE NASC.:'+props.atendimento[0].registro : '')
      refConteudo.value = refConteudo.value.replace('#NOMEDOMEDICO#', props.atendimento[0].clinico[0].user.name)
      refConteudo.value = refConteudo.value.replace('#CID#', props.atendimento[0].clinico[0].diagnostico_confirmado1.split('-')[0])
      refConteudo.value = refConteudo.value.replace('#LOCAL#', 
          props.atendimento[0].clinico[0].user.unidade.cidade ? props.atendimento[0].clinico[0].user.unidade.cidade+'/'+props.atendimento[0].clinico[0].user.unidade.estado+", " : '')
      refConteudo.value = refConteudo.value.replace('#CIDDATA#', moment(props.atendimento[0].clinico[0].created_at).format('DD/MM/YYYY'))
      refConteudo.value = refConteudo.value.replace('#CIDHORA#', ' ÀS '+moment(props.atendimento[0].clinico[0].created_at).format('hh:mm'))
      refConteudo.value = refConteudo.value.replace('#HOJE#', moment().format('DD/MM/YYYY'))
      refConteudo.value = refConteudo.value.replace('#SERVIÇO#', props.atendimento[0].clinico[0].user.service.toUpperCase())
      refConteudo.value = refConteudo.value.replace('#UNIDADE#', props.atendimento[0].clinico[0].user.unidade.nome_fantasia.toUpperCase())
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
  