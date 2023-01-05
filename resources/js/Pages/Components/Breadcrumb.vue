<template>
  <nav
    class="
      flex
      py-3
      px-5
      text-base
      rounded-lg
      border
      text-layout-800
      bg-layout-100
      border-layout-200
      dark:text-layout-100 dark:bg-layout-800 dark:border-layout-700
    "
    aria-label="Breadcrumb"
  >
    <ol class="inline-flex flex-col lg:flex-row items-start lg:items-center justify-start space-x-1 md:space-x-3">
      <li v-if="!startPage">
        <Link
          :href="route(routeDashboard)"
          class="
            flex
            items-center
            hover:text-sunprimary
            dark:hover:text-nightprimary-dark
            hover:underline
          "
        >
          <icon-home class="-mt-0.5 w-4 h-4" />
          <div class="ml-1 font-medium md:ml-2">{{ home }}</div>
        </Link>
      </li>
      <li v-if="startPage">
        <div class="flex items-center">
          <icon-home class="-mt-0.5 w-4 h-4" />
          <div class="ml-1 font-medium md:ml-2">
            {{ home }}
          </div>
        </div>
      </li>
      <li v-for="(value, key, index) in breadcrumbs" :key="index">
        <div class="flex items-center">
          <icon-breadcrumb-divider
            class="-mt-0.5 w-4 h-4"
          ></icon-breadcrumb-divider>
          <Link
            :href="value"
            class="
              ml-1
              font-medium
              md:ml-2
              hover:text-sunprimary
              dark:hover:text-nightprimary-dark
              hover:underline
            "
            >{{ key }}</Link
          >
        </div>
      </li>
      <li aria-current="page" v-if="current">
        <div class="flex items-center">
          <icon-breadcrumb-divider
            class="-mt-0.5 w-4 h-4"
          ></icon-breadcrumb-divider>
          <div class="ml-1 font-medium md:ml-2 text-layout-400 dark:text-layout-600">
            {{ current }}
          </div>
        </div>
      </li>
    </ol>
  </nav>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import IconHome from "@/Pages/Components/Icons/Home.vue";
import IconBreadcrumbDivider from "@/Pages/Components/Icons/BreadcrumbDivider.vue";

export default {
  name: "Components_Breadcrumb",

  components: {
    Link,
    IconHome,
    IconBreadcrumbDivider,
  },

  props: {
    home: {
      type: String,
      default: "Dashboard",
    },
    applicationName: {
      type: String,
      default: "", // mandant, consultant or admin
    },
    current: {
      type: String,
    },
    breadcrumbs: {
      type: Object,
    },
    startPage: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    routeDashboard() {
      if (this.applicationName == this.$page.props.applications.app_admin) {
        return "admin.dashboard";
      }
      if (this.applicationName == this.$page.props.applications.app_employee) {
        return "employee.dashboard";
      }
      if (this.applicationName == this.$page.props.applications.app_customer) {
        return "customer.dashboard";
      }
      return "customer.dashboard";
    },
  },
};
</script>
