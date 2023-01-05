<template>
  <div
    class="px-4 my-4 rounded-lg shadow-lg overflow-y-auto overflow-x-hidden"
    :class="[active ? 'pb-4' : 'pb-0', bgHeaderColor, txtHeaderColor]"
  >
    <div
      class="p-2 flex justify-between items-center cursor-pointer"
      @click.prevent="changeActive()"
    >
      <div class="flex-1 flex items-center justify-between">
        <div class="flex-1 font-medium text-lg">
          <span v-if="title">{{ title }}</span>
          <span v-else><slot name="title"></slot></span>
        </div>
        <div v-if="count" class="mx-2 p-1">
          <div
            class="
              w-6
              h-6
              leading-6
              text-center text-xs
              bg-sunprimary
              text-on-sunprimary
              hover:bg-sunprimary-dark hover:text-on-sunprimary-dark
              dark:bg-nightprimary
              dark:text-on-nightprimary
              dark:hover:bg-nightprimary-dark
              dark:hover:text-on-nightprimary-dark
              rounded-full
            "
          >
            {{ count }}
          </div>
        </div>
      </div>
      <div v-show="active">
        <icon-expand-less class="w-6 h-6"></icon-expand-less>
      </div>
      <div v-show="!active">
        <icon-expand-more class="w-6 h-6"></icon-expand-more>
      </div>
    </div>
    <transition name="bounce">
      <div
        v-show="active"
        class="
          border
          rounded-md
          bg-white
          text-layout-900
          border-layout-200
          dark:bg-layout-900 dark:text-white dark:border-layout-700
        "
      >
        <div class="p-2">
          <slot name="content" />
        </div>
      </div>
    </transition>
  </div>
</template>
<script>
import IconExpandMore from "@/Pages/Components/Icons/ExpandMore.vue";
import IconExpandLess from "@/Pages/Components/Icons/ExpandLess.vue";
//
export default {
  name: "Accordion",
  //
  components: {
    IconExpandMore,
    IconExpandLess,
  },
  //
  props: {
    title: {
      type: String,
    },
    count: {
      type: Number,
    },
    isOpen: {
      type: Boolean,
      default: false,
    },
    txtHeaderIsOpen: {
      type: String,
      default: "text-layout-900 dark:text-layout-100",
    },
    bgHeaderIsOpen: {
      type: String,
      default: "bg-white dark:bg-layout-900",
    },
    txtHeaderIsNotOpen: {
      type: String,
      default: "text-layout-900 dark:text-layout-100",
    },
    bgHeaderIsNotOpen: {
      type: String,
      default: "bg-layout-300 dark:bg-layout-700",
    },
  },
  //
  data() {
    return {
      active: this.isOpen,
    };
  },
  //
  computed: {
    bgHeaderColor: function () {
      if (this.active) {
        return this.bgHeaderIsOpen;
      } else {
        return this.bgHeaderIsNotOpen;
      }
    },
    txtHeaderColor: function () {
      if (this.active) {
        return this.txtHeaderIsOpen;
      } else {
        return this.txtHeaderIsNotOpen;
      }
    },
  },
  //
  watch: {
    isOpen: function (newValue) {
      //console.log("Accordion watch isOpen");
      this.active = newValue;
    },
  },
  //
  methods: {
    changeActive() {
      this.active = !this.active;
      this.$emit("change-active", this.active);
    },
  },
};
</script>
<style scoped>
.bounce-enter-active {
  animation: bounce-in 0.3s;
}
.bounce-leave-active {
  animation: bounce-in 0.5s reverse;
}
@keyframes bounce-in {
  0% {
    transform: scale(0);
  }
  20% {
    transform: scale(1.05);
  }
  100% {
    transform: scale(1);
  }
}
</style>
