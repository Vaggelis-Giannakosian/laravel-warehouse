require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import velocity from 'velocity-animate';
import Notifications from '@kyvg/vue3-notification'
import Antd from 'ant-design-vue';
import { dragscrollNext } from "vue-dragscroll";
import 'ant-design-vue/dist/antd.css';
import store from "./store/index"
import AssetMixin from './mixins/AssetMixin';
import FlashMixin from './mixins/FlashMixin';
import FlashMessage from "@/Shared/FlashMessage";
import PrimaryButton from './Components/Buttons/PrimaryButton'
import Card from '@/Components/Card'
import NavLink from '@/Components/NavLink'


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(store)
            .use(Antd)
            .use(Notifications,{ velocity })
            .component('flash-message', FlashMessage)
            .component('primary-button', PrimaryButton)
            .component('card', Card)
            .component('nav-link', NavLink)
            .directive('dragscroll', dragscrollNext)
            .mixin(AssetMixin)
            .mixin(FlashMixin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#3664a2' });
