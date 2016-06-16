<template>
    <div class="portlet-title">
        <slot name="header"></slot>
    </div>
</template>

<script>
    import laroute  from '../../../../laroute.js';
    import COMMON from '../../../../common';
    export default {
        props: ['printsUrl', 'ids'],

        methods:{
            onDelete(ids){
                swal({
                    title: "Are you sure delete this order?",
                    type: "info",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, (isConfirm) => {
                    if(isConfirm) {
                        this.$http.delete(laroute.route('admin.orders.destroy', { 'orders': [ids]})).then(res => {
                            swal.close();
                            this.$parent.reloadAsyncData();
                            return res;
                        }, (res) => {
                                if(res.status === 500) {
                                    COMMON.alertError();
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