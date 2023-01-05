<template>
  <Link
    :href="routeName"
    class="flex items-center px-2 py-2 mt-2 transition duration-1000 transform"
    :class="[route().current(routeName) ? activeClass : inactiveClass]"
  >
    <component v-bind:is="icon" class="w-5 h-5 mr-2" />
    <span class="text-sm mx-2">{{ label }}</span>
  </Link>
</template>
<script>
import { defineComponent, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

import IconArrowLeftOnRectangle from "@/Pages/Components/Icons/ArrowLeftOnRectangle.vue";
import IconArrowRightOnRectangle from "@/Pages/Components/Icons/ArrowRightOnRectangle.vue";
import IconWindow from "@/Pages/Components/Icons/Window.vue";
import IconChatAlt from "@/Pages/Components/Icons/ChatAlt.vue";
import IconChartBar from "@/Pages/Components/Icons/ChartBar.vue";
import IconChartPie from "@/Pages/Components/Icons/ChartPie.vue";
import IconCollection from "@/Pages/Components/Icons/Collection.vue";
import IconNewspaper from "@/Pages/Components/Icons/Newspaper.vue";
import IconUsers from "@/Pages/Components/Icons/Users.vue";
import IconViewGrid from "@/Pages/Components/Icons/ViewGrid.vue";
import IconDocumentText from "@/Pages/Components/Icons/DocumentText.vue";
import IconBuildingOffice from "@/Pages/Components/Icons/BuildingOffice.vue";
import IconCircleStack from "@/Pages/Components/Icons/CircleStack.vue";

export default defineComponent({
  name: "Component_SidebarLink",
  //
  components: {
    Link,
    IconArrowLeftOnRectangle,
    IconArrowRightOnRectangle,
    IconWindow,
    IconChatAlt,
    IconChartBar,
    IconChartPie,
    IconCollection,
    IconNewspaper,
    IconUsers,
    IconViewGrid,
    IconDocumentText,
    IconBuildingOffice,
    IconCircleStack,
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
    routeName: {
      type: String,
      required: true,
    },
  },

  setup(props) {
    const activeClass = ref(
      `
      border-l-4
      text-layout-800
      bg-layout-300
      border-sunprimary
      dark:text-layout-200
      dark:bg-layout-700
      dark:border-nightprimary
      `
    );
    const inactiveClass = ref(
      `
      border-l-4 border-transparent
      text-layout-800
      bg-layout-200
      hover:text-white
      hover:bg-layout-900
      hover:border-sunprimary

      dark:text-layout-100
      dark:bg-layout-700
      dark:hover:text-layout-900
      dark:hover:bg-layout-100
      dark:hover:border-nightprimary
      `
    );

    return {
      activeClass,
      inactiveClass,
    };
  },
});
</script>
