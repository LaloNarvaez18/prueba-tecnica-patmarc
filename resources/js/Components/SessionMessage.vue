<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    message: String,
});

let timer = null;
let { message } = props;

let active = ref(
    (message)
        ? true
        : false
);

const closeAlert = () => {
    if (active.value)
        active.value = false;
}

onMounted(() => {
    if (active.value) {
        timer = setTimeout(() => {
            active.value = false;
        }, 5000);
    }
});

onBeforeUnmount(() => {
    if (timer) {
        clearTimeout(timer);
    }
});
</script>

<template>
    <div v-if="message && active" class="mb-4 font-medium text-sm text-green-500">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-7">
            <span class="block sm:inline">
                <i class="bi bi-check-circle mr-2"></i>{{ message }}
                <i class="bi bi-x-lg float-end cursor-pointer" @click="closeAlert()"></i>
            </span>
        </div>
    </div>
</template>
