<template>
  <div :class="mode">
    <div
      class="
        relative
        flex
        h-screen
        text-layout-900
        bg-white
        dark:text-layout-50 dark:bg-layout-900
      "
    >
      <admin-sidebar
        :is-sidebar-open="isSidebarOpen"
        @changeSidebarValue="changeSidebarOpen"
      ></admin-sidebar>
      <div class="flex-1 flex flex-col overflow-hidden">
        <admin-header
          :mode="mode"
          :is-sidebar-open="isSidebarOpen"
          @changeSidebarValue="changeSidebarOpen"
          @changeDarkLight="changeMode"
        ></admin-header>
        <main class="flex-1 overflow-x-hidden overflow-y-auto">
          <div class="w-full lg:w-9/12 mx-auto px-6 py-8" id="app-layout-start">
            <div class="mb-6">
              <slot name="breadcrumb"></slot>
            </div>
            <toast class="mb-6"></toast>
            <div class="mb-16">
              <slot />
            </div>
          </div>
          <div
            class="
              fixed
              bottom-0
              left-0
              right-0
              text-layout-800
              bg-layout-100
              dark:text-layout-100 dark:bg-layout-800
            "
          >
            <div class="lg:mr-12 p-2 text-center lg:text-right text-xs">
              Version: {{ $page.props.version.versionnr }} vom
              {{ $page.props.version.versionsdatum }}
              <br />
              {{ $page.props.applications.app_admin_name }}
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>
<script>
import { defineComponent, ref } from "vue";

import AdminSidebar from "@/Pages/Application/Admin/Shared/Sidebar.vue";
import AdminHeader from "@/Pages/Application/Admin/Shared/Header.vue";

import Toast from "@/Pages/Components/Content/Toast.vue";

export default defineComponent({
  name: "Admin_Layout",

  components: {
    AdminSidebar,
    AdminHeader,
    Toast,
  },

  setup() {
    const mode = ref("light");
    const isSidebarOpen = ref(false);
    //
    if (localStorage.theme) {
      mode.value = localStorage.theme;
    }
    //
    function changeSidebarOpen(newValue) {
      //console.log("Admin Layout.vue changeSidebarOpen:", newValue);
      isSidebarOpen.value = newValue;
    }
    //
    function changeMode(newValue) {
      //console.log("Admin Layout.vue changeMode:", newValue);
      mode.value = newValue;
      //
      localStorage.theme = mode.value;
    }
    //
    return {
      mode,
      isSidebarOpen,
      changeSidebarOpen,
      changeMode,
    };
  },
});
</script>
