<template>
  <div class="flex">
    <!-- Backdrop -->
    <div
      :class="isSidebarOpen ? 'block' : 'hidden'"
      @click="closeSidebar"
      class="
        fixed
        inset-0
        z-20
        transition-opacity
        bg-sunprimary-light
        dark:bg-nightprimary-dark
        opacity-50
        lg:hidden
      "
    ></div>
    <!-- End Backdrop -->

    <transition name="slide-fade">
      <div
        :class="
          isSidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'
        "
        class="
          fixed
          inset-y-0
          left-0
          z-30
          w-80
          overflow-y-auto
          transition
          duration-1000
          transform
          bg-layout-100
          dark:bg-layout-800
          lg:translate-x-0 lg:static lg:inset-0
        "
      >
        <div class="flex items-center justify-center mt-8">
          <div class="flex items-center">
            <company-name
              :with-favicon="true"
              :with-link="true"
              :with-slogan="true"
              route-name="home"
            ></company-name>
          </div>
        </div>

        <nav class="mt-10">
          <sidebar-link
            icon="icon-chart-bar"
            :route-name="route('customer.dashboard')"
            label="Dashboard"
          ></sidebar-link>
          <sidebar-link
            icon="icon-arrow-left-on-rectangle"
            :route-name="route('customer.chat.inbox.index')"
            label="Posteingang"
          ></sidebar-link>
          <sidebar-link
            icon="icon-arrow-right-on-rectangle"
            :route-name="route('customer.chat.outbox.index')"
            label="Postausgang"
          ></sidebar-link>
          <application-switch
            v-if="$page.props.userdata.is_admin || $page.props.userdata.is_employee"
            class="lg:hidden"
            :display-type="$page.props.navtype.nav_sidebar"
            :application-name="$page.props.applications.app_customer"
          />
        </nav>
      </div>
    </transition>
  </div>
</template>

<script>
import { defineComponent } from "vue";

import SidebarLink from "@/Pages/Components/SidebarLink.vue";
import ApplicationSwitch from "@/Pages/Components/ApplicationSwitch.vue";

import CompanyName from "@/Pages/Components/Content/CompanyName.vue";

export default defineComponent({
  name: "Customer_Sidebar",

  components: {
    SidebarLink,
    ApplicationSwitch,
    CompanyName,
  },

  props: {
    isSidebarOpen: {
      type: Boolean,
      required: true,
    },
  },

  emits: ["changeSidebarValue"],

  setup(props) {
    function closeSidebar() {
      if (props.isSidebarOpen) {
        this.$emit("changeSidebarValue", false);
      }
    }
    //
    return {
      closeSidebar,
    };
  },
});
</script>
