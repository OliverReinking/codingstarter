<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Teammitglied einladen"
      ></breadcrumb>
    </template>

    <page-title>
      <span>Teammitglied einladen</span>
    </page-title>

    <invitation-form
      :invitation="invitation"
      :roles="roles"
      :errors="errors"
      :application-name="$page.props.applications.app_employee"
    ></invitation-form>

  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import InvitationForm from "@/Pages/Application/Shared/InvitationForm.vue";

export default defineComponent({
  name: "Employee_TeamMemberCreate",

  components: {
    EmployeeLayout,
    Breadcrumb,
    PageTitle,
    InvitationForm,
  },

  props: {
    invitation: {
      type: Object,
      default: () => ({}),
    },
    roles: {
      type: Object,
      default: () => ({}),
    },
    errors: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>
