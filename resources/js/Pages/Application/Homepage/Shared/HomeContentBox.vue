<template>
  <div
    class="
      px-4
      py-16
      mx-auto
      sm:max-w-xl
      md:max-w-full
      lg:max-w-screen-xl
      md:px-24
      lg:px-8 lg:py-20
    "
  >
    <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
      <div>
        <span
          v-if="!categoryRoute"
          class="
            inline-block
            px-3
            py-1
            mb-4
            text-xs
            font-semibold
            tracking-wider
            uppercase
            rounded-full
            border border-sunprimary
            text-on-sunprimary
            dark:border-nightprimary dark:text-on-nightprimary
          "
        >
          {{ category }}
        </span>
        <Link
          v-if="categoryRoute"
          :href="categoryRoute"
          class="
            inline-block
            px-3
            py-1
            mb-4
            text-xs
            font-semibold
            tracking-wider
            uppercase
            rounded-full
            border border-sunprimary
            text-on-sunprimary
            dark:border-nightprimary dark:text-on-nightprimary
            hover:bg-sunprimary-dark hover:text-on-sunprimary-dark
            dark:hover:bg-nightprimary-dark dark:hover:text-on-nightprimary-dark
          "
          >{{ category }}</Link
        >
      </div>
      <h2
        class="
          max-w-lg
          mb-6
          text-2xl
          font-bold font-title
          leading-none
          tracking-tight
          text-on-sunprimary
          dark:text-on-nightprimary
          sm:text-3xl
          md:mx-auto
        "
      >
        <span class="relative inline-block">
          <svg
            viewBox="0 0 52 24"
            fill="currentColor"
            class="
              absolute
              top-0
              left-0
              z-0
              hidden
              w-32
              -mt-8
              -ml-20
              text-sunprimary
              dark:text-nightprimary
              lg:w-32 lg:-ml-28 lg:-mt-10
              sm:block
            "
          >
            <defs>
              <pattern
                id="34f481be-159a-4846-821d-9ca19fb6bcc5-one"
                x="0"
                y="0"
                width=".135"
                height=".30"
              >
                <circle cx="1" cy="1" r=".7"></circle>
              </pattern>
            </defs>
            <rect
              fill="url(#34f481be-159a-4846-821d-9ca19fb6bcc5-one)"
              width="52"
              height="24"
            ></rect>
          </svg>
          <span class="relative" v-html="part_one"></span>
        </span>
        <span>
          <slot name="part_two" />
        </span>
      </h2>
    </div>
    <slot name="content" />
  </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  name: "Homepage_ContentBox",
  //
  components: {
    Link,
  },

  props: {
    category: {
      type: String,
      default: "",
    },
    categoryRoute: {
      type: String,
      default: "",
    },
    part_one: {
      type: String,
      default: "",
    },
  },
};
</script>
