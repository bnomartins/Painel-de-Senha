<template>




  <button
    class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-md text-center"  
    @click.prevent="abrirModal"
  >
  <i class="fa fa-print" aria-hidden="true"></i>
      Receita Especial 
  </button>

  <Modal :show="confirmar" @close="closeModal" >

      <div id="print" class="p-5 uppercase">


        <table>
          <tr>
            <td style="padding-right:25px;width:200px">

              <img :src="'../storage/'+atendimento[0].clinico[0].user.unidade.logotipo" alt="" style="width:450px; margin: auto" >

              <table class="w-full"  style="margin-top:10px;width:500px;font-size:10px">
                <tr style="height:30px">
                    <td style="border:1px solid;width:200px;padding-left:10px;text-align:center;font-size:16px;font-weight:bold">
                      Identificação do Emitente
                    </td>
                    <td style="width:100px;text-align:center;font-size:15px;font-weight:bold" rowspan="2">

                      1ª VIA FARMÁCIA<br>
                      2ª VIA PACIENTE<br>

                    </td>
                </tr>
                <tr style="height:30px">
                    <td style="border:1px solid;padding-left:10px;font-size:12px;text-align:center">
                      {{ atendimento[0].clinico[0].user.unidade.nome_fantasia }} <br>
                      CNPJ: {{ atendimento[0].clinico[0].user.unidade.cnpj }} <br>
                      ENDEREÇO: {{ atendimento[0].clinico[0].user.unidade.endereco }} {{ atendimento[0].clinico[0].user.unidade.numero }} {{ atendimento[0].clinico[0].user.unidade.bairro }} <br>
                      {{ atendimento[0].clinico[0].user.unidade.cidade }}  {{ atendimento[0].clinico[0].user.unidade.estado }}<br>
                      CEP: {{ atendimento[0].clinico[0].user.unidade.CEP }}
                  </td>
                </tr>

            </table>
    
            <br>

            Paciente: {{ atendimento[0].paciente.nome }}

            <h1 style="font-size:18px; margin:auto;margin-top:20px; font-weight:bold;text-align:center">
              Receituário Especial
            </h1>
            <br>
    
            <!-- <p v-html="replaceWithBr()" style="margin-top:20px; font-size:30px;text-justify;line-height:60px;text-align:justify"></p> -->
    
            <ul class="text-2xl" style="font-size: 12px;line-height:18px">
              <li v-for="m in medicamentos" :key="m.id">{{ m.medicamento }} - {{ m.observacao }}</li>
            </ul>
    
            <br>
            
            <span style="font-size:12px;display:block;font-weight:bold;text-align:center;text-decoration:underline">{{ refMedico }}</span>
            <span style="font-size:12px;display:block;font-weight:bold;text-align:center">{{ refConselho }} {{ refConselhoNumero }}</span>

            <table class="w-full"  style="margin-top:10px;width:500px;font-size:10px">
              <tr style="height:30px">
                  <td style="border:1px solid;width:200px;padding-left:10px;text-align:center;font-size:16px;font-weight:bold">
                    Identificação do Comprador
                  </td>
                  <td style="border:1px solid;width:200px;padding-left:10px;text-align:center;font-size:16px;font-weight:bold">
                    Identificação do Fornecedor
                  </td>
              </tr>
              <tr style="height:30px">
                <td style="border:1px solid;padding-left:10px;font-size:12px;text-align:left;line-height:20px">
                  Nome: ____________________________________<br>
                  Ident.: __________Órgão Emissor: _____<br>
                  End: _____________________________________<br>
                  Cidade: _________________________UF.:_____<br>
                  Telefone: ________________________________<br>
                  
                </td>
                <td style="border:1px solid;padding-left:10px;font-size:12px;text-align:center;line-height:20px">
                  <br><br>
                ____________________________________<br>
                Assinatura do Farmacêutico<br>
                Data: _____/_____/20_____.  
              

              </td>
              </tr>
          </table>

            


            <br>
    
            <p style="border: 1px solid black; padding:5px;line-height:15px;font-size:12px;  word-break: break-all;">Assinatura digital: ICP Brasil dfsdfsdfadsfdsafdfdf465d4fd654f3s5d4f684df65d4f654sd6f54sda6f54ds6a5f4d6f54ads65f465d4fa65
            f4d65f4ss65d4f65das4f654d65f4d65f4d6544</p>
            <p style="text-align:center;font-size:12px">Este documento pode ser verificado no site https://assinaturadigital.iti.gov.br</p>
    
              
            
            </td>

            <td style="width:500px">

              <img :src="'../storage/'+atendimento[0].clinico[0].user.unidade.logotipo" alt="" style="width:450px; margin: auto" >

              <table class="w-full"  style="margin-top:10px;width:500px;font-size:10px">
                <tr style="height:30px">
                    <td style="border:1px solid;width:200px;padding-left:10px;text-align:center;font-size:16px;font-weight:bold">
                      Identificação do Emitente
                    </td>
                    <td style="width:100px;text-align:center;font-size:15px;font-weight:bold" rowspan="2">

                      1ª VIA FARMÁCIA<br>
                      2ª VIA PACIENTE<br>

                    </td>
                </tr>
                <tr style="height:30px">
                    <td style="border:1px solid;padding-left:10px;font-size:12px;text-align:center">
                      {{ atendimento[0].clinico[0].user.unidade.nome_fantasia }} <br>
                      CNPJ: {{ atendimento[0].clinico[0].user.unidade.cnpj }} <br>
                      ENDEREÇO: {{ atendimento[0].clinico[0].user.unidade.endereco }} {{ atendimento[0].clinico[0].user.unidade.numero }} {{ atendimento[0].clinico[0].user.unidade.bairro }} <br>
                      {{ atendimento[0].clinico[0].user.unidade.cidade }}  {{ atendimento[0].clinico[0].user.unidade.estado }}<br>
                      CEP: {{ atendimento[0].clinico[0].user.unidade.CEP }}
                  </td>
                </tr>

            </table>
    
            <br>

            Paciente: {{ atendimento[0].paciente.nome }}

            <h1 style="font-size:18px; margin:auto;margin-top:20px; font-weight:bold;text-align:center">
              Receituário Especial
            </h1>
            <br>
    
            <!-- <p v-html="replaceWithBr()" style="margin-top:20px; font-size:30px;text-justify;line-height:60px;text-align:justify"></p> -->
    
            <ul class="text-2xl" style="font-size: 12px;line-height:18px">
              <li v-for="m in medicamentos" :key="m.id">{{ m.medicamento }} - {{ m.observacao }}</li>
            </ul>
    
            <br>
            
            <span style="font-size:12px;display:block;font-weight:bold;text-align:center;text-decoration:underline">{{ refMedico }}</span>
            <span style="font-size:12px;display:block;font-weight:bold;text-align:center">{{ refConselho }} {{ refConselhoNumero }}</span>

            <table class="w-full"  style="margin-top:10px;width:500px;font-size:10px">
              <tr style="height:30px">
                  <td style="border:1px solid;width:200px;padding-left:10px;text-align:center;font-size:16px;font-weight:bold">
                    Identificação do Comprador
                  </td>
                  <td style="border:1px solid;width:200px;padding-left:10px;text-align:center;font-size:16px;font-weight:bold">
                    Identificação do Fornecedor
                  </td>
              </tr>
              <tr style="height:30px">
                <td style="border:1px solid;padding-left:10px;font-size:12px;text-align:left;line-height:20px">
                  Nome: ____________________________________<br>
                  Ident.: __________Órgão Emissor: _____<br>
                  End: _____________________________________<br>
                  Cidade: _________________________UF.:_____<br>
                  Telefone: ________________________________<br>
                  
                </td>
                <td style="border:1px solid;padding-left:10px;font-size:12px;text-align:center;line-height:20px">
                  <br><br>
                ____________________________________<br>
                Assinatura do Farmacêutico<br>
                Data: _____/_____/20_____.  
              

              </td>
              </tr>
          </table>

            


            <br>
    
            <p style="border: 1px solid black; padding:5px;line-height:15px;font-size:12px;  word-break: break-all;">Assinatura digital: ICP Brasil dfsdfsdfadsfdsafdfdf465d4fd654f3s5d4f684df65d4f654sd6f54sda6f54ds6a5f4d6f54ads65f465d4fa65
            f4d65f4ss65d4f65das4f654d65f4d65f4d6544</p>
            <p style="text-align:center;font-size:12px">Este documento pode ser verificado no site https://assinaturadigital.iti.gov.br</p>
    

            </td>
          </tr>
        </table>

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
      medicamentos: {
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
                frameDoc.document.open('','','width=740,height=600');
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
    const refConselho = ref(props.atendimento[0].clinico[0].user.prestador[0] ? props.atendimento[0].clinico[0].user.prestador[0].conselho_regional : '');
    const refConselhoNumero = ref(props.atendimento[0].clinico[0].user.prestador[0] ? props.atendimento[0].clinico[0].user.prestador[0].conselho_numero : '');

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
    @media print {
      @page {
          size: landscape;
      }
  }
    </style>
  