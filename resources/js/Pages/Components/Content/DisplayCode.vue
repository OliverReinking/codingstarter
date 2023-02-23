<template>
  <div class="my-4 p-3 rounded-lg bg-layout-200 dark:bg-layout-700 font-mono">
    <span v-if="label">{{ label }}</span>
    <span v-else><slot></slot></span>
  </div>
</template>
<script>
export default {
  name: "Content_Displaycode",

  props: {
    label: {
      type: String,
      default: "",
    },
  },
};
</script>
