<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Postausgang"
      ></breadcrumb>
    </template>
    <!-- Anzeige Chatliste Postausgang -->
    <section class="mt-8">
      <list-container
        title="Postausgang"
        :datarows="chats"
        route-index="employee.chat.outbox.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Nachrichten, die den Suchbegriff in der Nachricht enthalten."
        :show-on="true"
        route-show="employee.chat.outbox.show"
      >
        <template #header>
          <tr>
            <th class="np-dl-th-normal">Datum</th>
            <th class="np-dl-th-normal">Empfänger</th>
            <th class="np-dl-th-normal">Nachricht</th>
            <th class="np-dl-th-normal">Gelesen?</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal whitespace-nowrap">
            <display-date :value="data.datarow.chat_date" :time-on="true" />
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.receiver_person_company_name }}
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

export default defineComponent({
  name: "Employee_ChatOutboxList",

  components: {
    EmployeeLayout,
    Breadcrumb,
    ListContainer,
    DisplayDate,
    DisplayYesOrNo,
    DisplayShortText,
  },

  props: {
    chats: {
      type: Object,
      default: () => ({}),
    },
    filters: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>
