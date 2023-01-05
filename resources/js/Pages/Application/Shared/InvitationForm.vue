<template>
  <section-form>
    <template #title>Daten zum Teammitglied</template>
    <template #description
      >Hier kannst du die Daten des Teammitglieds eingeben
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
        <input-container>
          <input-label name="email" label="Mailadresse"></input-label>
          <input-element
            type="email"
            name="email"
            v-model="form.email"
            placeholder="Mailadresse"
            :required="true"
            ref="email"
          ></input-element>
          <input-error :message="errors.email" />
        </input-container>
      </input-group>

      <template v-if="Object.keys(roles).length > 0">
        <input-subtitle>Rolle des Teammitglieds</input-subtitle>
        <input-group>
          <input-container>
            <input-label name="role" label="Rolle"></input-label>
            <input-select
              v-model="form.role"
              :options="roles"
              ref="role"
            ></input-select>
            <input-error :message="errors.role" />
          </input-container>
        </input-group>
      </template>
    </template>
    <template #actions>
      <!-- Befehle -->
      <button-group>
        <smooth-scroll href="#app-layout-start">
          <input-button type="button" @click.prevent="createInvitationData">
            Teammitglied einladen
          </input-button>
        </smooth-scroll>
      </button-group>
      <!-- ENDS Befehle -->
    </template>
  </section-form>
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
  },

  props: {
    invitation: {
      type: Object,
      default: () => ({}),
    },
    roles: {
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
      form: {
        first_name: null,
        last_name: null,
        email: null,
        role: null,
      },
    };
  },

  methods: {
    createInvitationData() {
      let routeInvitationCreate = null;
      //
      if (this.applicationName == this.$page.props.applications.app_admin) {
        routeInvitationCreate = "admin.teammember.store";
      } else if (
        this.applicationName == this.$page.props.applications.app_employee
      ) {
        routeInvitationCreate = "employee.teammember.store";
      } else if (
        this.applicationName == this.$page.props.applications.app_customer
      ) {
        routeInvitationCreate = "customer.teammember.store";
      } else {
        this.alertText =
          "Das Teammitglied konnte nicht eingeladen werden, da die Anwendung nicht eindeutig bestimmt werden konnte.";
        this.isAlert = true;
        return;
      }
      //
      this.loading = true;
      this.loadingText = "Die Einladungsdaten werden jetzt gespeichert!";
      //
      this.$inertia.post(this.route(routeInvitationCreate), this.form, {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },
  },
};
</script>
