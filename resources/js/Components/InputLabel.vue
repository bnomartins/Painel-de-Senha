<template>
    <label class="block text-sm text-gray-700 text-xl">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

<script setup>
defineProps(['value']);
</script>
