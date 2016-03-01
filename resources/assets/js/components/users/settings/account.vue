<template>
    <div v-if="$loadingAsyncData">Loading...</div>
    <form  v-if="!$loadingAsyncData" class="" @submit.prevent="onSubmit" novalidate>

        <div class="form-group">
            <label>First Name: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.first_name">
        </div>
        <div class="form-group">
            <label>Last Name: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.last_name">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input readonly type="text" class="form-control" autocomplete="off" v-model="user.email">
        </div>
        <div class="form-group">
            <label>Phone: <sup class="text-danger">*</sup></label>
            <input type="text" class="form-control" autocomplete="off" v-model="user.phone">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Update Account
            </button>
        </div>

    </form>
</template>
<script>
    import BOX from '../../../common';

    export default {

        data() {
            return {
                user: {}
            }
        },

        asyncData(resolve, reject){
            this.$http.get(_api.user).then(res => {
                const user = res.data;

                resolve({
                    user
                });

            }, (res) => {
                BOX.alertError();
            });
        },

        methods: {
            onSubmit() {

            }
        }

    }
</script>