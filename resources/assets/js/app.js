const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

var Loading = Vue.extend(require('./components/Globals/Loading.vue'));
Vue.component('loading', Loading);
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
    }
});
$('[data-toggle="tooltip"]').tooltip();