require('./bootstrap');
window.Vue = require('vue');

import router from './routes'
import store from './vuex'


Vue.component('body-component', require('./components/BodyComponent.vue').default);


const app = new Vue({
    router,
    store,
    el: '#app',
});
