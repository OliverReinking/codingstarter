<template>
    <homepage-layout header-title="Datenschutzerklärung" :cookie-consent-display="false">
        <div class="max-w-4xl p-6 mx-auto text-layout-700 dark:text-white bg-layout-50 dark:bg-layout-700 rounded-md shadow-md">
            <markdown :markdown="policy"></markdown>
        </div>
    </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import Markdown from "@/Pages/Components/Content/Markdown.vue";

export default defineComponent({
    name: "Homepage_Privacy",

    props: {
        policy: {
            type: String,
            required: true,
        },
    },

    components: {
        HomepageLayout,
        Markdown,
    },
});
</script>
