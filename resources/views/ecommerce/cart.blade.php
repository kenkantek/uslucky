@extends('layouts.master')

@section('title' , 'Your Cart')

@section('content')
    <div class="bg4 p8">
        <div class="container cart-page">
            <manage-cart inline-template>
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel panel-default">
                        	<!-- Default panel contents -->
                            <div class="panel-heading">
                                <h3 class="panel-title">All items in your cart</h3>
                            </div>

                                <table class="table table-cart table-bordered">
                                    <thead>
                                        <th colspan="2">Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cart in carts">
                                            <td>
                                                <img :src="cart.data.thumb" height="100"/>
                                            </td>
                                            <td>
                                                <a :href="cart.data.id | linkProduct" v-text="cart.data.name">Name</a>
                                            </td>
                                            <td>@{{cart.data.price | currency}}</td>
                                            <td>
                                                <input width="100" type="number" step="1" min="1" :value="cart.count" @change="updateCountCart(cart.data, $event)">
                                            </td>
                                            <td v-text="calcPrice(cart) | currency">Total</td>
                                            <td>
                                                <a href="#" class="btn btn-danger" @click.prevent="deleteCart(cart)">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr v-if="!carts.length">
                                            <td colspan="6">Cart empty</td>
                                        </tr>
                                    </tbody>
                                </table>

                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="panel panel-info">
                        	  <div class="panel-body">
                        			<span class="pull-left">Sum:</span>
                                    <span class="pull-right" v-text="total | currency"></span>
                                    <hr>
                                    <span class="pull-left">Total:</span>
                                    <span class="pull-right" class="price" v-text="total | currency"></span>
                        	  </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button
                                    class="btn btn-danger cart-button" :class="{disabled: !total}"
                                    data-toggle="modal"
                                    data-target="#ModalPayment"
                                    data-backdrop="static"
                                    data-keyboard="false"
                                    type="button"
                                    @click.prevent="openModal"
                                >
                                    Check Out
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalPayment" tabindex="-1" role="dialog">
                    <form-modal v-if="submiting" :submiting.sync="submiting" :total="total" :carts="carts"></form-modal>
                </div>
            </manage-cart>
        </div>
    </div>
@stop

@section('scripts')
{!! HTML::script('https://js.stripe.com/v2/') !!}
<script type="text/javascript">
    Stripe.setPublishableKey(_stripe.key);
</script>
@stop
