<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Anzeige der Person bzw. des Unternehmens"
        :breadcrumbs="{
          Edit: route('employee.person_company.edit', person_company.id),
        }"
      ></breadcrumb>
    </template>

    <page-title> Anzeige Person bzw. des Unternehmens </page-title>

     <!-- Anzeige der Person bzw. des Unternehmens -->
    <section-content :full-width="true">
      <template #content>
        <person-company-show
          :person-company="person_company"
        ></person-company-show>
      </template>
    </section-content>
  </employee-layout>
</template>

<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import SectionContent from "@/Pages/Components/Content/SectionContent.vue";

import PersonCompanyShow from "@/Pages/Application/Shared/PersonCompanyShow.vue";

export default defineComponent({
  name: "Employee_PersonCompanyShow",

  components: {
    EmployeeLayout,
    Breadcrumb,
    PageTitle,
    SectionContent,
    PersonCompanyShow,
  },

  props: {
    person_company: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>

