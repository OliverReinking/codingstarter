<template>
  <textarea
    :id="name"
    :value="modelValue"
    :rows="rows"
    class="
      block
      p-2.5
      w-full
      text-sm text-layout-900
      bg-layout-50
      rounded-lg
      border border-layout-300
      focus:ring-blue-500 focus:border-blue-500
      dark:bg-layout-700
      dark:border-layout-600
      dark:placeholder-layout-400
      dark:text-white
      dark:focus:ring-blue-500
      dark:focus:border-blue-500
    "
    :placeholder="placeholder"
    @input="$emit('update:modelValue', $event.target.value)"
  ></textarea>
</template>
<script>
export default {
  name: "InputTextarea",
  //
  props: {
    name: {
      type: String,
      required: true,
    },
    modelValue: {
      type: [String, Number],
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    rows: {
      type: Number,
      default: 4,
    },
  },

  emits: ["update:modelValue"],
};
</script>
