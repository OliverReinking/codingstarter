<template>
  <customer-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_customer"
        current="Teammitglied"
        :breadcrumbs="{
          Liste: route('customer.teammember.index'),
        }"
      ></breadcrumb>
    </template>

    <page-title>
      <span>Daten eines Teammitglieds ändern</span>
    </page-title>

    <team-member-form
      :teammember="user"
      :errors="errors"
      :application-name="$page.props.applications.app_customer"
    ></team-member-form>
  </customer-layout>
</template>
<script>
import { defineComponent } from "vue";

import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import TeamMemberForm from "@/Pages/Application/Shared/TeamMemberForm.vue";

export default defineComponent({
  name: "Customer_TeamMemberEdit",

  components: {
    CustomerLayout,
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
