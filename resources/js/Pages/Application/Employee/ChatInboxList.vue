<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Posteingang"
      ></breadcrumb>
    </template>

    <!-- Loading -->
    <input-loading
      :loading="loading"
      :loading-text="loadingText"
    ></input-loading>
    <!-- ENDS Loading -->

    <!-- Message -->
    <action-message
      :show="filterChatsText"
      type="info"
      :message="filterChatsText"
    >
    </action-message>
    <!-- ENDS Message -->

    <!-- Anzeige Chatliste Posteingang -->
    <section class="mt-8" v-if="!loading">
      <list-container
        title="Posteingang"
        :datarows="chats"
        route-index="employee.chat.inbox.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Nachrichten, die den Suchbegriff in der Nachricht enthalten."
        :show-on="true"
        route-show="employee.chat.inbox.show"
      >
        <template #button>
          <input-button type="button" @click.prevent="filterChats('all')"
            >alle Nachrichten</input-button
          >
          <input-button type="button" @click.prevent="filterChats('unread')"
            >nur ungelesene Nachrichten</input-button
          >
          <input-button type="button" @click.prevent="filterChats('read')"
            >nur gelesene Nachrichten</input-button
          >
        </template>

        <template #header>
          <tr>
            <th class="np-dl-th-normal">Datum</th>
            <th class="np-dl-th-normal">Absender</th>
            <th class="np-dl-th-normal">Nachricht</th>
            <th class="np-dl-th-normal">Gelesen?</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal whitespace-nowrap">
            <display-date :value="data.datarow.chat_date" :time-on="true" />
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.sender_person_company_name }}
          </td>
          <td class="np-dl-td-normal">
             <display-short-text
              :content="data.datarow.message"
              :max-length="100"
            ></display-short-text>
          </td>
          <td class="np-dl-td-normal">
            <display-yes-or-no
              :value="data.datarow.read_status"
            ></display-yes-or-no>
          </td>
        </template>
      </list-container>
    </section>
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ListContainer from "@/Pages/Components/Lists/ListContainer.vue";
import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";
import DisplayYesOrNo from "@/Pages/Components/Content/DisplayYesOrNo.vue";
import DisplayShortText from "@/Pages/Components/Content/DisplayShortText.vue";

import InputButton from "@/Pages/Components/Form/InputButton.vue";
import InputLoading from "@/Pages/Components/Form/InputLoading.vue";

import ActionMessage from "@/Pages/Components/Content/ActionMessage.vue";

export default defineComponent({
  name: "Employee_ChatInboxList",

  components: {
    EmployeeLayout,
    Breadcrumb,
    ListContainer,
    DisplayDate,
    DisplayYesOrNo,
    DisplayShortText,
    InputButton,
    InputLoading,
    ActionMessage,
  },

  props: {
    chats: {
      type: Object,
      default: () => ({}),
    },
    filterChatsText: {
      type: String,
      default: () => ({}),
    },
    filters: {
      type: Object,
      default: () => ({}),
    },
  },

  data() {
    return {
      loading: false,
      loadingText: null,
    };
  },

  methods: {
    filterChats(filter_read) {
      //console.log("filter_read");
      //
      this.loading = true;
      //
      this.loadingText = "Alle Nachrichten im Posteingang werden angezeigt!";
      //
      if (filter_read == "unread") {
        this.loadingText =
          "Die ungelesenen Nachrichten im Posteingang werden angezeigt!";
      }
      //
      if (filter_read == "read") {
        this.loadingText =
          "Die gelesenen Nachrichten im Posteingang werden angezeigt!";
      }
      //
      this.$inertia.get(
        this.route("employee.chat.inbox.index", { filter_read, page: 1 }),
        {
          onSuccess: () => {
            this.loading = false;
          },
          onError: () => {
            this.loading = false;
          },
        }
      );
    },
  },
});
</script>
