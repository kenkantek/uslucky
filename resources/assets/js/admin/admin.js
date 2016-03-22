const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

var Loading = Vue.extend(require('../components/Globals/Loading.vue'));
Vue.component('loading', Loading);

import SignIn from './components/Auth/SignIn.vue';
import Contacts from './components/Contacts/Contacts.vue';
import Order from './components/Order/Index.vue';

new Vue({
    el: 'body',
    components: {
        SignIn,
        Contacts,
        Order
    }
});
$('[data-toggle="tooltip"]').tooltip();