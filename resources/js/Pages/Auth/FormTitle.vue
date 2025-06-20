<script setup>
defineProps({
    title: {
        type: String,
        default: ''
    },
    subTitle: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <div class="mb-7 text-center">
        <h1 class="text-2xl font-bold text-gray-900">{{ title }}</h1>
        <p class="text-sm font-medium text-gray-600">{{ subTitle }}</p>
    </div>
</template>
