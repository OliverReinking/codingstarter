<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Version"
      ></breadcrumb>
    </template>

    <div class="mt-8">
      <markdown :markdown="version_documentation"></markdown>
    </div>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import Markdown from "@/Pages/Components/Content/Markdown.vue";

export default defineComponent({
  name: "Admin_Version",

  components: {
    AdminLayout,
    Breadcrumb,
    Markdown,
  },

  props: {
    version_documentation: {
      type: String,
      required: true,
    },
  },
});
</script>
