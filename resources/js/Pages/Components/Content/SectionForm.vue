<template>
  <div class="mt-6" :class="[fullWidth ? '' : 'md:grid md:grid-cols-3 md:gap-6']">
    <section-title :full-width="fullWidth">
      <template #title><slot name="title"></slot></template>
      <template #description><slot name="description"></slot></template>
      <template #onlinehelp><slot name="onlinehelp"></slot></template>
    </section-title>

    <div class="mt-2" :class="[fullWidth ? 'mt-8' : 'md:mt-0 md:col-span-2']">
      <form @submit.prevent="$emit('submitted')">
        <div
          class="
            px-4
            py-5
            bg-transparent
            sm:bg-layout-100
            dark:sm:bg-layout-800
            sm:p-6
          "
          :class="
            hasActions ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md'
          "
          v-if="hasForm"
        >
          <div class="grid grid-cols-1 gap-6">
            <slot name="form"></slot>
          </div>
        </div>

        <div
          class="
            flex
            items-center
            justify-end
            px-4
            py-3
            bg-layout-100
            dark:bg-layout-800
            text-right
            sm:px-6
            shadow
            sm:rounded-bl-md sm:rounded-br-md
          "
          v-if="hasActions"
        >
          <slot name="actions"></slot>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import SectionTitle from "@/Pages/Components/Content/SectionTitle.vue";

export default {
  name: "Content_SectionForm",

  emits: ["submitted"],

  components: {
    SectionTitle,
  },

  props: {
    fullWidth: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    hasForm() {
      return !!this.$slots.form;
    },
    hasActions() {
      return !!this.$slots.actions;
    },
  },
};
</script>
