<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Anzeige der Person bzw. des Unternehmens"
        :breadcrumbs="{
          'Liste der Personen / Unternehmen': route('admin.person_company.index'),
          Edit: route('admin.person_company.edit', person_company.id),
        }"
      ></breadcrumb>
    </template>

    <page-title> Anzeige Person bzw. des Unternehmens </page-title>

     <!-- Anzeige der Person bzw. des Unternehmes -->
    <section-content :full-width="true">
      <template #content>
        <person-company-show
          :person-company="person_company"
        ></person-company-show>
      </template>
    </section-content>
  </admin-layout>
</template>

<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import SectionContent from "@/Pages/Components/Content/SectionContent.vue";

import PersonCompanyShow from "@/Pages/Application/Shared/PersonCompanyShow.vue";

export default defineComponent({
  name: "Admin_PersonCompanyShow",

  components: {
    AdminLayout,
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

