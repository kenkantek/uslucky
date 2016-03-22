<template>
    <form class="login-form" @submit.prevent="onSubmit" novalidate>
        <h3 class="form-title font-green">Sign In</h3>
        <div class="alert alert-danger" v-show="formErrors.message">
            <button class="close" data-close="alert"></button>
            <span class="help-block err" v-text="formErrors.message"></span>
        </div>

        <div class="form-group" :class="{'has-error': formErrors.email}">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" v-model="formInputs.email" />
            <span class="help-block" v-show="formErrors.email" v-text="formErrors.email"></span>
        </div>

        <div class="form-group" :class="{'has-error': formErrors.password}">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" v-model="formInputs.password" />
            <span class="help-block" v-show="formErrors.password" v-text="formErrors.password"></span>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn green uppercase" :disabled="submiting">
                <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Login
            </button>
        </div>
    </form>
</template>

<script>
    import laroute from '../../../laroute';
    import COMMON from '../../../common';

    export default {
        data() {
        return {
            formInputs: {},
            formErrors: {
                message: ''
            },
            submiting: false
        }
    },

    methods: {
        onSubmit(e) {
            this.submiting = true;
            this.$http.post('/login', this.formInputs).then(res => {
                this.submiting = false;
            swal({
                title: "Sign In Successful!",
                timer: 2000,
                text: "Auto redirect to profile",
                type: "info",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, () => {
                location.href = laroute.route('admin.dashboard');
            setTimeout(() =>{}, 2000);
        });

        }, (res) => {
                const status = res.status;
                this.formErrors = {...res.formErrors, ...res.data};
                this.submiting = false;
                if(res.status === 500) {
                    COMMON.alertError();
                } else if(status === 422)  {
                    toastr.error('Please check input field!.', 'Validate!');
                }
            });
        }
    }
    }
</script>