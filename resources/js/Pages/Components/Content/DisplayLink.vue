<template>
  <Link
    :href="href"
    class="
      inline-flex
      items-baseline
      px-1.5
      border-b-2 border-transparent
      font-medium
      leading-5
      rounded
      text-layout-500
      bg-layout-100
      dark:text-layout-200
      dark:bg-layout-700
      hover:text-layout-800
      dark:hover:text-white
      hover:border-sunprimary
      dark:hover:border-nightprimary
      focus:outline-none focus:text-layout-700 focus:border-sunprimary
      dark:focus:border-nightprimary
      transition
      no-underline
      cursor-pointer
    "
  >
    <div class="mr-1">&#8594;</div>
    <slot></slot>
  </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  name: "Content_DisplayLink",

  components: {
    Link,
  },
  props: ["href"],
};
</script>
