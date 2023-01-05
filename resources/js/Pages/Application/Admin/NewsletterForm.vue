<template>
  <admin-layout>
    <template #breadcrumb>
      <breadcrumb
        :application-name="$page.props.applications.app_admin"
        current="Ändere Newsletter"
        :breadcrumbs="{
          'Liste der Newsletter': route('admin.newsletter.index'),
        }"
      ></breadcrumb>
    </template>

    <section-form :full-width="true">
      <template #title>Newsletter-Daten</template>
      <template #description
        >Hier kannst du alle Daten des Newsletter ändern
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

        <input-group>
          <input-container>
            <input-label name="name" label="Name"></input-label>
            <input-element
              type="text"
              name="name"
              v-model="form.name"
              placeholder="Name"
              :required="true"
              ref="name"
            ></input-element>
            <input-error :message="errors.name" />
          </input-container>
          <input-container :full-width="true">
            <input-label
              name="content"
              label="Beschreibung des Newsletters"
            ></input-label>
            <input-html v-model.value="form.description"></input-html>
            <input-error :message="errors.description" />
          </input-container>
        </input-group>
      </template>
      <template #actions>
        <!-- Befehle -->
        <button-group>
          <input-danger-button
            type="button"
            @click.prevent="confirmNewsletterDeletion"
          >
            Newsletter löschen
          </input-danger-button>
          <smooth-scroll href="#app-layout-start">
            <input-button type="button" @click.prevent="updateNewsletterData">
              Newsletter ändern
            </input-button>
          </smooth-scroll>
        </button-group>
        <!-- ENDS Befehle -->
      </template>
    </section-form>

    <template v-if="newsletter_members">
      <section-border></section-border>
      <section-content :full-width="true">
        <template #title> Abonnenten des Newsletters </template>

        <template #description>
          Hier kannst du die Liste der Abonnenten für diesen Newsletter
          einsehen.
          <!-- Loading -->
          <input-loading
            :loading="loadingTwo"
            :loading-text="loadingTextTwo"
          ></input-loading>
          <!-- ENDS Loading -->
        </template>
        <template #content>
          <table class="np-dl-table">
            <thead class="np-dl-thead">
              <tr>
                <th class="np-dl-th-normal">Name</th>
                <th class="np-dl-th-normal">Mail</th>
                <th class="np-dl-th-normal">per Mail verifiziert?</th>
                <th class="np-dl-th-normal">UUID</th>
                <th class="np-dl-th-normal">abmelden</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="member in newsletter_members"
                :key="member.id"
                class="np-dl-tr"
              >
                <td class="np-dl-td-normal">
                  {{ member.name }}
                </td>
                <td class="np-dl-td-normal">
                  {{ member.email }}
                </td>
                <td class="np-dl-td-normal">
                  <div v-if="member.email_verified_at">
                    Ja, am
                    <display-date
                      :value="member.email_verified_at"
                      :time-on="false"
                    ></display-date>
                  </div>
                  <div v-else>Nein</div>
                </td>
                <td class="np-dl-td-normal">
                  {{ member.uuid }}
                </td>
                <td class="np-dl-td-normal">
                  <input-icon-button
                    @click.prevent="deleteNewsletterMember(member.id)"
                  >
                    <template #icon>
                      <icon-trash class="h-5 w-5 mr-2"></icon-trash>
                    </template>
                    abmelden
                  </input-icon-button>
                </td>
              </tr>
            </tbody>
          </table>
        </template>
      </section-content>
    </template>

    <!-- Delete Newsletter Confirmation Modal -->
    <dialog-modal
      :show="confirmingNewsletterDeletion"
      @close="close_confirmingNewsletterDeletion"
    >
      <template #title> Newsletter löschen </template>

      <template #content>
        Bist du sicher, dass du diesen Newsletter und all seine Abonennten
        löschen willst?
      </template>

      <template #footer>
        <button-group>
          <input-button @click="close_confirmingNewsletterDeletion">
            Zurück
          </input-button>

          <input-danger-button @click="deleteNewsletter">
            Newsletter jetzt löschen
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
import InputHtml from "@/Pages/Components/Form/InputHtml.vue";
import InputError from "@/Pages/Components/Form/InputError.vue";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

import DialogModal from "@/Pages/Components/DialogModal.vue";

import InputIconButton from "@/Pages/Components/Form/InputIconButton.vue";
import IconTrash from "@/Pages/Components/Icons/Trash.vue";

export default defineComponent({
  name: "Admin_NewsletterForm",

  components: {
    AdminLayout,
    Breadcrumb,
    SmoothScroll,
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
    InputHtml,
    InputError,
    DisplayDate,
    DialogModal,
    InputIconButton,
    IconTrash,
  },

  props: {
    newsletter: {
      type: Object,
      default: () => ({}),
    },
    newsletter_members: {
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
      loadingTwo: false,
      loadingTextTwo: null,
      //
      confirmingNewsletterDeletion: false,
      //
      form: {
        name: this.newsletter.name,
        description: this.newsletter.description,
      },
    };
  },

  methods: {
    confirmNewsletterDeletion() {
      this.confirmingNewsletterDeletion = true;
    },

    deleteNewsletter() {
      this.confirmingNewsletterDeletion = false;
      //
      this.loading = true;
      this.loadingText = "Der Newsletter wird gelöscht!";
      //
      this.$inertia.delete(
        this.route("admin.newsletter.delete", this.newsletter.id),
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

    close_confirmingNewsletterDeletion() {
      this.confirmingNewsletterDeletion = false;
    },

    updateNewsletterData() {
      this.loading = true;
      this.loadingText =
        "Die geänderten Daten des Newsletters werden jetzt gespeichert!";
      //
      this.$inertia.put(
        this.route("admin.newsletter.update", this.newsletter.id),
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

    deleteNewsletterMember(id) {
      this.loadingTwo = true;
      this.loadingTextTwo =
        "Der ausgewählte Abonnement wird vom Newsletter abgemeldet!";
      //
      this.$inertia.delete(this.route("admin.newsletter.member.delete", id), {
        onSuccess: () => {
          this.loadingTwo = false;
        },
        onError: () => {
          this.loadingTwo = false;
        },
      });
    },
  },
});
</script>

