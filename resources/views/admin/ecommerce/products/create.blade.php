@extends('admin.layouts.master')

@section('title') Add new Product @stop

@section('content')
    <h3 class="page-title"> Product
        <small>Create product</small>
    </h3>
    {!! Breadcrumbs::render('product.create') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">

                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Create product</span>
                            </div>

                            <div class="portlet-body">
                                <ecommerce-product-create inline-template>
                                    <form
                                        class="form-horizontal form-row-seperated"
                                        action="{{ route('ecommerce.admin.ecommerce.product.store') }}" method="post"
                                        v-submit="formData"
                                        :submiting='onSubmiting'
                                        :complete= 'onComplete'
                                        :error='onError'
                                    >

                                        <div class="form-group" :class="{'has-error': formErrors.name}">
                                            <label class="col-md-2 control-label">Name:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" v-model="formInputs.name">
                                                <span class="help-block" v-text="formErrors.name" v-show="formErrors.name"></span>
                                            </div>
                                        </div>

                                        <div class="form-group" :class="{'has-error': formErrors.price}">
                                            <label class="col-md-2 control-label">Price:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" v-model="formInputs.price">
                                                <span class="help-block" v-text="formErrors.price" v-show="formErrors.price"></span>
                                            </div>
                                        </div>

                                        <div class="form-group" :class="{'has-error': formErrors.description}">
                                            <label class="col-md-2 control-label">Description:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" v-model="formInputs.description"></textarea>
                                                <span class="help-block" v-text="formErrors.description" v-show="formErrors.description"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Thumb image:
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-10">
                                                <img v-base64="formInputs.thumb" height="100">
                                                <div class="margin-top-10" :class="{'has-error': formErrors.thumb}">
                                                    <input type="file" v-upload="formInputs.thumb" accept="image/*">
                                                    <span class="help-block" v-text="formErrors.thumb" v-show="formErrors.thumb"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="margin-top-10 clearfix form-group">
                                            <div class="col-md-10 col-md-offset-2">
                                                <button type="submit" class="btn green" :disabled="submiting">
                                                   <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Save
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </ecommerce-product-create>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
