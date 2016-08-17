@extends('layouts.master')

@section('body-class','ticket')

@section('title') Your Products @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2>详细订单</h2>
                <hr>
                <ecommerce-show-order inline-template>
                    <div v-if="$loadingAsyncData">
                        <loading></loading>
                    </div>
                    <div v-else>
                    <div class="row">
                        <div class="col-xs-6">
                            <dl class="dl-horizontal">
                                <dt>订单号</dt>
                                <dd>@{{ order.id }}</dd>

                                <dt>名字</dt>
                                <dd v-text="order.user.fullname"></dd>

                                <dt>订购时间</dt>
                                <dd>@{{ order.created_at }}</dd>
                            </dl>
                        </div>
                        <div class="col-xs-6">
                            <dl class="dl-horizontal">
                                <dt>总计</dt>
                                <dd>@{{ order.total | currency }}</dd>

                                <dt>数量</dt>
                                <dd>@{{ order.products.length }}</dd>

                                <dt>{{ trans('setting.status') }}</dt>
                                <dd>
                                    <span
                                        class="label"
                                        :class="{
                                        'label-success': order.status.status == 'succeeded',
                                        'label-info': order.status.status == 'pending purchase',
                                        'label-danger': order.status.status == 'pendding'}"
                                        v-text="order.status.status"
                                    ></span>
                                </dd>

                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div v-html="order.description"></div>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover trans">
                        <thead>
                        <tr>
                            {{--<th>Order ID</th>--}}
                            <th colspan="2">商品名字</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>总价</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="product in order.products">
                            {{--<td v-text="product.id"></td>--}}
                            <td><img :src="product.thumb" alt="" width="100px"></td>
                            <td v-text="product.name"></td>
                            <td v-text="product.pivot.count"></td>
                            <td v-text="product.pivot.price | currency"></td>
                            <td v-text="product.pivot.count * product.pivot.price | currency"></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </ecommerce-show-order>

                <hr>

            </div>
        </div>
    </div>
@stop
