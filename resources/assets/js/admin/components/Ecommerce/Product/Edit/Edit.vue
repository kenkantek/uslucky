<script>
    import NOTIFY from '../../../../../common';
    import laroute from '../../../../../laroute';
    import Category from './Category.vue';
    import _ from 'lodash';

    export default {
        props: {
            id: {
                type: String,
                required: true
            },
            categories: {
                required: true,
                coerce(val) {
                    return JSON.parse(val);
                }
            }
        },

        data() {
            return {
                formData: new FormData,
                formInputs: {
                    thumb: '/images/image-default.png'
                },
                formErrors: {},
                submiting: false
            }
        },

        asyncData(resolve, reject) {
            this.$http.get(laroute.route('ecommerce.admin.ecommerce.product.show', { 
                product : this.id
            })).then(({ data }) => {
                resolve({
                    formInputs : data
                });
        }, err => NOTIFY.alertError());
        },

        computed: {
            categories_selected() {
                const tmp = this.formInputs.categories;
                const categories = [];

                if(_.isArray(tmp)) {
                    //array
                    tmp.forEach((v, i) => {
                        v && categories.push(i);
                    });
                } else {
                    //object
                    for(let i in tmp) {
                        tmp[i] && categories.push(i);
                    }
                }

                return categories;
            }
        },

        methods: {
            onSubmiting(data) {
                this.submiting = true;
                this.formErrors = {};

                for(let i in this.formInputs) {
                    this.formData.set(i, this.formInputs[i]);
                }
                this.formData.set('categories', JSON.stringify(this.categories_selected));
            },
            onComplete({ redirect, message }) {
                message && toastr.success(message);
                redirect && (window.location = redirect);
                this.submiting = false;
            },
            onError(data, status) {
                if(status === 422) {
                    this.formErrors = data;
                    toastr.error(this.$l('message.check_field'));
                } else { //500
                    NOTIFY.alertError();
                }
                this.submiting = false;
            },
        },

        components: { Category }
    }

</script>