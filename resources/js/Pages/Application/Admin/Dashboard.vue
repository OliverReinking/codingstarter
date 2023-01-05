<template>
  <admin-layout>
    <breadcrumb
      :application-name="$page.props.applications.app_admin"
      :start-page="true"
    ></breadcrumb>

    <page-title>
      Herzlich Willkommen im Dashboard für Administratoren!
    </page-title>

    <section class="mt-8">
      <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        <navigation-card title="Anwender-Liste" :buttonTwo="false">
          <template #icon> <icon-chat-alt /> </template>
          <template #description>
            Hier kannst du eine Liste aller Anwender anzeigen
          </template>
          <template #buttonOne>
            <Link :href="route('admin.user.index')" class="flex items-center">
              <icon-card-list class="h-4 w-4 mr-1" />Liste
            </Link>
          </template>
        </navigation-card>

        <navigation-card title="Liste der Personen und Unternehmen" :buttonTwo="false">
          <template #icon> <icon-building-office /> </template>
          <template #description>
            Hier kannst du eine Liste aller Personen und Unternehmen anzeigen
          </template>
          <template #buttonOne>
            <Link
              :href="route('admin.person_company.index')"
              class="flex items-center"
            >
              <icon-card-list class="inline-block h-5 w-5 mr-2" />Liste
            </Link>
          </template>
        </navigation-card>

        <navigation-card title="Content">
          <template #icon> <icon-newspaper /> </template>
          <template #description>
            Hier findest du alles zum Thema Content
          </template>
          <template #buttonOne>
            <Link
              :href="route('admin.content.index')"
              class="flex items-center"
            >
              <icon-card-list class="inline-block h-5 w-5 mr-2" />Dashboard
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
              :href="route('admin.teammember.index')"
              class="flex items-center"
            >
              <icon-card-list class="inline-block h-5 w-5 mr-2" />Liste
            </Link>
          </template>
          <template #buttonTwo>
            <Link
              :href="route('admin.teammember.create')"
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
              :href="route('admin.invitation.index')"
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
              :href="route('admin.chat.inbox.index')"
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
              :href="route('admin.chat.outbox.index')"
              class="flex items-center"
            >
              <icon-card-list class="h-4 w-4 mr-1" />Postausgang
            </Link>
          </template>
        </navigation-card>
      </div>
    </section>

    <section class="mt-8">
      <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
        <statistic-value
          :with-link="false"
          :with-icon="true"
          icon="icon-users"
          label="Anzahl der Anwender"
          value-type="number"
          :after-digits="0"
          value-unit="Anwender"
          :value="counts.users"
        ></statistic-value>
        <statistic-value
          :with-link="false"
          :with-icon="true"
          icon="icon-users"
          label="Anzahl der Kunden"
          value-type="number"
          :after-digits="0"
          value-unit="Kunden"
          :value="counts.customers"
        ></statistic-value>
        <statistic-value
          :with-link="false"
          :with-icon="true"
          icon="icon-users"
          label="Anzahl der Mitarbeiter"
          value-type="number"
          :after-digits="0"
          value-unit="Mitarbeiter"
          :value="counts.employees"
        ></statistic-value>
        <statistic-value
          :with-link="false"
          :with-icon="true"
          icon="icon-users"
          label="Anzahl der Administratoren"
          value-type="number"
          :after-digits="0"
          value-unit="Administratoren"
          :value="counts.admins"
        ></statistic-value>
      </div>
    </section>
  </admin-layout>
</template>
<script>
import { defineComponent } from "vue";

import { Link } from "@inertiajs/inertia-vue3";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import NavigationCard from "@/Pages/Components/Content/NavigationCard.vue";

import StatisticValue from "@/Pages/Components/Content/StatisticValue.vue";

import IconBuildingOffice from "@/Pages/Components/Icons/BuildingOffice.vue";
import IconArrowLeftOnRectangle from "@/Pages/Components/Icons/ArrowLeftOnRectangle.vue";
import IconArrowRightOnRectangle from "@/Pages/Components/Icons/ArrowRightOnRectangle.vue";
import IconChatAlt from "@/Pages/Components/Icons/ChatAlt.vue";
import IconUsers from "@/Pages/Components/Icons/Users.vue";
import IconCardList from "@/Pages/Components/Icons/CardList.vue";
import IconAddCircle from "@/Pages/Components/Icons/AddCircle.vue";
import IconNewspaper from "@/Pages/Components/Icons/Newspaper.vue";

export default defineComponent({
  name: "Admin_Dashboard",

  components: {
    Link,
    AdminLayout,
    Breadcrumb,
    PageTitle,
    NavigationCard,
    StatisticValue,
    IconBuildingOffice,
    IconArrowLeftOnRectangle,
    IconArrowRightOnRectangle,
    IconChatAlt,
    IconUsers,
    IconCardList,
    IconAddCircle,
    IconNewspaper,
  },

  props: {
    counts: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>
