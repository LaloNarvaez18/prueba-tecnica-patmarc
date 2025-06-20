<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Form from "./Form.vue";

defineProps({
    category: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <Form :category="category.data" :edit="true" />
</template>
