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
                    <button class="btn btn-info" v-if="result.apply_module">
                        Update status
                    </button>
                    <button class="btn btn-danger" v-else @click="onCalculate" :disabled="calculating">
                        <i class="fa fa-circle-o-notch fa-spin" v-show="calculating"></i> Calculate Winning
                    </button>
                </div>
            </div>
            <div class="row" v-if="result.apply_module">
                list ket qua trung
            </div>
        </div>
    </div>
</template>

<script>
    import laroute  from '../../../../laroute.js';
    import COMMON from '../../../../common';
    import moment from 'moment';

    export default {
        data() {
            return {
                result: _result,
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
            }
        }
    }
</script>