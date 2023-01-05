<template>
  <button
    @click.prevent="toggleDropdown"
    type="button"
    class="w-full px-2 py-2 mt-2 transition duration-1000 transform"
    :class="inactiveClass"
  >
    <div class="w-full flex items-center justify-between">
      <div class="flex-1 flex justify-start">
        <component v-bind:is="icon" class="inline-flex w-5 h-5 mr-2" />
        <span class="text-sm mx-2">{{ label }}</span>
      </div>
      <div>
        <icon-chevron-down v-if="!show" class="inline-flex w-5 h-5"></icon-chevron-down>
        <icon-chevron-up v-if="show" class="inline-flex w-5 h-5"></icon-chevron-up>
      </div>
    </div>
  </button>
  <div v-if="show" class="ml-4">
    <slot name="links"></slot>
  </div>
</template>
<script>
import { defineComponent, ref } from "vue";

import IconChartPie from "@/Pages/Components/Icons/ChartPie.vue";
import IconUsers from "@/Pages/Components/Icons/Users.vue";
import IconChevronDown from "@/Pages/Components/Icons/ChevronDown.vue";
import IconChevronUp from "@/Pages/Components/Icons/ChevronUp.vue";
import IconDocumentText from "@/Pages/Components/Icons/DocumentText.vue";
import IconCreditCard from "@/Pages/Components/Icons/CreditCard.vue";
import IconNewspaper from "@/Pages/Components/Icons/Newspaper.vue";

export default defineComponent({
  name: "Component_SidebarDropDown",
  //
  components: {
    IconChartPie,
    IconUsers,
    IconChevronDown,
    IconChevronUp,
    IconDocumentText,
    IconCreditCard,
    IconNewspaper,
  },

  props: {
    icon: {
      type: String,
      default: null,
    },
    label: {
      type: String,
      required: true,
    },
  },

  setup(props) {
    const show = ref(false);

    function toggleDropdown() {
      //console.log("toggleDropdown");
      this.show = !this.show;
    }

    const inactiveClass = ref(
      `
      border-l-4 border-transparent
      text-layout-800
      bg-layout-200
      hover:text-white
      hover:bg-layout-900

      dark:text-layout-100
      dark:bg-layout-900
      dark:hover:text-layout-900
      dark:hover:bg-layout-100
      `
    );

    return {
      inactiveClass,
      show,
      toggleDropdown,
    };
  },
});
</script>

