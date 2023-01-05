<template>
  <homepage-layout header-title="Anwenderaktion">
    <div class="container px-6 py-16 mx-auto">
      <div class="items-center lg:flex lg:items-start">
        <div class="w-full lg:w-1/2">
          <div class="lg:max-w-lg">
            <h1 class="font-logo text-2xl font-semibold lg:text-3xl">
              {{ title }}
            </h1>
            <div class="mt-2">
              <div
                class="
                  text-lg
                  font-extrabold
                  text-primary
                  dark:text-primary-dark
                "
                v-html="message"
              ></div>
            </div>
            <div class="mt-2" v-if="contact_show">
              <div
                class="
                  text-lg
                  font-extrabold
                  text-primary
                  dark:text-primary-dark
                "
              >
                Kontaktinformationen
              </div>
              <div v-html="contact_info"></div>
            </div>
          </div>
        </div>

        <div
          class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2"
        >
          <undraw-confirmation
            class="w-full h-full lg:max-w-2xl"
          ></undraw-confirmation>
        </div>
      </div>
    </div>
  </homepage-layout>
</template>
<script>
import { defineComponent } from "vue";
import HomepageLayout from "@/Pages/Application/Homepage/Shared/Layout.vue";

import UndrawConfirmation from "@/Pages/Components/UnDraw/Confirmation.vue";

export default defineComponent({
  name: "Homepage_UserActionConfirmation",

  components: {
    HomepageLayout,
    UndrawConfirmation,
  },

  props: {
    title: {
      type: String,
      required: true,
    },
    message: {
      type: String,
      required: true,
    },
    contact_show: {
      type: Boolean,
      default: false,
    },
    contact_info: {
      type: String,
      required: true,
    },
  },
});
</script>
