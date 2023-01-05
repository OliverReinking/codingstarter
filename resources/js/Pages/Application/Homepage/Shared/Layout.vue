<template>
  <Head :title="headerTitle" />
  <div class="relative flex flex-col justify-start" :class="mode">
    <!-- Header -->
    <header
      class="
        w-full
        bg-white
        dark:bg-layout-900
        border-b border-layout-100
        dark:border-transparent
        px-2
        sm:px-4
      "
    >
      <nav class="container mx-auto px-2 lg:px-8 py-2.5 rounded">
        <div class="flex flex-wrap justify-between items-center mx-auto">
          <company-name
            :with-favicon="true"
            :with-link="true"
            :with-slogan="true"
            route-name="home"
          ></company-name>
          <div class="flex md:order-2 items-center">
            <button-register-now></button-register-now>
            <button
              type="button"
              class="
                inline-flex
                items-center
                p-2
                text-sm text-layout-500
                rounded-lg
                md:hidden
                hover:bg-layout-100
                focus:outline-none focus:ring-2 focus:ring-layout-200
                dark:text-layout-400
                dark:hover:bg-layout-700
                dark:focus:ring-layout-600
              "
              v-on:click="toggleNavbar()"
            >
              <span class="sr-only">Menü öffnen</span>
              <icon-menu class="w-6 h-6" v-if="!isOpen"></icon-menu>
              <icon-close class="w-6 h-6" v-if="isOpen"></icon-close>
            </button>
          </div>
          <div
            class="
              justify-start
              items-start
              w-full
              md:flex md:w-auto md:order-1
            "
            v-bind:class="{
              hidden: !isOpen,
              'min-h-screen block': isOpen,
            }"
          >
            <ul
              class="
                flex flex-col
                items-center
                mt-4
                md:flex-row
                md:flex-nowrap
                md:space-x-8
                md:mt-0
                md:text-sm
                md:font-medium
              "
            >
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <nav-link label="Startseite" route-name="home"></nav-link>
              </li>
              <li>
                <nav-link>
                  <div @click.prevent="cookieHasRemoved">
                    Cookie-Einstellungen
                  </div>
                </nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <nav-link label="Über uns" route-name="about"></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <nav-link
                  label="Unsere Mission"
                  route-name="mission"
                ></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <nav-link label="Blog" route-name="home.blog.index"></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <nav-link
                  label="Webinare"
                  route-name="home.webinar.index"
                ></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <nav-link label="Kontakt" route-name="contact"></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                  hidden: !isOpen,
                }"
              >
                <nav-link label="Login" route-name="login"></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                  hidden: !isOpen,
                }"
              >
                <nav-link
                  label="Registrierung"
                  route-name="register"
                ></nav-link>
              </li>
              <li
                v-bind:class="{
                  'w-full': isOpen,
                }"
              >
                <button-change-mode
                  :mode="mode"
                  @changeMode="changeMode"
                ></button-change-mode>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Content -->
    <section
      id="app-layout-start"
      class="
        text-layout-800
        dark:text-white
        bg-white
        dark:bg-layout-800
        w-full
        min-h-screen
        px-2
        sm:px-4
        pb-48
      "
    >
      <div class="container mx-auto px-2 lg:px-8 pt-2 lg:pt-8">
        <!-- Toast -->
        <toast></toast>
        <!-- CookieConsent inklusive slot für Content -->
        <div>
          <vue-cookie-accept-decline
            class="p-4 text-center cookie-container"
            :ref="'vcad_customer'"
            :elementId="'vcad_customer'"
            :debug="false"
            :position="'top-left'"
            :type="'bar'"
            :disableDecline="false"
            :transitionName="'slideFromBottom'"
            :showPostponeButton="true"
            @status="cookieStatus"
            @clicked-accept="cookieClickedAccept"
            @clicked-decline="cookieClickedDecline"
            @clicked-postpone="cookieClickedPostpone"
            @removed-cookie="cookieRemovedCookie"
          >
            <template #postponeContent>
              <div class="flex justify-end">
                <icon-close class="h-8 w-8 text-sunprimary" />
              </div>
            </template>

            <!-- Optional -->
            <template #message>
              <div class="my-8">
                Wir verwenden auf unserer Website Cookies.
                <br />
                Diese Cookies sind erforderlich, damit du diese Webseite nutzen
                kannst.
                <br />
                Die Cookie-Einwilligung kann jederzeit über den Link
                <b>Cookie-Einstellung</b> im Header angepasst werden.
              </div>
              <div class="mt-4 text-center">
                Weitere Informationen zum Thema
                <b>Cookies</b> findest Du in unserer
                <br />
                <a :href="route('privacy')" class="my-4 cookie-consent-link"
                  >Datenschutzerklärung</a
                >
              </div>
            </template>

            <!-- Optional -->
            <template #declineContent>
              <div class="btn-cookie-consent btn-cookie-consent-decline mr-2">
                Cookies ablehnen
              </div>
            </template>

            <!-- Optional -->
            <template #acceptContent>
              <div class="btn-cookie-consent btn-cookie-consent-accept mr-2">
                Cookies akzeptieren
              </div>
            </template>
          </vue-cookie-accept-decline>

          <div v-if="(cookieConsentStatus == 'accept') || !cookieConsentDisplay">
            <slot></slot>
          </div>
          <div v-else class="cookie-container">
            <div class="p-4">
              Diese Webseite kann nicht genutzt werden, da Du die Nutzung
              unserer Cookies nicht akzeptiert hast.
              <br />
              Du kannst die Cookie-Einstellungen ändern, wenn Du in der
              Kopfzeile auf den Link
              <b>Cookie-Einstellungen</b> klickst.
            </div>

            <div class="p-4">
              Oder Du klickst auf den folgenden Button:
              <br />
              <button
                @click.prevent="cookieHasRemoved"
                class="mt-2 btn-cookie-consent btn-cookie-consent-change"
              >
                Cookie-Einstellungen anpassen
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer
      class="
        fixed
        bottom-0
        left-0
        w-full
        bg-white
        dark:bg-layout-900
        border-t border-layout-100
        dark:border-transparent
        px-2
        sm:px-4
        py-2
      "
    >
      <div class="container mx-auto px-2 lg:px-8 pt-2">
        <div class="lg:flex lg:items-center lg:justify-between md:p-3">
          <ul
            class="
              lg:order-2
              flex flex-wrap flex-row
              items-center
              justify-around
              mt-3
              text-sm text-layout-500
              dark:text-layout-400
              sm:mt-0
            "
          >
            <li class="mr-2 md:mr-6 hidden md:block">
              <footer-link label="Über uns" route-name="about"></footer-link>
            </li>
            <li class="mr-2 md:mr-6 hidden md:block">
              <footer-link
                label="Blog"
                route-name="home.blog.index"
              ></footer-link>
            </li>
            <li class="mr-2 md:mr-6 hidden md:block">
              <footer-link
                label="Webinare"
                route-name="home.webinar.index"
              ></footer-link>
            </li>
            <li class="mr-2 md:mr-6">
              <footer-link label="Impressum" route-name="imprint"></footer-link>
            </li>
            <li class="mr-2 md:mr-6">
              <footer-link
                label="Datenschutzerklärung"
                route-name="privacy"
              ></footer-link>
            </li>
            <li class="mr-2 md:mr-6 hidden md:block">
              <footer-link label="Login" route-name="login"></footer-link>
            </li>
            <li class="mr-2 md:mr-6 hidden md:block">
              <footer-link
                label="Registrierung"
                route-name="register"
              ></footer-link>
            </li>
          </ul>
          <div
            class="
              lg:order-1
              text-xs
              md:text-sm
              text-layout-500
              dark:text-layout-400
              text-center
              lg:text-left
            "
          >
            © 2014 - {{ year }}
            <footer-link label="CodingStarter" route-name="home"></footer-link>.
            All Rights Reserved.
            <br />
            <span class="hidden sm:inline-block">
              Version: {{ $page.props.version.versionnr }} vom
              {{ $page.props.version.versionsdatum }}
            </span>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
<script>
// https://github.com/johndatserakis/vue-cookie-accept-decline
import VueCookieAcceptDecline from "vue-cookie-accept-decline";

import { ref } from "vue";

import { Head } from "@inertiajs/inertia-vue3";

import NavLink from "@/Pages/Application/Homepage/Shared/NavLink.vue";
import ButtonRegisterNow from "@/Pages/Application/Homepage/Shared/ButtonRegisterNow.vue";
import FooterLink from "@/Pages/Application/Homepage/Shared/FooterLink.vue";

import Favicon from "@/Pages/Components/Logo/Favicon.vue";
import IconNight from "@/Pages/Components/Icons/Night.vue";
import IconSun from "@/Pages/Components/Icons/Sun.vue";
import IconMenu from "@/Pages/Components/Icons/Menu.vue";
import IconClose from "@/Pages/Components/Icons/Close.vue";

import ButtonChangeMode from "@/Pages/Components/ButtonChangeMode.vue";

import Toast from "@/Pages/Components/Content/Toast.vue";

import CompanyName from "@/Pages/Components/Content/CompanyName.vue";

export default {
  name: "Homepage_Layout",

  components: {
    VueCookieAcceptDecline,
    Head,
    NavLink,
    ButtonRegisterNow,
    FooterLink,
    Favicon,
    IconNight,
    IconSun,
    IconMenu,
    IconClose,
    ButtonChangeMode,
    Toast,
    CompanyName,
  },

  props: {
    headerTitle: {
      type: String,
      default: "CodingStarter",
    },
    cookieConsentDisplay: {
      type: Boolean,
      default: true,
    },
  },

  setup(props) {
    const mode = ref();
    const isOpen = ref(false);
    const year = ref(new Date().getFullYear());
    const cookieConsentStatus = ref("unknown");
    const vcad_customer = ref(null);
    //
    if (localStorage.theme) {
      mode.value = localStorage.theme;
    }
    //
    function changeMode(value) {
      mode.value = value;
      //
      localStorage.theme = mode.value;
    }
    //
    function toggleNavbar() {
      this.isOpen = !this.isOpen;
    }
    //
    function cookieStatus(status) {
      //console.log("status: " + status);
      if (status) {
        cookieConsentStatus.value = status;
      }
    }
    //
    function cookieClickedAccept() {
      //console.log("here in accept");
      cookieConsentStatus.value = "accept";
    }
    //
    function cookieClickedDecline() {
      //console.log("here in decline");
      cookieConsentStatus.values = "decline";
    }
    //
    function cookieClickedPostpone() {
      //console.log("here in postpone");
      cookieConsentStatus.values = "postpone";
    }
    //
    function cookieRemovedCookie() {
      //console.log("here in cookieRemoved");
      vcad_customer.value.init();
    }
    //
    function cookieHasRemoved() {
      //console.log("App methods cookieHasRemoved");
      vcad_customer.value.removeCookie();
    }
    //
    return {
      mode,
      isOpen,
      year,
      cookieConsentStatus,
      vcad_customer,
      changeMode,
      toggleNavbar,
      cookieStatus,
      cookieClickedAccept,
      cookieClickedDecline,
      cookieClickedPostpone,
      cookieRemovedCookie,
      cookieHasRemoved,
    };
  },
};
</script>
