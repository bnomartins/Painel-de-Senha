<template>
<!-- Aviso -->
<div class="w-14 h-8 flex items-center rounded-full border border-1 border-gray-300"
    :class="{'bg-emerald-400' : refOn == true, 'bg-gray-300' : refOn == false}"
    :value="refOn"
    @click.prevent="() => {refOn = ! refOn; $emit('alterarStatus', refOn, refId)}"
    >
    <div 
    class="w-6 h-6 bg-white rounded-full shadow-md border border-1 border-gray-300"
    :class="{'translate-x-6' : refOn == true}"
    ></div>
</div>

</template>

<script setup>
import { computed, ref} from 'vue';
import { usePage } from '@inertiajs/vue3';
// import swal from 'sweetalert';

const props = defineProps({
    on: {
        type: Boolean
    },
    id:{
        type: Object
    }

})

const refOn = ref(props.on ? props.on : false)
const refId = ref(props.id ? props.id : '')

</script>
