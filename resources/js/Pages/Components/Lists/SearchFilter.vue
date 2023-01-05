<template>
  <div>
    <div class="relative">
      <div
        class="
          flex
          absolute
          inset-y-0
          left-0
          items-center
          pl-3
          pointer-events-none
        "
      >
        <icon-search class="block mr-3 h-5 w-5" />
      </div>
      <input
        type="text"
        id="default-search"
        class="
          block
          p-4
          pl-10
          w-full
          rounded-lg
          border
          text-sm text-layout-900
          bg-layout-50
          border-layout-300
          dark:text-layout-100
          dark:bg-layout-900
          dark:border-layout-700
          focus:ring-sunprimary focus:border-sunprimary
        "
        autocomplete="off"
        name="search"
        :placeholder="placeholder"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
      />
      <button
        type="submit"
        class="
          absolute
          right-2
          bottom-2
          font-medium
          rounded-lg
          text-sm
          px-4
          py-2
          cursor-pointer
          border-2
          focus:ring focus:outline-none
          bg-sunprimary-dark
          text-on-sunprimary-dark
          hover:text-sunprimary hover:bg-layout-100
          hover:border-sunprimary-dark
          focus:border-sunprimary-darker

          dark:bg-nightprimary-dark
          dark:text-on-nightprimary-dark
          dark:hover:text-nightprimary dark:hover:bg-layout-900
          dark:hover:border-nightprimary-dark
          dark:focus:border-nightprimary-darker

        "
        @click.prevent="$emit('reset')"
      >
        Suche zurücksetzen
      </button>
    </div>

    <div class="w-full mt-4">
      <div
        class="
          p-1
          text-sm
          my-2
          text-layout-600
          dark:text-layout-400
          text-left
          font-medium
          tracking-wide
        "
        v-if="searchText"
      >
        <span v-html="searchText"></span>
      </div>
    </div>
  </div>
</template>

<script>
import IconChevronDown from "@/Pages/Components/Icons/ChevronDown.vue";
import IconSearch from "@/Pages/Components/Icons/Search.vue";
//
export default {
  name: "SearchFilter",
  //
  emits: ["update:modelValue", "reset"],
  //
  components: {
    IconChevronDown,
    IconSearch,
  },
  //
  props: {
    modelValue: {
      type: String,
      default: null,
    },
    placeholder: {
      type: String,
      default: "Suchen",
    },
    searchText: {
      type: String,
    },
  },
};
</script>
