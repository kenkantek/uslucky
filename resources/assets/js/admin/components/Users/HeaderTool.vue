<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="actions">
            <div class="btn-group" v-show="ids.length != 0">
                <button class="btn red btn-danger btn-circle" @click.prevent="onDelete(ids)">
                    <i class="fa fa-trash"></i>
                    <span class="hidden-xs"> Delete all users </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../laroute';
    import COMMON from '../../../common';
    export default {
        props: ['ids'],

        methods:{
            onDelete(ids){
                swal({
                    title: "Are you sure delete this users?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.delete(laroute.route('admin.users.destroy', { 'users': [ids]})).then(res => {
                            swal.close();
                            this.$parent.reloadAsyncData();
                            return res;
                        }, (res) => {
                                if(res.status === 500) {
                                    COMMON.alertError('Don\'t choose yourself!');
                                }
                            }
                        );
                    } else {
                        swal.close();
                    }
                });
            }
        }
    }
</script>