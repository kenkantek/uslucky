<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="actions">
            <div class="btn-group" v-show="ids.length != 0">
                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-share"></i>
                    <span class="hidden-xs"> Tools </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                    <li :class="{disabled: !printsUrl}">
                        <a :href="printsUrl" target="_blank" data-action="0" class="tool-action">
                            <i class="icon-printer"></i> Print
                        </a>
                    </li>
                    <li class="hidden">
                        <a href="" @click.prevent="onDelete(ids)" data-action="0" class="tool-action">
                            <i class="icon-trash"></i> Delete
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../laroute';
    import COMMON from '../../../common';
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