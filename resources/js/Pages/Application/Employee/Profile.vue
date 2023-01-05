<template>
  <employee-layout>
    <breadcrumb
      :application-name="$page.props.applications.app_employee"
      current="Persönliche Einstellungen"
    ></breadcrumb>
    <profile :sessions="sessions"></profile>
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";
import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import Profile from "@/Pages/Components/Profile.vue";

export default defineComponent({
  name: "Employee_Profile",

  components: {
    EmployeeLayout,
    Breadcrumb,
    Profile,
  },

  props: {
    sessions: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>
