<template>
  <div
    class="
      bg-layout-100
      text-layout-800
      dark:text-white dark:bg-layout-800
      shadow-lg
      rounded-lg
      p-2
    "
  >
    <div class="relative w-full flex flex-col items-center justify-center">
      <div class="h-6 sm:h-8 w-6 sm:w-8 text-sunprimary dark:text-white">
        <slot name="icon"></slot>
      </div>

      <h1 class="mt-4 text-base sm:text-xl text-center font-semibold h-12">
        {{ title }}
      </h1>

      <div class="mt-2 text-xs sm:text-sm text-center h-32">
        <slot name="description"></slot>
      </div>
      <div class="w-full absolute bottom-0 left-0">
        <div
          class="flex items-center justify-center"
          :class="{ 'justify-between': buttonTwo }"
        >
          <div>
            <button
              class="
                mt-4
                px-4
                py-1
                font-medium
                text-sm
                tracking-wide
                transition-colors
                duration-200
                transform
                rounded-md
                border
                focus:outline-none
                border-black
                text-black
                hover:border-sunprimary hover:bg-layout-200
                focus:border-sunprimary-dark
                dark:border-white
                dark:text-white
                dark:hover:border-nightprimary
                dark:hover:bg-layout-600
                dark:focus:border-nightprimary-light
              "
            >
              <slot name="buttonOne"></slot>
            </button>
          </div>
          <div v-if="buttonTwo">
            <button
              class="
                mt-4
                px-4
                py-1
                font-medium
                text-sm
                tracking-wide
                transition-colors
                duration-200
                transform
                rounded-md
                border
                focus:outline-none
                border-black
                text-black
                hover:border-sunprimary hover:bg-layout-200
                focus:border-sunprimary-dark
                dark:border-white
                dark:text-white
                dark:hover:border-nightprimary
                dark:hover:bg-layout-600
                dark:focus:border-nightprimary-light
              "
            >
              <slot name="buttonTwo"></slot>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "NavigationCard",
  //
  props: {
    title: {
      type: String,
      required: true,
    },
    buttonTwo: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
