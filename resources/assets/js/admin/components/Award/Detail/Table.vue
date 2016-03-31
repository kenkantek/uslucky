<template>
    <div class="portlet light ">
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <div v-if="$loadingAsyncData" class="move-top-10"><loading></loading></div>
                <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                    <thead>
                        <tr class="uppercase">
                            <th>Winning Numbers</th>
                            <th>Power Play</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pb in data.draws" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                            
                        </tr>
                        <tr v-if="!data.draws || !data.draws.length">
                            <td colspan="8">No records found.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../../laroute';
    import deferred from 'deferred';
    import async from 'async';
    import COMMON from '../../../../common';
    import moment from 'moment';
    import timestamp2date from '../../../../filter/timestamp2date';
    import _ from 'lodash';

    export default {
        data() {
        },

        asyncData(resolve, reject) {
            // this.$http.get()
        },

        components: {  }
    }
</script>