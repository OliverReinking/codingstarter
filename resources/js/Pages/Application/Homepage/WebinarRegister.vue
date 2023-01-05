<template>
  <homepage-layout header-title="Zum Webinar anmelden">
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

        <h2 class="mt-8 text-xl font-semibold">Webinar "{{ webinar.title }}"</h2>

        <form class="mt-4">
          <!-- Liste der Fehler -->
          <error-list :errors="errors" />

          <input-group class="mt-8 mb-4">
            <input-container>
              <input-label name="salutation_id" label="Anrede"></input-label>
              <input-select
                v-model="form.salutation_id"
                :options="salutations"
                ref="salutation_id"
              ></input-select>
              <input-error :message="errors.salutation_id" />
            </input-container>

            <input-container>
              <input-label name="first_name" label="Vorname"></input-label>
              <input-element
                type="text"
                name="first_name"
                v-model="form.first_name"
                placeholder="Gebe hier deinen Vornamen ein"
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
                ref="phone"
              ></input-element>
              <input-error :message="errors.phone" />
            </input-container>

            <input-container>
              <input-checkbox
                name="agreementPrivacy"
                v-model="form.agreementPrivacy"
              >
                Stimmst du unserer
                <b>Datenschutzerklärung für unsere Webinare</b>
                zu?</input-checkbox
              >
            </input-container>
          </input-group>

          <button-group class="mt-8" align="justify-start">
            <input-button type="button" @click.prevent="sendWebinarOrderData">
              Webinaranmeldung durchführen
            </input-button>
          </button-group>
        </form>
      </section>
      <section>
        <div
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
          <markdown :markdown="policy"></markdown>
        </div>
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

import Markdown from "@/Pages/Components/Content/Markdown.vue";

export default defineComponent({
  name: "Homepage_WebinarRegister",

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
    Markdown,
  },

  props: {
    errors: {
      type: Object,
      required: true,
    },
    webinar: {
      type: Object,
      required: true,
    },
    salutations: {
      type: Object,
      default: () => ({}),
    },
    policy: {
      type: String,
      required: true,
    },
  },

  data() {
    return {
      loading: false,
      loadingText: null,
      //
      form: {
        salutation_id: 3,
        first_name: null,
        last_name: null,
        email: null,
        phone: null,
        agreementPrivacy: false,
      },
    };
  },

  mounted() {
     this.$nextTick(() => {
      // This callback will only be called after the
      // DOM has been updated
      this.$refs.salutation_id.focus();
    });
  },

  methods: {
    sendWebinarOrderData() {
      this.loading = true;
      this.loadingText = "Die Daten werden jetzt verarbeitet!";
      //
      this.$inertia.post(
        this.route("home.webinar.order.send", this.webinar.id),
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
  },
});
</script>
