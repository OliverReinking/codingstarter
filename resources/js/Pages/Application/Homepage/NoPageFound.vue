<template>
    <homepage-layout header-title="Seite nicht gefunden">
        <h1
            class="font-logo text-4xl font-bold tracking-tight text-layout-900 dark:text-white sm:text-5xl
                   sm:leading-none"
        >
            Seite nicht gefunden!
        </h1>
    </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

export default defineComponent({
    name: "Homepage_NoPageFound",

    components: {
        HomepageLayout,
    },
});
</script>
