<template>
  <homepage-layout header-title="Bewerbung">
    <div class="">
      <section
        class="
          max-w-4xl
          p-6
          mx-auto
          text-layout-700
          dark:text-white
          bg-layout-50
          dark:bg-layout-700
          rounded-md
          shadow-md
        "
      >
        <!-- Loading -->
        <input-loading
          :loading="loading"
          :loading-text="loadingText"
        ></input-loading>
        <!-- ENDS Loading -->

        <h2 class="text-xl font-semibold">Bewerbungsformular</h2>

        <form class="mt-4">
          <!-- Liste der Fehler -->
          <error-list :errors="errors" />

          <input-subtitle>Name</input-subtitle>
          <input-group>
            <input-container>
              <input-label name="first_name" label="Vorname"></input-label>
              <input-element
                type="text"
                name="first_name"
                v-model="form.first_name"
                placeholder="Gebe hier deinen Vornamen ein"
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
                placeholder="Gebe hier deinen Nachnamen ein"
                :required="true"
                ref="last_name"
              ></input-element>
              <input-error :message="errors.last_name" />
            </input-container>
          </input-group>

          <input-subtitle>Kontakt</input-subtitle>
          <input-group>
            <input-container>
              <input-label name="email" label="Mailadresse"></input-label>
              <input-element
                type="email"
                name="email"
                v-model="form.email"
                placeholder="Gebe hier deine Mailadresse ein"
                :required="true"
                ref="email"
              ></input-element>
              <input-error :message="errors.email" />
            </input-container>
            <input-container>
              <input-label name="phone" label="Telefon-Nr"></input-label>
              <input-element
                type="text"
                name="phone"
                v-model="form.phone"
                placeholder="Gebe hier deine Telefon-Nr ein"
                :required="true"
                ref="phone"
              ></input-element>
              <input-error :message="errors.phone" />
            </input-container>
          </input-group>

          <input-subtitle>Persönliche Daten</input-subtitle>
          <input-group>
            <input-container>
              <input-label name="birthday" label="Geburtsdatum"></input-label>
              <input-element
                type="date"
                name="birthday"
                v-model="form.birthday"
                :required="false"
                ref="birthday"
              ></input-element>
              <input-error :message="errors.birthday" />
            </input-container>
            <input-container>
              <input-label name="gender" label="Geschlecht"></input-label>
              <input-select
                v-model="form.gender"
                :options="genders"
                ref="gender"
              ></input-select>
              <input-error :message="errors.gender" />
            </input-container>
            <input-container :full-width="true">
              <input-label name="continent" label="Kontinent"></input-label>
              <input-radio
                v-model="form.continent"
                :options="continents"
                :vertical="false"
              ></input-radio>
              <input-error :message="errors.continent" />
            </input-container>
          </input-group>

          <input-subtitle>Deine Sprachkenntnisse</input-subtitle>
          <input-group>
            <input-container>
              <input-checkbox name="german" v-model="form.languages.german">
                Kannst du Artikel in deutscher Sprache
                verfassen?</input-checkbox
              >
            </input-container>
            <input-container>
              <input-checkbox name="english" v-model="form.languages.english">
                Kannst du Artikel in englischer Sprache
                verfassen?</input-checkbox
              >
            </input-container>
            <input-container>
              <input-checkbox name="french" v-model="form.languages.french">
                Kannst du Artikel in französischer Sprache
                verfassen?</input-checkbox
              >
            </input-container>
            <input-container>
              <input-checkbox name="spanish" v-model="form.languages.spanish">
                Kannst du Artikel in spanischer Sprache
                verfassen?</input-checkbox
              >
            </input-container>
            <input-container :full-width="true">
              <input-error :message="errors.languages" />
            </input-container>
          </input-group>

          <input-subtitle>Dein Lebenslauf</input-subtitle>

          <input-group>
            <input-container :full-width="true">
              <input-file
                v-model="form.fileCurriculumVitae"
                :is-pdf="true"
                description-of-the-allowed-files="Erlaubt sind nur PDF-Dateien"
                @change="changeFile"
              ></input-file>
            </input-container>
          </input-group>

          <smooth-scroll href="#app-layout-start">
            <input-button type="button" @click.prevent="sendJobApplicationData">
              Bewerbungsdaten absenden
            </input-button>
          </smooth-scroll>
        </form>
      </section>
    </div>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";

import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import ErrorList from "@/Pages/Components/Form/ErrorList.vue";
import InputLoading from "@/Pages/Components/Form/InputLoading.vue";
import InputSubtitle from "@/Pages/Components/Form/InputSubtitle.vue";
import InputGroup from "@/Pages/Components/Form/InputGroup.vue";
import InputContainer from "@/Pages/Components/Form/InputContainer.vue";
import InputLabel from "@/Pages/Components/Form/InputLabel.vue";
import InputElement from "@/Pages/Components/Form/InputElement.vue";
import InputSelect from "@/Pages/Components/Form/InputSelect.vue";
import InputRadio from "@/Pages/Components/Form/InputRadio.vue";
import InputButton from "@/Pages/Components/Form/InputButton.vue";
import InputCheckbox from "@/Pages/Components/Form/InputCheckbox.vue";
import InputFile from "@/Pages/Components/Form/InputFile.vue";
import InputError from "@/Pages/Components/Form/InputError.vue";

import SmoothScroll from "@/Pages/Components/SmoothScroll.vue";

export default defineComponent({
  name: "Homepage_JobApplication",

  components: {
    HomepageLayout,
    ErrorList,
    InputLoading,
    InputSubtitle,
    InputGroup,
    InputContainer,
    InputLabel,
    InputElement,
    InputSelect,
    InputRadio,
    InputCheckbox,
    InputButton,
    InputFile,
    InputError,
    SmoothScroll,
  },

  props: {
    errors: Object,
  },

  data() {
    return {
      loading: false,
      loadingText: null,
      //
      form: {
        first_name: null,
        last_name: null,
        email: null,
        phone: null,
        birthday: null,
        gender: "female",
        continent: "Africa",
        languages: {
          german: false,
          english: false,
          french: false,
          spanish: false,
        },
        fileCurriculumVitae: null,
      },
      //
      fileCurriculumVitaeName: null,
      //
      genders: { female: "weiblich", male: "männlich", divers: "divers" },
      //
      continents: [
        { label: "Afrika", value: "Africa" },
        { label: "Antartkis", value: "Antarctica" },
        { label: "Asien", value: "Asia" },
        { label: "Australien/Ozeanien", value: "Australia/Oceania" },
        { label: "Europa", value: "Europe" },
        { label: "Nordamerika", value: "North America" },
        { label: "Südamerika", value: "South America" },
      ],
    };
  },

  mounted() {
     this.$nextTick(() => {
      // This callback will only be called after the
      // DOM has been updated
      this.$refs.first_name.focus();
    });
  },

  methods: {
    changeFile(e) {
      //console.log("methods changeFile: ", e);
      this.fileCurriculumVitaeName =
        "Du hast die folgende Datei ausgewählt: " + e.name;
    },

    sendJobApplicationData() {
      this.loading = true;
      this.loadingText =
        "Die Daten des Bewerbungsformulares werden jetzt verarbeitet!";
      //
      var data = new FormData();
      //
      data.append("first_name", this.form.first_name);
      data.append("last_name", this.form.last_name);
      data.append("email", this.form.email);
      data.append("phone", this.form.phone);
      data.append("birthday", this.form.birthday);
      data.append("gender", this.form.gender);
      data.append("continent", this.form.continent);
      //
      data.append("languages['german']", this.form.languages.german);
      data.append("languages['english']", this.form.languages.english);
      data.append("languages['french']", this.form.languages.french);
      data.append("languages['spanish']", this.form.languages.spanish);
      //
      data.append("fileCurriculumVitae", this.form.fileCurriculumVitae);
      //
      this.$inertia.post(this.route("home.job_application.send"), data, {
        onSuccess: () => {
          this.loading = false;
        },
        onError: () => {
          this.loading = false;
        },
      });
    },
  },
});
</script>
