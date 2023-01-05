<template>
  <homepage-layout header-title="Unser Blog">
    <section
      class="bg-white text-layout-800 dark:bg-layout-800 dark:text-layout-100"
    >
      <div
        class="container max-w-6xl p-1 md:p-6 mx-auto space-y-6"
        v-if="blogs.data.length == 0 && !form.search"
      >
        <alert type="warning"> Zurzeit liegen keine Blogartikel vor! </alert>
      </div>
      <div v-else class="container max-w-6xl p-1 md:p-6 mx-auto space-y-6">
        <div class="flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full" @reset="reset">
          </search-filter>
        </div>

        <div v-if="blogs.data.length == 0 && form.search">
          <alert type="warning">
            Für den vorgegebenen Suchbegriff wurden keine Blogartikel gefunden.
          </alert>
        </div>

        <div v-if="blogs.data.length > 0">
          <blog-preview-big :blog="blogs.data[0]"></blog-preview-big>
          <div
            class="
              mt-8
              grid
              justify-center
              grid-cols-1
              gap-6
              sm:grid-cols-2
              lg:grid-cols-3
            "
          >
            <template v-for="(blog, index) in blogs.data" :key="blog.id">
              <blog-preview-small
                v-if="index > 0"
                :blog="blog"
              ></blog-preview-small>
            </template>
          </div>
        </div>
      </div>
    </section>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import BlogPreviewBig from "@/Pages/Application/Shared/BlogPreviewBig.vue";
import BlogPreviewSmall from "@/Pages/Application/Shared/BlogPreviewSmall.vue";

import SearchFilter from "@/Pages/Components/Lists/SearchFilter.vue";

import Alert from "@/Pages/Components/Content/Alert.vue";

import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default defineComponent({
  name: "Homepage_BlogList",

  components: {
    Link,
    HomepageLayout,
    BlogPreviewBig,
    BlogPreviewSmall,
    SearchFilter,
    Alert,
  },

  props: {
    blogs: {
      type: Object,
      default: () => ({}),
    },
    filters: {
      type: Object,
      default: () => ({}),
    },
  },

  data() {
    return {
      form: {
        search: this.filters.search,
      },
    };
  },

  watch: {
    form: {
      handler: throttle(function () {
        let query = pickBy(this.form);
        //
        this.$inertia.get(
          this.route(
            "home.blog.index",
            Object.keys(query).length ? query : { remember: "forget" }
          ),
          this.form,
          {
            preserveState: true,
          }
        );
      }, 150),
      deep: true,
    },
  },

  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
});
</script>
