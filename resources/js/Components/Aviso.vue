<template>
  <!-- Aviso -->

  <div
    id="toast-success"
    class="fixed z-50 flex items-center w-full max-w-xs p-2 p-4 mb-4 rounded-lg shadow shadow-lg dark:text-green-400 dark:bg-gray-800 right-2 bottom-12"
    :class="{
      'bg-green-100 text-green-500':
        $page.props.flash.message.indexOf('sucesso') !== -1,
      'bg-red-100 text-red-500':
        $page.props.flash.message.indexOf('sucesso') == -1,
    }"
    role="alert"
    v-if="$page.props.flash.message"
  >
    <div
      class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg"
      :class="{
        'text-green-500 bg-green-100':
          $page.props.flash.message.indexOf('sucesso') !== -1,
        'text-red-500 bg-red-100':
          $page.props.flash.message.indexOf('sucesso') == -1,
      }"
    >
      <svg
        class="w-5 h-5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        viewBox="0 0 20 20"
        v-if="$page.props.flash.message.indexOf('sucesso') !== -1"
      >
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"
        />
      </svg>

      <svg
        class="w-5 h-5"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        viewBox="0 0 20 20"
        v-else
      >
        <path
          d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"
        />
      </svg>
      <!--
            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-yellow-500 bg-yellow-100 rounded-lg dark:bg-yellow-800 dark:text-yellow-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
            </div>

            <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
            </div> -->
    </div>

    <div
      class="ml-3 text-sm font-bold text-black dark:text-green-500"
      :class="{
        'dark:text-green-500':
          $page.props.flash.message.indexOf('sucesso') !== -1,
        'dark:text-red-500': $page.props.flash.message.indexOf('sucesso') == -1,
      }"
    >
      {{ $page.props.flash.message }}
    </div>
    <button
      type="button"
      class="inline-flex items-center justify-center w-6 h-6 p-1 mx-1 my-1 ml-auto text-gray-400 bg-white rounded-lg hover:text-gray-900 focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
      :class="{
        'dark:text-green-500':
          $page.props.flash.message.indexOf('sucesso') !== -1,
        'dark:text-red-500': $page.props.flash.message.indexOf('sucesso') == -1,
      }"
      data-dismiss-target="#toast-success"
      aria-label="Close"
      @click="fecharAviso"
    >
      <span class="sr-only">Fechar</span>
      <svg
        class="w-3 h-3"
        aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 14 14"
      >
        <path
          stroke="currentColor"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
        />
      </svg>
    </button>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";
// import { Ref } from '@inertiajs/vue3';
// import { Ref } from "@inertiajs/inertia";

const page = usePage();

const msg = computed(() => {
  console.log(refAviso.value);
});



// watch(refAviso, async (newQuestion, oldQuestion) => {
//   if (newQuestion.indexOf('?') > -1) {
//     answer.value = 'Thinking...'

//     if (refAviso.value) {
//     console.log('----------- -', refAviso.value)
//     var timerInterval = ''
//   Swal.fire({
//     title: "Aviso!",
//     html: page.props.flash.message,
//     timer: 2000,
//     timerProgressBar: true,
//     didOpen: () => {
//       Swal.showLoading();
//       const b = Swal.getHtmlContainer().querySelector("b");
//       timerInterval = setInterval(() => {
//         b.textContent = Swal.getTimerLeft();
//       }, 100);
//     },
//     willClose: () => {
//       clearInterval(timerInterval);
//     },
// }).then((result) => {
//     /* Read more about handling dismissals below */
//     if (result.dismiss === Swal.DismissReason.timer) {
//         console.log("I was closed by the timer");
//         page.props.flash.message = ''
//     }
//   });
//   console.log('------------', page.props.flash.message);
// }
// console.log('--------necas----', page.props.flash.message);

//   }
// })

function fecharAviso() {
  page.props.flash.message = "";
}
</script>
