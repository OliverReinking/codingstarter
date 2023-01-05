<template>
    <div class="font-sans">
        <div
            v-html="markdown"
            class="prose md:prose-md dark:prose-invert prose-headings:font-logo"
        ></div>
    </div>
</template>
<script>
export default {
    name: "Markdown",
    //
    props: {
        markdown: {
            type: String,
            required: true,
        },
    },
};
</script>
