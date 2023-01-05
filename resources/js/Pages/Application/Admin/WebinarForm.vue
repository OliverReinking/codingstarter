<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        :current="webinar.id > 0 ? 'Ändere Webinar' : 'Webinar erstellen'"
        :breadcrumbs="{
          'Übersicht Content': route('admin.content.index'),
          'Liste der Webinare': route('admin.webinar.index'),
        }"
      ></breadcrumb>
    </template>

    <section-form>
      <template #title>Webinar-Daten</template>
      <template #description
        >Hier kannst du alle Daten des Webinars ändern
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

        <input-element
          type="hidden"
          name="company_id"
          v-model="form.company_id"
          ref="company_id"
        ></input-element>

        <input-group>
          <input-container>
            <input-label name="title" label="Webinarname"></input-label>
            <input-element
              type="text"
              name="title"
              v-model="form.title"
              placeholder="Webinarname"
              :required="true"
              ref="title"
            ></input-element>
            <input-error :message="errors.title" />
          </input-container>
          <input-container>
            <input-label name="event_date" label="Webinardatum"></input-label>
            <input-element
              type="date"
              name="event_date"
              v-model="form.event_date"
              :required="true"
              ref="event_date"
            ></input-element>
            <input-error :message="errors.event_date" />
          </input-container>
          <input-container>
            <input-label
              name="event_start"
              label="Webinaruhrzeit"
              helptext="Bitte in der Form HH:MM eingeben. Also zum Beispiel 16:00"
            ></input-label>
            <input-element
              type="text"
              name="event_start"
              v-model="form.event_start"
              placeholder="Uhrzeit"
              :required="true"
              ref="event_start"
            ></input-element>
            <input-error :message="errors.event_start" />
          </input-container>
          <input-container>
            <input-label
              name="access"
              label="Link zum Webinarraum"
            ></input-label>
            <input-element
              type="url"
              name="access"
              v-model="form.access"
              placeholder="Link zum Webinarraum"
              :required="true"
              ref="access"
            ></input-element>
            <input-error :message="errors.access" />
          </input-container>

          <input-container :full-width="true">
            <input-label
              name="description"
              label="Webinarbeschreibung"
            ></input-label>
            <input-html v-model.value="form.description"></input-html>
            <input-error :message="errors.description" />
          </input-container>

          <input-container :full-width="true">
            <input-checkbox name="active" v-model="form.active">
              Soll das Webinar auf der Homepage verfügbar sein?</input-checkbox
            >
          </input-container>
        </input-group>

        <input-subtitle>Webinarbild</input-subtitle>
        <input-group>
          <input-container :full-width="true">
            <input-label
              name="webinar_image_id"
              label="Webinarbild"
            ></input-label>
            <div class="grid grid-cols-12 gap-4">
              <div
                v-for="image in webinar_images"
                :key="image.id"
                class="col-span-2"
              >
                <div
                  class="border-4 rounded-lg p-1 cursor-pointer"
                  :class="
                    image.id == form.webinar_image_id
                      ? 'border-sunprimary'
                      : 'border-transparent'
                  "
                  @click="selectWebinarImage(image.id)"
                >
                  <div class="">
                    <img :src="image.url" class="object-cover" />
                  </div>
                </div>
              </div>
            </div>
            <input-error :message="errors.webinar_image_id" />
          </input-container>
        </input-group>
      </template>

      <template #actions>
        <!-- Befehle -->
        <button-group>
          <input-danger-button
            v-if="webinar.id > 0"
            type="button"
            @click.prevent="confirmWebinarDeletion"
          >
            Webinar löschen
          </input-danger-button>
          <smooth-scroll href="#app-layout-start" v-if="webinar.id > 0">
            <input-button type="button" @click.prevent="updateWebinarData">
              Webinar ändern
            </input-button>
          </smooth-scroll>
          <smooth-scroll href="#app-layout-start" v-if="webinar.id == 0">
            <input-button type="button" @click.prevent="createWebinarData">
              Webinar erstellen
            </input-button>
          </smooth-scroll>
          <smooth-scroll href="#app-layout-start" v-if="webinar.id > 0">
            <input-button
              type="button"
              @click.prevent="sendReminderToParticipants"
              v-tippy
            >
              Erinnerungsmail an Teilnehmer versenden
            </input-button>
            <tippy>Diese Funktion funktioniert nur am Veranstaltungstag</tippy>
          </smooth-scroll>
        </button-group>
        <!-- ENDS Befehle -->
      </template>
    </section-form>

    <section-border></section-border>
    <section-content
      class="mb-6"
      :full-width="Object.keys(webinar_orders).length > 0 ? true : false"
    >
      <template #title> Anmeldungen für dieses Webinar </template>

      <template #description>
        Hier kannst du die Liste der Anmeldungen für dieses Webinar einsehen.
      </template>
      <template #content>
        <table
          class="np-dl-table"
          v-if="Object.keys(webinar_orders).length > 0"
        >
          <thead class="np-dl-thead">
            <tr>
              <th class="np-dl-th-normal">Name</th>
              <th class="np-dl-th-normal">Mail</th>
              <th class="np-dl-th-normal">Telefon-Nr</th>
              <th class="np-dl-th-normal"></th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="order in webinar_orders"
              :key="order.id"
              class="np-dl-tr"
            >
              <td class="np-dl-td-normal">
                {{ order.first_name }} {{ order.last_name }}
              </td>
              <td class="np-dl-td-normal">
                {{ order.email }}
              </td>
              <td class="np-dl-td-normal">
                {{ order.phone }}
              </td>
              <td class="np-dl-td-edit">
                <input-icon-hyperlink
                  :href="route('admin.webinarorder.edit', order.id)"
                >
                  <template #icon>
                    <icon-edit class="h-5 w-5"></icon-edit>
                  </template>
                </input-icon-hyperlink>
              </td>
            </tr>
          </tbody>
        </table>
        <alert type="info" v-if="Object.keys(webinar_orders).length == 0">
          Zur Zeit liegen für dieses Webinar keine Anmeldungen vor.
        </alert>
      </template>
    </section-content>

    <!-- Delete Webinar Confirmation Modal -->
    <dialog-modal
      :show="confirmingWebinarDeletion"
      @close="close_confirmingWebinarDeletion"
    >
      <template #title> Webinar löschen </template>

      <template #content>
        Bist du sicher, dass du dieses Webinar und alle Webinaranmeldungen
        löschen willst?
      </template>

      <template #footer>
        <button-group>
          <input-button @click="close_confirmingWebinarDeletion">
            Zurück
          </input-button>

          <input-danger-button @click="deleteWebinar">
            Webinar jetzt löschen
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

import SectionContent from "@/Pages/Components/Content/SectionContent.vue";
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

import InputIconHyperlink from "@/Pages/Components/Form/InputIconHyperlink.vue";
import IconEdit from "@/Pages/Components/Icons/Edit.vue";

export default defineComponent({
  name: "Admin_WebinarForm",

  components: {
    AdminLayout,
    Breadcrumb,
    SmoothScroll,
    PageTitle,
    SectionContent,
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
    InputIconHyperlink,
    IconEdit,
  },

  props: {
    webinar: {
      type: Object,
      default: () => ({}),
    },
    webinar_orders: {
      type: Object,
      default: () => ({}),
    },
    webinar_images: {
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
      confirmingWebinarDeletion: false,
      //
      form: {
        company_id: this.webinar.company_id,
        webinar_image_id: this.webinar.webinar_image_id,
        title: this.webinar.title,
        event_date: this.webinar.event_date,
        event_start: this.webinar.event_start,
        description: this.webinar.description,
        access: this.webinar.access,
        active: this.webinar.active,
      },
    };
  },

  methods: {
    confirmWebinarDeletion() {
      this.confirmingWebinarDeletion = true;
    },

    deleteWebinar() {
      this.confirmingWebinarDeletion = false;
      //
      this.loading = true;
      this.loadingText = "Das Webinar wird gelöscht!";
      //
      this.$inertia.delete(
        this.route("admin.webinar.delete", this.webinar.id),
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

    close_confirmingWebinarDeletion() {
      this.confirmingWebinarDeletion = false;
    },

    createWebinarData() {
      this.loading = true;
      this.loadingText = "Das neue Webinar wird gespeichert!";
      //
      this.$inertia.post(this.route("admin.webinar.store"), this.form, {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },

    updateWebinarData() {
      this.loading = true;
      this.loadingText =
        "Die geänderten Daten des Webinars werden jetzt gespeichert!";
      //
      this.$inertia.put(
        this.route("admin.webinar.update", this.webinar.id),
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

    sendReminderToParticipants() {
      this.loading = true;
      this.loadingText =
        "An jeden Teilnehmer wird eine Erinnerungsmail versendet.";
      //
      this.$inertia.put(this.route("admin.webinar.reminder", this.webinar.id), {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },

    selectWebinarImage(id) {
      this.form.webinar_image_id = id;
    },
  },
});
</script>
