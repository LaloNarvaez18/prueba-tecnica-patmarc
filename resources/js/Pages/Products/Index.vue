<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import SessionMessage from '@/Components/SessionMessage.vue';
import Modal from '@/Components/Modal.vue';
import DeleteDialog from '@/Components/DeleteDialog.vue';
import { ref } from 'vue';

const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
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
let productToDelete = ref(false)

const form = useForm({});

const confirmDelete = (productId) => {
    showDialog.value = true;
    productToDelete.value = productId;
}

const closeDialog = () => {
    showDialog.value = false;
}

const deleteProduct = () => {
    form.delete(route('products.destroy', productToDelete.value), {
        onSuccess: () => {
            showDialog.value = false;
            productToDelete.value = false;
        }
    });
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Productos" />

        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
            <SessionMessage :message="message" />

            <div class="mb-6 flex items-center justify-between">
                <section>
                    <h2 class="text-xl font-semibold text-gray-900">Productos</h2>
                    <p class="text-sm text-gray-600">Listado de todos los productos</p>
                </section>

                <section class="flex items-center space-x-4">
                    <a :href="route('products.create')"
                        class="inline-block text-sm rounded-lg bg-indigo-500 py-2 px-6 text-white shadow-md transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center">
                        <i class="bi bi-plus-lg"></i>
                        Agregar producto
                    </a>
                </section>
            </div>

            <div class="overflow-hidden rounded-lg border shadow-md mb-5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500">
                        <thead class="bg-gray text-xs uppercase text-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Imagen</th>
                                <th scope="col" class="px-6 py-3">Nombre</th>
                                <th scope="col" class="px-6 py-3">Precio</th>
                                <th scope="col" class="px-6 py-3">Stock</th>
                                <th scope="col" class="px-6 py-3">Categoría(s)</th>
                                <th scope="col" class="px-6 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr v-for="product in products.data" :key="product.id">
                                <td class="px-6 py-4">{{ product.id }}</td>
                                <td class="px-6 py-4">
                                    <i class="bi bi-image text-xl text-gray-400"></i>
                                </td>
                                <td class="px-6 py-4">{{ product.name }}</td>
                                <td class="px-6 py-4">{{ product.price }}</td>
                                <td class="px-6 py-4">{{ product.stock }}</td>
                                <td class="px-6 py-4">
                                    <span v-for="category in product.categories" :key="category.id"
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-800 bg-blue-100 rounded-full">
                                        {{ category.name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a :type="'button'" :href="route('products.edit', product.id)"
                                        class="inline-block px-3 py-1 mr-2 text-white bg-yellow-500 rounded hover:bg-yellow-600 transition-colors duration-200">
                                        <i class="bi bi-pencil"></i>
                                        Editar
                                    </a>
                                    <a :type="'button'" @click="confirmDelete(product.id)"
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
                <Pagination :data="products" />
            </div>
        </div>

        <Modal :show="showDialog" @close="closeDialog">
            <DeleteDialog :title="'Eliminar producto'">
                <a type="button" @click="deleteProduct"
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
