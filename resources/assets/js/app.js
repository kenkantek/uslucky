const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

var Loading = Vue.extend(require('./components/Globals/Loading.vue'));
Vue.component('loading', Loading);

Vue.filter('currency', function (value, currency) {
  return require('./filter/currency.js')(value, currency);
});

import SignUp from './components/Auth/SignUp.vue';
import SignIn from './components/Auth/SignIn.vue';
import SettingAccount from './components/Users/Settings/Accounts/Account.vue';
import CreditCard from './components/Users/Settings/Payment/Index.vue';
import Winning from './components/Users/Settings/Winning/Index.vue';
import Powerball from './components/Games/Powerball/Index.vue';
import Transaction from './components/Users/Settings/Payment/Transaction.vue';
import Order from './components/Users/Settings/Order/Index.vue';
import ShowOrder from './components/Users/Settings/Order/ShowOrder.vue'
import Contact from './components/Others/Contact.vue';
import Winnumber from './components/Games/Results/Winnumber.vue';
import Notification from './components/Users/Settings/Notification/Index.vue';

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
        ShowOrder,
        Winnumber,
        Notification
    }
});
$('[data-toggle="tooltip"]').tooltip();