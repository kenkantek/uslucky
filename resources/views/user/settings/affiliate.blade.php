@extends('layouts.master')

@section('body-class', 'noti')

@section('title') Affiliate Program @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> Affiliate Program </h2>
                <hr>
                <affiliate inline-template>
                    <loading v-if="$loadingAsyncData"></loading>
                    <div v-else>

                        <div v-if="affiliate.length" class="notifications">
                            <div v-if="affiliate[0].type == 0">
                                <div class="error-notice" slot="notice-minimum">
                                    <div class="oaerror info">
                                        <p>
                                            *Your request become a member of Affiliate Program is considering. Please wait until administrator approve.!
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div v-else>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Your amount from Affiliate Program: @{{affiliate[0].amount | currency}}</h4>
                                        <p>Your award: @{{affiliate[0].type == 1 ? affiliate[0].avalue + '%' : '$' + affiliate[0].avalue}}</p>
                                        <p>
                                            <input style="max-width: 300px;float: left;" readonly id="post-shortlink" type="text" value="{{$code ? route('front::get.affiliate.ref',$code->code) : ''}}" class="form-control">
                                            <button style="max-width: 300px;float: left;" class="btn btn-primary" id="copy-button" data-clipboard-target="#post-shortlink">Copy your link to clipboard</button></p>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>History</h4>
                                        <table class="table table-bordered table-hover trans" style="margin-bottom: 0px">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Commission</th>
                                                    <th colspan="2">Type</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in affiliate[0].affiliates">
                                                    <td v-text="item.transaction.updated_at"></td>
                                                    <td v-text="item.transaction.amount | currency"></td>
                                                    <td v-text="item.amount | currency"></td>
                                                    <td v-text="item.type == 1 ? 'Percent' : 'Cash'"></td>
                                                    <td v-text="item.type == 1 ? '%' : '$'"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-else>
                            <div class="error-notice" slot="notice-minimum">
                                <div class="oaerror info">
                                    <p>
                                        *You do not belong affiliate program!
                                    </p>
                                    <a @click.prevent="onAffiliate" class="btn btn-primary">I want become to member of Affiliate program!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </affiliate>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
    <script>
        (function(){
            new Clipboard('#copy-button');
        })();
    </script>
@stop
