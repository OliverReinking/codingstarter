<template>
  <input
    :value="modelValue"
    :id="name"
    class="
      w-full
      p-2.5
      text-sm
      rounded-lg
      block
      border

      text-layout-900
      bg-layout-50
      border-layout-300
      placeholder-layout-600
      autofill:bg-layout-600
      focus:ring-sunprimary
      focus:border-sunprimary

      dark:text-white
      dark:bg-layout-700
      dark:border-layout-600
      dark:placeholder-layout-400
      dark:autofill-layout-700
      dark:focus:ring-nightprimary
      dark:focus:border-nightprimary

    "
    :placeholder="placeholder"
    :required="required"
    @input="$emit('update:modelValue', $event.target.value)"
    ref="input"
  />
</template>
<script>
export default {
  name: "Form_InputElement",

  props: {
    name: {
      type: String,
      required: true,
    },
    modelValue: {
      type: [Number, String],
      default: "",
    },
    placeholder: {
      type: String,
      default: "",
    },
    required: {
      type: Boolean,
      default: false,
    },
  },

  emits: ["update:modelValue"],

  methods: {
    focus() {
      this.$refs.input.focus();
    },
  },
};
</script>
