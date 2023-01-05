<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Statisiken"
      ></breadcrumb>
    </template>

    <page-title> Statisiken </page-title>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

export default defineComponent({
  name: "Admin_Statistics",

  components: {
    AdminLayout,
    Breadcrumb,
    PageTitle,
  },
});
</script>
