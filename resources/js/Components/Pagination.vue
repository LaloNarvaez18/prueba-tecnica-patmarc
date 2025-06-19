<script setup>
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object,
        required: true,
    },
});

const updatePage = (page) => {
    let pageNumber = page.url.split("=")[1];

    router.visit(`/products?page=${pageNumber}`, {
        preserveState: true,
        preserveScroll: true,
    });
};
</script>

<template>
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between sm:hidden">
            <a href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700">
                    Mostrando del
                    <span class="font-medium">{{ data.meta.from }}</span>
                    al
                    <span class="font-medium">{{ data.meta.to }}</span>
                    de
                    <span class="font-medium">{{ data.meta.total }}</span>
                    resultados
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded shadow-xs" aria-label="Pagination">
                    <button
                        @click.prevent="updatePage(page)"
                        :disabled="page.active || !page.url"
                        v-for="(page, index) in data.meta.links"
                        :key="index"
                        class="relative inline-flex items-center border px-4 py-2 text-sm font-medium focus:z-20"
                        :class="{
                            'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : page.active,
                            'bg-white border-gray-300 text-gray-500 hover:bg-gray-50' : !page.active,
                        }"
                    >
                        <span v-html="page.label"></span>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>
