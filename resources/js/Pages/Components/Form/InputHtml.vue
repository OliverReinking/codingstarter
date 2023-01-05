<template>
  <div class="rounded-lg border border-layout-300 p-4 editor">
    <!-- Fehleranzeige -->
    <div v-if="error" v-html="error" class="editor__error"></div>

    <div class="editor__header" v-if="editor">
      <!-- normale Formatierungsbefehle -->
      <menu-bar v-if="menuBar" :editor="editor" />
    </div>

    <!-- Tabellen -->
    <div v-if="editor && tableOn" class="editor__header">
      <table-menu :editor="editor"></table-menu>
    </div>

    <div>
      <editor-content :editor="editor" />
    </div>
  </div>
</template>

<script>
import { Editor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";

import Table from "@tiptap/extension-table";
import TableRow from "@tiptap/extension-table-row";
import TableCell from "@tiptap/extension-table-cell";
import TableHeader from "@tiptap/extension-table-header";

import Link from "@tiptap/extension-link";

import Icon from "@/Pages/Components/Editor/Icon.vue";
import TableMenu from "@/Pages/Components/Editor/TableMenu.vue";
import MenuBar from "@/Pages/Components/Editor/MenuBar.vue";
import MenuItem from "@/Pages/Components/Editor/MenuItem.vue";

export default {
  components: {
    EditorContent,

    Icon,
    TableMenu,
    MenuBar,
    MenuItem,
  },

  props: {
    menuBar: {
      type: Boolean,
      default: true,
    },
    modelValue: {
      type: String,
      default: "",
    },
    error: {
      default: "",
      type: String,
    },
    tableOn: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      editor: null,
    };
  },

  watch: {
    modelValue(value) {
      const isSame = this.editor.getHTML() === value;

      if (isSame) {
        return;
      }

      this.editor.commands.setContent(value, false);
    },
  },

  mounted() {
    this.editor = new Editor({
      content: this.modelValue,
      extensions: [
        StarterKit,
        Table.configure({
          resizable: true,
        }),
        TableRow,
        TableHeader,
        TableCell,
        Link,
      ],
      editorProps: {
        attributes: {
          class:
            "prose prose-sm sm:prose lg:prose-lg xl:prose-2xl m-5 focus:outline-none dark:text-white",
        },
      },
      onUpdate: () => {
        this.$emit("update:modelValue", this.editor.getHTML());
      },
    });
  },

  beforeUnmount() {
    this.editor.destroy();
  },
};
</script>
