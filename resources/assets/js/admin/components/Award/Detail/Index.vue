<template>
    <div class="portlet light ">
        <slot slot="header" name="header"></slot>
        <div class="portlet-body">
            <div class="row">
                    <div class="col-xs-6">
                        <dl class="dl-horizontal">
                            <dt>Game Name</dt>
                            <dd>{{ result.game.name }}</dd>

                            <dt>Draw date</dt>
                            <dd>{{ result.draw_at }}</dd>

                            <dt>Numbers</dt>
                            <dd>
                                <span v-for="number in result.numbers">
                                    <strong v-text="number"></strong>
                                </span>
                                <span>
                                    <strong class="powerball" v-text="result.ball"></strong>
                                </span>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-xs-6">
                        <dl class="dl-horizontal">
                            <dt>Power play</dt>
                            <dd>{{ result.multiplier }}</dd>

                            <dt>Annuity payout</dt>
                            <dd>{{ result.annuity | currency }}</dd>

                            <dt>Status</dt>
                            <dd>
                                <span class="label" :class="[result.status.status === 'pendding' ? 'label-danger' : 'label-success']">{{ result.status.status }}</span>
                            </dd>
                        </dl>
                    </div>
            </div>
            
            <div class="row">
                <hr>
                <div class="col-md-6 col-md-offset-5">
                    <button class="btn btn-info" @click.prevent="onFinish" v-if="checkDoneAward">
                        Change to done
                    </button>
                    <button class="btn btn-danger" v-if="result.status.status == 'pendding'" @click="onCalculate" :disabled="calculating">
                        <i class="fa fa-circle-o-notch fa-spin" v-show="calculating"></i> Calculate Winning
                    </button>

                </div>
                <div class="col-md-12">
                    <div v-show="calculating"><loading></loading></div>
                </div>
            </div>
            <div class="row" v-if="result.apply_module">
                <table-value :result="result" :check-done-award.sync="checkDoneAward"></table-value>
            </div>
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../../laroute.js';
    import COMMON from '../../../../common';
    import TableValue from './Table.vue';

    export default {
        data() {
            return {
                result: _result,
                checkDoneAward: false,
                calculating: false
            }
        },

        methods: {
            onCalculate() {
                this.calculating = true;
                this.$http.post(laroute.route('admin.post.award.result.calculate', {result: this.result.id})).then(res => {
                    toastr.success('Calculated successfuly and Reload page now');
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                }, res => {
                    this.calculating = false;
                    COMMON.alertError();
                });
            },

            onFinish(){
                this.calculating = true;
                this.$http.post(laroute.route('admin.post.award.result.finish', {result: this.result.id})).then(res => {
                    toastr.success('All tickets was paid!');
                    setTimeout(() => {
                        window.location.reload()
                    }, 2000);
                }, res => {
                    this.calculating = false;
                    COMMON.alertError();
                });
            }
        },

        components: {
            TableValue
        }
    }
</script>