<template>
  <button
    type="button"
    class="
      hidden
      lg:block
      text-white
      bg-gradient-to-r
      from-sunprimary-light
      via-sunprimary
      to-sunprimary-dark
      hover:bg-gradient-to-br
      focus:ring-4 focus:ring-sunprimary-lighter
      dark:focus:ring-sunprimary-darker
      font-medium
      rounded-lg
      text-sm
      px-5
      py-2.5
      text-center
    "
  >
    <Link :href="route('register')"> Jetzt registrieren</Link>
  </button>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
  name: "Homepage_ButtonRegisterNow",
  //
  components: {
    Link,
  },
};
</script>
