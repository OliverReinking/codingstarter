<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-layout-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-layout-700 active:bg-layout-900 focus:outline-none focus:border-layout-900 focus:ring focus:ring-layout-300 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
