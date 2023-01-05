<template>
  <!-- ActionMessage -->
  <div v-if="message && show" class="mx-auto">
    <div
      class="
        flex
        items-center
        w-full
        p-4
        mt-8
        rounded-lg
        shadow
        border
        text-layout-800
        bg-white
        dark:text-layout-200 dark:bg-layout-900
      "
      :class="classTypeBackground"
      role="alert"
    >
      <div
        v-if="type == 'success'"
        class="
          inline-flex
          items-center
          justify-center
          flex-shrink-0
          w-8
          h-8
          rounded-lg
          text-layout-900
          dark:text-white
        "
      >
        <icon-done class="w-5 h-5"></icon-done>
      </div>
      <div
        v-if="type == 'error'"
        class="
          inline-flex
          items-center
          justify-center
          flex-shrink-0
          w-8
          h-8
          rounded-lg
          text-layout-900
          dark:text-white
        "
      >
        <icon-exclamation class="w-5 h-5"></icon-exclamation>
      </div>
      <div
        v-if="type == 'info'"
        class="
          inline-flex
          items-center
          justify-center
          flex-shrink-0
          w-8
          h-8
          rounded-lg
          text-layout-900
          dark:text-white
        "
      >
        <icon-exclamation-circle class="w-5 h-5"></icon-exclamation-circle>
      </div>
      <div class="ml-3 text-sm font-normal">
        <span v-html="message"></span>
      </div>
      <button
        type="button"
        class="
          ml-auto
          -mx-1.5
          -my-1.5
          rounded-lg
          p-1.5
          inline-flex
          h-8
          w-8
          cursor-pointer
          border
          focus:ring focus:outline-none
          text-on-sunprimary
          border-sunprimary-light
          hover:text-on-sunprimary-light hover:bg-sunprimary-light
          dark:text-nightprimary-darker
          dark:border-nightprimary-dark
          dark:hover:text-on-nightprimary-darker
          dark:hover:bg-nightprimary-darker
          focus:bg-sunprimary focus:ring-sunprimary
          dark:focus:bg-nightprimary dark:focus:ring-nightprimary
        "
        @click.prevent="show = false"
      >
        <span class="sr-only">Close</span>
        <icon-close class="w-5 h-5"></icon-close>
      </button>
    </div>
  </div>
  <!-- ENDS Toast -->
</template>
<script>
import IconDone from "@/Pages/Components/Icons/Done.vue";
import IconExclamation from "@/Pages/Components/Icons/Exclamation.vue";
import IconExclamationCircle from "@/Pages/Components/Icons/ExclamationCircle.vue";
import IconClose from "@/Pages/Components/Icons/Close.vue";

export default {
  name: "Content_ActionMessage",

  components: {
    IconDone,
    IconExclamation,
    IconExclamationCircle,
    IconClose,
  },

  props: {
    show: {
      type: [String, Boolean],
      default: false,
    },
    message: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "info",
    },
  },
  //
  computed: {
    classTypeBackground() {
      if (this.type == "error") {
        return "border-red-500 dark:border-red-500";
      }
      if (this.type == "success") {
        return "border-green-500 dark:border-green-500";
      }
      return "border-violet-500 dark:border-violet-500";
    },
  },
};
</script>
