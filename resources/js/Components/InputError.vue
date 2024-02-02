<template>
    <div v-show="message">
        <p class="text-sm text-red-600 text-2xl">
            {{ message }}
        </p>
    </div>
</template>

<script setup>
defineProps(['message']);
</script>
