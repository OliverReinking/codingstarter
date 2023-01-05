<template>
  <div v-if="editor" class="editor_menubar">
    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="
        editor
          .chain()
          .focus()
          .insertTable({
            rows: 3,
            cols: 3,
            withHeaderRow: true,
          })
          .run()
      "
    >
      <icon name="table" />
    </button>
    <tippy placement="bottom">Eine neue Tabelle einfügen</tippy>
    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().deleteTable().run()"
      :disabled="!editor.can().deleteTable()"
    >
      <icon name="delete_tables" />
    </button>
    <tippy placement="bottom">Tabelle löschen</tippy>

    <div class="editor_menubar__divider" />

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().addColumnBefore().run()"
      :disabled="!editor.can().addColumnBefore()"
    >
      <icon name="add_col_before" />
    </button>
    <tippy placement="bottom">Links eine neue Spalte hinzufügen</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().addColumnAfter().run()"
      :disabled="!editor.can().addColumnAfter()"
    >
      <icon name="add_col_after" />
    </button>
    <tippy placement="bottom">Rechts eine neue Spalte hinzufügen</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().deleteColumn().run()"
      :disabled="!editor.can().deleteColumn()"
    >
      <icon name="delete_cols" />
    </button>
    <tippy placement="bottom">Spalte löschen</tippy>

    <div class="editor_menubar__divider" />

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().addRowBefore().run()"
      :disabled="!editor.can().addRowBefore()"
    >
      <icon name="add_row_before" />
    </button>
    <tippy placement="bottom">Oben eine neue Zeile hinzufügen</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().addRowAfter().run()"
      :disabled="!editor.can().addRowAfter()"
    >
      <icon name="add_row_after" />
    </button>
    <tippy placement="bottom">Unten eine neue Zeile hinzufügen</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().deleteRow().run()"
      :disabled="!editor.can().deleteRow()"
    >
      <icon name="delete_rows" />
    </button>
    <tippy placement="bottom">Zeile löschen</tippy>

    <div class="editor_menubar__divider" />

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().toggleHeaderColumn().run()"
      :disabled="!editor.can().toggleHeaderColumn()"
    >
      <icon name="highlighted_col" />
    </button>
    <tippy placement="bottom">Spalte Überschrift oder Normal</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().toggleHeaderRow().run()"
      :disabled="!editor.can().toggleHeaderRow()"
    >
      <icon name="highlighted_row" />
    </button>
    <tippy placement="bottom">Zeile Überschrift oder Normal</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().toggleHeaderCell().run()"
      :disabled="!editor.can().toggleHeaderCell()"
    >
      <icon name="highlighted_cell" />
    </button>
    <tippy placement="bottom">Zelle Überschrift oder Normal</tippy>

    <div class="editor_menubar__divider" />
    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().mergeOrSplit().run()"
      :disabled="!editor.can().mergeOrSplit()"
    >
      <icon name="combine_cells" />
    </button>
    <tippy placement="bottom">Verbinden bzw. splitten</tippy>

    <div class="editor_menubar__divider" />
    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().goToPreviousCell().run()"
      :disabled="!editor.can().goToPreviousCell()"
    >
      <icon name="arrow_left" />
    </button>
    <tippy placement="bottom">Zurück</tippy>

    <button
      class="editor_menubar__button"
      v-tippy
      @click.prevent="editor.chain().focus().goToNextCell().run()"
      :disabled="!editor.can().goToNextCell()"
    >
      <icon name="arrow_right" />
    </button>
    <tippy placement="bottom">Vor</tippy>
  </div>
</template>
<script>
import Icon from "@/Pages/Components/Editor/Icon.vue";
//
export default {
  components: {
    Icon,
  },
  //
  props: {
    editor: {
      type: Object,
      required: true,
    },
  },
};
</script>
