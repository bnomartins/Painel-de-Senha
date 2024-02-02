<template>
    <Head title="Rotinas Médicas" />

    <AuthenticatedLayout>
        <template #header>
            Rotinas Médicas
        </template>


        <div class="flex-auto ">
            <form @submit.prevent="editarClinico()"  enctype="multipart/form-data"  class="w-full">

            <div class="flex flex-col screens-sm">

                <!-- Clínico -->

                <div class="font-sans antialiased bg-grey-lightest">



                    <div class="w-full mt-2">
                        <div class="container mx-auto py-2">
                        <div class="w-full sm:min-w-sm mx-auto bg-white">


            <div class="flex ">
                <div class="flex flex-column mr-2" style="width:15rem">

                    <div id="accordion-collapse" data-accordion="collapse" class="mt-52">
                        <h2 id="accordion-collapse-heading-1"
                            v-if="consultas[0].clinico[0] ? consultas[0].clinico[0].exames[0] : false"
                        >
                            <button type="button" class="flex items-center justify-between w-full my-2 p-1 py-1 text-left text-md
                            font-bold text-blue-600  px-2 rounded-r-xl shadow-sm hover:bg-blue-100"
                              data-accordion-target="#accordion-collapse-body-1"
                              aria-expanded="true"
                              aria-controls="accordion-collapse-body-1"
                              @click.prevent="alternaMenu('exames')"
                              >
                                <span>Exames</span>
                            </button>
                        </h2>
                        <div :class="{'hidden' : !refMenu.exames}">

                            <!-- {{  atendimento[0].clinico[0].exames }} -->

                            <div class="text-gray-800 bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            >
                            
                            <div class="flex flex-col items-center w-full px-2 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg"
                                v-for="a in consultas" :key="a.id"
                            >
                                <span class="flex flex-col w-full font-bold text-sm">
                                    Nº Atend.: {{a.id}} - {{ moment(a.updated_at).format('D/M/Y') }}
                                </span>
                                <div v-for="c in a.clinico" :key="c.id" class="flex flex-col  w-full">
                                    <div v-for="e in c.exames" :key="e.id" class="flex flex-col  w-full">

                                        <a
                                        :href="'../storage/'+e.resultado"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class=" w-full ml-2
                                            text-sm
                                        hover:bg-gray-100 hover:text-blue-700
                                         focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700
                                         dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white"
                                        >
                                            <i class="fa fa-check-square mr-2 mt-2  text-green-500" v-if="e.resultado"></i>
                                            <i class="fa fa-check-square mr-2 mt-2  text-yellow-500" v-else></i>
                                            <!-- <span>{{ e.exame_auxes[0].exame}}<br>{{ moment(e.updated_at).format('D/M/Y-H:M') }}</span> -->
                                            <span class="font-bold">
                                                {{ moment(e.updated_at).format('DD/MM/YY hh:mm:ss') }}
                                            </span>
                                            <span class="font-xs">
                                                {{ " "+e.procedimentos[0].procedimento }}
                                            </span> 
                                        </a>

                                    </div>
                                </div>
                            </div>

                            </div>

                        </div>
                        <h2 id="accordion-collapse-heading-1"
                            v-if="consultas[0].clinico[0] ? consultas[0].clinico[0].imagems[0] : false"
                        >
                            <button type="button" class="flex items-center justify-between w-full my-2 p-1 py-1 text-left text-md
                            font-bold text-blue-600  px-2 rounded-r-xl shadow-sm hover:bg-blue-100"
                                  data-accordion-target="#accordion-collapse-body-1"
                                  aria-expanded="true"
                                  aria-controls="accordion-collapse-body-1"
                                    @click.prevent="alternaMenu('imagems')"
                                >
                                <span>Imagens</span>
                            </button>
                        </h2>
                        <div :class="{'hidden' : !refMenu.imagems}">

                            <div class="flex flex-col items-center w-full px-2 py-2 text-sm font-medium border-b border-gray-200 rounded-t-lg"
                                v-for="a in consultas" :key="a.id"
                            >
                                <span class="flex flex-col w-full font-bold text-sm"
                                >
                                    Nº Atend.: {{a.id}} - {{ moment(a.updated_at).format('D/M/Y') }}
                                </span>
                                <div v-for="c in a.clinico" :key="c.id" class="flex flex-col  w-full">
                                    <div v-for="e in c.imagems" :key="e.id" class="flex flex-col  w-full">

                                        <a
                                        :href="'../storage/'+e.resultado"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class=" w-full ml-2
                                            text-sm
                                        hover:bg-gray-100 hover:text-blue-700
                                         focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700
                                         dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white"
                                        >
                                            <i class="fa fa-check-square mr-2 mt-2  text-green-500" v-if="e.resultado"></i>
                                            <i class="fa fa-check-square mr-2 mt-2  text-yellow-500" v-else></i>
                                            <!-- <span>{{ e.exame_auxes[0].exame}}<br>{{ moment(e.updated_at).format('D/M/Y-H:M') }}</span> -->
                                            <span class="font-bold">
                                                {{ moment(e.updated_at).format('DD/MM/YY hh:mm:ss') }}
                                            </span>
                                            <span class="font-xs">
                                                {{ " "+e.procedimentos[0].procedimento }}
                                            </span> 
                                        </a>

                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>
                </div>
                <div class="flex flex-column flex-0 w-full">

                    <div class="border border-grey-ligther rounded-lg w-full">
                        <div class="flex-row">
                            <div class="flex-col">

                                <div class="font-sans antialiased rounded-xl shadow-lg bg-grey-lighter p-4">
                                    <!-- Card Resumo do Paciente -->

                                    <CardPacienteAtendimento :paciente="atendimento[0].paciente" :tipo="'Cadastro'" :triagem="atendimento[0].triagem"/>
                                </div>


                            </div>
                        </div>




                        <ul class="flex flex-wrap -mb-px text-md font-bold text-center text-gray-700 mt-5"
                            id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('resumo')"
                                >
                                    Resumo
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('anamnese')"
                                >
                                    Anamnese
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('diagnostico')"
                                >
                                    Hipotése/Diagnóstico
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('prescricao')"
                                >
                                    Prescrição
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('exame')"
                                >
                                    Exames
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('imagem')"
                                >
                                    Imagens
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('procedimento')"
                                >
                                    Procedimentos
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('evolucao')"
                                >
                                    Evolução
                                </button>
                            </li>

                            <li
                                class="mr-2 border border-grey-lighter rounded-t-lg
                                hover:bg-gray-100"
                                role="presentation"
                            >
                                <button class="inline-block p-2 py-3 rounded-t text-xl
                                font-bold"
                                id="profile-tab" data-tabs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false"
                                @click.prevent="alternaTab('documentos')"
                                >
                                    Documentos
                                </button>
                            </li>


                        </ul>

                        <!-- Resumo -->
                        <div id="myTabContent" class=" border border-grey-ligther rounded-lg">

                            <div class=" p-4 rounded-lg"
                            id="profile" role="tabpanel" aria-labelledby="profile-tab"
                            v-if="refTabs.resumo"
                            >

                            <div class="py-2 px-2 text-black text-2xl font-bold">
                                Resumo
                            </div>


                                <div class="py-4 px-8">


                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="queixa">Queixa</label>
                                        <textarea 
                                            class="appearance-none border rounded w-full py-2 px-3 text-grey-darker uppercase"
                                        rows="1"
                                        :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].queixa : '' "
                                        disabled
                                        ></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="alergia">Alergia</label>

                                        <Multiselect
                                        class="appearance-none w-full pb-2 px-3 text-grey-darker 
                                            border border-1 border-black rounded-md disabled
                                        "                                        
                                        v-model="refAlergia"
                                        mode="tags"
                                        :close-on-select="false"
                                        :object="true"
                                        :options="[]"   
                                        disabled
                                        />

                                    </div>

                                    <div class="flex mb-4">

                                        <div class="w-1/4 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="observacao">Classificação</label>

                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                            placeholder=""
                                            :class="{
                                                'border border-1 border-red-500 text-red-500 font-bold bg-red-100' : atendimento[0].triagem[0] ? atendimento[0].triagem[0].classificacao === 'VERMELHO' ? true : false : false,
                                                'border border-1 border-orange-500 text-orange-500 font-bold bg-orange-100' : atendimento[0].triagem[0] ? atendimento[0].triagem[0].classificacao === 'LARANJA' ? true : false: false,
                                                'border border-1 border-yellow-500 text-yellow-500 font-bold bg-yellow-100' : atendimento[0].triagem[0] ? atendimento[0].triagem[0].classificacao === 'AMARELO' ? true : false: false,
                                                'border border-1 border-green-500 text-green-500 font-bold bg-green-100' : atendimento[0].triagem[0] ? atendimento[0].triagem[0].classificacao === 'VERDE' ? true : false: false,
                                                'border border-1 border-blue-500 text-blue-500 font-bold bg-blue-100' : atendimento[0].triagem[0] ? atendimento[0].triagem[0].classificacao === 'AZUL' ? true : false: false,
                                            }"
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].classificacao : ''"
                                            disabled
                                            >

                                        </div>
                                        <div class="w-3/4 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="observacao">Observação</label>

                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="observacao" type="text"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].observacao : ''"
                                            disabled
                                           >

                                        </div>
                                    </div>

                                    <div class="flex mb-4">
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="peso">Peso</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="peso" type="number"
                                            step="any"
                                            placeholder="(Kg)"
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].peso : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="altura">Altura</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="altura" type="number"
                                            step="any"
                                            placeholder="(cm)"
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].altura : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="cintura">Cintura</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="cintura" type="number"
                                            step="any"
                                            placeholder="(cm)"
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].cintura : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 ml-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="perimetro_cefalico">Perimetro Cefálico</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="perimetro_cefalico" type="number"
                                            step="any"
                                            placeholder="(cm)"
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].perimetro_cefalico : ''"
                                            disabled
                                            >
                                        </div>
                                    </div>

                                    <div class="flex mb-4">
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="frequencia_respiratoria">Frequência Respiratória</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="frequencia_respiratoria" type="number"
                                            step="any"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].frequencia_respiratoria : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="frequencia_cardiaca">Frequência Cardiaca</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="frequencia_cardiaca" type="number"
                                            step="any"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].frequencia_cardiaca : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="flex w-1/2">

                                            <div class="w-1/2 ml-1">
                                                <label class="block text-grey-darker text-md font-bold mb-2 text-center"
                                            for="pressao_arterial_sistolica">Pressão Arterial Sist.</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="pressao_arterial_sistolica" type="number"
                                            step="any"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].pressao_arterial_sistolica : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 ml-1">
                                            <label class="block text-grey-darker text-md font-bold mb-2 text-center"
                                            for="pressao_arterial_diastolica">Pressão Arterial Diast.</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="pressao_arterial_diastolica" type="number"
                                            step="any"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].pressao_arterial_diastolica : ''"
                                            disabled
                                            >
                                        </div>
                                    </div>
                                    </div>

                                    <div class="flex mb-4">
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="temperatura">Temperatura</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="temperatura" type="number"
                                            step="any"
                                            placeholder="(°C)"
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].temperatura :''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 mr-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="glicemia_capilar">Glicemia Capilar</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="glicemia_capilar" type="number"
                                            step="any"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].glicemia_capilar : ''"
                                            disabled
                                            >
                                        </div>
                                        <div class="w-1/2 ml-1">
                                            <label class="block text-grey-darker text-lg font-bold mb-2"
                                            for="saturacao_o2">Saturação O²</label>
                                            <input class="appearance-none border rounded w-full
                                            py-2 px-3 text-grey-darker" id="saturacao_o2" type="number"
                                            step="any"
                                            placeholder=""
                                            :value="atendimento[0].triagem[0] ? atendimento[0].triagem[0].saturacao_o2 : ''"
                                            disabled
                                            >
                                        </div>
                                    </div>

                                </div>

                            </div>

                </div>

                        <!-- Anamnese -->
                        <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                            <div class=" p-4 rounded-lg"
                            id="profile" role="tabpanel" aria-labelledby="profile-tab"
                            v-if="refTabs.anamnese"
                            >

                            <div class="py-2 px-2 text-black text-2xl font-bold">
                                Anamnese
                            </div>


                                <div class="py-4 px-8">
                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="queixa">Queixa Principal e duração</label>
                                        <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        rows="3"
                                        v-model="form.anamnese_queixa"
                                        ></textarea>
                                    </div>
                                </div>


                                <div class="py-4 px-8 flex gap-3">
                                    
                                    <div class="mb-4 w-1/2">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="alergia">Histórico da Moléstia Atual</label>
                                        <textarea 
                                        rows="6"
                                        class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        v-model="form.anamnese_historico_molestia"
                                        ></textarea>
                                    </div>

                                    <div class="mb-4 w-1/2">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="alergia">Histórico Patológica Pregressa</label>
                                        <textarea 
                                        rows="6"
                                        class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        v-model="form.anamnese_historico_patologia"
                                        ></textarea>
                                    </div>


                                    <div class="mb-4 w-1/2">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="alergia">Histórico Familiar</label>
                                        <textarea 
                                            rows="6"
                                            class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                            v-model="form.anamnese_historico_familiar"
                                        ></textarea>
                                    </div>

                                </div>
                                <div class=" px-8">
                                    
                                    <div class="flex mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mt-2"
                                        for="peso">Antecedentes Mórbidos</label>
                                    </div>
                                    <div class="mb-4">

                                        <Multiselect
                                            class="appearance-none w-full pb-2 px-3 text-grey-darker 
                                                border border-1 border-black rounded-md
                                            "                                        
                                            v-model="form.anamnese_antecedentes_morbidos"
                                            mode="tags"
                                            :close-on-select="false"
                                            :searchable="true"
                                            :object="true"
                                            :create-option="true"
                                            :options="[
                                                'Hipertensão Arterial Sistêmica', 
                                                'Diabetes Mellitus', 
                                                'Dislipidemia',
                                                'Obesidade',
                                                'Asma',
                                                'Hipotireodismo',
                                                'Tabagismo',
                                                'Alcoolismo',
                                                'Acidente Vascular Cerebral',
                                                'DPOC',
                                                'Infarto Agudo do Miocárdio',
                                                'Arritimia Cardiaca',
                                                'Insuficiência Cardiaca',
                                                'Insuficiência renal',
                                                ]"
                                        />

                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="queixa">Exame Físico</label>
                                        <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        rows="2"
                                        v-model="form.anamnese_exame_fisico"
                                        ></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="queixa">Observação</label>
                                        <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        rows="2"
                                        v-model="form.anamnese_observacao"
                                        ></textarea>
                                    </div>


                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="frequencia_respiratoria">Hipótese Diagnóstica:</label>
                                        <input class="appearance-none border rounded w-full
                                        py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                        list="list_cid"
                                        v-model="form.diagnostico_hipotese1"
                                        >
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                        for="frequencia_respiratoria">Confirmação Diagnóstica:</label>
                                        <input class="appearance-none border rounded w-full
                                        py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                        list="list_cid"
                                        v-model="form.diagnostico_confirmado1"
                                        >
                                    </div>

                                </div>

                            </div>

                        </div>

                    <!-- Diagnostico -->
                    <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                        <div class=" p-4 rounded-lg"
                        id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        v-if="refTabs.diagnostico"
                        >

                        <div class="py-2 px-2 text-black text-2xl font-bold">
                            Diagnóstico
                        </div>
                            <div class="flex mb-4">
                                <div class="w-1/5 mr-1">
                                    
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="discriminacao">Versão</label>
                                    <input
                                        type="text"
                                        list="list_riscos"
                                        class="w-full appearance-none border rounded w-full
                                        py-2 px-3 text-grey-darker"
                                        value="CID 10"
                                        disabled
                                        >                                       
                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Hipótese Dignóstica - 1º</label>

                                    <input class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                    list="list_cid"
                                    v-model="form.diagnostico_hipotese1"
                                    >

                                    
                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Observação</label>
                                    
                                    <textarea cols="30" rows="1" class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker"
                                    v-model="form.diagnostico_hipotese1_observacao"></textarea>

                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Status</label>

                                    <select class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" disabled>
                                        <option value="Hipótese">Hipótese</option>
                                        <option value="Confirmado">Confirmado</option>
                                    </select>

                                </div>
                            </div>

                            <div class="flex mb-4">
                                <div class="w-1/5 mr-1">
                                    
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="discriminacao">Versão</label>
                                    <input
                                        type="text"
                                        list="list_riscos"
                                        class="w-full appearance-none border rounded w-full
                                        py-2 px-3 text-grey-darker"
                                        value="CID 10"
                                        disabled
                                        >                                       
                                        
                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Hipótese Dignóstica - 2º</label>

                                    <input class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                    placeholder=""
                                    list="list_cid"
                                    v-model="form.diagnostico_hipotese2"
                                    >

                                    
                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Observação</label>
                                    
                                    <textarea cols="30" rows="1" class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" 
                                    v-model="form.diagnostico_hipotese2_observacao"></textarea>

                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Status</label>

                                    <select class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" disabled>
                                        <option value="Hipótese">Hipótese</option>
                                        <option value="Confirmado">Confirmado</option>
                                    </select>

                                </div>
                            </div>

                            <hr class="border border-1 border-gray-400 shadow-lg">
                            <div class="flex mb-4 mt-5">
                                <div class="w-1/5 mr-1">
                                    
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="discriminacao">Versão</label>
                                    <input
                                        type="text"
                                        list="list_riscos"
                                        class="w-full appearance-none border rounded w-full
                                        py-2 px-3 text-grey-darker"
                                        value="CID-10"
                                        disabled
                                        >                                       
                                        
                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Dignóstico Confirmado - 1º</label>

                                    <input class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                    placeholder=""
                                    list="list_cid"
                                    v-model="form.diagnostico_confirmado1"
                                    >

                                </div>

                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Observação</label>

                                    <textarea cols="30" rows="1" class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" 
                                    v-model="form.diagnostico_confirmado1_observacao"></textarea>

                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Status</label>

                                    <select class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" disabled>
                                        <option value="Confirmado">Confirmado</option>
                                        <option value="Hipótese">Hipótese</option>
                                    </select>

                                </div>
                            </div>

                            <hr class="border border-1 border-gray-200 shadow-lg">
                            <div class="flex mb-4">
                                <div class="w-1/5 mr-1">
                                    
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="discriminacao">Versão</label>
                                    <input
                                        type="text"
                                        list="list_riscos"
                                        class="w-full appearance-none border rounded w-full
                                        py-2 px-3 text-grey-darker"
                                        value="CID 10"
                                        disabled
                                        >                                       
                                        
                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Dignóstico Confirmado - 2º</label>

                                    <input class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                    placeholder=""
                                    list="list_cid"
                                    v-model="form.diagnostico_confirmado2"
                                    >


                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Observação</label>

                                    <textarea cols="30" rows="1" class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" 
                                    v-model="form.diagnostico_confirmado2_observacao"></textarea>

                                </div>
                                <div class="w-2/3 mr-1">
                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="observacao">Status</label>

                                <select class="appearance-none border rounded w-full
                                    py-2 px-3 text-grey-darker" disabled>
                                    <option value="Confirmado">Confirmado</option>
                                    <option value="Hipótese">Hipótese</option>
                                </select>
                                
                            </div>
                        </div>

                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="conduta">
                            Conduta
                        </label>

                        <div class="flex mb-4">
                            <div class="w-full mr-1">

                                <textarea cols="30" rows="3"
                                class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker"
                                v-model="form.conduta"
                                ></textarea>
                                
                            </div>
                        </div>

                        <label class="block text-grey-darker text-lg font-bold mb-2"
                        for="observacao">
                            Prognóstico
                        </label>

                        <div class="flex mb-4">
                            <div class="w-full mr-1">

                                <textarea cols="30" rows="3"
                                class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker"
                                v-model="form.prognostico"
                                ></textarea>
                                
                            </div>
                        </div>

                        
                    </div>
                    
                </div>
                
                <datalist id="list_cid">
                    <option v-for="c in cid" :key="c.id" :value="c.cid+' - '+c.descricao"></option>
                </datalist>
                    <!-- Prescrição -->
                    <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                        <div class=" p-4 rounded-lg"
                        id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        v-if="refTabs.prescricao"
                        >

                        <div class="py-2 px-2 text-black text-2xl font-bold">
                            Prescrição
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/3 mr-1">
    
                                <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Medicamento </label>
    
                                <input 
                                    type="text"
                                    name="proc"
                                    id="proc"
                                    class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    v-model="form.medicamento_descricao"
                                    list="list-medicamentos"
                                    @click.prevent="() => form.medicamento_descricao =  '' "
                                >
    
                                <datalist id="list-medicamentos">
                                    <option v-for="m in medicamentos" :key="m.id" :value="m.id+' - '+m.descricao">{{m.descricao}}</option>
                                </datalist>
    

                                <label class="block text-grey-darker text-lg font-bold mb-2" for="proc_observacao">Observação </label>
                                <textarea
                                    name="proc_observacao"
                                    id="proc_observacao"
                                    rows="2"
                                    class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    v-model="form.medicamento_observacao"></textarea>
    
                            </div>
    
                            <div class="w-20 mr-1 flex ">
                                <label class="block text-grey-darker text-sm font-bold mb-2"
                                for="altura"></label>
                                <button
                                class="w-full p-2 text-2xl"
                                @click.prevent="addMedicamento(form.medicamento_descricao, form.medicamento_observacao)"
                                >
                                    <i class="fas fa-chevron-circle-right"></i>
                                </button>
                            </div>

                            <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl" >
                                <b class="font-bold text-xl"><b class="text-red-700 font-bold text-xl">+</b>Medicamento(s) Solicitado(s): </b>
                                <div class="appearance-none border border-gray-200  rounded py-2 px-3 text-grey-darker shadow-lg bg-white w-full"
                                id="prescricao"
                                >

                                
                                <ul v-for="(p, index) in form.medicamento" :key="p.id"
                                        class="text-gray-700 text-lg font-bold w-full ml-4">
                                        <li>
                                            - {{ p.medicamento }} <span v-show="p.observacao">{{', Obs.: '+p.observacao}}</span>
                                                <button @click.prevent="() => {  form.medicamento.splice(form.medicamento.indexOf(p), 1)  }"
                                                    class="px-2 text-lg"
                                                >
                                                <i class="fa fa-trash text-red-400" aria-hidden="true"></i>
                                            </button>
                                        </li>
                                        <hr class="border border-1 border-gray-300">
                                    </ul>

    
                                </div>
                            </div>
                            
                        </div>
                        {{ prescricao }}
                        <div class="flex flex-row">
                            <div class="flex justify-end w-full ">
                                <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                                    @click.prevent="addMedicamento(form.medicamento_descricao, form.medicamento_observacao)"
                                >
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Adicionar
                                </button>
                                <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                                >
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Confirmar
                                </button>
                                <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Assinar
                                </button>
                                <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Fechar
                                </button>

                            </div>
                        </div>
    
                        <div
                        class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                        >
                        <b class="font-bold text-xl">
                            <b class="text-red-700 font-bold text-xl">+</b>Medicamento(s):
                        </b>
    
                        <!-- <div v-if="atendimento[0].clinico[0] ? atendimento[0].clinico[0].prescricaos.isArray() ? true : false : false"> -->
                        <div v-if="atendimento[0].clinico[0] ? atendimento[0].clinico[0].prescricaos ? true : false : false">
                            <div v-for="a, index in atendimento[0].clinico[0].prescricaos" :key="index"                                
                            class="text-green-700 font-bold w-full ml-4 p-2 bg-white uppercase"
                            >
                                <span
                                    class="text-gray-600 font-bold w-full p-1 bg-white"
                                    >
                                    Medicamento: {{ a.medicamento }} {{ a.observacao }}
                                    <span class="block uppercase" v-if="a.user">REALIZADO POR {{a.procedimentos ?  a.user.name : '' }} - {{ moment(a.updated_at).format('DD/MM/YY hh:mm:ss')}}</span>
                                </span>
                            </div>

                            <Prescricao 
                                :medicamentos="atendimento[0].clinico[0] ? atendimento[0].clinico[0].prescricaos : []" 
                                :atendimento="atendimento" 
                            />                           

                            <ReceitaSimples 
                                :medicamentos="atendimento[0].clinico[0] ? atendimento[0].clinico[0].prescricaos : []" 
                                :atendimento="atendimento" 
                            />                           

                            <ReceitaEspecial 
                                :medicamentos="atendimento[0].clinico[0] ? atendimento[0].clinico[0].prescricaos : []" 
                                :atendimento="atendimento" 
                            />                           
                        </div>

                    </div>
    
                </div>
            </div>

                <!-- exames -->
                <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                    <div class=" p-4 rounded-lg"
                    id="profile" role="tabpanel" aria-labelledby="profile-tab"
                    v-if="refTabs.exame"
                    >

                    <div class="py-2 px-2 text-black text-2xl font-bold">
                        Diagnóstico - Exames
                    </div>


                    <div class="flex mb-4">
                        <div class="w-1/3 mr-1">

                            <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Procedimento </label>

                            <input 
                                type="text"
                                name="proc"
                                id="proc"
                                class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                v-model="form.proc_exame"
                                list="list-proc"
                                @click.prevent="() => form.proc_exame =  '' "
                            >

                            <datalist id="list-proc">
                                <option v-for="p in exames" :key="p.id" :value="p.id+' - '+p.procedimento">{{p.codigo+" - "+p.procedimento}}</option>
                            </datalist>

                            <label class="block text-grey-darker text-lg font-bold mb-2" for="proc_observacao">Observação </label>
                            <textarea
                                name="proc_observacao"
                                id="proc_observacao"
                                rows="2"
                                class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                v-model="form.proc_exame_observacao"></textarea>

                        </div>

                        <div class="w-20 mr-1 flex ">
                            <label class="block text-grey-darker text-sm font-bold mb-2"
                            for="altura"></label>
                            <button
                            class="w-full p-2 text-2xl"
                            @click.prevent="addExame(form.proc_exame, form.proc_exame_observacao)"
                            >
                                <i class="fas fa-chevron-circle-right"></i>
                            </button>
                        </div>
                        <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl" >
                            <b class="font-bold text-xl"><b class="text-red-700 font-bold text-xl">+</b>Exame(s) Solicitado(s): </b>
                            <div class="appearance-none border border-gray-200  rounded py-2 px-3 text-grey-darker shadow-lg bg-white w-full"
                            >
                                <ul v-for="(p, index) in form.exame" :key="p.id"
                                    class="text-gray-700 text-lg font-bold w-full ml-4">
                                    <li>
                                        - Procedimento: {{ p.proc+', Observação: '+p.observacao }}
                                            <button @click.prevent="() => {  form.exame.splice(form.exame.indexOf(p), 1)  }"
                                                class="px-2 text-lg"
                                            >
                                            <i class="fa fa-trash text-red-400" aria-hidden="true"></i>
                                        </button>
                                    </li>
                                </ul>

                        </div>
                        </div>

                    </div>
                    <div class="flex flex-row">
                        <div class="flex justify-end w-full ">
                            <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                                @click.prevent="addExame(form.proc_exame, form.proc_exame_observacao)"
                            >
                                <i class="fa fa-print" aria-hidden="true"></i>
                                Adicionar
                            </button>
                            <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                            >
                                <i class="fa fa-print" aria-hidden="true"></i>
                                Confirmar
                            </button>

                            <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                Assinar
                            </button>
                            <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                                <i class="fa fa-print" aria-hidden="true"></i>
                                Fechar
                            </button>
                        </div>
                    </div>

                    <div
                    class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                    >
                    <b class="font-bold text-xl">
                        <b class="text-red-700 font-bold text-xl">+</b>Exame(s) Realizado(s):
                    </b>

                    <div v-if="atendimento[0].clinico[0]">
                        <div v-for="a, index in atendimento[0].clinico[0].exames" :key="index"                                
                        class="text-green-700 font-bold w-full ml-4 p-2 bg-white"
                        >
                            <span
                                :class="{'text-green-700 font-bold w-full p-1 bg-white': a.user_id, 'text-orange-700 font-bold w-full p-1 bg-white': !a.user_id}"
                                >
                                <span v-if="a.user_id" class="mr-2 px-1 bg-emerald-100 text-emerald-500 border border-emerald-400">Concluído</span>
                                <span v-else class="mx-2 px-1 bg-orange-100 text-orange-500 border border-orange-400 font-bold">Pendente</span>
                                PROCEDIMENTO: {{ a.procedimentos[0].procedimento }} - {{ a.observacao }}
                                <span class="block uppercase text-right" v-if="a.user">REALIZADO POR {{a.procedimentos ?  a.user.name : '' }} - {{ moment(a.dthrfim).format('DD/MM/YY hh:mm:ss')}}</span>
                            </span>
                            <embed 
                            :src="'../storage/'+a.resultado"
                            width="800"
                            height="500"
                            v-if="a.user_id"
                            >

                        </div>
                        
                    </div>
                    <SolicitacaoExames 
                        :exames="atendimento[0].clinico[0] ? atendimento[0].clinico[0].exames : []" 
                        :atendimento="atendimento" 
                    />                           

                </div>



                </div>
            </div>


            <!-- imagens -->
            <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                
                <div class=" p-4 rounded-lg"
                id="profile" role="tabpanel" aria-labelledby="profile-tab"
                v-if="refTabs.imagem"
                >


                <div class="py-2 px-2 text-black text-2xl font-bold">
                    Diagnóstico por Imagem
                </div>


                <div class="flex mb-4">
                    <div class="w-1/3 mr-1">

                        <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Procedimento </label>

                        <input 
                            type="text"
                            name="proc"
                            id="proc"
                            class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            v-model="form.proc_imagem"
                            list="list-proc"
                            @click.prevent="() => form.proc_imagem =  '' "
                        >

                        <datalist id="list-proc">
                            <option v-for="p in imagems" :key="p.id" :value="p.id+' - '+p.procedimento">{{p.codigo+" - "+p.procedimento}}</option>
                        </datalist>

                        <label class="block text-grey-darker text-lg font-bold mb-2" for="proc_observacao">Observação </label>
                        <textarea
                            name="proc_observacao"
                            id="proc_observacao"
                            rows="2"
                            class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            v-model="form.proc_imagem_observacao"></textarea>

                    </div>

                    <div class="w-20 mr-1 flex ">
                        <label class="block text-grey-darker text-sm font-bold mb-2"
                        for="altura"></label>
                        <button
                        class="w-full p-2 text-2xl"
                        @click.prevent="addImagem(form.proc_imagem, form.proc_imagem_observacao)"
                        >
                            <i class="fas fa-chevron-circle-right"></i>
                        </button>
                    </div>
                    <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl" >

                <b class="font-bold text-xl"><b class="text-red-700 font-bold text-xl">+</b>Imagens Solicitadas: </b>
                        <div class="appearance-none border border-gray-200  rounded py-2 px-3 text-grey-darker shadow-lg bg-white w-full"
                        >
                            <ul v-for="(p, index) in form.imagem" :key="p.id"
                                class="text-gray-700 text-lg font-bold w-full ml-4">
                                <li>
                                    - Procedimento: {{ p.proc+', Observação: '+p.observacao }}
                                        <button @click.prevent="() => {  form.imagem.splice(form.imagem.indexOf(p), 1)  }"
                                            class="px-2 text-lg"
                                        >
                                        <i class="fa fa-trash text-red-400" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>

                    </div>
                    </div>

                </div>
                <div class="flex flex-row">
                    <div class="flex justify-end w-full ">
                        <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                            @click.prevent="addImagem(form.proc_imagem, form.proc_imagem_observacao)"
                        >
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Adicionar
                        </button>
                        <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                        >
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Confirmar
                        </button>

                        <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Assinar
                        </button>

                        <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                            <i class="fa fa-print" aria-hidden="true"></i>
                            Imprimir
                        </button>
                    </div>
                </div>

                <div
                    class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                    >
                    <b class="font-bold text-xl">
                        <b class="text-red-700 font-bold text-xl">+</b>Diagnóstico(s) de Imagem Realizado(s):
                    </b>

                    <div v-if="atendimento[0].clinico[0]">
                        <div v-for="a, index in atendimento[0].clinico[0].imagems" :key="index"                                
                            class="text-green-700 font-bold w-full ml-4 p-2 bg-white"
                            >
                            <span
                                :class="{'text-green-700 font-bold w-full p-1 bg-white': a.user_id, 'text-orange-700 font-bold w-full p-1 bg-white': !a.user_id}"
                                >
                                <span v-if="a.user_id" class="mr-2 px-1 bg-emerald-100 text-emerald-500 border border-emerald-400">Concluído</span>
                                <span v-else class="mx-2 px-1 bg-orange-100 text-orange-500 border border-orange-400 font-bold">Pendente</span>
                                PROCEDIMENTO: {{ a.procedimentos[0].procedimento }} - {{ a.observacao }}
                                <span class="block uppercase text-right" v-if="a.user">REALIZADO POR {{a.procedimentos ?  a.user.name : '' }} - {{ moment(a.dthrfim).format('DD/MM/YY hh:mm:ss')}}</span>
                            </span>
                        <embed 
                            :src="'../storage/'+a.resultado"
                            width="800"
                            height="500"
                            v-if="a.user_id"
                            >                            
                        </div>

                    </div>

                    <SolicitacaoImagems 
                        :imagems="atendimento[0].clinico[0] ? atendimento[0].clinico[0].imagems : []" 
                        :atendimento="atendimento" 
                    />   

                </div>


                </div>

            </div>


            <!-- Procedimentos -->
            <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                <div class=" p-4 rounded-lg"
                id="profile" role="tabpanel" aria-labelledby="profile-tab"
                v-if="refTabs.procedimento"
                >

                <div class="py-2 px-2 text-black text-2xl font-bold">
                    <b class="text-red-700 font-bold text-md">+</b>Procedimentos Ambulatorial
                </div>

                    <div class="py-4 px-8">


                        <div class="items-center w-full text-2xl font-medium text-gray-900 border border-gray-200
                        rounded-lg  dark:bg-gray-700 dark:border-gray-600 dark:text-white p-2">
                            <div class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600 "
                                >

                                <div class="flex mb-4">
                                    <div class="w-1/2 mr-1">

                                        <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Procedimento </label>

                                        <input 
                                            type="text"
                                            name="proc"
                                            id="proc"
                                            class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                            v-model="form.proc_procedimento"
                                            list="list-proc"
                                            @click.prevent="() => form.proc_procedimento =  '' "
                                        >

                                        <datalist id="list-proc">
                                            <option v-for="p in procedimentos" :key="p.id" :value="p.id+' - '+p.procedimento">{{p.codigo+" - "+p.procedimento}}</option>
                                        </datalist>

                                        <!-- <label class="block text-grey-darker text-lg font-bold mb-2" for="proc_observacao">Observação </label> -->
                                        <!-- <textarea
                                            name="proc_observacao"
                                            id="proc_observacao"
                                            rows="2"
                                            class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                            v-model="form.proc_observacao"></textarea>
 -->
                                            <div class="mr-1 flex flex-col">

                                                
                                                <div>

                                                    <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Medicamentos </label>
                                                    
                                                    <div class="flex flex-column">
                                                        
                                                        <input 
                                                        type="text"
                                                        name="proc"
                                                        id="proc"
                                                        class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                                        v-model="form.proc_medicamento"
                                                        list="list-medicamentos"
                                                        @click.prevent="() => form.proc_medicamento =  '' "
                                                        >
                                                        
                                                        <button class="text-4xl mx-1 text-red-600" 
                                                        @click.prevent="addProcedimentoMedicamentos(form.proc_medicamento_observacao, form.proc_medicamento)">+</button>
                                                    </div>

                                                    <datalist id="list-proc">
                                                        <option v-for="p in form.procedimentos" :key="p.id" :value="p.id+' - '+p.procedimento">
                                                            {{p.codigo+" - "+p.procedimento}}
                                                        </option>
                                                    </datalist>
                                                </div>
                                                

                                                
                                                <div>
                                                    <label class="block text-grey-darker text-lg font-bold mb-2" for="proc_observacao">Observação </label>

                                                    <div class="flex flex-column">
    
                                                    <textarea
                                                        name="proc_observacao"
                                                        id="proc_observacao"
                                                        rows="2"
                                                        class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                                        v-model="form.proc_medicamento_observacao"></textarea>
                                                        <span class="text-4xl mx-1 text-red-600"> </span>
                                                    </div>

                                                </div>

                                            </div>
            
                                        <datalist id="list-medicamentos">
                                            <option v-for="m in medicamentos" :key="m.id" :value="m.id+' - '+m.descricao">{{m.descricao}}</option>
                                        </datalist>
            

                                    </div>

                                    <div class="w-20 mr-1 flex ">
                                        <!-- <label class="block text-grey-darker text-sm font-bold mb-2"
                                        for="altura"></label>
                                        <button
                                        class="w-full p-2 text-2xl"
                                        @click.prevent="addProcedimento(form.proc_procedimento, form.proc_observacao)"
                                        >
                                            <i class="fas fa-chevron-circle-right"></i>
                                        </button> -->
                                    </div>
                                    <div class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-lg border-1 bg-gray-200 rounded-xl" >

                                    <b class="font-bold text-xl">
                                        <b class="text-red-700 font-bold text-xl">+</b>
                                        Procedimentos: 
                                    </b>
                                    <div class="appearance-none border border-gray-200  rounded py-2 px-3 text-grey-darker shadow-lg bg-white w-full"
                                    >
                                        <div class="border border-1 border-gray-500 rounded-md p-2">
                                                {{ form.proc_procedimento }}
                                            <div class="mt-2 p-2 text-gray-500">                                               
                                                <ul class="list-style-type: disc;">
                                                    <li v-for="f, index in form.procedimento_medicamentos" :key="index">
                                                        {{ f.med }} {{ f.observacao ? '- '+f.observacao : ''}}

                                                        <button @click.prevent="() => {  
                                                            form.procedimento_medicamentos.splice(form.proc_medicamento.indexOf(p), 1)  }"
                                                            class="px-2 text-lg"
                                                            >
                                                            <i class="fa fa-trash text-red-400" aria-hidden="true"></i>
                                                        </button>
        

                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="m-auto w-full text-center">
                                                
                                                <button
                                                    @click.prevent="addProcedimento(form.proc_procedimento, form.proc_observacao)"
                                                    class="rounded-md bg-blue-500 shadow-md text-white mt-2  px-2 text-lg"
                                                >
                                                    Confirmar 
                                                    <i class="fas fa-chevron-circle-right text-white"></i>
                                                </button>

                                            </div>
                                        </div>
                                        <ul v-for="(p, index) in form.ambulatorio" :key="p.id"
                                            class="text-gray-700 text-lg font-bold w-full ml-4 mt-5">
                                            <li>
                                                - Procedimento: {{ p[0].proc }}
                                                <button @click.prevent="() => {  
                                                    form.ambulatorio.splice(form.ambulatorio.indexOf(p), 1)  }"
                                                    class="px-2 text-lg"
                                                    >
                                                    <i class="fa fa-trash text-red-400" aria-hidden="true"></i>
                                                </button>
                                                
                                                <li class="border border-1 border-gray-400 p-2">

                                                    <li> -- Medicamentos:</li>
                                                    <ul class="list-style-type: disc;">
                                                        <li v-for="m, index in p[0].medicamentos" :key="index">--- {{ m.med }} {{ m.observacao ? ' - '+m.observacao : '' }}</li>
                                                    </ul>

                                                </li>
                                            </li>
                                        </ul>
                                        <div class="m-auto w-full text-center">
                                                
                                            <button
                                                class="rounded-md bg-blue-500 shadow-md text-white mt-2 px-2 text-lg"
                                            >
                                                Salvar 
                                                <i class="fas fa-chevron-circle-right text-white"></i>
                                            </button>

                                        </div>                                        
                                    </div>
                                </div>

                            </div>


                            <div class="flex flex-row">
                                <div class="flex justify-end w-full ">
                                    <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                                        @click.prevent="addProcedimento(form.proc_procedimento, form.proc_observacao)"
                                    >
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                        Adicionar
                                    </button>
                                    <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg"
                                    >
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                        Confirmar
                                    </button>                                    
                                    <button class="h-max rounded-md p-2 m-4 bg-blue-600 hover:bg-blue-400 text-white font-bold text-lg">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                        Assinar
                                    </button>

                                </div>

                            </div>


                        </div>
                </div>

                <div
                    class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                    >

                    <b class="font-bold text-xl">
                        <b class="text-red-700 font-bold text-xl">+</b>Procedimentos Realizados:
                    </b>

                        <div v-if="atendimento[0].clinico[0] ? atendimento[0].clinico[0].ambulatorios ? true : false : false">
                            <div v-for="a, index in atendimento[0].clinico[0].ambulatorios" :key="index"                                
                                class="text-green-700 font-bold w-full ml-4 p-2 bg-white"
                                >

                                <span
                                :class="{'text-green-700 font-bold w-full p-1 bg-white': a.user_id, 'text-orange-700 font-bold w-full p-1 bg-white': !a.user_id}"
                                >
                                <span v-if="a.user_id" class="mr-2 px-1 bg-emerald-100 text-emerald-500 border border-emerald-400">Concluído</span>
                                <span v-else class="mx-2 px-1 bg-orange-100 text-orange-500 border border-orange-400 font-bold">Pendente</span>
                                PROCEDIMENTO: {{ a.procedimentos[0].procedimento }} {{ a.observacao ? '- '+a.observacao : ''}}
                                
                                <ul class="list-disc ml-8">
                                    <li v-for="m, index in a.medicamentos" :key="index">
                                        {{ m.descricao }} {{ m.pivot.observacao }} 
                                    </li>
                                    <span class="block uppercase text-right text-sm" v-if="a.user">REALIZADO POR {{a.procedimentos[0] ?  a.user.name : '' }} - {{ moment(a.dthrfim).format('DD/MM/YY hh:mm:ss')}}</span>
                                    <hr class="border border-1 border-gray-400">
                                </ul>

                            </span>
                        </div>


                        <SolicitacaoProcedimento 
                        :ambulatorios="atendimento[0].clinico[0] ? atendimento[0].clinico[0].ambulatorios ? atendimento[0].clinico[0].ambulatorios : [] : []" 
                        :atendimento="atendimento" 
                    />   

                        </div>

                    </div>

                </div>
            </div>

                    <!-- Evolução -->
                    <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                        <div class=" p-4 rounded-lg"
                        id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        v-if="refTabs.evolucao"
                        >

                        <div class="py-2 px-2 text-black text-2xl font-bold">
                            Evolução
                        </div>



                        
                            <div class="py-4 px-8">
                                <div class="mb-4">
                                    <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                    rows="20"
                                    v-model="form.evolucao"
                                    ></textarea>
                                </div>

                                <div class="mb-4">

                                    <div class="flex rounded-md bg-red-50 p-4 text-sm text-red-500" x-cloak x-show="showAlert" x-data="{ showAlert: true }"
                                    v-if="form.hasErrors"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-3 h-5 w-5 flex-shrink-0">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                          <h4 class="font-bold">Pendência</h4>
                                          <div class="mt-1">
                                            <ul class="list-inside list-disc">
                                              <li v-for="error, index in form.errors" :key="index" >{{ error }}</li>
                                            </ul>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Documentos -->
                    <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                        <div class=" p-4 rounded-lg"
                        id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        v-if="refTabs.documentos"
                        >

                        <div class="py-2 px-2 text-black text-2xl font-bold">
                            Documentos
                        </div>

                            <div class="py-2 px-8">

                                <div>

                                    <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Modelos </label>
                                        <div class="flex flex-column">

                                            <input 
                                                type="text"
                                                name="proc"
                                                id="proc"
                                                class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                                v-model="form.documentoModelo"
                                                list="list-documentos"                                            
                                                v-on:input.prevent="carregarDoc($event)"
                                                :disabled="form.diagnostico_confirmado1 == ''"
                                            >
                                        </div>
                                        <span class="font-bold text-gray-400 block">Os modelos serão liberados somente se existir Diagnóstico CID - Confirmado</span>
                                        <span class="font-bold text-gray-400 block">Selecione o modelo e aperte Carregar</span>

                                        <button 
                                            class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-md"
                                                @click.prevent="carregarDocumento(form.documentoModelo)"
                                        >
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                            Carregar
                                        </button>                                            


                                    <datalist id="list-documentos">
                                        <option v-for="d in documentos" :key="d.id" :value="d.titulo">
                                            {{ $page.props.auth.user.id == d.user_id ? $page.props.auth.user.name : '' }}
                                        </option>
                                    </datalist>
                                </div>

                                <div>
                                    <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Tipo </label>
                                    
                                    <div class="flex flex-column">
                                        <input 
                                        type="text"
                                        name="proc"
                                        id="proc"
                                        class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        v-model="form.documento_tipo"
                                       
                                        >
                                        
                                    </div>

                                </div>

                                <div>
                                    <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Título </label>
                                    
                                    <div class="flex flex-column">
                                        <input 
                                        type="text"
                                        name="proc"
                                        id="proc"
                                        class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                        v-model="form.documento_titulo"
                                        
                                        >
                                        
                                    </div>

                                </div>


                                <div class="mb-4">

                                    <div class="w-full">
    
                                        <label class="block text-grey-darker text-lg font-bold mb-2" for="procedimento">Descrição </label>

                                        <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                            rows="10"
                                            v-model="form.documento_conteudo"
                                        ></textarea>

                                        <div class="flex justify-end w-full ">
                                            <button class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-md"
                                            >
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                                Confirmar
                                            </button>
                                            <button class="h-max rounded-md p-2 m-2 bg-blue-600 hover:bg-blue-400 text-white font-bold text-md"
                                                @click.prevent="salvarModelo()"
                                            >
                                                <i class="fa fa-print" aria-hidden="true"></i>
                                                Salvar como Modelo
                                            </button>
                                        </div>                                        
                                    </div>

                                    <h1 class="font-bold text-md pl-5">
                                        TAGS ACEITAS:
                                    </h1>
                                    <div class="mt-2 pl-5 flex gap-5 text-sm">
                                        <div>
                                            <ul class="py-2 border border-1 border-gray-400 p-1 rounded-md">
                                                <li><b>#PACIENTE#</b> - Pega o nome do paciente desse atendimento</li>
                                                <li><b>#CPF-RG-CERTIDAO#</b> - Pega o cpf ou RG ou Certidão do paciente desse atendimento</li>
                                                <li><b>#SERVIÇO#</b> - Pega o serviço em que o profissional esta cadastrado</li>
                                                <li><b>#UNIDADE#</b> - Pega o nome fantasia da unidade de saúde</li>
                                                <li><b>#DTATENDINICIO#</b> - Pega o horário do início desse atendimento</li>
                                                <li><b>#DTATENDFIM#</b> - Pega o horário do termino desse atendimento</li>
                                                
                                            </ul>
                                        </div>
                                        <ul class="py-2 border border-1 border-gray-400 p-1 rounded-md">

                                            <li><b>#CID#</b> - Pega o CID do diagnóstico confirmado do paciente desse atendimento</li>
                                            <li><b>#CIDDATA#</b> - Pega a data do CID diagnóstico confirmado do paciente desse atendimento</li>
                                            <li><b>#CIDHORA#</b> - Pega a horário do CID diagnóstico confirmado do paciente desse atendimento</li>
                                            <li><b>#CIDHORA#</b> - Pega o nome do paciente desse atendimento</li>
                                        </ul>



                                    </div>
                                </div>


                                <div
                                class=" mt-5 p-3 border border-gray-50 m-auto w-full font-bold text-md border-1 bg-gray-200 rounded-xl"
                                >
            
                                    <b class="font-bold text-xl">
                                        <b class="text-red-700 font-bold text-xl">+</b>Documentos Realizados:
                                    </b>
            
                                    <div v-if="atendimento[0].clinico[0] ? atendimento[0].clinico[0].documentos ? true : false : false">
                                        <div v-for="a, index in atendimento[0].clinico[0].documentos" :key="index"                                
                                        class="text-green-700 font-bold w-full ml-4 p-2 bg-white"
                                        >
            
                                            <span class="block">Tipo: {{ a.tipo }}</span>
                                            <span class="block">Titulo: {{ a.titulo }}</span>
                                            <textarea class="w-full" rows="5" disabled>{{ a.conteudo }}</textarea>

                                            
                                            <div class="w-full text-right">
                                                <span class="text-center">Elaborado por {{ a.user.name }} - {{ moment(a.updated_at).format('DD/MM/YY hh:mm:ss') }}</span>
                                            </div>

                                            <div class="flex justify-end w-full ">
                                               

                                            <Imprimir 
                                                :tipo="a.tipo" 
                                                :conteudo="a.conteudo" 
                                                :atendimento="atendimento" 
                                            />


                                            </div>

                                        </div>            
                                    </div>
                                    <hr class="border border-1 border-gray-400 shadow-lg">

            
                            </div>
        
                            <div class="mb-4">

                                <div class="flex rounded-md bg-red-50 p-4 text-sm text-red-500" x-cloak x-show="showAlert" x-data="{ showAlert: true }"
                                v-if="form.hasErrors"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-3 h-5 w-5 flex-shrink-0">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                    <div>
                                        <h4 class="font-bold">Pendência</h4>
                                        <div class="mt-1">
                                        <ul class="list-inside list-disc">
                                            <li v-for="error, index in form.errors" :key="index" >{{ error }}</li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="flex items-center justify-center gap-6 px-4">

                            <!-- Alta Alta após procedimento Retorno -->
                            <div class="my-2 w-full">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="procedimento">
                                    Motivo da Alta
                                </label>

                                <select
                                    class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"                                    
                                    v-model="form.alta_motivo"
                                >
                                    <option value="">Selecione</option>
                                    <option value="ALTA A PEDIDO DO PACIENTE">ALTA A PEDIDO DO PACIENTE</option>
                                    <option value="ALTA APÓS CONSULTA">ALTA APÓS CONSULTA</option>
                                    <option value="ALTA APÓS MEDICAÇÃO">ALTA APÓS MEDICAÇÃO</option>
                                    <option value="ENCAMINHADO A INTERNAÇÃO">ENCAMINHADO A INTERNAÇÃO</option>
                                    <option value="ENCAMINHADO AO CENTRO CIRURGICO">ENCAMINHADO AO CENTRO CIRURGICO</option>
                                    <option value="ENCAMINHADO AO ESPECIALISTA">ENCAMINHADO AO ESPECIALISTA</option>
                                </select>
                            </div>

                            <div class="my-2 w-full">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                    for="procedimento">
                                    Observação
                                </label>                                    
                                <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                rows="1"
                                v-model="form.alta_observacao"
                                ></textarea>
                            </div>
                        </div>

                     


                        <div class="mb-4">

                            <Aviso />

                            <div class="flex rounded-md bg-red-50 p-4 text-sm text-red-500" x-cloak x-show="showAlert" x-data="{ showAlert: true }"
                            v-if="form.hasErrors"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="mr-3 h-5 w-5 flex-shrink-0">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <h4 class="font-bold">Pendência</h4>
                                    <div class="mt-1">
                                        <ul class="list-inside list-disc">
                                            <li v-for="error, index in form.errors" :key="index" >{{ error }}</li>
                                        </ul>                                     
                                    </div>
                                </div>
                            </div>

                        </div>

                            <div class="flex items-center justify-end mt-2">


                                <ValidadorAssinatura :f="form"/>

                                <button class="text-black bg-yellow-500 hover:bg-yellow-400
                                    active:bg-yellow-600 font-bold text-lg px-4 py-2 rounded outline-none focus:outline-none
                                        mr-1 mb-1 ease-linear transition-all duration-150"
                                    type="submit"
                                    @click.prevent="limparFormulario"
                                    >
                                    <i>
                                    Limpar
                                    </i>
                                </button>
                            </div>

                    </div>

            </div>

        </div>
    </div>

</div>

<div>


</div>
        </div>


                        </div>


                    </div>
                </div>
            </div>

            <FormSuporte />

    </form>
</div>

    </AuthenticatedLayout>
</template>
<style src="@vueform/multiselect/themes/default.css"></style>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm, router } from '@inertiajs/vue3';
import { Inertia, usePage } from "@inertiajs/inertia";
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

import Pagination from '../../Components/Pagination.vue'
import Aviso from '@/Components/Aviso.vue'
import CadastroTriagem from '../../Components/Triagems/Cadastro.vue'
import EditarTriagem from '../../Components/Triagems/Edicao.vue'
import ExcluirTriagem from '../../Components/Triagems/Excluir.vue'
import ChamarSenha from '../../Components/Senhas/ChamarSenha.vue'
import FormSuporte from '@/Components/Utils/FormSuporte.vue'
import {ref} from 'vue'
import ValidadorAssinatura from '@/Components/Utils/ValidadorAssinatura.vue';
import CardPacienteAtendimento from '../../Components/Pacientes/CardPacienteAtendimento.vue'
import Imprimir from '../../Components/Documentos/Imprimir.vue'
import Prescricao from '../../Components/Documentos/Prescricao.vue'
import ReceitaSimples from '../../Components/Documentos/ReceitaSimples.vue'
import ReceitaEspecial from '../../Components/Documentos/ReceitaEspecial.vue'
import SolicitacaoExames from '../../Components/Documentos/SolicitacaoExames.vue'
import SolicitacaoImagems from '../../Components/Documentos/SolicitacaoImagems.vue'
import SolicitacaoProcedimento from '../../Components/Documentos/SolicitacaoProcedimento.vue'
import moment from 'moment'
import Multiselect from '@vueform/multiselect'
import VueDocumentEditor from 'vue-document-editor'
import VueFileToolbarMenu from 'vue-file-toolbar-menu';



const props = defineProps({

    atendimento:{
        type: Object
    },
    consultas:{
        type: Object
    },
    exames: {
        type: Object
    },

    imagems: {
        type: Object
    },

    procedimentos: {
        type: Object
    },
    procedimentoCid: {
        type: Object
    },
    cid: {
        type: Object
    },
    cid1: {
        type: Object
    },
    medicamentos: {
        type: Object
    },
    prescricao: {
        type:Object
    },
    documentos: {
        type: Object
    }
})


const form = useForm({

    id: props.atendimento[0].id,
    nome: props.atendimento[0].nome,
    cpf:  props.atendimento[0].cpf,

    clinico_id: props.atendimento[0].clinico_id,
    observacao: props.atendimento[0].observacao,

    classificacao: props.atendimento[0].classificacao,
    observacao_triagem: props.atendimento[0].observacao_triagem,

    dthrinicio: '',
    status: props.atendimento[0].status,
    
    anamnese_queixa : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_queixa : '',
    anamnese_historico_molestia : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_historico_molestia : '',
    anamnese_historico_patologia : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_historico_patologia : '',
    anamnese_historico_familiar : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_historico_familiar : '',
    anamnese_antecedentes_morbidos : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_antecedentes_morbidos ? JSON.parse(props.atendimento[0].clinico[0].anamnese_antecedentes_morbidos) : [] : [],
        // [{value: 'teste', label: '1111'}],
    anamnese_exame_fisico : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_exame_fisico : '',
    anamnese_observacao : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].anamnese_observacao : '',

    diagnostico_hipotese1: props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_hipotese1 : '',
    diagnostico_hipotese1_observacao: props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_hipotese1_observacao : '',

    diagnostico_hipotese2: props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_hipotese2 : '',
    diagnostico_hipotese2_observacao: props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_hipotese2_observacao : '',

    diagnostico_confirmado1 : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_confirmado1 : '',
    diagnostico_confirmado1_observacao : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_confirmado1_observacao : '',

    diagnostico_confirmado2 : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_confirmado2 : '',
    diagnostico_confirmado2_observacao : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].diagnostico_hipotese2_observacao : '',

    conduta : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].conduta : '',
    prognostico : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].prognostico : '',
    evolucao : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].evolucao : '',

    alta_motivo : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].alta_motivo : '',
    alta_observacao : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].alta_observacao : '',
    alta_data : props.atendimento[0].clinico[0] ? props.atendimento[0].clinico[0].alta_data : '',

    exame: [],
    imagem: [],
    ambulatorio: [],
        
    ambulatorios: [],
    procedimentos: [],
    procedimento_medicamentos: [],

    medicamento: [],
    medicamento_descricao: '',

    documentoModelo: null,
    documento_id: null,
    documento_titulo: '',
    documento_tipo: '',
    documento_conteudo: ''

  })


const refCont = ref(0)
const refText = ref(["<h1>Hello!</h1>Fill this page with text and new pages will be created as it overflows."])
const refAlergia = ref(props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].alergia ? JSON.parse(props.atendimento[0].triagem[0].alergia): [] : [])
const refProcedimentos = ref([])
const refDiscriminacao = ref('')

const refTabs = ref({
        resumo: true,
        anamnese: false,
        diagnostico: false,
        clinico: false,
        exame: false,
        imagem: false,
        procedimento: false,
        evolucao: false,
        ambulatorial: false,
        documentos: false
    })

const refMenu = ref({
        exames: false,
        imagems: false,
        procedimentos: false,
        consultas: false,
        prescricoes: false,
    })

const refCid = ref({
    cid: ''
})

    const alternaTab = (tab) => {

        if(tab == 'resumo') {
            refTabs.value.resumo = true
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false
        }

        if(tab == 'anamnese') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = true
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'diagnostico') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = true
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'clinico') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = true
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'exame') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = true
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'imagem') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = true
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'procedimento') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = true
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'evolucao') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = true
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }

        if(tab == 'prescricao') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = true
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = false

        }
        if(tab == 'ambulatorial') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = true
            refTabs.value.documentos = false

        }
        if(tab == 'documentos') {
            refTabs.value.resumo = false
            refTabs.value.anamnese = false
            refTabs.value.diagnostico = false
            refTabs.value.prescricao = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.procedimento = false
            refTabs.value.evolucao = false
            refTabs.value.ambulatorial = false
            refTabs.value.documentos = true

        }

    }

    const alternaMenu = (menu) => {

        if(menu == 'exames') {
            refMenu.value.exames = !refMenu.value.exames
        }

        if(menu == 'imagems') {
            refMenu.value.imagems = !refMenu.value.imagems
        }

        if(menu == 'procedimentos') {
            refMenu.value.procedimentos = !refMenu.value.procedimentos
        }

        if(menu == 'consultas') {
            refMenu.value.consultas = !refMenu.value.consultas
        }

        if(menu == 'prescricoes') {
            refMenu.value.prescricoes = !refMenu.value.prescricoes
        }
    }


function classificacao(){
    form.classificacao = form.discriminacao.split(' - ')[2];
    form.risco_id = form.discriminacao.split(' - ')[0];
}

function limparFormulario(){
    form.atendimento_id = props.atendimentos[0] ? props.atendimentos[0].id : ''
    form.queixa = ''
    form.alergia = ''
    form.peso = ''
    form.altura = ''
    form.cintura = ''
    form.perimetro_cefalico = ''
    form.frequencia_respiratoria = ''
    form.frequencia_cardiaca = ''
    form.pressao_arterial = ''
    form.temperatura = ''
    form.glicemia_capilar = ''
    form.saturacao_o2 = ''
    form.classificacao = ''
    form.discriminacao = ''
    form.observacao = ''
    form.risco_id = ''

}

function editarClinico(){
      form.post(route('clinicos.store'),{
        preserveState: true,
        preserveScroll: true,
      })
  }

  function addProcedimentoMedicamentos(observacao = '', medicamento){
    const id = medicamento.split(' - ')[0]
    const med = medicamento.split(' - ')[1]+" "+medicamento.split(' - ')[2]

    form.proc_medicamento = ''

    refCont.value++

    if(id !== ''){

        if(form.procedimento_medicamentos.length > 0){

            const consultaProcedimentoMedicamento =
                form.procedimento_medicamentos.filter(
                    (item) =>  item.id== id
                )

            if(consultaProcedimentoMedicamento.length === 0){
                form.procedimento_medicamentos.push({id, med, observacao})
            }

        } else {
            form.procedimento_medicamentos.push({id, med, observacao})
            form.proc_medicamento = ''
            form.proc_medicamento_observacao = ''
        }
    }
  }

  function addProcedimento(procedimento, observacao = ''){
    const id = procedimento.split(' - ')[0]
    const proc = procedimento.split(' - ')[1]

    form.proc_procedimento = ''
    form.proc_medicamento = ''
    form.proc_medicamento_observacao = ''

    refCont.value++

    if(id !== ''){

        if(form.ambulatorio.length > 0){

            const consultaProcedimento =
                form.ambulatorio.filter(
                    (item) =>  item.id== id
                )

            if(consultaProcedimento.length === 0){
                form.ambulatorio.push([{id, proc, observacao, medicamentos: form.procedimento_medicamentos }])
                form.procedimento_medicamentos = []
            }

        } else {
            form.ambulatorio.push([{id, proc, observacao, medicamentos: form.procedimento_medicamentos }])
            form.proc_procedimento = ''
            form.proc_medicamento = ''
            form.proc_medicamento_observacao = ''
            form.procedimento_medicamentos = []
        }
    }
}

  function addExame(procedimento, observacao = ''){
    const id = procedimento.split(' - ')[0]
    const proc = procedimento.split(' - ')[1]

    form.proc_exame = ''
    form.proc_exame_observacao = ''

    if(id !== ''){

        if(form.exame.length > 0){

            const consultaExame =
                form.exame.filter(
                    (item) =>  item.id== id
                )

            if(consultaExame.length === 0){
                form.exame.push({id, proc, observacao})
            }

        } else {
            form.exame.push({id, proc, observacao})
            form.proc_exame = ''
            form.proc_exame_observacao = ''
        }
    }
}

function salvarModelo(){
    form.post(route('documentoModelos.store'),{
        preserveState: true,
        preserveScroll: true,
      })
        
}

  function addImagem(procedimento, observacao = ''){
    const id = procedimento.split(' - ')[0]
    const proc = procedimento.split(' - ')[1]

    form.proc_imagem = ''
    form.proc_imagem_observacao = ''

    if(id !== ''){

        if(form.imagem.length > 0){

            const consultaImagem =
                form.imagem.filter(
                    (item) =>  item.id== id
                )

            if(consultaImagem.length === 0){
                form.imagem.push({id, proc, observacao})
            }

        } else {
            form.imagem.push({id, proc, observacao})
            form.proc_imagem = ''
            form.proc_imagem_observacao = ''
        }
    }
}
  function addMedicamento(descricao, observacao = ''){
    const id = descricao.split(' - ')[0]
    const forma = descricao.split(' - ')[2] ? " - "+descricao.split(' - ')[2] : ''
    const medicamento = descricao.split(' - ')[1]+forma

    form.medicamento_descricao = ''
    form.medicamento_observacao = ''

    if(id !== ''){

        if(form.medicamento.length > 0){

            const consultaMedicamento =
                form.medicamento.filter(
                    (item) =>  item.id== id
                )

            if(consultaMedicamento.length === 0){
                form.medicamento.push({id, medicamento, observacao})
            }

        } else {
            form.medicamento.push({id, medicamento, observacao})
            form.medicamento_descricao = ''
            form.medicamento_observacao = ''
        }
    }
}


function imprimirPrescricao(){

        var conteudo = document.getElementById('prescricao').innerHTML,
            tela_impressao = window.open('about:blank', 'width=200, height=100');

                tela_impressao.document.write(conteudo);

                tela_impressao.window.print();
            tela_impressao.window.close();

}

function carregarDocumento(doc){
    if(doc !== ''){

    const d = props.documentos.find(d => d.titulo === doc)
    form.documento_id = d.id
    form.documento_conteudo = d.conteudo
    form.documento_titulo = d.titulo
    form.documento_tipo = d.tipo
}
}

function carregarDoc(e){
    e.preventDefault()
    if(!e.inputType){
        carregarDocumento(form.documento)
    }
}

function imprimirDocumento(tipo, descricao){
    window.print('descricao')

    // imprimirDocumento(form.documento_tipo, form.documento_descricao)
}

// function consultarProcedimentosCid(){
//     if(form.diagnostico_hipotese) {
//         form.get(route('clinicos.cid'),{
//             only: ['cid1'],
//             preserveState: true,
//             preserveScroll: true,
//         })
//     }
// }




</script>
