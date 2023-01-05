<template>
  <select
    class="
      w-full
      p-2.5
      text-sm
      rounded-lg
      block
      borde
      text-layout-900
      bg-layout-50
      border-layout-300
      placeholder-layout-600
      focus:ring-sunprimary focus:border-sunprimary
      dark:bg-layout-700
      dark:text-white
      dark:border-layout-600
      dark:placeholder-layout-400
      dark:focus:ring-nightprimary
      dark:focus:border-nightprimary
    "
    :value="modelValue"
    @change="$emit('update:modelValue', $event.target.value)"
    ref="select"
  >
    <template v-if="sortedOptions.constructor.name === 'Array'">
      <option
        v-for="(option, key) in sortedOptions"
        :value="option[0]"
        :key="key"
        :selected="option[0] === modelValue"
      >
        {{ option[1] }}
      </option>
    </template>
    <template v-if="sortedOptions.constructor.name === 'Object'">
      <option
        v-for="(option, key) in sortedOptions"
        :value="key"
        :key="key"
        :selected="option === modelValue"
      >
        {{ option }}
      </option>
    </template>
  </select>
</template>
<script>
export default {
  name: "InputSelect",

  props: {
    modelValue: {
      type: [String, Number],
      default: "",
    },
    options: {
      type: [Array, Object],
      required: true,
    },
    sortColumn: {
      type: Number,
      default: 1,
    },
  },

  emits: ["update:modelValue"],

  computed: {
    sortedOptions() {
      if (this.options.constructor.name === "Object") {
        //console.log("InputSelect computed sortedOptions");
        //console.log("sortColumn:", this.sortColumn);
        //
        if (this.sortColumn == 1) {
          return Object.entries(this.options).sort(function (a, b) {
            //console.log("78: ", a[0], a[1], b[0], b[1]);
            if (a[1] < b[1]) {
              return -1;
            }
            if (a[1] > b[1]) {
              return 1;
            }
            return 0;
          });
        }
        //
        return Object.entries(this.options).sort(function (a, b) {
          //console.log("90: ", a[0], a[1], b[0], b[1]);
          if (Number(a[0]) < Number(b[0])) {
            //console.log("92 a kleiner b");
            return -1;
          }
          if (Number(a[0]) > Number(b[0])) {
            //console.log("96 a größer b");
            return 1;
          }
          //console.log("99 a gleich b");
          return 0;
        });
      }
      // Sonstige Fälle
      return this.options;
    },
  },

  methods: {
    focus() {
      this.$refs.select.focus();
    },
  },
};
</script>
