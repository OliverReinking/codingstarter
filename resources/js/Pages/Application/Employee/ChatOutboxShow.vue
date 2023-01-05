<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Nachricht"
        :breadcrumbs="{
          Postausgang: route('employee.chat.outbox.index'),
        }"
      ></breadcrumb>
    </template>
    <!-- Anzeige Nachricht -->
    <chat-show
      :inbox="false"
      :chat="chat"
      :chathistory="chathistory"
    ></chat-show>
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ChatShow from "@/Pages/Application/Shared/ChatShow.vue";

export default defineComponent({
  name: "Employee_ChatOutboxShow",

  components: {
    EmployeeLayout,
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

