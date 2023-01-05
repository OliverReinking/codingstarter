<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        :current="blog.id > 0 ? 'Ändere Blogartikel' : 'Blogartikel erstellen'"
        :breadcrumbs="{
          'Übersicht Content': route('admin.content.index'),
          'Liste der Blogartikels': route('admin.blog.index'),
        }"
      ></breadcrumb>
    </template>

    <section-form>
      <template #title>Blogartikel-Daten</template>
      <template #description
        >Hier kannst du alle Daten des Blogartikels ändern
        <!-- Loading -->
        <input-loading
          :loading="loading"
          :loading-text="loadingText"
        ></input-loading>
        <!-- ENDS Loading -->
      </template>

      <template #form>
        <!-- Liste der Fehler -->
        <error-list :errors="errors" />

        <input-subtitle>Daten</input-subtitle>

        <input-group>
          <input-container>
            <input-label
              name="blog_date"
              label="Blogartikeldatum"
            ></input-label>
            <input-element
              type="date"
              name="blog_date"
              v-model="form.blog_date"
              :required="true"
              ref="blog_date"
            ></input-element>
            <input-error :message="errors.blog_date" />
          </input-container>

          <input-container>
            <input-label name="title" label="Titel"></input-label>
            <input-element
              type="text"
              name="title"
              v-model="form.title"
              placeholder="Titel"
              :required="true"
              ref="title"
            ></input-element>
            <input-error :message="errors.title" />
          </input-container>

          <input-container>
            <input-label name="blog_author_id" label="Kategorie"></input-label>
            <input-select
              v-model="form.blog_category_id"
              :options="blog_categories"
              ref="blog_category_id"
            ></input-select>
            <input-error :message="errors.blog_category_id" />
          </input-container>

          <input-container>
            <input-label name="blog_author_id" label="Autor"></input-label>
            <input-select
              v-model="form.blog_author_id"
              :options="blog_authors"
              ref="blog_author_id"
            ></input-select>
            <input-error :message="errors.blog_author_id" />
          </input-container>

          <input-container :full-width="true">
            <input-label name="summary" label="Zusammenfassung"></input-label>
            <input-html v-model.value="form.summary"></input-html>
            <input-error :message="errors.summary" />
          </input-container>

          <input-container :full-width="true">
            <input-checkbox name="markdown_on" v-model="form.markdown_on">
              Liegt der Artikel im Markdown-Format vor?</input-checkbox
            >
          </input-container>

          <input-container :full-width="true" v-if="form.markdown_on">
            <alert type="info">
              Bitte beachte, dass ein Blogartikel im Markdown-Format
              implementiert werden muss.
              <br />
              Weitere Infos hierzu von Oliver Reinking.
            </alert>
          </input-container>

          <input-container :full-width="true" v-if="!form.markdown_on">
            <input-label name="content" label="Artikelinhalt"></input-label>
            <input-html
              v-model.value="form.content"
              :table-on="false"
            ></input-html>
            <input-error :message="errors.content" />
          </input-container>

          <input-container>
            <input-label
              name="reading_time"
              label="Lesezeit in Minuten"
            ></input-label>
            <input-element
              type="number"
              name="reading_time"
              v-model="form.reading_time"
              placeholder="Lesezeit"
              :required="true"
              ref="reading_time"
            ></input-element>
            <input-error :message="errors.reading_time" /> </input-container
        ></input-group>

        <input-subtitle>Audio-Daten</input-subtitle>
        <input-group>
          <input-container :full-width="true">
            <input-checkbox name="audio_on" v-model="form.audio_on">
              Gibt es eine Audiodatei?</input-checkbox
            >
          </input-container>
          <input-container v-if="form.audio_on">
            <input-label name="audio_url" label="Audio-Dateiname"></input-label>
            <input-element
              type="text"
              name="audio_url"
              v-model="form.audio_url"
              placeholder="Dateiname"
              ref="audio_url"
            ></input-element>
            <input-error :message="errors.audio_url" />
          </input-container>
          <input-container v-if="form.audio_on">
            <input-label
              name="audio_duration"
              label="Audiodauer in Sekunden"
            ></input-label>
            <input-element
              type="number"
              name="audio_duration"
              v-model="form.audio_duration"
              placeholder="Audiodauer"
              ref="audio_duration"
            ></input-element>
            <input-error :message="errors.audio_duration" />
          </input-container>
        </input-group>

        <input-subtitle>Blogbild</input-subtitle>
        <input-group>
          <input-container :full-width="true">
            <input-label name="blog_image_id" label="Artikelbild"></input-label>
            <div class="grid grid-cols-12 gap-4">
              <div
                v-for="image in blog_images"
                :key="image.id"
                class="col-span-2"
              >
                <div
                  class="border-4 rounded-lg p-1 cursor-pointer"
                  :class="
                    image.id == form.blog_image_id
                      ? 'border-sunprimary'
                      : 'border-transparent'
                  "
                  @click="selectBlogImage(image.id)"
                >
                  <div class="">
                    <img :src="image.url" class="object-cover" />
                  </div>
                </div>
              </div>
            </div>
            <input-error :message="errors.blog_image_id" />
          </input-container>
        </input-group>
      </template>

      <template #actions>
        <!-- Befehle -->
        <button-group>
          <input-danger-button
            v-if="blog.id > 0"
            type="button"
            @click.prevent="confirmBlogDeletion"
          >
            Blogartikel löschen
          </input-danger-button>
          <smooth-scroll href="#app-layout-start" v-if="blog.id > 0">
            <input-button type="button" @click.prevent="updateBlogData">
              Blogartikel ändern
            </input-button>
          </smooth-scroll>
          <smooth-scroll href="#app-layout-start" v-if="blog.id == 0">
            <input-button type="button" @click.prevent="createBlogData">
              Blogartikel erstellen
            </input-button>
          </smooth-scroll>
        </button-group>
        <!-- ENDS Befehle -->
      </template>
    </section-form>

    <!-- Delete Blog Confirmation Modal -->
    <dialog-modal
      :show="confirmingBlogDeletion"
      @close="close_confirmingBlogDeletion"
    >
      <template #title> Blogartikel löschen </template>

      <template #content>
        Bist du sicher, dass du diesen Blogartikel löschen willst?
      </template>

      <template #footer>
        <button-group>
          <input-button @click="close_confirmingBlogDeletion">
            Zurück
          </input-button>

          <input-danger-button @click="deleteBlog">
            Blogartikel jetzt löschen
          </input-danger-button>
        </button-group>
      </template>
    </dialog-modal>
  </admin-layout>
</template>

<script>
import { defineComponent } from "vue";

import AdminLayout from "@/Pages/Application/Admin/Shared/Layout.vue";
import Breadcrumb from "@/Pages/Components/Breadcrumb.vue";

import SmoothScroll from "@/Pages/Components/SmoothScroll.vue";

import PageTitle from "@/Pages/Components/Content/PageTitle.vue";

import SectionForm from "@/Pages/Components/Content/SectionForm.vue";
import SectionBorder from "@/Pages/Components/Content/SectionBorder.vue";

import ButtonGroup from "@/Pages/Components/Form/ButtonGroup.vue";
import InputButton from "@/Pages/Components/Form/InputButton.vue";
import InputDangerButton from "@/Pages/Components/Form/InputDangerButton.vue";

import InputLoading from "@/Pages/Components/Form/InputLoading.vue";

import ErrorList from "@/Pages/Components/Form/ErrorList.vue";
import InputSubtitle from "@/Pages/Components/Form/InputSubtitle.vue";
import InputGroup from "@/Pages/Components/Form/InputGroup.vue";
import InputContainer from "@/Pages/Components/Form/InputContainer.vue";
import InputLabel from "@/Pages/Components/Form/InputLabel.vue";
import InputElement from "@/Pages/Components/Form/InputElement.vue";
import InputCheckbox from "@/Pages/Components/Form/InputCheckbox.vue";
import InputSelect from "@/Pages/Components/Form/InputSelect.vue";
import InputHtml from "@/Pages/Components/Form/InputHtml.vue";
import InputError from "@/Pages/Components/Form/InputError.vue";

import DialogModal from "@/Pages/Components/DialogModal.vue";

import Alert from "@/Pages/Components/Content/Alert.vue";

export default defineComponent({
  name: "Admin_BlogForm",

  components: {
    AdminLayout,
    Breadcrumb,
    SmoothScroll,
    PageTitle,
    SectionForm,
    SectionBorder,
    ButtonGroup,
    InputButton,
    InputDangerButton,
    InputLoading,
    ErrorList,
    InputSubtitle,
    InputGroup,
    InputContainer,
    InputLabel,
    InputElement,
    InputCheckbox,
    InputSelect,
    InputHtml,
    InputError,
    DialogModal,
    Alert,
  },

  props: {
    blog: {
      type: Object,
      default: () => ({}),
    },
    blog_authors: {
      type: Object,
      default: () => ({}),
    },
    blog_categories: {
      type: Object,
      default: () => ({}),
    },
    blog_images: {
      type: Object,
      default: () => ({}),
    },
    errors: {
      type: Object,
      default: () => ({}),
    },
  },

  data() {
    return {
      loading: false,
      loadingText: null,
      //
      confirmingBlogDeletion: false,
      //
      form: {
        blog_author_id: this.blog.blog_author_id,
        blog_category_id: this.blog.blog_category_id,
        markdown_on: this.blog.markdown_on,
        blog_image_id: this.blog.blog_image_id,
        blog_date: this.blog.blog_date,
        title: this.blog.title,
        summary: this.blog.summary,
        content: this.blog.content,
        reading_time: this.blog.reading_time,
        audio_on: this.blog.audio_on,
        audio_url: this.blog.audio_url,
        audio_duration: this.blog.audio_duration,
      },
    };
  },

  methods: {
    confirmBlogDeletion() {
      this.confirmingBlogDeletion = true;
    },

    deleteBlog() {
      this.confirmingBlogDeletion = false;
      //
      this.loading = true;
      this.loadingText = "Der Blogartikel wird gelöscht!";
      //
      this.$inertia.delete(this.route("admin.blog.delete", this.blog.id), {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },

    close_confirmingBlogDeletion() {
      this.confirmingBlogDeletion = false;
    },

    createBlogData() {
      this.loading = true;
      this.loadingText = "Der neue Blogarikel wird gespeichert!";
      //
      this.$inertia.post(this.route("admin.blog.store"), this.form, {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },

    updateBlogData() {
      this.loading = true;
      this.loadingText =
        "Die geänderten Daten des Blogartikels werden jetzt gespeichert!";
      //
      this.$inertia.put(
        this.route("admin.blog.update", this.blog.id),
        this.form,
        {
          onSuccess: () => {
            this.loading = false;
          },
          onError: () => {
            this.loading = false;
          },
        }
      );
    },

    selectBlogImage(id) {
      this.form.blog_image_id = id;
    },
  },
});
</script>
