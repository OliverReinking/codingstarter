<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Teammitglied"
        :breadcrumbs="{
          Liste: route('employee.teammember.index'),
        }"
      ></breadcrumb>
    </template>

    <page-title>
      <span>Daten eines Teammitglieds ändern</span>
    </page-title>

    <team-member-form
      :teammember="user"
      :errors="errors"
      :application-name="$page.props.applications.app_employee"
    ></team-member-form>
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import TeamMemberForm from "@/Pages/Application/Shared/TeamMemberForm.vue";

export default defineComponent({
  name: "Employee_TeamMemberEdit",

  components: {
    EmployeeLayout,
    Breadcrumb,
    PageTitle,
    TeamMemberForm,
  },

  props: {
    user: {
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
