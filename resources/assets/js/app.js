const Vue = require('vue');
Vue.use(require('vue-resource'));
Vue.use(require('vue-async-data'));
Vue.http.headers.common['X-CSRF-TOKEN'] = _token;

import SignUp from './components/auth/SignUp.vue';
import SignIn from './components/auth/SignIn.vue';

new Vue({
	el: 'body',
    components: {
    	SignUp,
        SignIn
    }
});