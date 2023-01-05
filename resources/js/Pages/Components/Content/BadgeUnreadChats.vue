<template>
  <div class="relative">
    <icon-bell class="h-5 w-5"></icon-bell>
    <div
      v-if="count > 0"
      class="
        absolute
        text-xs
        font-medium
        text-center text-on-sunprimary-light
        bg-sunprimary-light
        dark:text-on-nightprimary dark:bg-nightprimary
        top-0
        right-0
        -mt-3
        -mr-3
        w-5
        h-5
        pt-0.5
        rounded-full
      "
    >
      {{ count }}
    </div>
  </div>
</template>
<script>
import IconBell from "@/Pages/Components/Icons/Bell.vue";

export default {
  name: "Content_BadgeUnreadChats",

  components: {
    IconBell,
  },

  props: {
    count: {
      type: Number,
      default: 0,
    },
  },
};
</script>
