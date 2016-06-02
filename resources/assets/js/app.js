import Vue from 'vue';

Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));

Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

const Loading = Vue.extend(require('./components/Globals/Loading.vue'));
Vue.component('loading', Loading);

Vue.filter('currency', (value, currency) => {
  return require('./filter/currency.js')(value, currency);
});

Lang.setLocale(_lang);
import format from './filter/format';

Vue.prototype.$l = (lang, args = {}) => {
    return format(Lang.get(lang).replace(/:[^\s]+/g, '{$&}').replace(/(?:{):/g, '{'), args);
}

import SignUp from './components/Auth/SignUp.vue';
import SignIn from './components/Auth/SignIn.vue';
import SettingAccount from './components/Users/Settings/Accounts/Account.vue';
import CreditCard from './components/Users/Settings/Payment/Index.vue';
import Winning from './components/Users/Settings/Winning/Index.vue';
import Powerball from './components/Games/Powerball/Index.vue';
import MegaMillions from './components/Games/MegaMillions/Index.vue';
import Transaction from './components/Users/Settings/Payment/Transaction.vue';
import Order from './components/Users/Settings/Order/Index.vue';
import ShowOrder from './components/Users/Settings/Order/ShowOrder.vue'
import Contact from './components/Others/Contact.vue';
import Winnumber from './components/Games/Results/Winnumber.vue';
import Notification from './components/Users/Settings/Notification/Index.vue';

import ItemProduct from './components/Ecommerce/ItemProduct.vue';
import Cart from './components/Ecommerce/Cart.vue';
import ManageCart from './components/Ecommerce/ManageCart.vue';
import EcommerceOrder from './components/Ecommerce/Orders/Index.vue';
import EcommerceShowOrder from './components/Ecommerce/Orders/Show.vue';

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
        Notification,
        MegaMillions,
        
        ItemProduct, Cart, ManageCart,
        EcommerceOrder,
        EcommerceShowOrder
    },

    events: {
        'add-cart'(product) {
            this.$broadcast('add-cart', product);
        },
        'update-cart'(carts) {
            this.$broadcast('update-cart', carts);
        }
    }
});
$('[data-toggle="tooltip"]').tooltip();