<template>
  <!-- Alert -->
  <alert v-if="personCompany.is_deleted" class="mt-2" type="warning">
    <span class="font-medium">Achtung! </span>
    <span v-html="personCompany.delete_history"></span>
  </alert>

  <div
    class="grid gap-2 grid-cols-1 md:grid-cols-2"
    v-if="!personCompany.is_deleted"
  >
    <div v-if="personCompany.is_natural_person">
      <display-title>Kundenname</display-title>
      <display-row label="Anrede">
        <template #content>
          {{ personCompany.salutation.name }}
        </template>
      </display-row>
      <display-row label="Vorname">
        <template #content>
          {{ personCompany.contactperson_first_name }}
        </template>
      </display-row>
      <display-row label="Nachname">
        <template #content>
          {{ personCompany.contactperson_last_name }}
        </template>
      </display-row>

      <display-title>Kontaktdaten</display-title>
      <display-row label="Telefon">
        <template #content>
          {{ personCompany.contactperson_phone }}
        </template>
      </display-row>
      <display-row label="Mailadresse">
        <template #content>
          {{ personCompany.contactperson_email }}
        </template>
      </display-row>
      <display-title>Anwendungen</display-title>
      <display-row label="Gehört die Person zu einer Administration?">
        <template #content>
          <div v-if="personCompany.admin">Ja</div>
          <div v-else>Nein</div>
        </template>
      </display-row>
      <display-row label="Gehört die Person zu einem Unternehmen?">
        <template #content>
          <div v-if="personCompany.company">Ja</div>
          <div v-else>Nein</div>
        </template>
      </display-row>
      <display-row label="Ist die Person ein Kunde?">
        <template #content>
          <div v-if="personCompany.customer">Ja</div>
          <div v-else>Nein</div>
        </template>
      </display-row>
    </div>

    <div v-if="!personCompany.is_natural_person">
      <display-title>Unternehmensname, Anschrift und Mailadresse</display-title>
      <display-row label="Unternehmenssame">
        <template #content>
          {{ personCompany.name }}
        </template>
      </display-row>
      <display-row label="Adresse">
        <template #content>
          {{ personCompany.country.name }}
          <br />
          {{ personCompany.street }}
          <br />
          {{ personCompany.postcode }} {{ personCompany.city }}
        </template>
      </display-row>

      <display-title>Kontaktperson</display-title>
      <display-row label="Kontaktperson">
        <template #content>
          {{ personCompany.salutation.name }}
          <br />
          {{ personCompany.contactperson_first_name }}
          {{ personCompany.contactperson_last_name }}
          <br />
          Telefon: {{ personCompany.contactperson_phone }}
          <br />
          Mailadresse: {{ personCompany.contactperson_email }}
        </template>
      </display-row>
      <display-title>Anwendungen</display-title>
      <display-row label="Ist das Unternehmen eine Administration?">
        <template #content>
          <div v-if="personCompany.admin">Ja</div>
          <div v-else>Nein</div>
        </template>
      </display-row>
      <display-row label="Ist das Unternehmen ein Unternehmen?">
        <template #content>
          <div v-if="personCompany.company">Ja</div>
          <div v-else>Nein</div>
        </template>
      </display-row>
      <display-row label="Ist das Unternehmen ein Kunde?">
        <template #content>
          <div v-if="personCompany.customer">Ja</div>
          <div v-else>Nein</div>
        </template>
      </display-row>
    </div>

    <div>
      <display-title>Rechnungsadresse und Bankverbindung</display-title>
      <display-row label="Rechnungsadresse">
        <template #content>
          {{ personCompany.billing_address }}
          <br />
          {{ personCompany.billing_address_line_2 }}
          <br />
          {{ personCompany.billingcountry.name }}
          <br />
          {{ personCompany.billing_postcode }} {{ personCompany.billing_city }}
          <br />
          {{ personCompany.billing_street }}
          <br />
        </template>
      </display-row>
      <display-row label="Bankverbindung">
        <template #content>
          {{ personCompany.bankconnection_iban }}
        </template>
      </display-row>
      <display-row label="Kontoinhaber">
        <template #content>
          {{ personCompany.bankconnection_accountholder }}
        </template>
      </display-row>
    </div>
  </div>
</template>
<script>
import DisplayTitle from "@/Pages/Components/Content/DisplayTitle.vue";
import DisplayRow from "@/Pages/Components/Content/DisplayRow.vue";
import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";
import DisplayYesOrNo from "@/Pages/Components/Content/DisplayYesOrNo.vue";

import Alert from "@/Pages/Components/Content/Alert.vue";

export default {
  name: "Shared_PersonCompanyShow",

  components: {
    DisplayTitle,
    DisplayRow,
    DisplayDate,
    DisplayYesOrNo,
    Alert,
  },

  props: {
    personCompany: {
      type: Object,
      default: () => ({}),
    },
  },
};
</script>
