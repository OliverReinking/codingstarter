<template>
  <customer-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_customer"
        current="Nachricht"
        :breadcrumbs="{
          Postausgang: route('customer.chat.outbox.index'),
        }"
      ></breadcrumb>
    </template>
    <!-- Anzeige Nachricht -->
    <chat-show
      :inbox="false"
      :chat="chat"
      :chathistory="chathistory"
    ></chat-show>
  </customer-layout>
</template>
<script>
import { defineComponent } from "vue";

import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ChatShow from "@/Pages/Application/Shared/ChatShow.vue";

export default defineComponent({
  name: "Customer_ChatOutboxShow",

  components: {
    CustomerLayout,
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

