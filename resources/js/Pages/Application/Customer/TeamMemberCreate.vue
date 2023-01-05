<template>
  <customer-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_customer"
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
      :application-name="$page.props.applications.app_customer"
    ></invitation-form>

  </customer-layout>
</template>
<script>
import { defineComponent } from "vue";

import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import InvitationForm from "@/Pages/Application/Shared/InvitationForm.vue";

export default defineComponent({
  name: "Customer_TeamMemberCreate",

  components: {
    CustomerLayout,
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
