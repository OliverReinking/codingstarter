<script setup>
import { onMounted, ref } from "vue";

defineProps({
  modelValue: String,
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute("autofocus")) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    ref="input"
    class="
      bg-layout-50
      border border-layout-300
      text-layout-900 text-sm
      rounded-lg
      focus:ring-sky-500 focus:border-sky-500
      block
      w-full
      p-2.5
      dark:bg-layout-700
      dark:border-layout-600
      dark:placeholder-layout-400
      dark:text-white
      dark:focus:ring-sky-500
      dark:focus:border-sky-500
    "
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
