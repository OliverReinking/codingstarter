<template>
  <button
    type="button"
    @click="changeMode"
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
      dark:active:bg-layout-900
      hover:bg-white hover:text-layout-900
      dark:hover:bg-layout-900 dark:hover:text-layout-100
      focus:bg-white focus:text-layout-900 focus:ountline-none
      dark:focus:bg-layout-900
      dark:focus:text-layout-100
      dark:focus:ountline-none
    "
  >
    <span v-if="mode == 'light'">
      <icon-night class="w-5 h-5"></icon-night>
    </span>
    <span v-else>
      <icon-sun class="w-5 h-5"></icon-sun>
    </span>
  </button>
</template>
<script>
import { defineComponent } from "vue";

import IconNight from "@/Pages/Components/Icons/Night.vue";
import IconSun from "@/Pages/Components/Icons/Sun.vue";

export default defineComponent({
  name: "Component_ButtonChangeMode",

  components: {
    IconNight,
    IconSun,
  },

  emits: ["changeMode"],

  props: {
    mode: {
      type: String,
      default: "light",
    },
  },

  setup(props) {
    function changeMode() {
      let value = "light";
      if (props.mode == "light") {
        value = "dark";
      }
      this.$emit("changeMode", value);
    }

    return {
      changeMode,
    };
  },
});
</script>
