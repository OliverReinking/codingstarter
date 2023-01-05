<template>
  <div
    class="
      flex
      items-center
      justify-betweeen
      rounded-lg
      border
      h-12
      text-layout-900
      bg-layout-50
      border-layout-500
      dark:text-layout-100 dark:bg-layout-900 dark:border-layout-700
    "
  >
    <div class="h-12 p-4 text-sm">
      {{ copyText }}
    </div>
    <div
      class="font-medium text-sm text-sunprimary dark:text-nightprimary"
    >
      <button
        type="submit"
        class="
          h-12
          cursor-pointer
          outline-none
          hover:rounded-r-lg
          hover:border-t
          hover:border-b
          hover:border-r
          hover:border-layout-500
          hover:bg-layout-200
          hover:font-extrabold
          dark:hover:font-extrabold
        "
        @click.prevent="copyToClipboard"
        v-tippy
      >
        <icon-clipboard-document class="mx-2 w-5 h-5">
        </icon-clipboard-document>
      </button>
      <tippy>{{ copyDescription }}</tippy>
    </div>
  </div>
</template>
<script>
import { defineComponent } from "vue";

import IconClipboardDocument from "@/Pages/Components/Icons/ClipboardDocument.vue";

export default defineComponent({
  name: "Component_CopyToClipboard",

  components: {
    IconClipboardDocument,
  },

  props: {
    copyText: {
      type: String,
      required: true,
    },
    copyDescription: {
      type: String,
      default: "Hier klicken, dann wird der Text in die Zwischenablage kopiert",
    },
  },

  methods: {
    copyToClipboard() {
      //console.log("copyToClipboard");
      // Copy the text inside the text field
      navigator.clipboard.writeText(this.copyText);
      //
      alert("Der Text wurde in die Zwischenablage kopiert.");
    },
  },
});
</script>
