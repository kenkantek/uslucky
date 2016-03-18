const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

import SignIn from './components/Auth/SignIn.vue';
import Contacts from './components/Contacts/Contacts.vue';

new Vue({
    el: 'body',
    components: {
        SignIn,
        Contacts,
    }
});
$('[data-toggle="tooltip"]').tooltip();