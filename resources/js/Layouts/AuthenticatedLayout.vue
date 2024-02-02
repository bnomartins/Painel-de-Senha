<template>
    <div class="flex max-h-full min-h-screen bg-gray-200 font-roboto">
                <!-- menu lateral -->
                <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
                class="fixed inset-0 z-20 transition-opacity bg-black opacity-0 lg:hidden"></div>

                <div
                :class="
                $page.props.showingMobileMenu ? 'translate-x-0 ease-out w-20' : '-translate-x-full w-64 ease-in'"
                class="fixed inset-y-0 left-0 z-30 transition duration-500 transform bg-blue-900 lg:translate-x-0 lg:static lg:inset-0"
                >
                
                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center text-md">

                    <!-- <i class="fa-regular fa-hospital" :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'"
                    style="color: #f4f5f6;"></i>
                    <span class="mx-2 font-semibold text-white text-md"
                        :class="$page.props.showingMobileMenu ? 'hidden' : ''">PRONTCenter<span class="animate-pulse">X</span>
                    </span> -->

                    </div>
                </div>

                <nav class="mt-10 text-md" x-data="{ isMultiLevelMenuOpen: false }">

                <span class="absolute px-1 text-lg font-bold text-black align-middle rounded-xl -right-8"
                @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu"
                >
                <i
                    class="w-6 h-6 font-bold text-blue-700 fa fa-arrow-circle-right"
                    aria-hidden="true"
                    :class="{'rotate-180': !$page.props.showingMobileMenu}"></i>

                </span>


                <div class="flex flex-row bg-blue-900">
                    <nav-link :href="route('dashboard')" :active="route().current('dashboard')"
                    class="w-full h-full pl-3 mt-0 font-bold rounded-lg  hover:bg-blue-200 hover:text-blue-700"

                    >
                        <i class="fa-solid fa-chart-line"   :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                        <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                            Dashboard
                        </span>
                    </nav-link>
                </div>
                <!-- Recepção -->
                <button id="dropdownDefaultButton" 
                    data-dropdown-toggle="dropdown" 
                    class="text-white bg-blue-900 hover:bg-blue-200 hover:text-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-md px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-900 dark:hover:bg-blue-900 dark:focus:ring-blue-800 w-full my-2" 
                    type="button"
                    @click.prevent="() => refMenuRecepcao = !refMenuRecepcao"
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                    >
                    <i class="fa-solid fa-id-card-clip"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Recepção
                    </span>
                
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 w-full divide-y divide-gray-100 rounded-sm shadow dark:bg-gray-700"
                    :class="{'block' : refMenuRecepcao, 'hidden' : !refMenuRecepcao}"
                >
                    <ul 
                        class="font-bold text-blue-700 dark:text-gray-200 text-md" 
                        aria-labelledby="dropdownDefaultButton"
                        >
                        <li class="bg-blue-600">
                            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700 text-md">

                                <nav-link
                                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                                    :href="route('senhas.index')"
                                    class="w-full pt-0 pl-6 mt-0 font-bold hover:text-blue-700"
                                >
            
                                    <i class="text-blue-300 fa-solid fa-id-card-clip"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                                        Painel
                                    </span>

                                </nav-link>

                            </div>
                            </li>
                        <li class="bg-blue-600">
                            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700 text-md">

                                <nav-link
                                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                                    :href="route('atendimentos.create')"
                                    class="w-full pt-0 pl-6 mt-0 font-bold hover:text-blue-700"
                                >
            
                                    <i class="text-blue-300 fa-solid fa-id-card-clip"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                                        Pré Atendimento
                                    </span>
                                </nav-link>

                            </div>
                            </li>
                        <li class="bg-blue-600">
                            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700 text-md">

                                <nav-link
                                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                                    :href="route('atendimentos.index')"
                                    class="w-full pt-0 pl-6 mt-0 font-bold hover:text-blue-700"
                                >
            
                                    <i class="text-blue-300 fa-solid fa-id-card-clip"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                                        Atendimento
                                    </span>
                                </nav-link>

                            </div>
                            </li>
                            <li class="bg-blue-600">
                                <a href="#" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">
                                <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                                    <nav-link
                                        v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                                        :href="route('pacientes.index')"
                                        class="w-full py-0 pl-2 mt-0 font-bold hover:text-blue-700"
                                        >
                                            <i class="text-blue-300 fa-solid fa-hospital-user"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                                            <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                                                Pacientes
                                            </span>
                                    </nav-link>
                                </div>                                        
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Recepção -->
                <!-- Triagem -->
                <button id="dropdownDefaultButton" 
                    data-dropdown-toggle="dropdown" 
                    class="text-white bg-blue-900 hover:bg-blue-200 hover:text-blue-700 focus:ring-2 focus:outline-none focus:ring-blue-500 font-medium rounded-lg text-md px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-900 dark:hover:bg-blue-900 dark:focus:ring-blue-800 w-full my-2" 
                    type="button"
                    @click.prevent="() => refMenuTriagem = !refMenuTriagem"
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Triagem' "
                    >
                    <i class="fa-solid fa-heart-pulse"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Classificação de Risco
                    </span>
                
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 w-full divide-y divide-gray-100 rounded-sm shadow dark:bg-gray-700"
                    :class="{'block' : refMenuTriagem, 'hidden' : !refMenuTriagem}"
                >
                    <ul 
                        class="font-bold text-blue-700 dark:text-gray-200 text-md" 
                        aria-labelledby="dropdownDefaultButton"
                        >
                        <li class="bg-blue-600">
                            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                            <nav-link
                                v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Triagem' "
                                :href="route('triagems.index')"
                                class="w-full py-2 mt-0 font-bold hover:text-blue-700 pl-42"
                            >
        
                                <i class="text-blue-300 fa-solid fa-heart-pulse"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                                <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                                    Atendimento
                                </span>
                            </nav-link>
                        </div>
        
                    </li>

                    </ul>
                </div>
      
    </nav>
</div>


<!-- menu lateral -->

        <div class="flex flex-col flex-1 overflow-hidden">
            <Header />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-white rounded-2xl">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="mb-4 text-3xl font-medium text-gray-700">
                        <slot name="header" />
                    </h3>

                    <slot />
                    <loader :on="rLoader"/>

                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from '@/Layouts/Header.vue';

import { ref } from 'vue'

import Loader from '@/Components/Loader.vue'

import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

let rLoader = ref(false)
let refMenuRecepcao = ref(false)
let refMenuTriagem = ref(false)
let refMenuClinico = ref(false)
let refMenuAmbulatorio = ref(false)
let refMenuExame = ref(false)
let refMenuSuprimentos = ref(false)
let refMenuSuprimentosAdm = ref(false)
let refMenuFaturamentos = ref(false)
let refMenuAdministrador = ref(false)
let refMenuAdministrador2 = ref(false)
let refMenuEstoque = ref(false)
let refMenuEstoqueAdm = ref(false)

router.on('start', () => {   

    rLoader.value = true

    console.log(rLoader.value)
        NProgress.start()
    }
)

router.on('finish', () => {
    NProgress.done()
    rLoader.value = false
})

</script>

<script>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        NavLink,
        Link,
    },

    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu

        }
    },
}
</script>