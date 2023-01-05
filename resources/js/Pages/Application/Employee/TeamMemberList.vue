<template>
  <employee-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_employee"
        current="Liste der Teammitglieder"
      ></breadcrumb>
    </template>
    <!-- Anzeige der Teammitgliederliste -->
    <section class="mt-8">
      <list-container
        title="Liste der Teammitglieder"
        :datarows="company_users"
        route-index="employee.teammember.index"
        :filters="filters"
        :search-filter="true"
        search-text="Gesucht werden alle Teammitglieder, die den Suchbegriff im Vornamen, im Nachnamen oder in der Mailadresse enthalten."
        :edit-on="true"
        route-edit="employee.teammember.edit"
        :create-on="true"
        route-create="employee.teammember.create"
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
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import ListContainer from "@/Pages/Components/Lists/ListContainer.vue";
import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

export default defineComponent({
  name: "Employee_TeamMemberList",

  components: {
    EmployeeLayout,
    Breadcrumb,
    ListContainer,
    DisplayDate,
  },

  props: {
    company_users: {
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
