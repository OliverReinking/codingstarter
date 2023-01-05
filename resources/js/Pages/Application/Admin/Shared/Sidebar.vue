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
        bg-sunprimary-500
        opacity-50
        lg:hidden
      "
    ></div>
    <!-- End Backdrop -->

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
          :route-name="route('admin.dashboard')"
          label="Dashboard"
        ></sidebar-link>
        <sidebar-link
          icon="icon-users"
          :route-name="route('admin.user.index')"
          label="Anwender"
        ></sidebar-link>
        <sidebar-link
          icon="icon-collection"
          :route-name="route('admin.processes')"
          label="Prozesse"
        ></sidebar-link>

        <sidebar-dropdown icon="icon-newspaper" label="Content">
          <template #links>
            <sidebar-link
              icon="icon-newspaper"
              :route-name="route('admin.content.index')"
              label="Übersicht"
            ></sidebar-link>
            <sidebar-link
              icon="icon-newspaper"
              :route-name="route('admin.blog.index')"
              label="Blogartikel"
            ></sidebar-link>
            <sidebar-link
              icon="icon-newspaper"
              :route-name="route('admin.webinar.index')"
              label="Webinare"
            ></sidebar-link>
            <sidebar-link
              icon="icon-newspaper"
              :route-name="route('admin.webinarorder.index')"
              label="Webinaranmeldungen"
            ></sidebar-link>
            <sidebar-link
              icon="icon-newspaper"
              :route-name="route('admin.newsletter.index')"
              label="Newsletter"
            ></sidebar-link>
          </template>
        </sidebar-dropdown>

        <sidebar-link
          icon="icon-chart-pie"
          :route-name="route('admin.statistics')"
          label="Statistik"
        ></sidebar-link>
        <sidebar-link
          icon="icon-document-text"
          :route-name="route('admin.documentation')"
          label="Dokumentation"
        ></sidebar-link>
        <sidebar-link
          icon="icon-arrow-left-on-rectangle"
          :route-name="route('admin.chat.inbox.index')"
          label="Posteingang"
        ></sidebar-link>
        <sidebar-link
          icon="icon-arrow-right-on-rectangle"
          :route-name="route('admin.chat.outbox.index')"
          label="Postausgang"
        ></sidebar-link>
        <application-switch
          v-if="
            $page.props.userdata.is_employee || $page.props.userdata.is_customer
          "
          class="lg:hidden"
          :display-type="$page.props.navtype.nav_sidebar"
          :application-name="$page.props.applications.app_admin"
        />
      </nav>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

import SidebarLink from "@/Pages/Components/SidebarLink.vue";
import SidebarDropdown from "@/Pages/Components/SidebarDropdown.vue";
import ApplicationSwitch from "@/Pages/Components/ApplicationSwitch.vue";

import CompanyName from "@/Pages/Components/Content/CompanyName.vue";

export default defineComponent({
  name: "Admin_Sidebar",

  components: {
    SidebarLink,
    SidebarDropdown,
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
