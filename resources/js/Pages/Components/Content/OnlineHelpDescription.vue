<template>
    <div class="mb-2 text-layout-900 dark:text-layout-50">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </div>
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
