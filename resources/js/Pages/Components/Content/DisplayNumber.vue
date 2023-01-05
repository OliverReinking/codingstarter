<template>
  <span
    >{{ displaynumber }}
    <span v-if="valueUnit && value != null && value != undefined" :class="valueUnitClass">
      <span v-if="value == 1">{{ valueSingleUnit }}</span>
      <span v-else>{{ valueUnit }}</span>
    </span></span
  >
</template>
<script>
export default {
  name: "Content_Number",

  props: {
    value: {
      type: Number,
      default: null,
    },
    afterDigits: {
      type: Number,
      default: 2,
    },
    valueUnit: {
      type: String,
      default: "",
    },
    valueSingleUnit: {
      type: String,
      default: "",
    },
    valueUnitClass: {
      type: String,
      default: "",
    },
  },
  //
  computed: {
    displaynumber() {
      if (this.value == null || this.value == undefined ) {
        return "-";
      }
      var formatNumber = new Intl.NumberFormat("de-DE", {
        minimumFractionDigits: this.afterDigits,
      }).format(this.value);
      //
      //console.log("DisplayNumber: ", this.afterDigits, this.value, formatNumber);
      //
      return formatNumber;
    },
  },
};
</script>
