<template>
  <div>
    <div class="editor_menubar">
      <template v-for="(item, index) in items" :key="index">
        <div class="editor_menubar__divider" v-if="item.type === 'divider'" />
        <menu-item v-else v-bind="item" />
      </template>
    </div>

    <!-- Modales Fenster zur Eingabe des Links -->
    <Modal v-show="isDialogHyperlinkVisible" @close="closeDialogHyperlink">
      <template v-slot:header> Eingabe Link </template>
      <template v-slot:body>
        <form name="savelink" @submit.prevent="saveLink">
          <input-group>
            <input-container>
              <input-element
                type="url"
                name="Link"
                v-model="input_url"
                label="Link"
                placeholder="Link"
                validation="^url"
              />
            </input-container>
            <input-container>
              <input-button type="submit" class="text-center">
                <icon-done class="h-4 w-4 mr-2"></icon-done>
                <div>Link einfügen</div>
              </input-button>
            </input-container>
          </input-group>
        </form>
      </template>
    </Modal>
  </div>
</template>

<script>
import IconDone from "@/Pages/Components/Icons/Done.vue";
import MenuItem from "@/Pages/Components/Editor/MenuItem.vue";

import Modal from "@/Pages/Components/Editor/Modal.vue";

import InputGroup from "@/Pages/Components/Form/InputGroup.vue";
import InputContainer from "@/Pages/Components/Form/InputContainer.vue";
import InputElement from "@/Pages/Components/Form/InputElement.vue";

import InputButton from "@/Pages/Components/Form/InputButton.vue";
//
export default {
  components: {
    IconDone,
    MenuItem,
    Modal,
    InputGroup,
    InputContainer,
    InputElement,
    InputButton,
  },
  //
  props: {
    editor: {
      type: Object,
      required: true,
    },
  },
  //
  data() {
    return {
      isDialogHyperlinkVisible: false,
      //
      input_url: null,
      //
      items: [
        {
          icon: "bold",
          title: "Text fett machen",
          action: () => this.editor.chain().focus().toggleBold().run(),
          isActive: () => this.editor.isActive("bold"),
        },
        {
          icon: "italic",
          title: "Text kursiv machen",
          action: () => this.editor.chain().focus().toggleItalic().run(),
          isActive: () => this.editor.isActive("italic"),
        },
        {
          icon: "strike",
          title: "Text durchstreichen",
          action: () => this.editor.chain().focus().toggleStrike().run(),
          isActive: () => this.editor.isActive("strike"),
        },
        {
          type: "divider",
        },
        {
          icon: "link",
          title: "Link zum markierten Text hinzufügen",
          action: () => this.displayDialogHyperlink(),
          isActive: () => this.editor.isActive("link"),
        },
        {
          icon: "remove",
          title: "Link aus markiertem Text entfernen",
          action: () => this.editor.chain().focus().unsetLink().run(),
          isActive: () => this.editor.isActive("link"),
        },
        {
          type: "divider",
        },
        /* {
                    icon: "h1",
                    title: "Titel 1",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 1 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 1 })
                }, */
        {
          icon: "h2",
          title: "Titel 2",
          action: () =>
            this.editor.chain().focus().toggleHeading({ level: 2 }).run(),
          isActive: () => this.editor.isActive("heading", { level: 2 }),
        },
        {
          icon: "h3",
          title: "Titel 3",
          action: () =>
            this.editor.chain().focus().toggleHeading({ level: 3 }).run(),
          isActive: () => this.editor.isActive("heading", { level: 3 }),
        },
        {
          icon: "h4",
          title: "Titel 4",
          action: () =>
            this.editor.chain().focus().toggleHeading({ level: 4 }).run(),
          isActive: () => this.editor.isActive("heading", { level: 4 }),
        },
        /*  {
                    icon: "h5",
                    title: "Titel 5",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 5 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 5 })
                },
                {
                    icon: "h6",
                    title: "Titel 6",
                    action: () =>
                        this.editor
                            .chain()
                            .focus()
                            .toggleHeading({ level: 6 })
                            .run(),
                    isActive: () =>
                        this.editor.isActive("heading", { level: 6 })
                }, */
        {
          icon: "paragraph",
          title: "normale Zeile",
          action: () => this.editor.chain().focus().setParagraph().run(),
          isActive: () => this.editor.isActive("paragraph"),
        },
        {
          type: "divider",
        },
        {
          icon: "ul",
          title: "ungeordnete Liste",
          action: () => this.editor.chain().focus().toggleBulletList().run(),
          isActive: () => this.editor.isActive("bulletList"),
        },
        {
          icon: "ol",
          title: "numerierte Liste",
          action: () => this.editor.chain().focus().toggleOrderedList().run(),
          isActive: () => this.editor.isActive("orderedList"),
        },
        {
          type: "divider",
        },
        {
          icon: "hr",
          title: "Horizontale Linie",
          action: () => this.editor.chain().focus().setHorizontalRule().run(),
        },
        {
          type: "divider",
        },
        {
          icon: "undo",
          title: "Mache den letzten Befehl rückgängig",
          action: () => this.editor.chain().focus().undo().run(),
        },
        {
          icon: "redo",
          title: "Wiederhole den letzten Befehl rückgängig",
          action: () => this.editor.chain().focus().redo().run(),
        },
      ],
    };
  },
  //
  methods: {
    displayDialogHyperlink() {
      //console.log("displayDialogHyperlink:");
      this.isDialogHyperlinkVisible = true;
    },
    //
    closeDialogHyperlink() {
      this.isDialogHyperlinkVisible = false;
    },
    //
    saveLink() {
      //console.log("saveLink:", this.input_url);
      this.editor.chain().focus().setLink({ href: this.input_url }).run();
      this.input_url = null;
      this.isDialogHyperlinkVisible = false;
    },
  },
};
</script>
