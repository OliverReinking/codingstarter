<template>
    <div class="mt-8 mb-8 text-2xl font-extrabold text-center font-title">
        <span v-if="title">{{ title }}</span>
        <span v-else><slot></slot></span>
    </div>
</template>
<script>
export default {
    name: "RegisterTitle",

    props: {
        title: {
            type: String,
            default: "",
        },
    },
};
</script>
