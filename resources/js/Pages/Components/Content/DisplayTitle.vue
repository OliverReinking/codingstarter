<template>
    <div class="mt-4 mb-2 text-lg md:text-xl font-extrabold">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </div>
</template>
<script>
export default {
    name: "DisplayTitle",

    props: {
        value: {
            type: String,
        },
    },
};
</script>
