<template>
  <div
    class="
      min-w-full
      max-w-sm
      mx-auto
      group
      rounded
      hover:no-underline
      focus:no-underline
      bg-layout-100
      dark:bg-layout-900
    "
  >
    <img
      role="presentation"
      class="object-cover w-full rounded h-44 bg-layout-500"
      :src="webinar.url"
      :alt="webinar.name"
    />
    <div class="p-6 space-y-2">
      <h3
        class="
          text-2xl
          font-semibold
          font-title
        "
      >
        {{ webinar.title }}
      </h3>
      <div class="text-base text-layout-600 dark:text-layout-300">
        Veranstaltungsdatum:
        <display-date :value="webinar.event_date" :time-on="false" />
        um
        <span>{{ webinar.event_start }}</span> Uhr
      </div>
      <div v-html="webinar.description"></div>
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
import DisplayNumber from "@/Pages/Components/Content/DisplayNumber.vue";

export default {
  name: "Shared_WebinarPreviewSmall",
  //
  components: {
    Link,
    DisplayDate,
    DisplayNumber,
  },

  props: {
    webinar: {
      type: Object,
    },
  },
};
</script>
