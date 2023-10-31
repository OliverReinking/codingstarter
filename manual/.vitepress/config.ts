import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: 'TailwindSCM',
    description: 'Handbuch der SaaS-Anwendung TailwindSCM',
    outDir: './../public/manual/',
    base: '/manual/',
    themeConfig: {
        // https://vitepress.dev/reference/default-theme-config
        logo: '/kontaktknoten.svg',
        nav: [
            { text: 'Dashboard', link: 'https://codingstarter.test/admin/dashboard' },
            { text: 'Examples', link: '/markdown-examples' }
        ],

        sidebar: [
            {
                text: 'Examples',
                items: [
                    { text: 'Markdown Examples', link: '/markdown-examples' },
                    { text: 'Runtime API Examples', link: '/api-examples' }
                ]
            }
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/vuejs/vitepress' }
        ]
    }
})
