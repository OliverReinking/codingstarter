<template>
  <div class="font-sans">
    <div
      v-html="markdown"
      class="
        max-w-none
        min-h-full
        prose
        md:prose-md
        dark:prose-invert
        prose-headings:font-title
        prose-pre:bg-layout-100 prose-pre:text-layout-800
        dark:prose-pre:bg-layout-800 dark:prose-pre:text-layout-100
      "
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
