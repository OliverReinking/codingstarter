import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import { i18nVue } from "laravel-vue-i18n";

import "@fontsource/inter/index.css";

// use the plugin v-tippy (https://thecodewarrior.github.io/Tippy.vue/getting-started.html)
import { TippyPlugin } from "tippy.vue";

// default css for v-tippy
import "../../node_modules/tippy.js/dist/tippy.css";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "CodingStarter";

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(i18nVue, {
                resolve: async (lang) => {
                    const langs = import.meta.glob("../../lang/*.json");
                    return await langs[`../../lang/${lang}.json`]();
                },
            })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(TippyPlugin, {
                tippyDefaults: {}, // convenience to set tippy.js default props
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: "#8b5cf6" });
