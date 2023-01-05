<template>
  <homepage-layout header-title="Blog">
    <blog-show :blog="blog" :blogarticle="blogarticle"></blog-show>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import BlogShow from "@/Pages/Application/Shared/BlogShow.vue";

export default defineComponent({
  name: "Homepage_BlogShow",

  components: {
    Link,
    HomepageLayout,
    BlogShow,
  },

  props: {
    blog: {
      type: Object,
      default: () => ({}),
    },
    blogarticle: {
      type: String,
      default: null,
    },
  },
});
</script>
