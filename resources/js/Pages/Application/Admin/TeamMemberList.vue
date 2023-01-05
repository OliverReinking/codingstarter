<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Liste der Teammitglieder"
      ></breadcrumb>
    </template>
    <!-- Anzeige der Teammitgliederliste -->
    <section class="mt-8">
      <list-container
        title="Liste der Teammitglieder"
        :datarows="admin_users"
        route-index="admin.teammember.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Teammitglieder, die den Suchbegriff im Vornamen, im Nachnamen oder in der Mailadresse enthalten."
        :edit-on="true"
        route-edit="admin.teammember.edit"
        :create-on="true"
        route-create="admin.teammember.create"
      >
        <template #header>
          <tr>
            <th class="np-dl-th-normal">Vorname</th>
            <th class="np-dl-th-normal">Nachname</th>
            <th class="np-dl-th-normal">Mailadresse</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal">
            {{ data.datarow.first_name }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.last_name }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.email }}
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
  name: "Admin_TeamMemberList",

  components: {
    AdminLayout,
    Breadcrumb,
    ListContainer,
    DisplayDate,
  },

  props: {
    admin_users: {
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
