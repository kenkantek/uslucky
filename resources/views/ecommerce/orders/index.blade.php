@extends('layouts.master')

@section('body-class','order')

@section('title') {{trans('setting.title_order_ticket')}} @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('user.settings._sizebar')
            </div>

            <div class="col-xs-12 col-md-9">
                <h2> {{ trans('setting.title_order_ticket') }} </h2>
                <hr>
                <ecommerce-order inline-template>
                    <div v-if="$loadingAsyncData">
                        <loading></loading>
                    </div>
                    <table v-if="orders.length" class="table table-bordered table-hover trans">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{trans('setting.date')}}</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="order in orders">
                            <td v-text="order.id"></td>
                            <td v-text="order.created_at"></td>
                            <td v-text="order.total | currency"></td>
                            <td class="text-center">
                                <a class="link" href="{{ route('front::ecommerce.order.show', 1) }}">
                                    {{ trans('setting.button_details') }}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div v-else>
                        <div class="error-notice" slot="notice-minimum">
                            <div class="oaerror info">
                                <p> {{trans('setting.not_order')}} </p>
                            </div>
                        </div>
                    </div>
                    <button style="width: 100%" class="link" @click="nextPagination" v-show="nextPageUrl" :disabled="loading">{{trans('setting.load_more')}} @{{ numberMore }} {{trans('setting.record')}}</button>
                    <div v-show="nextPageUrl" style="width: 100%;text-align: center;margin-top: 15px">
                        {{trans('setting.show')}} @{{ orders.length }} {{trans('setting.of')}} @{{ totalOrders }} {{trans('setting.record')}}.
                    </div>
                </ecommerce-order>
                <hr>
            </div>
        </div>
    </div>
@stop
