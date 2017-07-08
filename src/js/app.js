window.axios = require('axios');
window.Vue = require('vue');

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/sl';
Vue.use(ElementUI, {locale});

Vue.component('weather-data', require('./components/WeatherData.vue'));

const app = new Vue({
    el: '#app'
});
