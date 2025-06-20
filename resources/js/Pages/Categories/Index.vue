<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SessionMessage from '@/Components/SessionMessage.vue';
import Modal from '@/Components/Modal.vue';
import DeleteDialog from '@/Components/DeleteDialog.vue';
import { ref } from 'vue';

const props = defineProps({
    categories: {
        type: Object,
        required: true,
    },
    message: {
        type: String,
    },
});

let message = usePage().props.flash.message;
let showDialog = ref(false);
let categoryToDelete = ref(false)

const form = useForm({});

const confirmDelete = (categoryId) => {
    showDialog.value = true;
    categoryToDelete.value = categoryId;
}

const closeDialog = () => {
    showDialog.value = false;
}

const deleteCategory = () => {
    form.delete(route('categories.destroy', categoryToDelete.value), {
        onSuccess: () => {
            showDialog.value = false;
            categoryToDelete.value = false;
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Categorias" />

        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <SessionMessage :message="message" />

            <div class="mb-6 flex items-center justify-between">
                <section>
                    <h2 class="text-xl font-semibold text-gray-900">Categorias</h2>
                    <p class="text-sm text-gray-600">Listado de todos los categorías</p>
                </section>

                <section class="flex items-center space-x-4">
                    <a :href="route('categories.create')"
                        class="inline-block text-sm rounded-lg bg-indigo-500 py-2 px-6 text-white shadow-md transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center">
                        <i class="bi bi-plus-lg"></i>
                        Agregar categoría
                    </a>
                </section>
            </div>

            <div class="overflow-hidden rounded-lg border shadow-md mb-5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="bg-gray text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="w-1/12 px-4 py-3">ID</th>
                                <th scope="col" class="w-3/12 px-4 py-3">Categoría</th>
                                <th scope="col" class="w-5/12 px-4 py-3">Descripción</th>
                                <th scope="col" class="w-3/12 px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr v-for="category in categories.data" :key="category.id">
                                <td class="px-4 py-4">{{ category.id }}</td>
                                <td class="px-4 py-4">{{ category.name }}</td>
                                <td class="px-4 py-4">{{ category.description }}</td>
                                <td class="px-4 py-4">
                                    <a :type="'button'" :href="route('categories.edit', category.id)"
                                        class="inline-block px-3 py-1 mr-2 text-white bg-yellow-500 rounded hover:bg-yellow-600 transition-colors duration-200">
                                        <i class="bi bi-pencil"></i>
                                        Editar
                                    </a>
                                    <a :type="'button'" @click="confirmDelete(category.id)"
                                        class="inline-block px-3 py-1 mr-2 text-white bg-red-500 rounded hover:bg-red-600 transition-colors duration-200">
                                        <i class="bi bi-trash3"></i>
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="overflow-hidden rounded-lg border shadow-md">
                <Pagination :data="categories" :routeName="'categories.index'" />
            </div>
        </div>

        <Modal :show="showDialog" @close="closeDialog">
            <DeleteDialog :title="'Eliminar categoría'">
                <a type="button" @click="deleteCategory"
                    class="inline-flex w-full sm:w-auto justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:mr-3 mb-3 sm:mb-0">
                    <i class="bi bi-trash mr-2"></i>Eliminar
                </a>
                <a type="button" @click="closeDialog"
                    class="inline-flex w-full sm:w-auto justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                    <i class="bi bi-x-lg mr-2"></i>Cancelar
                </a>
            </DeleteDialog>
        </Modal>
    </AuthenticatedLayout>
</template>
