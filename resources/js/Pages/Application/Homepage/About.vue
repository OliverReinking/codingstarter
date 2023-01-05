<template>
  <homepage-layout header-title="Über uns">
    <div class="container px-6 py-16 mx-auto">
      <div class="items-center lg:flex lg:items-start">
        <div class="w-full lg:w-1/2">
          <div class="lg:max-w-lg">
            <h1 class="font-logo text-2xl font-semibold uppercase lg:text-3xl">
              Über uns
            </h1>
            <div class="mt-2">
              Wir sind ein Team von erfahrenen Webentwicklern, das sich auf die
              Erstellung von benutzerfreundlichen und leistungsstarken
              Web-Anwendungen mit Laravel spezialisiert hat.
              <br />
              <br />
              Laravel ist ein populäres PHP-Web-Framework, das es Entwicklern
              ermöglicht, schnell und effektiv professionelle Web-Anwendungen zu
              erstellen. Es bietet eine Vielzahl von Funktionen und Werkzeugen,
              die das Erstellen von Code vereinfachen und beschleunigen.
              <br />
              <br />Wir verfügen über umfangreiche Erfahrung in der Entwicklung
              von Web-Anwendungen für Unternehmen jeglicher Größe und Branchen.
              Von der Konzeption bis zur Umsetzung setzen wir auf Qualität und
              Kundenzufriedenheit. <br />
              <br />Unser Team besteht aus hochqualifizierten Entwicklern, die
              stets auf dem neuesten Stand der Technik sind und sich
              kontinuierlich weiterbilden, um unseren Kunden die bestmöglichen
              Lösungen bieten zu können.<br />
              <br />
              Wir freuen uns darauf, mit Ihnen zusammenzuarbeiten und Ihnen zu
              helfen, Ihre Web-Anwendungsträume mit Laravel zu verwirklichen.
              Kontaktieren Sie uns noch heute, um mehr über unsere
              Dienstleistungen zu erfahren und ein unverbindliches Angebot zu
              erhalten.
            </div>
          </div>
        </div>

        <div
          class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2"
        >
          <undraw-the-world-is-mine
            class="w-full h-full lg:max-w-2xl"
          ></undraw-the-world-is-mine>
        </div>
      </div>
    </div>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import UndrawTheWorldIsMine from "@/Pages/Components/UnDraw/TheWorldIsMine.vue";

export default defineComponent({
  name: "Homepage_About",

  components: {
    HomepageLayout,
    UndrawTheWorldIsMine,
  },
});
</script>
