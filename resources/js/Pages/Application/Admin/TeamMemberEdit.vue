<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Teammitglied"
        :breadcrumbs="{
          Liste: route('admin.teammember.index'),
        }"
      ></breadcrumb>
    </template>

    <page-title>
      <span>Daten eines Teammitglieds ändern</span>
    </page-title>

    <team-member-form
      :teammember="user"
      :errors="errors"
      :application-name="$page.props.applications.app_admin"
    ></team-member-form>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import TeamMemberForm from "@/Pages/Application/Shared/TeamMemberForm.vue";

export default defineComponent({
  name: "Admin_TeamMemberEdit",

  components: {
    AdminLayout,
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
