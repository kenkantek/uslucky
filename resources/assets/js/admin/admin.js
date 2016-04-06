const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

Vue.component('loading', Vue.extend(require('../components/Globals/Loading.vue')));

Vue.filter('currency', function (value, currency) {
  return require('../filter/currency.js')(value, currency);
});

import Order from './components/Order/Index.vue';
import OrderDetails from './components/Order/ShowOrder.vue';
import SignIn from './components/Auth/SignIn.vue';
import Contacts from './components/Contacts/Contacts.vue';
import ReplyContact from './components/Contacts/Reply.vue';
import UsersList from './components/Users/Users.vue';
import ShowUser from './components/Users/ShowUser.vue';
import ResultsDaily from './components/Results/Index.vue';
import AwardPowerball from './components/Award/Index.vue';
import AwardDetail from './components/Award/Detail/Index.vue';
import Powerball from './components/Games/Powerball.vue';
import WinnerList from './components/Users/Winners/Winners.vue';
import RequestList from './components/Requests/Index.vue'

new Vue({
    el: 'body',
    components: {
        SignIn,
        Contacts,
        Order,
        ReplyContact,
        UsersList,
        OrderDetails,
        ShowUser,
        ResultsDaily,
        AwardPowerball,
        AwardDetail,
        Powerball,
        WinnerList,
        RequestList,
    }
});

const sidebar = $('.menu-toggler.sidebar-toggler');
sidebar.on('click', function() {
    localStorage.setItem('sidebar-admin', !!$('body').hasClass('page-sidebar-closed'));
});

window.onload = () => {
    localStorage.getItem('sidebar-admin') === 'false' && sidebar.trigger('click');
}