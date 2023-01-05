<template>
  <Link
    :href="route('home.blog.show', blog.slug)"
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
      :src="blog.url"
      :alt="blog.name"
    />

    <div class="p-6 space-y-2">
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
          text-2xl
          font-semibold font-title
          group-hover:underline
          group-focus:underline
        "
      >
        {{ blog.title }}
      </h3>
      <span class="text-xs text-layout-600 dark:text-layout-300">
        <display-date :value="blog.blog_date" :time-on="false" />
        von
        <span>{{ blog.author_name }}</span>
      </span>
      <p v-html="blog.summary"></p>
      <p>
        <display-number
          :value="blog.reading_time"
          :after-digits="0"
          value-unit="Minuten Lesezeit"
          value-single-unit="Minute Lesezeit"
        ></display-number>
      </p>
    </div>
  </Link>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";
import DisplayNumber from "@/Pages/Components/Content/DisplayNumber.vue";

export default {
  name: "Shared_BlogPreviewSmall",
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
