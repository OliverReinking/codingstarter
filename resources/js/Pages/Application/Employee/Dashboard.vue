<template>
  <employee-layout>
    <breadcrumb
      :application-name="$page.props.applications.app_employee"
      :start-page="true"
    ></breadcrumb>

    <page-title> Herzlich Willkommen im Dashboard für Mitarbeiter! </page-title>

    <section class="mt-8">
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <navigation-card title="Unternehmensdaten" :buttonTwo="true">
          <template #icon> <icon-building-office /> </template>
          <template #description>
            Hier kannst du deine Unternehmensdaten ändern bzw. anzeigen
          </template>
          <template #buttonOne>
            <Link
              :href="
                route(
                  'employee.person_company.edit',
                  $page.props.userdata.company_id
                )
              "
              class="flex items-center"
            >
              <icon-card-list class="inline-block h-5 w-5 mr-2" />Jetzt ändern
            </Link>
          </template>
          <template #buttonTwo>
            <Link
              :href="
                route(
                  'employee.person_company.show',
                  $page.props.userdata.company_id
                )
              "
              class="flex items-center"
            >
              <icon-eye class="inline-block h-5 w-5 mr-2" />Anzeigen
            </Link>
          </template>
        </navigation-card>

        <navigation-card title="Teammitglieder" :buttonTwo="true">
          <template #icon> <icon-users /> </template>
          <template #description>
            Hier kannst du eine Liste deiner Teammitglieder anzeigen
          </template>
          <template #buttonOne>
            <Link
              :href="route('employee.teammember.index')"
              class="flex items-center"
            >
              <icon-card-list class="inline-block h-5 w-5 mr-2" />Liste
            </Link>
          </template>
          <template #buttonTwo>
            <Link
              :href="route('employee.teammember.create')"
              class="flex items-center"
            >
              <icon-add-circle class="inline-block h-5 w-5 mr-2" />Neu
            </Link>
          </template>
        </navigation-card>

        <navigation-card title="Liste der Einladungen" :buttonTwo="false">
          <template #icon> <icon-users /> </template>
          <template #description>
            Hier kannst du eine Liste aller Teammitglieder-Einladungen anzeigen
          </template>
          <template #buttonOne>
            <Link
              :href="route('employee.invitation.index')"
              class="flex items-center"
            >
              <icon-card-list class="inline-block h-5 w-5 mr-2" />Liste
            </Link>
          </template>
        </navigation-card>

        <navigation-card title="Posteingang">
          <template #icon>
            <icon-arrow-left-on-rectangle />
          </template>
          <template #description>
            Hier kannst du eine Liste aller Nachrichten im Posteingang anzeigen
          </template>
          <template #buttonOne>
            <Link
              :href="route('employee.chat.inbox.index')"
              class="flex items-center"
            >
              <icon-card-list class="h-4 w-4 mr-1" />Posteingang
            </Link>
          </template>
        </navigation-card>

        <navigation-card title="Postausgang">
          <template #icon>
            <icon-arrow-right-on-rectangle />
          </template>
          <template #description>
            Hier kannst du eine Liste aller Nachrichten im Postausgang anzeigen
          </template>
          <template #buttonOne>
            <Link
              :href="route('employee.chat.outbox.index')"
              class="flex items-center"
            >
              <icon-card-list class="h-4 w-4 mr-1" />Postausgang
            </Link>
          </template>
        </navigation-card>
      </div>
    </section>
  </employee-layout>
</template>
<script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/inertia-vue3";

import EmployeeLayout from "@/Pages/Application/Employee/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import NavigationCard from "@/Pages/Components/Content/NavigationCard.vue";

import IconBuildingOffice from "@/Pages/Components/Icons/BuildingOffice.vue";
import IconArrowLeftOnRectangle from "@/Pages/Components/Icons/ArrowLeftOnRectangle.vue";
import IconArrowRightOnRectangle from "@/Pages/Components/Icons/ArrowRightOnRectangle.vue";
import IconUsers from "@/Pages/Components/Icons/Users.vue";
import IconCardList from "@/Pages/Components/Icons/CardList.vue";
import IconAddCircle from "@/Pages/Components/Icons/AddCircle.vue";
import IconEye from "@/Pages/Components/Icons/Eye.vue";

export default defineComponent({
  name: "Employee_Dashboard",

  components: {
    Link,
    EmployeeLayout,
    Breadcrumb,
    PageTitle,
    NavigationCard,
    IconBuildingOffice,
    IconArrowLeftOnRectangle,
    IconArrowRightOnRectangle,
    IconUsers,
    IconCardList,
    IconAddCircle,
    IconEye
  },
});
</script>
