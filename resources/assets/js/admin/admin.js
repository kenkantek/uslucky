const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

Vue.component('loading', Vue.extend(require('../components/Globals/Loading.vue')));

import Order from './components/Order/Index.vue';
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
    }
});

const sidebar = $('.menu-toggler.sidebar-toggler');
sidebar.on('click', function() {
    localStorage.setItem('sidebar-admin', !!$('body').hasClass('page-sidebar-closed'));
});

window.onload = () => {
    localStorage.getItem('sidebar-admin') === 'false' && sidebar.trigger('click');
}