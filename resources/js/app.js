import './bootstrap';
import '../css/app.css';
import '@splidejs/vue-splide/css';
import 'v-calendar/style.css';
import 'primeicons/primeicons.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import VCalendar from 'v-calendar';
import VueSplide from '@splidejs/vue-splide';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import PrimeVue from 'primevue/config';
import Lara from "@/presets/lara";



createInertiaApp({
    title: (title) => `${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara
            })
            .use(VCalendar, {})
            .use(VueSplide)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
