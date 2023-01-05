<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Liste der Webinaranmeldungen"
        :breadcrumbs="{
          'Übersicht Content': route('admin.content.index'),
        }"
      ></breadcrumb>
    </template>
    <!-- Anzeige der Webinaranmeldungs-Liste -->
    <section class="mt-8">
      <list-container
        title="Liste der Webinaranmeldungen"
        :datarows="webinar_orders"
        route-index="admin.webinarorder.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Webinaranmeldungen, die den Suchbegriff im Namen, in der Mailadresse oder in der Telefon-Nr enthalten."
        :edit-on="true"
        route-edit="admin.webinarorder.edit"
      >
        <template #header>
          <tr>
            <th class="np-dl-th-normal">Anmeledatum</th>
            <th class="np-dl-th-normal">Name</th>
            <th class="np-dl-th-normal">Mail</th>
            <th class="np-dl-th-normal">Telefon</th>
            <th class="np-dl-th-normal">Webinar</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal">
            <display-date
              :value="data.datarow.created_at"
              :time-on="false"
            ></display-date>
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.first_name }} {{ data.datarow.last_name }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.email }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.phone }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.title }}
          </td>
        </template>
      </list-container>
    </section>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ListContainer from "@/Pages/Components/Lists/ListContainer.vue";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

export default defineComponent({
  name: "Admin_WebinarOrderList",

  components: {
    AdminLayout,
    Breadcrumb,
    ListContainer,
    DisplayDate,
  },

  props: {
    webinar_orders: {
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
