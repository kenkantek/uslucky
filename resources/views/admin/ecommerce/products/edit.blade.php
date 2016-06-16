@extends('admin.layouts.master')

@section('title') Edit Product @stop

@section('content')

    <h3 class="page-title"> Product
        <small>Edit product</small>
    </h3>

    {!! Breadcrumbs::render('product.edit', $product) !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PORTLET -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light">

                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase">Edit product</span>
                            </div>

                            <div class="portlet-body">
                                <ecommerce-product-edit inline-template id="{{ $product->id }}" categories="{{ $categories }}">
                                    <div v-if="$loadingAsyncData">
                                        <loading></loading>
                                    </div>
                                    <form
                                        v-else
                                        class="form-horizontal form-row-seperated"
                                        action="{{ route('ecommerce.admin.ecommerce.product.update', $product->id) }}" method="post"
                                        v-submit="formData"
                                        :submiting='onSubmiting'
                                        :complete= 'onComplete'
                                        :error='onError'
                                    >
                                        <div class="row">
                                            <div class="col-md-6">
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
                                                    <label class="col-md-2 control-label">Images:
                                                    </label>
                                                    <div class="col-md-10">
                                                        <ul class="company-product-images clearfix">
                                                            <li v-for="image in formInputs.images">
                                                                <img v-base64="image" height="100">
                                                                <span @click="deleteImage(image)" title="Delete">
                                                                    <i class="fa fa-trash fa-2x"></i>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                        <div class="input-group input-group-file">
                                                            <input type="text" class="form-control" placeholder="Select multi file image" readonly>
                                                            <span class="input-group-btn">
                                                                <span class="btn btn-file">
                                                                    <i class="icon wb-upload"></i>
                                                                    <input type="file" accept="image/*" v-uploads="formInputs.images" multiple>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <category v-if="categories.length"
                                                :categories="categories"
                                                :categories-selected="formInputs.categories"
                                                ></category>

                                                <alert v-else type="info">
                                                    Please add new category
                                                    <a href="{{ route('ecommerce.admin.ecommerce.category.create') }}">
                                                        <small class="text-danger">click here</small>
                                                    </a>
                                                </alert>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <label class="col-md-1 control-label">Content:
                                                </label>
                                                <div class="col-md-10 transX13">
                                                    <div v-editor="formInputs.content">{!! $product->content !!}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-1 col-md-offset-1 transX13">
                                                    <button type="submit" class="btn green" :disabled="submiting">
                                                        <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </ecommerce-product-edit>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
@section('css')
    {!! HTML::style('js/libs/summernote/summernote.css') !!}
@stop
@section('script')
    {!! HTML::script('js/libs/summernote/summernote.min.js') !!}
@stop
