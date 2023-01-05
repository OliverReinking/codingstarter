<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Api-Token-Manager"
      ></breadcrumb>
    </template>

    <ApiTokenManager
      :tokens="tokens"
      :available-permissions="availablePermissions"
      :default-permissions="defaultPermissions"
    />
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";
import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";

export default defineComponent({
  name: "Admin_Profile",

  components: {
    AdminLayout,
    Breadcrumb,
    ApiTokenManager,
  },

  props: {
    tokens: {
      type: Object,
      default: () => ({}),
    },
     availablePermissions: {
      type: Object,
      default: () => ({}),
    },
     defaultPermissions: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>
