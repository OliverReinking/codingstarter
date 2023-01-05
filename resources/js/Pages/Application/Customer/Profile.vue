<template>
  <customer-layout>
    <breadcrumb
      :application-name="$page.props.applications.app_customer"
      current="Persönliche Einstellungen"
    ></breadcrumb>

    <profile :sessions="sessions"></profile>
  </customer-layout>
</template>
<script>
import { defineComponent } from "vue";
import CustomerLayout from "@/Pages/Application/Customer/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import Profile from "@/Pages/Components/Profile.vue";

export default defineComponent({
    name: "Customer_Profile",

    components: {
        CustomerLayout,
        Breadcrumb,
        Profile
    },

    props: {
        sessions: {
            type: Object,
            default: () => ({}),
        }
    }
});
</script>
