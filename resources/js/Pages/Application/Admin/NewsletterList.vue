<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Liste der Newsletter"
      ></breadcrumb>
    </template>
    <!-- Anzeige der Newsletter-Liste -->
    <section class="mt-8">
      <list-container
        title="Liste der Newsletter"
        :datarows="newsletters"
        route-index="admin.newsletter.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Newsletter, die den Suchbegriff im Namen enthalten."
        :edit-on="true"
        route-edit="admin.newsletter.edit"
      >
        <template #header>
          <tr>
            <th class="np-dl-th-normal">Name</th>
            <th class="np-dl-th-normal">Beschreibung</th>
            <th class="np-dl-th-normal">Abonnenten</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal">
            {{ data.datarow.name }}
          </td>
          <td class="np-dl-td-normal">
            <span v-html="data.datarow.description"></span>
          </td>
          <td class="np-dl-td-normal">
            <display-number
              :value="data.datarow.members_count"
              :after-digits="0"
            ></display-number>
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
import DisplayNumber from "@/Pages/Components/Content/DisplayNumber.vue";

export default defineComponent({
  name: "Admin_NewsletterList",

  components: {
    AdminLayout,
    Breadcrumb,
    ListContainer,
    DisplayNumber,
  },

  props: {
    newsletters: {
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
