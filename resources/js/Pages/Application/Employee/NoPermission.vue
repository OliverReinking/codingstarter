<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Kompetenzproblem"
      ></breadcrumb>
    </template>

    <page-title> Es ist ein Kompetenzproblem aufgetreten! </page-title>

     <!-- Message -->
    <action-message
      :show="message"
      type="error"
      :message="message"
    >
    </action-message>
    <!-- ENDS Message -->

  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/inertia-vue3";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import ActionMessage from "@/Pages/Components/Content/ActionMessage.vue";

export default defineComponent({
  name: "Employee_NoPermission",

  components: {
    Link,
    EmployeeLayout,
    Breadcrumb,
    PageTitle,
    ActionMessage,
 },

 props: {
    message: {
      type: String,
      default: "Die Ursache für das Kompetenzproblem konnte leider nicht ermittelt werden.",
    },
  },
});
</script>
