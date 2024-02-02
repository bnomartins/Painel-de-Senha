<template>
    <Head title="Triagem" />

    <AuthenticatedLayout>
        <template #header>
            Classificação de Risco - Triagem
        </template>

        <div class="flex-auto ">
            <div class="flex flex-col screens-sm">

                <!-- Clínico -->
                <div class="font-sans antialiased bg-grey-lightest">
                    
                    <div class="w-full mt-2">
                        <div class="container mx-auto py-2">
                        <div class="w-full sm:min-w-sm mx-auto bg-white">

                        <div class="flex ">
                        
                            <div class="flex flex-column flex-0 w-full">
                            
                                
                                <div class="border border-grey-ligther rounded-lg w-full">
                                    <div class="flex-row"> 
                                        <div class="flex-col">
                                        
                                            <div class="font-sans antialiased">
                                                <!-- Card Resumo do Paciente -->
                                                <CardPaciente :paciente="atendimento[0].paciente" :tipo="'Cadastro'"/>
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
                                            <button class="inline-block p-2 py-3 rounded-t text-xl
                                            font-bold"
                                            id="profile-tab" data-tabs-target="#profile"
                                            type="button" role="tab" aria-controls="profile" aria-selected="false"
                                            @click.prevent="alternaTab('paciente')"
                                            >
                                                Triagem
                                            </button>
                                        </li>

                                    </ul>
                                    <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                                        <div class=" p-4 rounded-lg"
                                        id="profile" role="tabpanel" aria-labelledby="profile-tab"
                                        v-if="refTabs.triagem"
                                        >

                                        <div class="py-4 px-8 text-black text-2xl font-bold">
                                            Dados do Paciente
                                        </div>
                                        <form @submit.prevent="cadastrarTriagem()" class="w-full">

                                            <aviso />

                                            <div class="py-4 px-8">
                                                <div class="mb-4">
                                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                                    for="queixa">Queixa</label>
                                                    <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker uppercase"
                                                    placeholder="Queixa" rows="2" 
                                                    v-model="form.queixa"
                                                    :class="{'ring-4 ring-red-300' : form.errors.queixa}"
                                                    ></textarea>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="block text-grey-darker text-lg font-bold mb-2"
                                                    for="alergia">Alergia Medicamentosa</label>
                                                    <!-- <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                                                    type="text" placeholder="Alergia"  v-model="form.alergia"> -->

                                                    <Multiselect
                                                        class="appearance-none w-full pb-2 px-3 text-grey-darker 
                                                            border border-1 border-black rounded-md uppercase
                                                        "                                        
                                                        v-model="form.alergia"
                                                        mode="tags"
                                                        :close-on-select="false"
                                                        :searchable="true"
                                                        :object="true"
                                                        :create-option="true"
                                                        :options="[
                                                            'Eritromicina', 
                                                            'Tetraciclina', 
                                                            'Penicilina e derivados', 
                                                            'Amoxicilina', 
                                                            'Ampicilina',
                                                            'Carbamazepina',
                                                            'Lamotrigina',
                                                            'Fenitoína',
                                                            'Insulina',
                                                            'Contraste de iodo',
                                                            'Ibuprofeno ',
                                                            'Naproxeno',
                                                            'dipirona',
                                                            'Nevirapina',
                                                            'Abacavir',
                                                            'Atracúrio',
                                                            'Suxametônio',
                                                            'Vecurônio',
                                                            ]"
                                                        />



                                                </div>


                                                <div class="flex mb-4">
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="peso">Peso</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="peso" type="number"  min="0"
                                                        step="any"
                                                        placeholder="(Kg)"  v-model="form.peso">
                                                    </div>
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="altura">Altura</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="altura" type="number"  min="0"
                                                        step="any"
                                                        placeholder="(cm)"  v-model="form.altura">
                                                    </div>
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="cintura">Cintura</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="cintura" type="number"  min="0"
                                                        step="any"
                                                        placeholder="(cm)"  v-model="form.cintura">
                                                    </div>
                                                    <div class="w-1/2 ml-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="perimetro_cefalico">Perimetro Cefálico</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="perimetro_cefalico" type="number"  min="0"
                                                        step="any"
                                                        placeholder="(cm)"  v-model="form.perimetro_cefalico">
                                                    </div>
                                                </div>

                                                <div class="flex mb-4">
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="frequencia_respiratoria">Frequência Respiratória</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="frequencia_respiratoria" type="number"  min="0"
                                                        step="any"
                                                        placeholder="" v-model="form.frequencia_respiratoria">
                                                    </div>
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="frequencia_cardiaca">Frequência Cardiaca</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="frequencia_cardiaca" type="number"  min="0"
                                                        step="any"
                                                        placeholder="" v-model="form.frequencia_cardiaca">
                                                    </div>

                                                    <div class="flex">
                                                        
                                                    <div class="w-1/2 ml-1">
                                                        <label class="block text-grey-darker text-md font-bold mb-2 text-center"
                                                        for="pressao_arterial_sistolica">PA - Sistólica</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="pressao_arterial_sistolica" type="number"  min="0"
                                                        placeholder="Sistólica"
                                                        step="any"
                                                        v-model="form.pressao_arterial_sistolica">
                                                    </div>
                                                    <div class="w-1/2 ml-1">
                                                        <label class="block text-grey-darker text-md font-bold mb-2 text-center"
                                                        for="pressao_arterial_diastolica">PA - Diastólica</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="pressao_arterial_diastolica" type="number"  min="0"
                                                        placeholder="Diástolica"
                                                        step="any"
                                                        v-model="form.pressao_arterial_diastolica">
                                                    </div>
                                                </div>
                                            </div>

                                                <div class="flex mb-4">
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="temperatura">Temperatura</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="temperatura" type="number"  min="0"
                                                        step="any"
                                                        placeholder="(°C)" v-model="form.temperatura">
                                                    </div>
                                                    <div class="w-1/2 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="glicemia_capilar">Glicemia Capilar</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="glicemia_capilar" type="number"  min="0"
                                                        step="any"
                                                        placeholder="" v-model="form.glicemia_capilar">
                                                    </div>
                                                    <div class="w-1/2 ml-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="saturacao_o2">Saturação O²</label>
                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="saturacao_o2" type="number"  min="0"
                                                        step="any"
                                                        placeholder="" v-model="form.saturacao_o2">
                                                    </div>
                                                </div>

                                                <div class="flex mb-4">
                                                    <div class="w-1/3 mr-1">

                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="discriminacao">Discriminador</label>
                                                        <input 
                                                            type="text" 
                                                            list="list_riscos"
                                                            v-model="form.discriminacao" 
                                                            @blur.prevent="classificacao"
                                                            class="w-full appearance-none border rounded w-full
                                                            py-2 px-3 text-grey-darker"                                            
                                                            :class="{'ring-4 ring-red-300' : form.errors.risco_id}"
                                                        >

                                                        <datalist id="list_riscos">
                                                            <option v-for="r in riscos" :key="r.id" :value="r.id+' - '+r.discriminacao+' - '+r.classificacao">
                                                                {{ r.discriminacao }}
                                                            </option>
                                                        </datalist>

                                                    </div>
                                                    <div class="w-1/3 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="observacao">Classificação</label>

                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="classificacao" type="text"
                                                        placeholder="" v-model="form.classificacao"
                                                        :class="{'ring-4 ring-red-300' : form.errors.risco_id}"
                                                        disabled
                                                        >
                                                            
                                                    </div>
                                                    <div class="w-2/3 mr-1">
                                                        <label class="block text-grey-darker text-lg font-bold mb-2"
                                                        for="observacao">Observação</label>

                                                        <input class="appearance-none border rounded w-full
                                                        py-2 px-3 text-grey-darker" id="observacao" type="text"
                                                        placeholder="" v-model="form.observacao"
                                                    >
                                                            
                                                    </div>
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
                                                    </div>                                    </div>
                                                <div class="flex items-center justify-end mt-8">
                                                    <button class="bg-blue-600 hover:bg-blue-400 text-white
                                                    text-xl font-bold py-2 px-4 rounded-xl mr-2"
                                                    :disabled="form.processing"
                                                    :class="{ 'opacity-25': form.processing}"
                                        
                                                    type="submit">
                                                        Salvar
                                                    </button>

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
                                        </form>
                                </div>
                                
                            </div>
                            
                        </div>
    </div>

</div>

            <!-- <ul class="flex flex-wrap -mb-px text-xl font-bold text-center text-gray-700"
                id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

                <li
                    class="mr-2 border border-grey-lighter rounded-t-lg
                    hover:bg-gray-100"
                    role="presentation"
                >
                    <button class="inline-block p-2 py-3 rounded-t text-2xl
                    font-bold"
                    id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false"
                    @click.prevent="alternaTab('paciente')"
                    >
                        Triagem
                    </button>
                </li>

                <li
                class="mr-2 border border-grey-lighter rounded-t-lg hover:bg-gray-100"
                    role="presentation"
                >
                <button class="inline-block p-2 py-3 rounded-t text-2xl font-bold"
                    id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false"
                    @click.prevent="alternaTab('clinico')"
                    >
                        Atendimento Clínico
                    </button>
                </li>
            </ul>
            <div id="myTabContent" class=" border border-grey-ligther rounded-lg">
                <div class=" p-4 rounded-lg"
                id="profile" role="tabpanel" aria-labelledby="profile-tab"
                v-if="refTabs.paciente"
                >

                <div class="py-4 px-8 text-black text-2xl font-bold">
                    Dados do Paciente
                </div>
                    <div class="py-4 px-8">
                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="queixa">Queixa</label>
                            <textarea class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            placeholder="Queixa" rows="3"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="alergia">Alergia</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            type="text" placeholder="Alergia">
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="peso">Peso</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="peso" type="text"
                                placeholder="(Kg)">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="altua">Altura</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="altura" type="text"
                                placeholder="(cm)">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="cintura">Cintura</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="cintura" type="text"
                                placeholder="(cm)">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="Perimetro_cefalico">Perimetro Cefálico</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="perimetro_cefalico" type="text"
                                placeholder="(cm)">
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="frequencia_respiratoria">Frequência Respiratória</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="frequencia_respiratoria" type="text"
                                placeholder="">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="frequencia_cardiaca">Frequência Cardiaca</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="frequencia_cardiaca" type="text"
                                placeholder="">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="pressao_arterial">Pressão Arterial</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="pressao_arterial" type="text"
                                placeholder="">
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="temperatura">Temperatura</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="temperatura" type="text"
                                placeholder="(°C)">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="glicemia_capilar">Glicemia Capilar</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="glicemia_capilar" type="text"
                                placeholder="">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="saturacao_o2">Saturação O²</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="saturacao_o2" type="text"
                                placeholder="">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="classificacao">Classificação</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="classificacao" type="text"
                            placeholder="">
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="observacao">Observação</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="observacao" type="text"
                            placeholder="">

                            <p class="text-red-500 text-lg font-bold mt-2 p-2 bg-red-50">
                                At least 6 characters
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-8">
                            <button class="bg-blue-600 hover:bg-blue-400 text-white
                            text-xl font-bold py-2 px-4 rounded-xl"
                            type="submit">
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>


            </div>

            <div class=" p-4 rounded-lg border border-grey-lighter"
            id="profile" role="tabpanel" aria-labelledby="profile-tab"
            v-if="refTabs.clinico"
            >
                <div class="py-4 px-8 text-black text-2xl font-bold">
                    Atendimento Clínico
                </div>
                    <div class="py-4 px-8">
                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="queixa">Queixa</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            type="text" placeholder="Queixa">
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="alergia">Alergia</label>
                            <input class="appearance-none border rounded w-full py-2 px-3 text-grey-darker"
                            type="text" placeholder="Alergia">
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="peso">Peso</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="peso" type="text"
                                placeholder="(Kg)">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="altua">Altura</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="altura" type="text"
                                placeholder="(cm)">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="cintura">Cintura</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="cintura" type="text"
                                placeholder="(cm)">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="Perimetro_cefalico">Perimetro Cefálico</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="perimetro_cefalico" type="text"
                                placeholder="(cm)">
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="frequencia_respiratoria">Frequência Respiratória</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="frequencia_respiratoria" type="text"
                                placeholder="">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="frequencia_cardiaca">Frequência Cardiaca</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="frequencia_cardiaca" type="text"
                                placeholder="">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="pressao_arterial">Pressão Arterial</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="pressao_arterial" type="text"
                                placeholder="">
                            </div>
                        </div>

                        <div class="flex mb-4">
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="temperatura">Temperatura</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="temperatura" type="text"
                                placeholder="(°C)">
                            </div>
                            <div class="w-1/2 mr-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="glicemia_capilar">Glicemia Capilar</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="glicemia_capilar" type="text"
                                placeholder="">
                            </div>
                            <div class="w-1/2 ml-1">
                                <label class="block text-grey-darker text-lg font-bold mb-2"
                                for="saturacao_o2">Saturação O²</label>
                                <input class="appearance-none border rounded w-full
                                py-2 px-3 text-grey-darker" id="saturacao_o2" type="text"
                                placeholder="">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="classificacao">Classificação</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="classificacao" type="text"
                            placeholder="">
                        </div>
                        <div class="mb-4">
                            <label class="block text-grey-darker text-lg font-bold mb-2"
                            for="observacao">Observação</label>
                            <input class="appearance-none border rounded w-full
                            py-2 px-3 text-grey-darker" id="observacao" type="text"
                            placeholder="">

                            <p class="text-red-500 text-lg font-bold mt-2 p-2 bg-red-50">
                                At least 6 characters
                            </p>
                        </div>
                        <div class="flex items-center justify-between mt-8">
                            <button class="bg-blue-600 hover:bg-blue-400 text-white
                            text-xl font-bold py-2 px-4 rounded-xl"
                            type="submit">
                                Salvar
                            </button>
                        </div>
                    </div>

            </div> -->

        </div>


                        </div>
                    </div>
                </div>

            </div>

            <FormSuporte />

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
import CardPaciente from '../../Components/Pacientes/CardPaciente.vue'
import moment from 'moment'
import Multiselect from '@vueform/multiselect'

const props = defineProps({
    atendimentos: {
        type: Object
    },
    atendimento:{
        type: Object
    },
    riscos: {
        type: Object
    },
    procedimentos: {
        type: Object
    },
    medicamentos: {
        type: Object
    }
})

const form = useForm({
      atendimento_id: props.atendimento[0] ? props.atendimento[0].id : '',

      queixa: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].queixa : '',
    //   alergia: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].alergia : [],
      alergia: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].alergia ? JSON.parse(props.atendimento[0].triagem[0].alergia) : [] : [],
      peso: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].peso : '',
      altura: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].altura : '',
      cintura: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].cintura : '',
      perimetro_cefalico: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].perimetro_cefalico : '',
      frequencia_respiratoria: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].frequencia_respiratoria : '',
      frequencia_cardiaca: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].frequencia_cardiaca : '',
      pressao_arterial_sistolica: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].pressao_arterial_sistolica : '',
      pressao_arterial_diastolica: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].pressao_arterial_diastolica : '',
      temperatura: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].temperatura : '',
      glicemia_capilar: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].glicemia_capilar : '',
      saturacao_o2: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].saturacao_o2 : '',
      classificacao: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].classificacao : '',
      discriminacao: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].discriminacao : '',
      observacao: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].observacao : '',
      risco_id: props.atendimento[0].triagem[0] ? props.atendimento[0].triagem[0].risco_id : '',

  })


const refDiscriminacao = ref('')

const refTabs = ref({
        triagem: true,
        paciente: false,
        clinico: false,
        exame: false,
        imagem: false,
        ambulatorial: false,
    })

const refMenu = ref({
        exames: false,
        imagems: false,
        procedimentos: false,
        consultas: false,
        prescricoes: false,
    })

    const alternaTab = (tab) => {

        if(tab == 'triagem') {
            refTabs.value.triagem = true
            refTabs.value.paciente = false
            refTabs.value.clinico = false
            refTabs.value.exame = false
            refTabs.value.imagem = false
            refTabs.value.ambulatorial = false
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
    form.atendimento_id = props.atendimento[0] ? props.atendimento[0].id : ''
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

function cadastrarTriagem(){

    form.post(route('triagems.store'), {
        });

}

function pesquisarTriagem(){
    form.searchClear = false
    form.get(route('triagems.index'), {
        search: form.search
    })

}

function limparPesquisaTriagem(){
    form.searchClear = true
    form.search = ''

    form.get(route('triagems.index'), {
        search: form.search
    })
}


</script>
