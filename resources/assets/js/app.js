const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

var Loading = Vue.extend(require('./components/Globals/Loading.vue'));
Vue.component('loading', Loading);
import SignUp from './components/auth/SignUp.vue';
import SignIn from './components/auth/SignIn.vue';
import SettingAccount from './components/users/settings/accounts/Account.vue';
import CreditCard from './components/users/settings/Payment/Index.vue';
import Winning from './components/users/settings/Winning/Index.vue';
import Powerball from './components/Games/Powerball/Index.vue';
import Transaction from './components/users/settings/Payment/Transaction.vue';
import Order from './components/users/settings/Order/Index.vue';
import Ticket from './components/users/settings/Order/Ticket.vue'
import Contact from './components/users/Contact.vue';

new Vue({
	el: 'body',
    components: {
    	SignUp,
        SignIn,
        SettingAccount,
        CreditCard,
        Winning,
        Powerball,
        Transaction,
        Contact,
        Order,
        Ticket,
    }
});
$('[data-toggle="tooltip"]').tooltip();