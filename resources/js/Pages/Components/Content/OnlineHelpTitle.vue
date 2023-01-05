<template>
    <h2 class="mt-4 mb-1 text-xl font-bold text-layout-900 dark:text-layout-50">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </h2>
</template>
<script>
export default {
    name: "OnlineHelpTitle",

    props: {
        value: {
            type: String,
        },
    },
};
</script>
