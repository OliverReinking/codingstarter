<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white border border-layout-300 rounded-md font-semibold text-xs text-layout-700 uppercase tracking-widest shadow-sm hover:text-layout-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-layout-800 active:bg-layout-50 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
