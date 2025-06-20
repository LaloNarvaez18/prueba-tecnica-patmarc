<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import FormTitle from './FormTitle.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <FormTitle
            :title="'Bienvenido'"
            :subTitle="'Ingresa tus datos para crear a tu cuenta.'"
        />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name">
                    <i class="bi bi-text-paragraph"></i> Nombre
                </InputLabel>

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email">
                    <i class="bi bi-at"></i> Correo electrónico
                </InputLabel>

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password">
                    <i class="bi bi-lock"></i> Contraseña
                </InputLabel>

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation">
                    <i class="bi bi-lock"></i> Confirmar contraseña
                </InputLabel>

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-center">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    ¿Ya tienes una cuenta?
                </Link>
            </div>

            <div class="mt-7">
                <button
                    class="middle none center w-full rounded-lg bg-indigo-500 py-2 px-6 text-white shadow-md transition duration-150 ease-in-out hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-center"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <i class="bi bi-person-plus mr-2"></i>Crear cuenta
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
