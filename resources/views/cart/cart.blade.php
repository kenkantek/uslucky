@extends('layouts.master')

@section('title' , 'Your Cart')

@section('content')
    <div class="bg4 p8">
        <div class="container cart-page">
            <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-default">
                    	<!-- Default panel contents -->
                        <div class="panel-heading">
                            <h3 class="panel-title">All items in your cart</h3>
                        </div>
                        <table class="table table-cart">
                            <thead>
                                <th colspan="2">Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="http://dummyimage.com/300x200/000/fff" width="100px" alt="">
                                    </td>
                                    <td>
                                        <a href="">Product names</a>
                                    </td>
                                    <td>$100</td>
                                    <td>
                                        <input type="text" width="30px" value="4">
                                    </td>
                                    <td>$400</td>
                                    <td width="20px"><a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="panel panel-info">
                    	  <div class="panel-body">
                    			<span style="float: left">Sum:</span> <span style="float: right">$400</span>
                                <hr>
                                <span style="float: left">Total:</span> <span style="float: right" class="price">$400</span><br>
                                <i style="font-size: 10px">(included VAT)</i>
                    	  </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{route('front::cart.checkout')}}" class="btn btn-danger cart-button">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop