<template>
  <homepage-layout header-title="Webinare">
    <section
      class="bg-white text-layout-800 dark:bg-layout-800 dark:text-layout-100"
    >
      <div
        class="container max-w-6xl p-1 md:p-6 mx-auto space-y-6"
        v-if="webinars.data.length == 0 && !form.search"
      >
        <alert type="warning"> Zurzeit liegen keine Webinare vor! </alert>
      </div>
      <div v-else class="container max-w-6xl p-1 md:p-6 mx-auto space-y-6">
        <div class="flex justify-between items-center">
          <search-filter v-model="form.search" class="w-full" @reset="reset">
          </search-filter>
        </div>

        <div v-if="webinars.data.length == 0 && form.search">
          <alert type="warning">
            Für den vorgegebenen Suchbegriff wurden keine Webinare gefunden.
          </alert>
        </div>

        <div v-if="webinars.data.length > 0">
          <webinar-preview-big :webinar="webinars.data[0]"></webinar-preview-big>

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
            <template v-for="(webinar, index) in webinars.data" :key="webinar.id">
              <webinar-preview-small
                v-if="index > 0"
                :webinar="webinar"
              ></webinar-preview-small>
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

import WebinarPreviewBig from "@/Pages/Application/Shared/WebinarPreviewBig.vue";
import WebinarPreviewSmall from "@/Pages/Application/Shared/WebinarPreviewSmall.vue";

import SearchFilter from "@/Pages/Components/Lists/SearchFilter.vue";

import Alert from "@/Pages/Components/Content/Alert.vue";

import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

export default defineComponent({
  name: "Homepage_WebinarList",

  components: {
    Link,
    HomepageLayout,
    WebinarPreviewBig,
    WebinarPreviewSmall,
    SearchFilter,
    Alert,
  },

  props: {
    webinars: {
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
            "home.webinar.index",
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
