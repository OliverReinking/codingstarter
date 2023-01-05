<template>
  <div
    class="
      p-5
      mx-auto
      sm:p-2
      md:p-10
      bg-white
      text-layout-800
      dark:bg-layout-800 dark:text-layout-100
    "
  >
    <div class="flex flex-col max-w-6xl mx-auto overflow-hidden rounded">
      <img
        :src="blog.blog_image.url"
        :alt="blog.blog_image.name"
        class="w-full h-60 sm:h-96 bg-layout-500"
      />
      <div
        class="
          p-2
          pb-12
          m-2
          mx-auto
          -mt-16
          space-y-6
          lg:max-w-5xl
          sm:px-10 sm:mx-12
          lg:rounded-md
          bg-layout-100
          dark:bg-layout-900
          prose
          dark:prose-invert
          md:prose-lg
          lg:prose-xl
        "
      >
        <div class="space-y-2">
          <div
            v-if="blog.blog_category.name"
            class="flex justify-end items-start"
          >
            <div
              class="
                text-sm
                min-w-fit min-h-fit
                bg-sunprimary-darker
                text-on-sunprimary-darker
                font-semibold
                px-2.5
                py-0.5
                rounded-lg
                dark:bg-nightprimary-darker dark:text-on-nightprimary-darker
                whitespace-nowrap
              "
            >
              {{ blog.blog_category.name }}
            </div>
          </div>

          <h1 class="pb-12 block font-title">
            {{ blog.title }}
          </h1>

          <div class="flex items-end justify-between">
            <div class="text-layout-600 dark:text-layout-300">
              <display-date :value="blog.blog_date" :time-on="false" />
              von
              <a href="#author_info" class="hover:underline">{{
                blog.blog_author.name
              }}</a>
            </div>
            <div>
              <display-number
                :value="blog.reading_time"
                :after-digits="0"
                value-unit="Minuten Lesezeit"
                value-single-unit="Minute Lesezeit"
                value-unit-class=""
              ></display-number>
            </div>
          </div>
          <div
            class="
              my-4
              bg-white
              dark:bg-layout-700
              rounded-lg
              p-4
              border border-sunprimary
              dark:border-nightprimary
            "
            v-if="blog.audio_on"
          >
            <div class="text-xs text-layout-600 dark:text-layout-400">
              <icon-speaker-wave
                class="
                  inline-block
                  h-8
                  w-8
                  mr-2
                  text-blue-500
                  dark:text-blue-500
                "
              ></icon-speaker-wave>
              Dieser Artikel liegt auch als Audio-Datei vor.
              <span v-if="blog.audio_duration > 0">
                Die Audio-Datei hat eine Länge von
                {{ blog.audio_duration }} Sekunden.
              </span>
            </div>
            <input
              class="
                w-full
                h-1
                bg-sunprimary-lighter
                dark:bg-nightprimary-lighter
                cursor-pointer
                appearance-none
              "
              type="range"
              min="0"
              max="100"
              step="1"
              v-model="seekValue"
              @change="onSeek"
            />
            <audio
              :src="'/audio/' + blog.audio_url"
              ref="audioPlayer"
              @timeupdate="onPlaying"
            >
              Your browser does not support the
              <code>audio</code> element.
            </audio>
            <div class="my-2">
              <display-number
                :value="currentTime"
                :after-digits="0"
                value-unit="Sekunden"
                value-single-unit="Sekunde"
              ></display-number>
            </div>
            <div class="flex items-center justify-start">
              <button @click="play">
                <icon-play
                  class="
                    h-12
                    w-12
                    mr-2
                    text-blue-500
                    dark:text-blue-500
                    bg-layout-100
                    dark:bg-layout-800
                    rounded-full
                    p-2
                  "
                ></icon-play>
              </button>
              <button @click="pause">
                <icon-pause
                  class="
                    h-12
                    w-12
                    mr-2
                    text-blue-500
                    dark:text-blue-500
                    bg-layout-100
                    dark:bg-layout-800
                    rounded-full
                    p-2
                  "
                ></icon-pause>
              </button>
              <button @click="stop">
                <icon-stop
                  class="
                    h-12
                    w-12
                    mr-2
                    text-blue-500
                    dark:text-blue-500
                    bg-layout-100
                    dark:bg-layout-800
                    rounded-full
                    p-2
                  "
                ></icon-stop>
              </button>
            </div>
          </div>
        </div>
        <div class="text-layout-800 dark:text-layout-200">
          <div v-if="blog.markdown_on">
            <markdown :markdown="blogarticle"></markdown>
          </div>

          <div v-else v-html="blog.content"></div>

          <h3 id="author_info">Informationen zu {{ blog.blog_author.name }}</h3>
          <div v-html="blog.blog_author.info"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import IconPause from "@/Pages/Components/Icons/Pause.vue";
import IconPlay from "@/Pages/Components/Icons/Play.vue";
import IconSpeakerWave from "@/Pages/Components/Icons/SpeakerWave.vue";
import IconStop from "@/Pages/Components/Icons/Stop.vue";

import DisplayDate from "@/Pages/Components/Content/DisplayDate.vue";
import DisplayNumber from "@/Pages/Components/Content/DisplayNumber.vue";

import Markdown from "@/Pages/Components/Content/Markdown.vue";

export default {
  name: "Shared_BlogShow",
  //
  components: {
    IconPause,
    IconPlay,
    IconSpeakerWave,
    IconStop,
    DisplayDate,
    DisplayNumber,
    Markdown,
  },

  props: {
    blog: {
      type: Object,
    },
    blogarticle: {
      type: String,
    },
  },

  data() {
    return {
      currentTime: 0,
      seekValue: 0,
    };
  },

  methods: {
    play() {
      this.$refs.audioPlayer.play();
    },
    pause() {
      this.$refs.audioPlayer.pause();
    },
    stop() {
      const { audioPlayer } = this.$refs;
      audioPlayer.pause();
      audioPlayer.currentTime = 0;
    },
    onPlaying() {
      const { audioPlayer } = this.$refs;
      if (!audioPlayer) {
        return;
      }
      this.currentTime = Math.round(audioPlayer.currentTime);
      this.seekValue = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    },
    onSeek() {
      const { audioPlayer } = this.$refs;
      const seekto = audioPlayer.duration * (this.seekValue / 100);
      audioPlayer.currentTime = seekto;
    },
  },
};
</script>
