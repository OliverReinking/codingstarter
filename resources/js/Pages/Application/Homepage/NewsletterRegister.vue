<template>
  <homepage-layout header-title="Newsletter abonnieren">
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

        <h2 class="mt-8 text-xl font-semibold">
          Newsletter {{ newsletter.name }}
        </h2>

        <form class="mt-4">
          <!-- Liste der Fehler -->
          <error-list :errors="errors" />

          <input-group>
            <input-container>
              <input-label name="name" label="Name"></input-label>
              <input-element
                type="text"
                name="name"
                v-model="form.name"
                placeholder="Gebe hier deinen Namen ein"
                ref="name"
              ></input-element>
              <input-error :message="errors.name" />
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
              <input-checkbox
                name="agreementPrivacy"
                v-model="form.agreementPrivacy"
              >
                Stimmst du unserer
                <b>Datenschutzerklärung für unsere Newsletter</b>
                zu?</input-checkbox
              >
            </input-container>
          </input-group>

          <button-group align="justify-start">
            <input-button type="button" @click.prevent="sendNewsletterData">
              Newsletter jetzt bestellen
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
  name: "Homepage_NewsletterRegister",

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
    newsletter: {
      type: Object,
      required: true,
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
        name: null,
        email: null,
        agreementPrivacy: false,
      },
    };
  },

  mounted() {
    this.$nextTick(() => {
      // This callback will only be called after the
      // DOM has been updated
      this.$refs.name.focus();
    });
  },

  methods: {
    sendNewsletterData() {
      this.loading = true;
      this.loadingText = "Die Daten werden jetzt verarbeitet!";
      //
      this.$inertia.post(
        this.route("home.newsletter.send", this.newsletter.id),
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
