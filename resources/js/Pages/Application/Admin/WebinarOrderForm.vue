<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Webinaranmeldung"
        :breadcrumbs="{
          'Übersicht Content': route('admin.content.index'),
          'Liste der Webinaranmeldungen': route('admin.webinarorder.index'),
          'Webinar': route('admin.webinar.edit', webinar_order.webinar.id),
        }"
      ></breadcrumb>
    </template>

    <section-form>
      <template #title>Webinaranmelde-Daten</template>
      <template #description
        >Hier kannst du die Webinaranmeldung löschen oder eine
        Anmeldebestätigung per Mail an den Webinar-Teilnehmer versenden
        <!-- Loading -->
        <input-loading
          :loading="loading"
          :loading-text="loadingText"
        ></input-loading>
        <!-- ENDS Loading -->
      </template>

      <template #form>
        <display-title>Anmeldedaten</display-title>
        <display-row label="Name, Mail und Telefon-Nr">
          <template #content>
            {{ webinar_order.first_name }} {{ webinar_order.last_name }}
            <br />
            {{ webinar_order.email }}
            <br />
            {{ webinar_order.phone }}
          </template>
        </display-row>

        <display-title>Historie</display-title>
        <display-row label="Was bisher geschah">
          <template #content>
            <div v-if="webinar_order.history">
              <span v-html="webinar_order.history"></span>
            </div>
            <div v-else>Bisher ist noch nichts geschehen</div>
          </template>
        </display-row>
      </template>

      <template #actions>
        <!-- Befehle -->
        <button-group>
          <input-danger-button
            type="button"
            @click.prevent="confirmWebinarOrderDeletion"
          >
            Webinaranmeldung löschen
          </input-danger-button>
          <smooth-scroll href="#app-layout-start">
            <input-button type="button" @click.prevent="sendMailRegistration">
              Anmeldebestätigung per Mail an den Webinar-Teilnehmer
            </input-button>
          </smooth-scroll>
        </button-group>
        <!-- ENDS Befehle -->
      </template>
    </section-form>

    <!-- Delete WebinarOrder Confirmation Modal -->
    <dialog-modal
      :show="confirmingWebinarOrderDeletion"
      @close="close_confirmingWebinarOrderDeletion"
    >
      <template #title> Webinaranmeldung löschen </template>

      <template #content>
        Bist du sicher, dass du diese Webinaranmeldung
        löschen willst?
      </template>

      <template #footer>
        <button-group>
          <input-button @click="close_confirmingWebinarOrderDeletion">
            Zurück
          </input-button>

          <input-danger-button @click="deleteWebinarOrder">
            Webinaranmeldung jetzt löschen
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

import DisplayTitle from "@/Pages/Components/Content/DisplayTitle.vue";
import DisplayRow from "@/Pages/Components/Content/DisplayRow.vue";

export default defineComponent({
  name: "Admin_WebinarOrderForm",

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
    DisplayTitle,
    DisplayRow
  },

  props: {
    webinar_order: {
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
      confirmingWebinarOrderDeletion: false,
    };
  },

  methods: {
    confirmWebinarOrderDeletion() {
      this.confirmingWebinarOrderDeletion = true;
    },

    deleteWebinarOrder() {
      this.confirmingWebinarOrderDeletion = false;
      //
      this.loading = true;
      this.loadingText = "Die Webinaranmeldung wird gelöscht!";
      //
      this.$inertia.delete(
        this.route("admin.webinarorder.delete", this.webinar_order.id),
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

    close_confirmingWebinarOrderDeletion() {
      this.confirmingWebinarOrderDeletion = false;
    },

    sendMailRegistration() {
      this.loading = true;
      this.loadingText =
        "Die Teilnahmebestätigung wird per Mail an den Webinar-Teilnehmer versendet.";
      //
      this.$inertia.put(
        this.route("admin.webinarorder.send.mail.registration.info", this.webinar_order.id),
        {},
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
  },
});
</script>
