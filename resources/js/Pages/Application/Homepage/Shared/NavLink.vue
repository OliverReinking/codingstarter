<template>
  <div v-if="routeName">
    <Link
      :href="route(routeName)"
      class="block py-2 pr-4 pl-3 cursor-pointer whitespace-nowrap"
      :class="[
        route().current(routeName)
          ? `
        rounded
        px-1
        border

        text-on-sunprimary-lighter
        border-sunprimary

        dark:text-on-nightprimary-lighter
        dark:border-nightprimary
        `
          : `
        rounded
        px-1
        hover:border

        text-on-sunprimary-lighter
        hover:text-on-sunprimary
        hover:border-sunprimary

        dark:text-on-nightprimary
        dark:hover:text-on-nightprimary
        dark:hover:border-nightprimary
        `,
      ]"
    >
      {{ label }}</Link
    >
  </div>
  <div v-else>
    <div
      class="
        block
        py-2
        pr-4
        pl-3
        cursor-pointer
        whitespace-nowrap
        rounded
        px-1
        hover:border
        text-on-sunprimary-lighter
        hover:text-on-sunprimary hover:border-sunprimary
        dark:text-on-nightprimary
        dark:hover:text-on-nightprimary
        dark:hover:border-nightprimary
      "
    >
      <slot></slot>
    </div>
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  name: "Homepage_NavLink",
  //
  components: {
    Link,
  },
  //
  props: {
    label: {
      type: String,
      default: null,
    },
    routeName: {
      type: String,
      default: null,
    },
  },
};
</script>
