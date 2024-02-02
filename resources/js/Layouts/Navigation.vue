<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
         class="fixed inset-0 z-20 bg-black opacity-0 transition-opacity lg:hidden"></div>

    <div
        :class="
        $page.props.showingMobileMenu ? 'translate-x-0 ease-out w-20' : '-translate-x-full w-64 ease-in'"
         class="fixed inset-y-0 left-0 z-30 bg-blue-900 transition
         duration-500 transform lg:translate-x-0 lg:static lg:inset-0"
         >




         <div class="flex justify-center items-center mt-8">
             <div class="flex items-center text-md">

                <!-- <i class="fa-regular fa-hospital" :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'"
                style="color: #f4f5f6;"></i>
                <span class="mx-2 text-md font-semibold text-white"
                    :class="$page.props.showingMobileMenu ? 'hidden' : ''">PRONTCenter<span class="animate-pulse">X</span>
                </span> -->

            </div>
            </div>

        <nav class="mt-10 text-md" x-data="{ isMultiLevelMenuOpen: false }">


            <span class="text-black text-lg px-1 font-bold rounded-xl absolute
            -right-8 align-middle"
            @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu"
            >
            <i
                class="fa fa-arrow-circle-right h-6 w-6 text-blue-700 font-bold"
                aria-hidden="true"
                :class="{'rotate-180': !$page.props.showingMobileMenu}"></i>

            </span>


    <div class="flex flex-row bg-blue-800">
        <nav-link :href="route('dashboard')" :active="route().current('dashboard')"
        class=" mt-0 pl-3 w-full h-full font-bold"
        >

        <i class="fa-solid fa-chart-line"   :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>

        <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Dashboard
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                    :href="route('pacientes.index')"
                    class="hover:text-blue-700 mt-0 pl-2 w-full font-bold"
                    >
                     <i class="fa-solid fa-hospital-user"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                     <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                         Pacientes
                     </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">

                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Recepcionista' "
                    :href="route('atendimentos.index')"
                    class="hover:text-blue-700 mt-0 pl-2 py-2 w-full font-bold"
                >

                    <i class="fa-solid fa-id-card-clip"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Atendimento
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Triagem' "
                    :href="route('triagems.index')"
                    class="hover:text-blue-700 mt-0 pl-2 py-2 w-full font-bold"
                >

                    <i class="fa-solid fa-heart-pulse"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Triagem
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Médico' "
                    :href="route('clinicos.index')"
                    class="hover:text-blue-700 mt-0 pl-2 py-2 w-full font-bold"
                    >

                    <i class="fa-solid fa-stethoscope"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Atendimento Médico
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Ambulatorio' "
                :href="route('ambulatorios.index')"
                class="hover:text-blue-700 mt-0 pl-2 py-2 w-full font-bold"
                >
                <i class="fa-solid fa-hand-holding-medical"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Atendimento Ambulatorial
                    </span>

                </nav-link>
            </div>


            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Exame' "
                    :href="route('exames.index')"
                    class="hover:text-blue-700 mt-0 pl-2 py-2 w-full font-bold"
                    >

                    <i class="fa-solid fa-prescription-bottle-medical"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Exames
                    </span>
                </nav-link>

            </div>
            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin' || $page.props.auth.user.access == 'Imagem' "
                    :href="route('imagems.index')"
                    class="hover:text-blue-700 mt-0 pl-2 py-2 w-full font-bold"
                    >

                    <i class="fa-solid fa-x-ray"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Diagnostico por Imagem
                    </span>
                </nav-link>
            </div>

            <hr>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('exameAuxes.index')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"
                >

                    <i class="fa-solid fa-prescription-bottle-medical"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>

                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Apoio ao Diagnóstico - Exames
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('imagemAuxes.index')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"

                    >
                    <i class="fa-solid fa-x-ray"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>

                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Apoio ao Diagnóstico - Imagems
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('ambulatorioAuxes.index')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"
                    >
                    <i class="fa-solid fa-hand-holding-medical"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Ambulatório - Procedimentos
                    </span>

                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('users.index')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"
                    >
                    <i class="fa-solid fa-users"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Usuários
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('unidades.index')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"
                    >
                     <i class="fa-regular fa-hospital" :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'"></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Unidade
                    </span>
                </nav-link>
            </div>

            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                    v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('produtos.index')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"
                    >
                     <i class="fa-regular fa-hospital" :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'"></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Produtos
                    </span>
                </nav-link>
            </div>
            
            
            <div class="flex flex-row hover:bg-blue-100 hover:text-blue-700">
                <nav-link
                v-if="$page.props.auth.user.access == 'Admin'"
                    :href="route('about')"
                    class="hover:text-blue-700 mt-0 pl-3 w-full font-bold"
                    >
                    <i class="fa-solid fa-info"  :class="$page.props.showingMobileMenu ? 'fa-xl mx-1' : 'fa-xl mx-1'" ></i>
                    <span :class="$page.props.showingMobileMenu ? 'hidden' : ''">
                        Sobre Nós
                    </span>
                </nav-link>
            </div>
            
            
            
                        --------------------------------------------------------
                        <i class="fa fa-spinner text-white animate-spin" aria-hidden="true"></i>

            <loader :on="rLoader"/>
            <!-- <div :class="{'loader' : rLoader}"></div> -->


            <!-- <a class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#" @click="showingTwoLevelMenu = !showingTwoLevelMenu">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path>
                </svg>
                <span class="mx-3">Two-level menu</span>
            </a>
            <transition
                enter-to-class="transition-all duration-300 ease-in-out"
                enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl"
                leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenu">
                    <ul class="overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700 bg-opacity-50 rounded-md shadow-inner"
                        aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150">
                            <Link class="w-full" :href="route('dashboard')">Child menu</Link>
                        </li>
                    </ul>
                </div>
            </transition> -->
            
        </nav>
    </div>



</template>

<script setup>
import { ref } from 'vue'

import Loader from '@/Components/Loader.vue'

import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

let rLoader = ref(false)

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

