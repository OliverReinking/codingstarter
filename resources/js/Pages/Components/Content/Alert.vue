<template>
  <div
    class="
      p-4
      my-2
      rounded-lg
    "
    :class="classTypeBackground"
    role="alert"
  >
    <div v-if="title || description">
        <span class="inline-block font-medium mr-2">{{ title }}</span>
        <span v-html="description"></span>
    </div>
    <div v-else>
      <slot></slot>
    </div>
  </div>
</template>
<script>
export default {
  name: "Content_Alert",

  props: {
    title: {
      type: String,
      default: "",
    },
    description: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "info",
    },
  },
  //
  computed: {
    classTypeBackground() {
      if (this.type == "error") {
        return "text-red-700 bg-red-100 dark:bg-red-200 dark:text-red-800";
      }
      if (this.type == "success") {
        return "text-green-700 bg-green-100 dark:bg-green-200 dark:text-green-800";
      }
      if (this.type == "warning") {
        return "text-yellow-700 bg-yellow-100 dark:bg-yellow-200 dark:text-yellow-800";
      }
      if (this.type == "dark") {
        return "text-layout-700 bg-layout-100 dark:bg-layout-200 dark:text-layout-800";
      }
      return "text-blue-700 bg-blue-100 dark:bg-blue-200 dark:text-blue-800";
    },
  },
};
</script>
