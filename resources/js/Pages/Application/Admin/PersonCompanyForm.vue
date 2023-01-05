<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Edit"
        :breadcrumbs="{
          'Liste der Personen / Unternehmen': route('admin.person_company.index'),
          Anzeige: route('admin.person_company.show', person_company.id),
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
      :application-name="$page.props.applications.app_admin"
    ></person-company-form>
  </admin-layout>
</template>

<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import PersonCompanyForm from "@/Pages/Application/Shared/PersonCompanyForm.vue";

export default defineComponent({
  name: "Admin_PersonCompanyForm",

  components: {
    AdminLayout,
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
