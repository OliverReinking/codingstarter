<template>
  <div
    class="
      flex
      items-center
      flex-nowrap
      cursor-pointer
      rounded-md
      px-3
      py-2
      border border-transparent
      text-sm
      leading-4
      font-medium
      bg-transparaent
      transition
      text-layout-900
      dark:text-layout-100
      active:bg-white
      dark:active:bg-layout-800
      hover:bg-white hover:text-layout-900
      dark:hover:bg-layout-700 dark:hover:text-layout-100
      focus:bg-white focus:text-layout-900 focus:ountline-none
      dark:focus:bg-layout-900
      dark:focus:text-layout-100
      dark:focus:ountline-none
    "
  >
    <template v-if="withRoute">
      <Link :href="routeName">
        <div>
          <slot></slot>
        </div>
        <div v-if="withIcon">
          <icon-chevron-down class="ml-2 h-4 w-h" />
        </div>
      </Link>
    </template>
    <template v-else>
      <div>
        <slot></slot>
      </div>
      <div v-if="withIcon">
        <icon-chevron-down class="ml-2 h-4 w-h" />
      </div>
    </template>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

import IconChevronDown from "@/Pages/Components/Icons/ChevronDown.vue";

export default {
  name: "Component_DropdownLink",

  components: {
    Link,
    IconChevronDown,
  },

  props: {
    routeName: {
      type: String,
      default: "",
    },
    withIcon: {
      type: Boolean,
      default: false,
    },
    withRoute: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
