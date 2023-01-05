<template>
  <section-form>
    <template #title>Daten einer Person bzw. eines Unternehmens</template>
    <template #description
      >Hier kannst du alle Daten einer Person bzw. eines Unternehmens ändern
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

      <!-- Alert -->
      <alert v-if="personCompany.is_deleted" class="mt-2" type="warning">
        <span class="font-medium">Achtung! </span>
        <span v-html="personCompany.delete_history"></span>
      </alert>

      <div v-if="!personCompany.is_deleted">
        <input-subtitle>Daten</input-subtitle>
        <input-group>
          <input-container>
            <input-label name="name" label="Unternehmensname"></input-label>
            <input-element
              type="text"
              name="name"
              v-model="form.name"
              placeholder="Unternehmensname"
              :required="true"
              ref="name"
            ></input-element>
            <input-error :message="errors.name" />
          </input-container>
          <input-container>
            <input-label name="street" label="Straße"></input-label>
            <input-element
              type="text"
              name="street"
              v-model="form.street"
              placeholder="Straße"
              :required="true"
              ref="street"
            ></input-element>
            <input-error :message="errors.street" />
          </input-container>
          <input-container>
            <input-label name="country_id" label="Land"></input-label>
            <input-select
              v-model="form.country_id"
              :options="countries"
              ref="country_id"
            ></input-select>
            <input-error :message="errors.country_id" />
          </input-container>
          <input-container>
            <input-label name="postcode" label="Postleitzahl"></input-label>
            <input-element
              type="text"
              name="postcode"
              v-model="form.postcode"
              placeholder="Postleitzahl"
              :required="true"
              ref="postcode"
            ></input-element>
            <input-error :message="errors.postcode" />
          </input-container>
          <input-container>
            <input-label name="city" label="Stadt"></input-label>
            <input-element
              type="text"
              name="city"
              v-model="form.city"
              placeholder="Stadt"
              :required="true"
              ref="city"
            ></input-element>
            <input-error :message="errors.city" />
          </input-container>
        </input-group>

        <input-subtitle>Kontaktperson</input-subtitle>
        <input-group>
          <input-container>
            <input-label
              name="contactperson_salutation_id"
              label="Anrede"
            ></input-label>
            <input-select
              v-model="form.contactperson_salutation_id"
              :options="salutations"
              ref="contactperson_salutation_id"
            ></input-select>
            <input-error :message="errors.contactperson_salutation_id" />
          </input-container>
          <input-container>
            <input-label
              name="contactperson_first_name"
              label="Vorname"
            ></input-label>
            <input-element
              type="text"
              name="contactperson_first_name"
              v-model="form.contactperson_first_name"
              placeholder="Vorname"
              :required="true"
              ref="contactperson_first_name"
            ></input-element>
            <input-error :message="errors.contactperson_first_name" />
          </input-container>
          <input-container>
            <input-label
              name="contactperson_last_name"
              label="Nachname"
            ></input-label>
            <input-element
              type="text"
              name="contactperson_last_name"
              v-model="form.contactperson_last_name"
              placeholder="Nachname"
              :required="true"
              ref="contactperson_last_name"
            ></input-element>
            <input-error :message="errors.contactperson_last_name" />
          </input-container>
          <input-container>
            <input-label
              name="contactperson_phone"
              label="Telefon"
            ></input-label>
            <input-element
              type="text"
              name="contactperson_phone"
              v-model="form.contactperson_phone"
              placeholder="Telefon"
              :required="true"
              ref="contactperson_phone"
            ></input-element>
            <input-error :message="errors.contactperson_phone" />
          </input-container>
          <input-container>
            <input-label
              name="contactperson_email"
              label="Mailadresse"
            ></input-label>
            <input-element
              type="email"
              name="contactperson_email"
              v-model="form.contactperson_email"
              placeholder="Mailadresse"
              :required="true"
              ref="contactperson_email"
            ></input-element>
            <input-error :message="errors.contactperson_email" />
          </input-container>
        </input-group>

        <input-subtitle>Rechnungsanschrift</input-subtitle>
        <input-group>
          <input-container>
            <input-label
              name="billing_address"
              label="Unternehmen"
            ></input-label>
            <input-element
              type="text"
              name="billing_address"
              v-model="form.billing_address"
              placeholder="Unternehmen"
              :required="true"
              ref="billing_address"
            ></input-element>
            <input-error :message="errors.billing_address" />
          </input-container>
          <input-container>
            <input-label
              name="billing_address_line_2"
              label="Unternehmen - zweite Zeile"
            ></input-label>
            <input-element
              type="text"
              name="billing_address_line_2"
              v-model="form.billing_address_line_2"
              placeholder="Unternehmen - 2 Zeile"
              ref="billing_address_line_2"
            ></input-element>
            <input-error :message="errors.billing_address_line_2" />
          </input-container>
          <input-container>
            <input-label name="billing_street" label="Straße"></input-label>
            <input-element
              type="text"
              name="billing_street"
              v-model="form.billing_street"
              placeholder="Straße"
              :required="true"
              ref="billing_street"
            ></input-element>
            <input-error :message="errors.street" />
          </input-container>
          <input-container>
            <input-label name="billing_country_id" label="Land"></input-label>
            <input-select
              v-model="form.billing_country_id"
              :options="countries"
              ref="billing_country_id"
            ></input-select>
            <input-error :message="errors.billing_country_id" />
          </input-container>
          <input-container>
            <input-label
              name="billing_postcode"
              label="Postleitzahl"
            ></input-label>
            <input-element
              type="text"
              name="billing_postcode"
              v-model="form.billing_postcode"
              placeholder="Postleitzahl"
              :required="true"
              ref="billing_postcode"
            ></input-element>
            <input-error :message="errors.billing_postcode" />
          </input-container>
          <input-container>
            <input-label name="billing_city" label="Stadt"></input-label>
            <input-element
              type="text"
              name="billing_city"
              v-model="form.billing_city"
              placeholder="Stadt"
              :required="true"
              ref="billing_city"
            ></input-element>
            <input-error :message="errors.billing_city" />
          </input-container>
        </input-group>

        <input-subtitle>Bankverbindung</input-subtitle>
        <input-group>
          <input-container>
            <input-label
              name="bankconnection_iban"
              label="IBAN-Nr"
            ></input-label>
            <input-element
              type="text"
              name="bankconnection_iban"
              v-model="form.bankconnection_iban"
              placeholder="IBAN-Nr"
              :required="true"
              ref="bankconnection_iban"
            ></input-element>
            <input-error :message="errors.bankconnection_iban" />
          </input-container>
          <input-container>
            <input-label
              name="bankconnection_accountholder"
              label="Kontoinhaber"
            ></input-label>
            <input-element
              type="text"
              name="bankconnection_accountholder"
              v-model="form.bankconnection_accountholder"
              placeholder="Kontoinhaber"
              :required="true"
              ref="bankconnection_accountholder"
            ></input-element>
            <input-error :message="errors.bankconnection_accountholder" />
          </input-container>
        </input-group>

      </div>
    </template>
    <template #actions>
      <!-- Befehle -->
      <button-group v-if="!personCompany.is_deleted">
        <input-danger-button
          v-if="applicationName == $page.props.applications.app_admin"
          type="button"
          @click.prevent="confirmPersonCompanyDeletion"
        >
          Daten löschen
        </input-danger-button>
        <smooth-scroll href="#app-layout-start">
          <input-button type="button" @click.prevent="updatePersonCompanyData">
            Daten ändern
          </input-button>
        </smooth-scroll>
      </button-group>
      <!-- ENDS Befehle -->
    </template>
  </section-form>

  <!-- Delete PersonCompany Confirmation Modal -->
  <dialog-modal
    :show="confirmingPersonCompanyDeletion"
    @close="close_confirmingPersonCompanyDeletion"
  >
    <template #title> Person / Unternehmen löschen </template>

    <template #content>
      Bist du sicher, dass du diese Unternehmen löschen willst?
      <br />
      Alle Daten des Unternehmens werden gelöscht.
    </template>

    <template #footer>
      <button-group>
        <input-button @click.prevent="close_confirmingPersonCompanyDeletion">
          Zurück
        </input-button>

        <input-danger-button @click.prevent="deletePersonCompany">
          Person / Unternehmen jetzt löschen
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
import InputCheckbox from "@/Pages/Components/Form/InputCheckbox.vue";
import InputSelect from "@/Pages/Components/Form/InputSelect.vue";
import InputError from "@/Pages/Components/Form/InputError.vue";

import DialogModal from "@/Pages/Components/DialogModal.vue";

import InputLoading from "@/Pages/Components/Form/InputLoading.vue";
import Alert from "@/Pages/Components/Content/Alert.vue";

import OnlineHelpContainer from "@/Pages/Components/Content/OnlineHelpContainer.vue";
import OnlineHelpTitle from "@/Pages/Components/Content/OnlineHelpTitle.vue";
import OnlineHelpDescription from "@/Pages/Components/Content/OnlineHelpDescription.vue";

export default {
  name: "Shared_PersonCompanyForm",
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
    InputCheckbox,
    InputSelect,
    InputError,
    DialogModal,
    InputLoading,
    Alert,
    OnlineHelpContainer,
    OnlineHelpTitle,
    OnlineHelpDescription,
  },

  props: {
    personCompany: {
      type: Object,
      default: () => ({}),
    },
    countries: {
      type: Object,
      default: () => ({}),
    },
    salutations: {
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
      confirmingPersonCompanyDeletion: false,
      //
      isAlert: false,
      alertText: null,
      //
      form: {
        name: this.personCompany.name,
        street: this.personCompany.street,
        country_id: this.personCompany.country_id,
        postcode: this.personCompany.postcode,
        city: this.personCompany.city,
        //
        contactperson_salutation_id: this.personCompany.contactperson_salutation_id,
        contactperson_first_name: this.personCompany.contactperson_first_name,
        contactperson_last_name: this.personCompany.contactperson_last_name,
        contactperson_phone: this.personCompany.contactperson_phone,
        contactperson_email: this.personCompany.contactperson_email,
        //
        billing_address: this.personCompany.billing_address,
        billing_address_line_2: this.personCompany.billing_address_line_2,
        billing_street: this.personCompany.billing_street,
        billing_city: this.personCompany.billing_city,
        billing_postcode: this.personCompany.billing_postcode,
        billing_country_id: this.personCompany.billing_country_id,
        //
        bankconnection_iban: this.personCompany.bankconnection_iban,
        bankconnection_accountholder: this.personCompany.bankconnection_accountholder,
      },
    };
  },

  methods: {
    updatePersonCompanyData() {
      let routePersonCompanyUpdate = null;
      //
      if (this.applicationName == this.$page.props.applications.app_admin) {
        routePersonCompanyUpdate = "admin.person_company.update";
      } else if (
        this.applicationName == this.$page.props.applications.app_employee
      ) {
        routePersonCompanyUpdate = "employee.person_company.update";
      } else if (
        this.applicationName == this.$page.props.applications.app_customer
      ) {
        routePersonCompanyUpdate = "customer.person_company.update";
      } else {
        this.alertText =
          "Die Daten können nicht gespeichert werden, da die Anwendung nicht eindeutig bestimmt werden konnte.";
        this.isAlert = true;
        return;
      }
      //
      this.loading = true;
      this.loadingText =
        "Die geänderten Daten werden jetzt gespeichert!";
      //
      this.$inertia.put(
        this.route(routePersonCompanyUpdate, this.personCompany.id),
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

    confirmPersonCompanyDeletion() {
      this.confirmingPersonCompanyDeletion = true;
    },

    deletePersonCompany() {
      this.confirmingPersonCompanyDeletion = false;
      //
      this.loading = true;
      this.loadingText = "Die Person bzw. das Unternehmen wird gelöscht!";
      //
      this.$inertia.delete(
        this.route("admin.person_company.delete", this.personCompany.id),
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

    close_confirmingPersonCompanyDeletion() {
      this.confirmingPersonCompanyDeletion = false;
    },
  },
};
</script>
