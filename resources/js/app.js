require('./bootstrap');
import vuetify from './vuetify';
import router from './router/route';
import store from './store/index';
import EventBus from './EventBus';

import AppHome from './components/AppHome';

window.Vue = require('vue');
window.EventBus = EventBus;

const app = new Vue({
    el: '#app',
    vuetify,
    router,
    store,
    components: {
        AppHome,
    },
});
