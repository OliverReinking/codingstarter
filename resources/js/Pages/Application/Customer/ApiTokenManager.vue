<template>
  <customer-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_customer"
        current="Api-Token-Manager"
      ></breadcrumb>
    </template>

    <ApiTokenManager
      :tokens="tokens"
      :available-permissions="availablePermissions"
      :default-permissions="defaultPermissions"
    />
  </customer-layout>
</template>
<script>
import { defineComponent } from "vue";
import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";

export default defineComponent({
  name: "Customer_Profile",

  components: {
    CustomerLayout,
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
