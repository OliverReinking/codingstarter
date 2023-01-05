<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Nachricht"
        :breadcrumbs="{
          Postausgang: route('admin.chat.outbox.index'),
        }"
      ></breadcrumb>
    </template>
    <!-- Anzeige Nachricht -->
    <chat-show
      :inbox="false"
      :chat="chat"
      :chathistory="chathistory"
    ></chat-show>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ChatShow from "@/Pages/Application/Shared/ChatShow.vue";

export default defineComponent({
  name: "Admin_ChatOutboxShow",

  components: {
    AdminLayout,
    Breadcrumb,
    ChatShow,
  },

  props: {
    chat: {
      type: Object,
      default: () => ({}),
    },
    chathistory: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>

