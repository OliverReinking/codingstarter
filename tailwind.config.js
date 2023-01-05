const colors = require('tailwindcss/colors');
const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                "layout-white": "#ffffff",
                "layout-50": "#fafafa",
                "layout-100": "#f5f5f5",
                "layout-200": "#e5e5e5",
                "layout-300": "#d4d4d4",
                "layout-400": "#a3a3a3",
                "layout-500": "#737373",
                "layout-600": "#525252",
                "layout-700": "#404040",
                "layout-800": "#262626",
                "layout-900": "#171717",
                "layout-black": "#000000",
                //
                sunlogo: "#8b5cf6",
                sunprimary: "#8b5cf6",
                "sunprimary-dark": "#7c3aed",
                "sunprimary-darker": "#4c1d95",
                "sunprimary-light": "#a78bfa",
                "sunprimary-lighter": "#ede9fe",
                "on-sunprimary": "#111827",
                "on-sunprimary-light": "#111827",
                "on-sunprimary-lighter": "#111827",
                "on-sunprimary-dark": "#f9fafb",
                "on-sunprimary-darker": "#f9fafb",
                //
                nightlogo: "#ffffff",
                nightprimary: "#8b5cf6",
                "nightprimary-dark": "#a78bfa",
                "nightprimary-darker": "#ede9fe",
                "nightprimary-light": "#7c3aed",
                "nightprimary-lighter": "#4c1d95",
                "on-nightprimary": "#f9fafb",
                "on-nightprimary-light": "#f9fafb",
                "on-nightprimary-lighter": "#f9fafb",
                "on-nightprimary-dark": "#111827",
                "on-nightprimary-darker": "#111827",
                //
                sunsecondary: "#8b5cf6",
                "sunsecondary-dark": "#7c3aed",
                "sunsecondary-darker": "#4c1d95",
                "sunsecondary-light": "#a78bfa",
                "sunsecondary-lighter": "#ede9fe",
                "on-sunsecondary": "#111827",
                "on-sunsecondary-light": "#111827",
                "on-sunsecondary-lighter": "#111827",
                "on-sunsecondary-dark": "#f9fafb",
                "on-sunsecondary-darker": "#f9fafb",
                //
                nightsecondary: "#8b5cf6",
                "nightsecondary-dark": "#a78bfa",
                "nightsecondary-darker": "#ede9fe",
                "nightsecondary-light": "#7c3aed",
                "nightsecondary-lighter": "#4c1d95",
                "on-nightsecondary": "#f9fafb",
                "on-nightsecondary-light": "#f9fafb",
                "on-nightsecondary-lighter": "#f9fafb",
                "on-nightsecondary-dark": "#111827",
                "on-nightsecondary-darker": "#111827",
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
                logo: ['Inter', ...defaultTheme.fontFamily.sans],
                title: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
