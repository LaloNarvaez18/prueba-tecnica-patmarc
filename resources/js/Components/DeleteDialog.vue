<script setup>
defineProps({
    title: {
        type: String,
        default: 'Eliminar elemento'
    },
    text: {
        type: String,
        default: '¿Estás seguro que deseas eliminar este elemento?'
    }
});
</script>

<template>
    <div class="p-6">
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-base font-semibold text-gray-900" id="dialog-title"><i
                    class="bi bi-exclamation-triangle-fill text-red-400 mr-2"></i>{{ title }}
            </h3>
            <div class="mt-2 mb-6">
                <p class="text-sm text-gray-500">¿Estás seguro que deseas eliminar este elemento?
                    Tenga presente que toda la información se borrará permanentemente y esta acción no se
                    puede deshacer.</p>
            </div>

            <div class="sm:flex sm:flex-row sm:justify-start">
                <slot />
            </div>
        </div>
    </div>
</template>
