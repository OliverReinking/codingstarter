<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Edit"
        :breadcrumbs="{
          Anzeige: route('employee.person_company.show', person_company.id),
        }"
      ></breadcrumb>
    </template>

    <page-title>
      <span>Aktualisierung der Daten</span>
    </page-title>

    <person-company-form
      :person-company="person_company"
      :countries="countries"
      :salutations="salutations"
      :errors="errors"
      :application-name="$page.props.applications.app_employee"
    ></person-company-form>
  </employee-layout>
</template>

<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import PersonCompanyForm from "@/Pages/Application/Shared/PersonCompanyForm.vue";

export default defineComponent({
  name: "Employee_PersonCompanyForm",

  components: {
    EmployeeLayout,
    Breadcrumb,
    PageTitle,
    PersonCompanyForm,
  },

  props: {
    person_company: {
      type: Object,
      default: () => ({}),
    },
    countries: {
      type: Object,
      default: () => ({}),
    },
    salutations: {
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
