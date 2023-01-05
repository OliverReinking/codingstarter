<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Api-Token-Manager"
      ></breadcrumb>
    </template>

    <ApiTokenManager
      :tokens="tokens"
      :available-permissions="availablePermissions"
      :default-permissions="defaultPermissions"
    />
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";
import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ApiTokenManager from "@/Pages/API/Partials/ApiTokenManager.vue";

export default defineComponent({
  name: "Employee_Profile",

  components: {
    EmployeeLayout,
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
