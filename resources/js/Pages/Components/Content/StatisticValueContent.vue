<template>
  <div class="p-4 flex items-center justify-start">
    <div v-if="withIcon" class="p-3 rounded-full mr-4" :class="classIcon">
      <component v-bind:is="icon" class="w-5 h-5" />
    </div>

    <div class="flex flex-col justify-center h-24">
      <div
        class="
          text-xs
          md:text-sm
          font-medium
          text-layout-800
          dark:text-layout-200
        "
      >
        {{ label }}
      </div>
      <div
        class="
          text-sm
          md:text-lg
          font-semibold
          text-layout-700
          dark:text-layout-300
        "
      >
        <span v-if="valueType == 'number'">
          <display-number
            :value="value"
            :after-digits="afterDigits"
            :value-unit="valueUnit"
          ></display-number>
        </span>
        <span v-else-if="valueType == 'date'">
          <display-date :value="value" :time-on="false"></display-date>
        </span>
        <span v-else-if="valueType == 'datetime'">
          <display-date :value="value" :time-on="true"></display-date>
        </span>
      </div>
    </div>
  </div>
</template>
<script>
import IconUsers from "@/Pages/Components/Icons/Users.vue";
import IconBuildingOffice from "@/Pages/Components/Icons/BuildingOffice.vue";

import DisplayNumber from "@/Pages/Components/Content/DisplayNumber.vue";
import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

export default {
  name: "Content_StatisticValueContent",
  //
  components: {
    IconUsers,
    IconBuildingOffice,
    DisplayNumber,
    DisplayDate,
  },
  //
  props: {
    withIcon: {
      type: Boolean,
      required: true,
    },
    icon: {
      type: String,
      default: null,
    },
    color: {
      type: String,
      default: "violet",
    },
    withLink: {
      type: Boolean,
      required: true,
    },
    routeName: {
      type: String,
      default: "",
    },
    label: {
      type: String,
      required: true,
    },
    valueType: {
      type: String,
      default: "number",
    },
    value: {
      type: [String, Number],
      required: true,
    },
    afterDigits: {
      type: Number,
      default: 0,
    },
    valueUnit: {
      type: String,
      default: "",
    },
    valueUnitClass: {
      type: String,
      default: "text-xs",
    },
  },

  computed: {
    classIcon: function () {
      if (this.color == "orange") {
        return "text-orange-500 dark:text-orange-500 bg-white dark:border-2 dark:border-orange-500 dark:bg-transparent";
      }
      if (this.color == "green") {
        return "text-green-500 dark:text-green-500 bg-white dark:border-2 dark:border-green-500 dark:bg-transparent";
      }
      //
      return "text-violet-500 dark:text-violet-500 bg-white dark:border-2 dark:border-violet-500 dark:bg-transparent";
    },
  },
};
</script>
