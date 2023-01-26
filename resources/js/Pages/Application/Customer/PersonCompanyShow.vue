<template>
  <customer-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_customer"
        current="Anzeige Kundendaten"
        :breadcrumbs="{
          Edit: route('customer.person_company.edit', person_company.id),
        }"
      ></breadcrumb>
    </template>

    <page-title> Anzeige Kundendaten </page-title>

     <!-- Anzeige der Person bzw. des Unternehmens -->
    <section-content :full-width="true">
      <template #content>
        <person-company-show
          :person-company="person_company"
        ></person-company-show>
      </template>
    </section-content>
  </customer-layout>
</template>

<script>
import { defineComponent } from "vue";

import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import SectionContent from "@/Pages/Components/Content/SectionContent.vue";

import PersonCompanyShow from "@/Pages/Application/Shared/PersonCompanyShow.vue";

export default defineComponent({
  name: "Customer_PersonCompanyShow",

  components: {
    CustomerLayout,
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

