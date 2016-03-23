const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

var Loading = Vue.extend(require('../components/Globals/Loading.vue'));
Vue.component('loading', Loading);

import Order from './components/Order/Index.vue';
import OrderDetails from './components/Order/ShowOrder.vue';
import SignIn from './components/Auth/SignIn.vue';
import Contacts from './components/Contacts/Contacts.vue';
import ReplyContact from './components/Contacts/Reply.vue';
import UsersList from './components/Users/Users.vue';

new Vue({
    el: 'body',
    components: {
        SignIn,
        Contacts,
        Order,
        ReplyContact,
        UsersList,
        OrderDetails,
    }
});
$('[data-toggle="tooltip"]').tooltip();