<template>
  <div :class="[fullWidth ? 'mt-2' : 'mt-6 md:grid md:grid-cols-3 md:gap-6']">
    <section-title :full-width="fullWidth">
      <template #title><slot name="title"></slot></template>
      <template #description><slot name="description"></slot></template>
      <template #onlinehelp><slot name="onlinehelp"></slot></template>
    </section-title>

    <div :class="[fullWidth ? 'mt-0' : 'mt-2 md:mt-0 md:col-span-2']">
      <div
        class="
          px-4
          py-5
          bg-transparent
          sm:bg-layout-100
          dark:sm:bg-layout-800
          rounded-lg
          sm:p-6
        "
      >
        <slot name="content"></slot>
      </div>
    </div>
  </div>
</template>

<script>
import SectionTitle from "@/Pages/Components/Content/SectionTitle.vue";

export default {
  name: "Content_SectionAccordion",

  components: {
    SectionTitle,
  },

  props: {
    fullWidth: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
