<template>
  <a
    :href="href"
    :target="target"
    class="
      inline-flex
      items-center
      px-4
      py-2
      rounded-md
      font-medium
      text-xs
      tracking-widest
      disabled:opacity-25
      transition
      cursor-pointer
      border-2
      focus:ring focus:outline-none
      border-green-500
      text-black
      hover:bg-layout-200 hover:border-green-600
      focus:border-green-600
      dark:border-green-500
      dark:text-white
      dark:hover:bg-layout-700
      dark:hover:border-green-400
      dark:focus:border-green-400
    "
  >
    <div class="flex items-center">
      <slot name="icon"></slot>
      <slot></slot>
    </div>
  </a>
</template>

<script>
export default {
  name: "Form_InputIconHyperlink",

  props: {
    href: {
      type: String,
      required: true
    },
    target: {
      type: String,
      default: ""
    },
  },
};
</script>
