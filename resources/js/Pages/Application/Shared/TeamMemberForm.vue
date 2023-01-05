<template>
  <section-form>
    <template #title>Daten zum Teammitglied</template>
    <template #description
      >Hier kannst du die Daten des Teammitglieds ändern
      <!-- Loading -->
      <input-loading
        :loading="loading"
        :loading-text="loadingText"
      ></input-loading>
      <!-- ENDS Loading -->
      <!-- Alert -->
      <alert
        v-if="isAlert"
        class="mt-2"
        type="warning"
        title="Achtung!"
        :description="alertText"
      >
      </alert>
      <!-- ENDS Alert -->
    </template>

    <template #form>
      <!-- Liste der Fehler -->
      <error-list :errors="errors" />

      <input-subtitle>Name des Teammitglieds</input-subtitle>
      <input-group>
        <input-container>
          <input-label name="first_name" label="Vorname"></input-label>
          <input-element
            type="text"
            name="first_name"
            v-model="form.first_name"
            placeholder="Vorname"
            :required="true"
            ref="first_name"
          ></input-element>
          <input-error :message="errors.first_name" />
        </input-container>
        <input-container>
          <input-label name="last_name" label="Nachname"></input-label>
          <input-element
            type="text"
            name="last_name"
            v-model="form.last_name"
            placeholder="Nachname"
            :required="true"
            ref="last_name"
          ></input-element>
          <input-error :message="errors.last_name" />
        </input-container>
      </input-group>

    </template>
    <template #actions>
      <!-- Befehle -->
      <button-group>
        <input-danger-button
          type="button"
          @click.prevent="confirmTeammemberDeletion"
        >
          Teammitglied entfernen
        </input-danger-button>
        <smooth-scroll href="#app-layout-start">
          <input-button type="button" @click.prevent="updateTeammemberData">
            Daten speichern
          </input-button>
        </smooth-scroll>
      </button-group>
      <!-- ENDS Befehle -->
    </template>
  </section-form>

  <!-- Delete Teammember Confirmation Modal -->
  <dialog-modal
    :show="confirmingTeammemberDeletion"
    @close="close_confirmingTeammemberDeletion"
  >
    <template #title> Teammitglied entfernen </template>

    <template #content>
      Bist du sicher, dass du dieses Teammitglied entfernen möchtest?
    </template>

    <template #footer>
      <button-group>
        <input-button @click="close_confirmingTeammemberDeletion">
          Zurück
        </input-button>

        <input-danger-button @click="deleteTeammember">
          Teammitglied jetzt entfernen
        </input-danger-button>
      </button-group>
    </template>
  </dialog-modal>
</template>
<script>
import SmoothScroll from "@/Pages/Components/SmoothScroll.vue";

import SectionForm from "@/Pages/Components/Content/SectionForm.vue";
import SectionBorder from "@/Pages/Components/Content/SectionBorder.vue";

import ButtonGroup from "@/Pages/Components/Form/ButtonGroup.vue";
import InputButton from "@/Pages/Components/Form/InputButton.vue";
import InputDangerButton from "@/Pages/Components/Form/InputDangerButton.vue";

import ErrorList from "@/Pages/Components/Form/ErrorList.vue";
import InputSubtitle from "@/Pages/Components/Form/InputSubtitle.vue";
import InputGroup from "@/Pages/Components/Form/InputGroup.vue";
import InputContainer from "@/Pages/Components/Form/InputContainer.vue";
import InputLabel from "@/Pages/Components/Form/InputLabel.vue";
import InputElement from "@/Pages/Components/Form/InputElement.vue";
import InputSelect from "@/Pages/Components/Form/InputSelect.vue";
import InputError from "@/Pages/Components/Form/InputError.vue";

import InputLoading from "@/Pages/Components/Form/InputLoading.vue";
import Alert from "@/Pages/Components/Content/Alert.vue";

import DialogModal from "@/Pages/Components/DialogModal.vue";

export default {
  name: "Shared_InvitationForm",
  //
  components: {
    SmoothScroll,
    SectionForm,
    SectionBorder,
    ButtonGroup,
    InputButton,
    InputDangerButton,
    ErrorList,
    InputSubtitle,
    InputGroup,
    InputContainer,
    InputLabel,
    InputElement,
    InputSelect,
    InputError,
    InputLoading,
    Alert,
    DialogModal,
  },

  props: {
    teammember: {
      type: Object,
      default: () => ({}),
    },
    errors: {
      type: Object,
      default: () => ({}),
    },
    applicationName: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      loading: false,
      loadingText: null,
      //
      isAlert: false,
      alertText: null,
      //
      confirmingTeammemberDeletion: false,
      //
      form: {
        first_name: this.teammember.first_name,
        last_name: this.teammember.last_name,
      },
    };
  },

  methods: {
    updateTeammemberData() {
      let routeInvitationCreate = null;
      //
      if (this.applicationName == this.$page.props.applications.app_admin) {
        routeInvitationCreate = "admin.teammember.update";
      } else if (
        this.applicationName == this.$page.props.applications.app_employee
      ) {
        routeInvitationCreate = "employee.teammember.update";
      } else if (
        this.applicationName == this.$page.props.applications.app_customer
      ) {
        routeInvitationCreate = "customer.teammember.update";
      } else {
        this.alertText =
          "Die Daten des Teammitglieds konnten nicht gespeichert werden, da die Anwendung nicht eindeutig bestimmt werden konnte.";
        this.isAlert = true;
        return;
      }
      //
      this.loading = true;
      this.loadingText = "Die Daten des Teammitglieds werden jetzt gespeichert!";
      //
      this.$inertia.put(this.route(routeInvitationCreate, this.teammember.id), this.form, {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },

    confirmTeammemberDeletion() {
      this.confirmingTeammemberDeletion = true;
    },

    deleteTeammember() {
      //
      this.confirmingTeammemberDeletion = false;
      //
      let routeTeammemberRemove = null;
      //
      if (this.applicationName == this.$page.props.applications.app_admin) {
        routeTeammemberRemove = "admin.teammember.delete";
      } else if (
        this.applicationName == this.$page.props.applications.app_employee
      ) {
        routeTeammemberRemove = "employee.teammember.delete";
      } else if (
        this.applicationName == this.$page.props.applications.app_customer
      ) {
        routeTeammemberRemove = "customer.teammember.delete";
      } else {
        this.alertText =
          "Das Teammitglied konnte nicht entfernt werden, da die Anwendung nicht eindeutig bestimmt werden konnte.";
        this.isAlert = true;
        return;
      }
      //
      this.loading = true;
      this.loadingText = "Das Teammitglied wird entfernt!";
      //
      this.$inertia.delete(this.route(routeTeammemberRemove, this.teammember.id), {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },

    close_confirmingTeammemberDeletion() {
      this.confirmingTeammemberDeletion = false;
    },
  },
};
</script>
