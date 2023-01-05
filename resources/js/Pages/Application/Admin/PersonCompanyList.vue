<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Liste der Personen und Unternehmen"
      ></breadcrumb>
    </template>

    <!-- Anzeige der Unternehmenliste -->
    <section class="mt-8">
      <list-container
        title="Liste der Personen und Unternehmen"
        :datarows="person_companies"
        route-index="admin.person_company.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Personen und Unternehmen, die den Suchbegriff in der Nr (Unternehmens-Nr), im Namen, in der Mailadresse, in der Postleitzahl oder in den Daten der Kontaktperson enthalten."
        :show-on="true"
        route-show="admin.person_company.show"
        :edit-on="true"
        route-edit="admin.person_company.edit"
      >
        <template #header>
          <tr>
            <th class="np-dl-th-normal">Nr</th>
            <th class="np-dl-th-normal">Name</th>
            <th class="np-dl-th-normal">PLZ</th>
            <th class="np-dl-th-normal">Land</th>
            <th class="np-dl-th-normal">Mailadresse</th>
            <th class="np-dl-th-normal">Kontaktperson</th>
          </tr>
        </template>
        <template v-slot:datarow="data">
          <td class="np-dl-td-normal">
            {{ data.datarow.person_company_number }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.name }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.postcode }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.country_name }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.contactperson_email }}
          </td>
          <td class="np-dl-td-normal">
            {{ data.datarow.contactperson_first_name }}
            {{ data.datarow.contactperson_last_name }}
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

export default defineComponent({
  name: "Admin_PersonCompanyList",

  components: {
    AdminLayout,
    Breadcrumb,
    ListContainer,
  },

  props: {
    person_companies: {
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
