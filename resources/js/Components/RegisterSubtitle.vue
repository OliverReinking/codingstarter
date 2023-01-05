<template>
    <div class="mt-4 mb-2 text-xl font-bold font-title">
        <span v-if="title">{{ title }}</span>
        <span v-else><slot></slot></span>
    </div>
</template>
<script>
export default {
    name: "RegisterSubtitle",

    props: {
        title: {
            type: String,
            default: "",
        },
    },
};
</script>
