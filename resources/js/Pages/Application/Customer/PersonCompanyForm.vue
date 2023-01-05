<template>
  <customer-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_customer"
        current="Edit"
        :breadcrumbs="{
          Anzeige: route('customer.person_company.show', person_company.id),
        }"
      ></breadcrumb>
    </template>

    <page-title>
      <span>Aktualisierung der Kundendaten</span>
    </page-title>

    <person-company-form
      :person-company="person_company"
      :countries="countries"
      :salutations="salutations"
      :errors="errors"
      :application-name="$page.props.applications.app_customer"
    ></person-company-form>
  </customer-layout>
</template>

<script>
import { defineComponent } from "vue";

import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import PersonCompanyForm from "@/Pages/Application/Shared/PersonCompanyForm.vue";

export default defineComponent({
  name: "Customer_PersonCompanyForm",

  components: {
    CustomerLayout,
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
