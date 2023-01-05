<template>
  <homepage-layout header-title="Registrierung Teammitglied">
    <div class="">
      <section
        class="
          mt-8
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

        <h2 class="mt-8 text-xl font-semibold">Teammitglied werden</h2>

        <div>Mailadresse lautet: {{ email }}</div>

        <form class="mt-4">
          <!-- Liste der Fehler -->
          <error-list :errors="errors" />

          <input-subtitle class="mt-8 mb-4">Name</input-subtitle>
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

          <input-subtitle class="mt-8 mb-4">Kennwort</input-subtitle>
          <input-group>
            <input-container>
              <input-label name="password" label="Kennwort"></input-label>
              <input-element
                type="password"
                name="password"
                v-model="form.password"
                :required="true"
                ref="password"
              ></input-element>
              <input-error :message="errors.password" />
            </input-container>
            <input-container>
              <input-label
                name="password_confirmation"
                label="Kennwortbestätigung"
              ></input-label>
              <input-element
                type="password"
                name="password_confirmation"
                v-model="form.password_confirmation"
                :required="true"
                ref="password_confirmation"
              ></input-element>
              <input-error :message="errors.password_confirmation" />
            </input-container>
          </input-group>

          <button-group class="mt-8" align="justify-start">
            <input-button type="button" @click.prevent="registerUser">
              Teammitglied werden
            </input-button>
          </button-group>
        </form>
      </section>
    </div>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";

import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import ButtonGroup from "@/Pages/Components/Form/ButtonGroup.vue";
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
import InputTextarea from "@/Pages/Components/Form/InputTextarea.vue";
import InputError from "@/Pages/Components/Form/InputError.vue";

export default defineComponent({
  name: "Homepage_RegisterUser",

  components: {
    HomepageLayout,
    ButtonGroup,
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
    InputTextarea,
    InputError,
  },

  props: {
    slug: {
      Type: String,
      required: true,
    },
    first_name: {
      Type: String,
      default: null
    },
    last_name: {
      Type: String,
      default: null
    },
    email: {
      Type: String,
      required: true,
    },
    errors: Object,
  },

  data() {
    return {
      loading: false,
      loadingText: null,
      //
      form: {
        first_name: this.first_name,
        last_name: this.last_name,
        password: null,
        password_confirmation: null,
      },
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
    registerUser() {
      this.loading = true;
      this.loadingText = "Die Daten werden jetzt verarbeitet!";
      //
      this.$inertia.post(this.route("home.invitation.register", this.slug), this.form, {
        onSuccess: () => {
          this.loading = false;
          this.password = null;
          this.password_confirmation = null;
        },
        onError: () => {
          this.loading = false;
          this.password = null;
          this.password_confirmation = null;
        },
      });
    },
  },
});
</script>
