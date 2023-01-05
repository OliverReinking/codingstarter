<template>
  <homepage-layout header-title="Unsere Mission">
    <div class="container px-6 py-16 mx-auto">
      <div class="items-center lg:flex lg:items-start">
        <div class="w-full lg:w-1/2">
          <div class="lg:max-w-lg">
            <h1 class="font-logo text-2xl font-semibold uppercase lg:text-3xl">
              Unsere Mission
            </h1>
            <div class="mt-2">
              Wir möchten die Entwicklung von Software vereinfachen, indem wir
              die Verwendung von einfachen und intuitiven Werkzeugen und
              Frameworks fördern und die Lernkurve für neue Entwickler
              minimieren.
              <ul class="list-outside list-disc">
                <li>
                  Die Bereitstellung von einfach zu verwendenden, aber
                  leistungsfähigen Frameworks und Bibliotheken, die Entwicklern
                  dabei helfen, schnell und effizient Anwendungen zu erstellen
                </li>
                <li>
                  Die Bereitstellung von umfassender Dokumentation und
                  Ressourcen, um den Einstieg in die Softwareentwicklung zu
                  erleichtern
                </li>
                <li>
                  Die Förderung von Best Practices und Standards, die die
                  Codequalität verbessern und die Wartbarkeit von Anwendungen
                  erhöhen
                </li>
                <li>
                  Die Unterstützung von Entwicklern bei der Lösung von Problemen
                  und der Verbesserung ihrer Fähigkeiten durch die
                  Zusammenarbeit in der Entwicklergemeinschaft.
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div
          class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2"
        >
          <undraw-target
            class="w-full h-full lg:max-w-2xl"
          ></undraw-target>
        </div>
      </div>
    </div>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import UndrawTarget from "@/Pages/Components/UnDraw/Target.vue";

export default defineComponent({
  name: "Homepage_Mission",

  components: {
    HomepageLayout,
    UndrawTarget,
  },
});
</script>
