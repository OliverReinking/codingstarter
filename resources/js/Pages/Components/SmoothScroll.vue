<template>
  <a :href="href" @click.prevent="scroll">
    <slot></slot>
  </a>
</template>

<script>
export default {
  name: "Content_SmoothScroll",

  props: ["href"],

  methods: {
    scroll() {
      document.querySelector(this.href).scrollIntoView({
        behavior: "smooth",
        block: "start",
        inline: "nearest",
      });
    },
  },
};
</script>
