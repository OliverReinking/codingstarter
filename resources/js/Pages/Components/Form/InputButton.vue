<template>
  <button
    :type="type"
    class="
      inline-flex
      items-center
      px-4
      py-2
      h-10
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
      dark:hover:text-layout-900
      dark:hover:bg-layout-200
      dark:hover:border-green-400
      dark:focus:border-green-400
    "
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: "Form_InputButton",

  props: {
    type: {
      type: String,
      default: "submit",
    },
  },
};
</script>
