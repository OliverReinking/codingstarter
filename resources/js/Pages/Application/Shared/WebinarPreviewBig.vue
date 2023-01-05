<template>
  <div
    class="
      block
      max-w-sm
      gap-3
      mx-auto
      sm:max-w-full
      bg-layout-100
      dark:bg-layout-900
      rounded
    "
  >
    <div class="p-6 space-y-2">
      <h3 class="text-xl font-semibold sm:text-2xl font-title">
        {{ webinar.title }}
      </h3>
      <div class="text-base text-layout-600 dark:text-layout-300 py-2">
        Veranstaltungsdatum:
        <display-date :value="webinar.event_date" :time-on="false" />
        um
        <span>{{ webinar.event_start }}</span> Uhr
      </div>
      <div v-html="webinar.description" class="pb-6"></div>
      <div>
        <Link
          :href="route('home.webinar.order', webinar.id)"
          class="
            inline-flex
            items-center
            font-medium
            text-lg
            transition-colors
            duration-200
            px-4
            py-2
            rounded-lg
            border
            text-on-sunprimary
            border-sunprimary
            hover:text-on-sunprimary-dark hover:bg-sunprimary-dark
            dark:text-on-nightprimary
            dark:border-nightprimary
            dark:hover:text-on-nightprimary-lighter
            dark:hover:bg-nightprimary-lighter
            focus:shadow-outline focus:outline-none
          "
        >
          Jetzt anmelden!
        </Link>
      </div>
    </div>
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

export default {
  name: "Shared_WebinarPreviewBig",
  //
  components: {
    Link,
    DisplayDate,
  },

  props: {
    webinar: {
      type: Object,
    },
  },
};
</script>
