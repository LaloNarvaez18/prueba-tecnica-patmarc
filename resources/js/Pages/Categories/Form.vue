<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import MultiSelect from 'primevue/multiselect';
import DatePicker from 'primevue/datepicker';
import Textarea from 'primevue/textarea';
import { watch, ref, computed } from 'vue';

let props = defineProps({
    category: {
        type: Object,
    },
    edit: {
        type: Boolean,
        default: false
    }
});

let { category, edit } = props;

const form = useForm({
    name: edit ? category.name : '',
    description: edit ? category.description : '',
});

const save = () => {
    form.post(route('categories.store'));
}

const update = () => {
    form.put(route('categories.update', category.id));
}
</script>

<template>
    <AuthenticatedLayout>

        <Head title="Categorias" />

        <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">

            <div class="mb-6 flex items-center justify-between">
                <section>
                    <h2 class="text-xl font-semibold text-gray-900">{{ edit ? 'Editar categoria' : 'Agregar nueva categoria' }}</h2>
                </section>

                <section class="flex items-center space-x-4">
                    <a :href="route('categories.index')"
                        class="inline-block text-sm rounded-lg bg-white py-2 px-6 text-gray-600 shadow-md transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center">
                        <i class="bi bi-arrow-left"></i>
                        Volver a categorias
                    </a>
                </section>
            </div>

            <div class="overflow-hidden rounded-lg border shadow-md mb-5 bg-white">
                <div class="overflow-x-auto px-6 py-6">
                    <section class="mb-7">
                        <h3 class="text-xl font-bold text-gray-900">Información de la categoria</h3>
                        <p class="text-md text-gray-700 mt-2">Complete el siguiente formulario para {{ edit ? 'actualizar' : 'crear' }} una categoria.</p>
                    </section>

                    <hr class="my-8 border-t border-gray-200" />

                    <form @submit.prevent="category ? update() : save()">
                        <div class="grid grid-cols-1 md:grid-cols-1">
                            <div>
                                <InputLabel for="name" class="font-extrabold text-md mb-3">
                                    <i class="bi bi-at"></i> Nombre de la categoria
                                </InputLabel>

                                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full"
                                    required />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 mt-4">
                            <div>
                                <InputLabel for="price" class="font-extrabold text-md mb-3">
                                    <i class="bi bi-text-paragraph"></i> Descripción
                                </InputLabel>

                                <Textarea v-model="form.description" rows="4"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm md:text-md" />

                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                        </div>

                        <div class="mt-7">
                            <button v-if="category"
                                class="rounded-lg bg-yellow-400 py-2 px-6 text-black shadow-md transition duration-150 ease-in-out hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 text-center justify-end">
                                <i class="bi bi-arrow-clockwise"></i> Actualizar categoria
                            </button>
                            <button v-else="category"
                                class="rounded-lg bg-indigo-500 py-2 px-6 text-white shadow-md transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center justify-end">
                                <i class="bi bi-plus-lg"></i> Crear nueva categoria
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
.p-datepicker-input:focus,
.p-textarea:focus,
.p-multiselect.p-focus {
    border: 2px solid #6366f1 !important;
    /* indigo-500 */
}
</style>
