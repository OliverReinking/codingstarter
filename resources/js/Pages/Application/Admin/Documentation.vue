<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Dokumentation"
      ></breadcrumb>
    </template>

    <div class="mt-8">
      <markdown :markdown="documentation"></markdown>
    </div>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import Markdown from "@/Pages/Components/Content/Markdown.vue";

export default defineComponent({
  name: "Admin_Documentation",

  components: {
    AdminLayout,
    Breadcrumb,
    Markdown,
  },

  props: {
    documentation: {
      type: String,
      required: true,
    },
  },
});
</script>
