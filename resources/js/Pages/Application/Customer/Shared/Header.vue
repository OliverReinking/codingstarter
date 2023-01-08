<template>
  <header
    class="
      flex
      items-center
      justify-between
      px-6
      py-4
      transition
      duration-1000
      transform
      bg-layout-200
      dark:bg-layout-800
      border-b-2 border-layout-200
      dark:border-layout-600
    "
  >
    <div class="flex items-center">
      <button @click="openSidebar" class="focus:outline-none lg:hidden">
        <icon-menu class="w-5 h-5 mt-2"></icon-menu>
      </button>
    </div>
    <div class="flex items-center space-x-2 md:flex-nowrap text-sm font-medium">
      <div>
        <button-change-mode
          :mode="mode"
          @changeMode="changeDarkLight"
        ></button-change-mode>
      </div>
      <div>
        <dropdown-link
          :with-icon="false"
          :with-route="true"
          :route-name="route('customer.chat.inbox.index', 'unread')"
        >
          <badge-unread-chats :count="$page.props.userdata.unreadCustomerChats" />
        </dropdown-link>
      </div>
      <div
        v-if="$page.props.userdata.is_admin || $page.props.userdata.is_employee"
        class="hidden lg:block"
      >
        <!-- Application Dropdown -->
        <dropdown align="right" width="96">
          <template #trigger>
            <dropdown-link :with-icon="true" :with-route="false"
              >Anwendung wechseln</dropdown-link
            >
          </template>

          <template #content>
            <!-- Application Management -->
            <div class="block px-4 py-2 text-xs">Anwendung wechseln</div>
            <application-switch
              :display-type="$page.props.navtype.nav_header"
              :application-name="$page.props.applications.app_customer"
            />
          </template>
        </dropdown>
      </div>
      <div>
        <dropdown align="right" width="96">
          <template #trigger>
            <dropdown-link v-if="$page.props.userdata.profile_photo_path">
              <img
                class="h-8 w-8 rounded-full object-cover"
                :src="$page.props.userdata.profile_photo_path"
                :alt="$page.props.userdata.first_name + ' ' + $page.props.userdata.last_name"
              />
            </dropdown-link>
            <dropdown-link v-else :with-icon="true">
              {{ $page.props.userdata.first_name }} {{ $page.props.userdata.last_name }}
            </dropdown-link>
          </template>

          <template #content>
            <!-- Account Management -->
            <div class="block px-4 py-2 text-xs text-layout-400">
              Meine Daten
            </div>

            <dropdown-link :route-name="route('customer.profile')" :with-route="true">
              Persönliche Einstellungen
            </dropdown-link>

             <dropdown-link
              :route-name="route('customer.api_tokens.index')"
              :with-route="true"
              v-if="$page.props.jetstream.hasApiFeatures"
            >
              API Tokens
            </dropdown-link>

            <div class="my-2 border-t border-layout-100"></div>

            <!-- Authentication -->
            <form @submit.prevent="logout">
              <dropdown-link>
                <button type="submit">Abmelden</button>
              </dropdown-link>
            </form>
          </template>
        </dropdown>
      </div>
    </div>
  </header>
</template>
<script>
import { defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";

import ButtonChangeMode from "@/Pages/Components/ButtonChangeMode.vue";
import IconMenu from "@/Pages/Components/Icons/Menu.vue";

import BadgeUnreadChats from "@/Pages/Components/Content/BadgeUnreadChats.vue";

import ApplicationSwitch from "@/Pages/Components/ApplicationSwitch.vue";
import Dropdown from "@/Pages/Components/Dropdown.vue";
import DropdownLink from "@/Pages/Components/DropdownLink.vue";

export default defineComponent({
  name: "Customer_Header",

  components: {
    ButtonChangeMode,
    IconMenu,
    BadgeUnreadChats,
    ApplicationSwitch,
    Dropdown,
    DropdownLink,
  },

  props: {
    mode: {
      type: String,
      required: true,
    },
    isSidebarOpen: {
      type: Boolean,
      required: true,
    },
  },

  emits: ["changeSidebarValue", "changeDarkLight"],

  setup(props, context) {
    function openSidebar() {
      context.emit("changeSidebarValue", true);
    }
    //
    function changeDarkLight(value) {
      localStorage.theme = value;
      context.emit("changeDarkLight", value);
    }
    //
    const logout = () => {
      Inertia.post(route("logout"));
    };
    //
    return {
      openSidebar,
      changeDarkLight,
      logout,
    };
  },
});
</script>
