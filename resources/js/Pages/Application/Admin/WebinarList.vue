<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Liste der Webinare"
        :breadcrumbs="{
          'Übersicht Content': route('admin.content.index'),
        }"
      ></breadcrumb>
    </template>
    <!-- Anzeige der WebinarListe -->
    <section class="mt-8">
      <list-container
        title="Liste der Webinare"
        :datarows="webinars"
        route-index="admin.webinar.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Webinare, die den Suchbegriff im Namen oder in der Beschreibung selbst enthalten."
        :edit-on="true"
        route-edit="admin.webinar.edit"
        :create-on="true"
        route-create="admin.webinar.create"
      >
        <template #header>
          <tr>
            <th class="np-dl-th-normal">Veranstaltungsdatum</th>
            <th class="np-dl-th-normal">Name</th>
            <th class="np-dl-th-normal">Aktiv?</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal">
            <display-date
              :value="data.datarow.event_date"
              :time-on="false"
            ></display-date>
            {{ data.datarow.event_start }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.title }}
          </td>
          <td class="np-dl-td-normal">
            <display-yes-or-no :value="data.datarow.active"></display-yes-or-no>
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
import DisplayYesOrNo from "@/Pages/Components/Content/DisplayYesOrNo.vue";

export default defineComponent({
  name: "Admin_WebinarList",

  components: {
    AdminLayout,
    Breadcrumb,
    ListContainer,
    DisplayDate,
    DisplayYesOrNo,
  },

  props: {
    webinars: {
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
