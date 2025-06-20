<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Form from "./Form.vue";

defineProps({
    categories: {
        type: Object,
        required: true,
    },
    product: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <Form :categories="categories.data" :product="product.data" :edit="true" />
</template>
