<template>
  <Link
    :href="route('home.blog.show', blog.slug)"
    class="
      block
      max-w-sm
      gap-3
      mx-auto
      sm:max-w-full
      group
      hover:no-underline
      focus:no-underline
      lg:grid lg:grid-cols-12
      bg-layout-100
      dark:bg-layout-900
    "
  >
    <img
      :src="blog.url"
      :alt="blog.name"
      class="
        object-cover
        w-full
        h-64
        sm:h-96
        rounded
        lg:col-span-7
        bg-layout-500
      "
    />
    <div class="p-6 space-y-2 lg:col-span-5">
      <div class="flex justify-end items-start">
        <div
          v-if="blog.category_name"
          class="
            text-sm
            min-w-fit min-h-fit
            bg-sunprimary-darker
            text-on-sunprimary-darker
            font-semibold
            px-2.5
            py-0.5
            rounded-lg
            dark:bg-nightprimary-darker dark:text-on-nightprimary-darker
            whitespace-nowrap
          "
        >
          {{ blog.category_name }}
        </div>
      </div>
      <h3
        class="
          text-xl
          font-semibold
          sm:text-2xl
          font-title
          group-hover:underline
          group-focus:underline
        "
      >
        {{ blog.title }}
      </h3>
      <div class="text-xs text-layout-600 dark:text-layout-300 py-2">
        <display-date :value="blog.blog_date" :time-on="false" />
        von
        <span>{{ blog.author_name }}</span>
      </div>
      <div v-html="blog.summary" class="pb-6"></div>
      <div>
        <display-number
          :value="blog.reading_time"
          :after-digits="0"
          value-unit="Minuten Lesezeit"
          value-single-unit="Minute Lesezeit"
        ></display-number>
      </div>
    </div>
  </Link>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";
import DisplayNumber from "@/Pages/Components/Content/DisplayNumber.vue";

export default {
  name: "Shared_BlogPreviewBig",
  //
  components: {
    Link,
    DisplayDate,
    DisplayNumber,
  },

  props: {
    blog: {
      type: Object,
    },
  },
};
</script>
