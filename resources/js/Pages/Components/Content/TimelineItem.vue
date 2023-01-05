<template>
  <li class="mb-10 ml-4">
    <div
      class="
        absolute
        w-3
        h-3
        rounded-full
        mt-1.5
        -left-1.5
        border border-layout-500
        bg-layout-500
        dark:border-layout-400 dark:bg-layout-400
      "
    ></div>
    <time
      class="
        mb-1
        text-base
        font-normal
        leading-none
        text-layout-500
        dark:text-layout-300
      "
    >
      <span v-if="date" v-html="date"></span>
      <span v-else><slot name="datepoint"></slot></span>
    </time>
    <h3 class="text-lg font-semibold text-layout-900 dark:text-white">
      {{ title }}
    </h3>
    <div
      class="mb-4 text-base font-normal text-layout-500 dark:text-layout-300"
    >
      <span v-if="description" v-html="description"></span>
      <span v-else><slot name="description"></slot></span>
    </div>
    <div v-if="hyperlinkOn">
      <a
        :href="hyperlinkUrl"
        :target="hyperlinkTarget"
        class="
          inline-flex
          items-center
          py-2
          px-4
          text-sm
          font-medium
          text-layout-900
          bg-white
          rounded-lg
          border border-layout-200
          hover:bg-layout-100 hover:text-sunprimary
          focus:z-10
          focus:ring-4
          focus:outline-none
          focus:ring-layout-200
          focus:text-sunprimary
          dark:bg-layout-800
          dark:text-layout-300
          dark:border-layout-600
          dark:hover:text-white
          dark:hover:bg-layout-700
          dark:focus:ring-layout-700
        "
        >{{ hyperlinkText }}
        <svg
          class="ml-2 w-3 h-3"
          fill="currentColor"
          viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          ></path></svg
      ></a>
    </div>
  </li>
</template>
<script>
export default {
  name: "TimelineItem",

  props: {
    date: {
      type: String,
      default: null,
    },
    title: {
      type: String,
      default: null,
    },
    description: {
      type: String,
      default: null,
    },
    hyperlinkOn: {
      type: Boolean,
      default: false,
    },
    hyperlinkUrl: {
      type: String,
      default: null,
    },
    hyperlinkTarget: {
      type: String,
      default: null,
    },
    hyperlinkText: {
      type: String,
      default: null,
    },
  },
};
</script>
