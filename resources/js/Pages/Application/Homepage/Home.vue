<template>
  <homepage-layout header-title="Home">
    <div class="px-4 py-6 mx-auto md:px-24 lg:px-8 lg:py-12">
      <div class="sm:p-16">
        <div class="flex flex-col lg:flex-row">
          <div class="mb-6 lg:mb-0 lg:w-1/2 lg:pr-5">
            <h2
              class="
                font-logo
                text-3xl
                font-bold
                tracking-tight
                sm:text-4xl sm:leading-none
              "
            >
              "CodingStarter ist der perfekte Start in die Laravel-Welt"
            </h2>
          </div>
          <div class="lg:w-1/2">
            <div class="mb-4 font-bold text-2xl">Laravel</div>
            <div class="mb-4 text-base">
              Laravel ist ein Open-Source-PHP-Web-Entwicklungs-Framework, das
              von Taylor Otwell entwickelt wurde. Es ist dafür bekannt, dass es
              die Entwicklung von Web-Anwendungen vereinfacht und beschleunigt,
              indem es eine Vielzahl von Funktionen und Tools bereitstellt, die
              für die Entwicklung von professionellen Anwendungen benötigt
              werden. Laravel ist ein sehr beliebtes Framework und wird von
              vielen Entwicklern weltweit verwendet, um schnell und effizient
              Anwendungen zu erstellen. Es bietet zahlreiche Funktionen und
              Tools, darunter:
            </div>
            <ul class="my-2 list-inside list-disc">
              <li>
                Eine intuitive und leistungsstarke ORM (Object-Relational
                Mapping) zur Verwaltung von Datenbanken
              </li>
              <li>
                Ein robustes Templatesystem zur Erstellung von
                Benutzeroberflächen
              </li>
              <li>
                Eine Vielzahl von integrierten Tools zur Erleichterung der
                Entwicklung, wie z.B. Routenverwaltung, Middleware, Jobs und
                Events
              </li>
              <li>
                Eine umfassende Dokumentation und eine aktive
                Entwicklergemeinschaft, die bei der Lösung von Problemen und der
                Verbesserung des Frameworks hilft.
              </li>
            </ul>
            <div class="mb-4 text-base">
              Insgesamt ist Laravel ein mächtiges und leistungsfähiges
              Framework, das vielen Entwicklern dabei hilft, professionelle
              Web-Anwendungen schnell und effizient zu entwickeln.
            </div>
            <div class="mb-4 font-bold text-2xl">CodingStarter</div>
            <div class="mb-4 text-base">
              Der CodingStarter ist für viele Web-Anwendungen ein idealer
              Startpunkt.
            </div>
            <ul class="my-2 list-inside list-disc">
              <li>
                der CodingStarter besteht aus vier Anwendungen
                <ul class="pl-6 my-2 list-inside list-disc">
                  <li>einer Webseite</li>
                  <li>eine Anwendung für Administratoren</li>
                  <li>eine Anwendung für Mitarbeiter eines Unternehmens</li>
                  <li>eine Anwendung für Kunden eines Unternehmens</li>
                </ul>
              </li>
              <li>
                der Codingstarter enthält folgende Content-Komponenten
                <ul class="pl-6 my-2 list-inside list-disc">
                  <li>Blog</li>
                  <li>Webinare</li>
                  <li>Newsletter</li>
                </ul>
              </li>
              <li>
                der CodingStarter besitzt eine Vielzahl von Vue-Komponenten, die
                wiederverwendet können.
              </li>
            </ul>
            <Link
              :href="route('home.newsletter.register', 1)"
              class="
                mt-8
                inline-flex
                items-center
                px-4
                py-2
                h-10
                rounded-md
                font-medium
                text-xs
                tracking-widest
                disabled:opacity-25
                transition
                cursor-pointer
                border-2
                focus:ring focus:outline-none
                border-sunprimary
                text-on-sunprimary
                hover:bg-layout-200 hover:border-sunprimary
                focus:border-sunprimary
                dark:border-nightprimary
                dark:text-on-nightprimary
                dark:hover:text-on-nightprimary-dark
                dark:hover:border-nightprimary
                dark:focus:border-nightprimary
              "
            >
              Jetzt unseren Laravel-Newsletter abonnieren!
            </Link>
          </div>
        </div>
      </div>
    </div>

    <home-content-box category="Codingstarter" part_one="Unser Start">
      <template #part_two>
        in die Entwicklung von
        <span class="text-sunprimary dark:text-nightprimary"
          >Web-Anwendungen</span
        >.
      </template>
      <template #content>
        <div
          class="
            grid
            gap-8
            row-gap-5
            mb-8
            md:row-gap-8
            lg:grid-cols-4
            sm:grid-cols-2
          "
        >
          <div
            class="
              duration-300
              transform
              bg-layout-100
              dark:bg-layout-900
              border-l-4 border-sunprimary
              dark:border-nightprimary
              hover:-translate-y-2
            "
          >
            <div class="h-full p-5 border border-l-0 rounded-r shadow-sm">
              <h6 class="mb-2 font-semibold leading-5">Laravel 9</h6>
              <p class="text-sm">
                nutzt das Laravel-Framework in der Version 9.
                <br />
                <a href="https://laravel.com/" class="underline" target="_blank"
                  >https://laravel.com/</a
                >
              </p>
            </div>
          </div>
          <div
            class="
              duration-300
              transform
              bg-layout-100
              dark:bg-layout-900
              border-l-4 border-sunprimary
              dark:border-nightprimary
              hover:-translate-y-2
            "
          >
            <div class="h-full p-5 border border-l-0 rounded-r shadow-sm">
              <h6 class="mb-2 font-semibold leading-5">Vue 3</h6>
              <p class="text-sm">
                verwendet Vue in der Version 3.
                <br />
                <a href="https://vuejs.org/" class="underline" target="_blank"
                  >https://vuejs.org/</a
                >
              </p>
            </div>
          </div>
          <div
            class="
              duration-300
              transform
              bg-layout-100
              dark:bg-layout-900
              border-l-4 border-sunprimary
              dark:border-nightprimary
              hover:-translate-y-2
            "
          >
            <div class="h-full p-5 border border-l-0 rounded-r shadow-sm">
              <h6 class="mb-2 font-semibold leading-5">Tailwind CSS</h6>
              <p class="text-sm">
                verwendet die Tailwind CSS Version 3.
                <br />
                <a
                  href="https://tailwindcss.com/"
                  class="underline"
                  target="_blank"
                  >https://tailwindcss.com/</a
                >
              </p>
            </div>
          </div>
          <div
            class="
              duration-300
              transform
              bg-layout-100
              dark:bg-layout-900
              border-l-4 border-sunprimary
              dark:border-nightprimary
              hover:-translate-y-2
            "
          >
            <div class="h-full p-5 border border-l-0 rounded-r shadow-sm">
              <h6 class="mb-2 font-semibold leading-5">
                Umfangreiche Funktionen
              </h6>
              <p class="text-sm">
                unser Starterpaket besteht aus einer Vielzahl von Funktionen.
                <br />
                Insgesamt besteht die entwickelte Plattform aus drei Anwendungen
                und einer Vielzahl von Vue-Komponenten.
              </p>
            </div>
          </div>
        </div>
        <div class="text-center">
          <Link
            :href="route('job_application')"
            class="
              inline-flex
              items-center
              px-4
              py-2
              h-10
              rounded-md
              font-medium
              text-xs
              tracking-widest
              disabled:opacity-25
              transition
              cursor-pointer
              border-2
              focus:ring focus:outline-none
              border-sunprimary
              text-on-sunprimary
              hover:bg-layout-200 hover:border-sunprimary
              focus:border-sunprimary
              dark:border-nightprimary
              dark:text-on-nightprimary
              dark:hover:text-on-nightprimary-dark
              dark:hover:border-nightprimary
              dark:focus:border-nightprimary
            "
          >
            Zum Bewerbungsformular
          </Link>
        </div>
      </template>
    </home-content-box>

    <home-content-box
      v-if="blog"
      category="Blog"
      :category-route="route('home.blog.index')"
      part_one="Aktuelles "
    >
      <template #part_two>
        aus unserem
        <span class="text-sunprimary dark:text-nightprimary"
          >Blog</span
        ></template
      >
      <template #content>
        <div class="mt-8 container max-w-6xl mx-auto space-y-6 sm:space-y-12">
          <blog-preview-big :blog="blog"></blog-preview-big></div
      ></template>
    </home-content-box>

    <home-content-box
      v-if="webinar"
      category="Webinare"
      :category-route="route('home.webinar.index')"
      part_one="Unser "
    >
      <template #part_two>
        nächstes Webinar
        <span class="text-sunprimary dark:text-nightprimary"
          >"{{ webinar.title }}"</span
        >
        startet am <display-date :value="webinar.event_date" :time-on="false" />
        um
        <span>{{ webinar.event_start }}</span> Uhr
      </template>
      <template #content>
        <div class="mt-8 container max-w-6xl mx-auto space-y-6 sm:space-y-12">
          <webinar-preview-big :webinar="webinar"></webinar-preview-big>
        </div>
      </template>
    </home-content-box>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import BlogPreviewBig from "@/Pages/Application/Shared/BlogPreviewBig.vue";
import WebinarPreviewBig from "@/Pages/Application/Shared/WebinarPreviewBig.vue";

import HomeContentBox from "@/Pages/Application/Homepage/Shared/HomeContentBox.vue";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";

export default defineComponent({
  name: "Homepage_Home",

  components: {
    Link,
    HomepageLayout,
    BlogPreviewBig,
    WebinarPreviewBig,
    HomeContentBox,
    DisplayDate,
  },

  props: {
    blog: {
      type: Object,
      default: () => ({}),
    },
    webinar: {
      type: Object,
      default: () => ({}),
    },
  },
});
</script>
