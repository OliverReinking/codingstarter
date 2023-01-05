<template>
  <input-group v-if="fileName">
    <input-container :full-width="true">
      <alert type="info">
        <div class="flex items-center justify-between">
          <div>{{ fileName }}</div>
          <div>
            <input-button @click.prevent="removeFile">
              Datei entfernen
            </input-button>
          </div>
        </div>
      </alert>
    </input-container>
  </input-group>

  <DropZone
    class="drop-area"
    @files-dropped="addFile"
    #default="{ dropZoneActive }"
  >
    <div class="flex items-center justify-center w-full">
      <label
        for="dropzone-file"
        class="
          flex flex-col
          items-center
          justify-center
          w-full
          h-64
          border-2 border-gray-300 border-dashed
          rounded-lg
          cursor-pointer
          bg-gray-50
          dark:hover:bg-bray-800 dark:bg-gray-700
          hover:bg-gray-100
          dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600
        "
      >
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
          <svg
            aria-hidden="true"
            class="w-10 h-10 mb-3 text-gray-400"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
            ></path>
          </svg>

          <div v-if="dropZoneActive">
            <span class="font-semibold"
              >Dateien hier hinziehen um sie hinzuzufügen.</span
            >
          </div>

          <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">
            <span class="font-semibold"
              >Datei hier hinziehen oder klicke hier um die Datei zu
              importieren</span
            >
          </div>
          <div class="text-xs text-gray-500 dark:text-gray-400">
            <span v-html="descriptionOfTheAllowedFiles"></span>
          </div>
        </div>

        <input
          id="dropzone-file"
          type="file"
          :name="modelValue"
          class="hidden"
          :accept="acceptType"
          @change="handleFileUploads($event)"
        />
      </label>
    </div>
  </DropZone>
</template>
<script>
import DropZone from "@/Pages/Components/Form/DropZone.vue";

import InputButton from "@/Pages/Components/Form/InputButton.vue";

import InputGroup from "@/Pages/Components/Form/InputGroup.vue";
import InputContainer from "@/Pages/Components/Form/InputContainer.vue";

import Alert from "@/Pages/Components/Content/Alert.vue";

export default {
  name: "Form_InputFiles",

  components: {
    DropZone,
    InputButton,
    InputGroup,
    InputContainer,
    Alert
  },

  emits: ["change", "update:modelValue"],

  props: {
    modelValue: {
      type: File,
    },
    descriptionOfTheAllowedFiles: {
      type: String,
      required: true,
    },
    isImage: {
      type: Boolean,
      default: false,
    },
    isPdf: {
      type: Boolean,
      default: false,
    },
    isWord: {
      type: Boolean,
      default: false,
    },
    isExcel: {
      type: Boolean,
      default: false,
    },
    isVideo: {
      type: Boolean,
      default: false,
    },
    isAudio: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      fileName: null,
    }
  },

  computed: {
    acceptType() {
      if (this.isExcel) {
        return ".xlsx, .xls";
      } else if (this.isWord) {
        return ".doc, .docx";
      } else if (this.isImage) {
        return "image/*";
      } else if (this.isVideo) {
        return "video/*";
      } else if (this.isPdf) {
        return "application/pdf";
      } else if (this.isAudio) {
        return "audio/*";
      } else {
        return "*";
      }
    },
  },

  methods: {
     removeFile() {
      //console.log("InputFiles methods removeFile");
      this.fileName = null;
      this.$emit("change", null);
      this.$emit("update:modelValue", null);
    },

    addFile(event) {
      //console.log("InputFiles methods addFile:", event[0]);
      this.fileName = event[0].name;
      this.$emit("change", event[0]);
      this.$emit("update:modelValue", event[0]);
    },

    handleFileUploads(event) {
      //console.log("InputFiles methods handleFileUploads: ", event);
      this.fileName = event.target.files[0].name;
      this.$emit("change", event.target.files[0]);
      this.$emit("update:modelValue", event.target.files[0]);
    },
  },
};
</script>
