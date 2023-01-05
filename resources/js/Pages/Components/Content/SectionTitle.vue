<template>
  <div class="md:col-span-1" :class="[fullWidth ? 'mb-4' : 'md:col-span-1']">
    <h3 class="text-lg font-medium text-layout-900 dark:text-layout-100">
      <slot name="title"></slot>
    </h3>
    <p class="mt-1 text-sm text-layout-600 dark:text-layout-400">
      <slot name="description"></slot>
    </p>
    <p class="mt-1 text-sm text-layout-400 dark:text-layout-600">
      <slot name="onlinehelp"></slot>
    </p>
  </div>
</template>
<script>
export default {
  name: "Content_SectionTitle",

  props: {
    fullWidth: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
