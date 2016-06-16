@extends('admin.layouts.master')

@section('title') Create Discount @stop

@section('content')

    <h3 class="page-title"> Manage Discounts
        <small>Create discount</small>
    </h3>

    {!! Breadcrumbs::render('discount.create') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">Create discount</span>
                        </div>

                    </div>

                    <div class="portlet-body">
                        <discount-edit inline-template :form-inputs="{{ $discount }}">
                            <form
                                action="{{ route('admin.discount.update', $discount->id) }}" novalidate
                                v-submit="formInputs"
                                :submiting="onSubmiting"
                                :complete="onComplete"
                                :error="onError"
                            >
                                <input name="_method" type="hidden" value="PUT">
                                <div class="row">

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group" :class="{'has-error': formErrors.name}">
                                            <label class="control-label">Discount name</label>
                                            <input type="text" autocomplete="off" placeholder="Discount name" class="form-control" v-model="formInputs.name">
                                            <span class="help-block" v-show="formErrors.name" v-text="formErrors.name"></span>
                                        </div>
                                        <div class="form-group" :class="{'has-error': formErrors.description}">
                                            <label class="control-label">Description</label>
                                            <textarea class="form-control" placeholder="Content" rows="5" v-model="formInputs.description"></textarea>
                                            <span class="help-block" v-show="formErrors.description" v-text="formErrors.description"></span>
                                        </div>
                                        <div class="form-group" :class="{'has-error': formErrors.value}">
                                            <label class="control-label">Discount <strong>(percent)</strong></label>
                                            <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Discount" v-model="formInputs.value">
                                                <div class="input-group-addon">
                                                    %
                                                </div>
                                            </div>
                                            <span class="help-block" v-show="formErrors.value" v-text="formErrors.value"></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="mt-checkbox-inline">
                                                <label class="mt-checkbox">
                                                    <input v-model="formInputs.active" type="checkbox" value="1"> Active
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group" :class="{'has-error': formErrors.code}">
                                            <label class="control-label">Code</label>
                                            <input type="text" autocomplete="off" placeholder="Code" class="form-control text-uppercase" v-model="formInputs.code">
                                            <span class="help-block" v-show="formErrors.code" v-text="formErrors.code"></span>
                                        </div>
                                        <div class="form-group" :class="{'has-error': formErrors.begin_at}">
                                            <label class="control-label">Begin at</label>
                                            <date-picker :value.sync="formInputs.begin_at" format="YYYY-MM-DD"></date-picker>
                                            <span class="help-block" v-show="formErrors.begin_at" v-text="formErrors.begin_at"></span>
                                        </div>
                                        <div class="form-group" :class="{'has-error': formErrors.end_at}">
                                            <label class="control-label">End at</label>
                                            <date-picker :value.sync="formInputs.end_at" format="YYYY-MM-DD"></date-picker>
                                            <span class="help-block" v-show="formErrors.end_at" v-text="formErrors.end_at"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <button type="submit" class="btn green" :disabled="submiting">
                                        <span v-show="submiting">Saving...</span>
                                        <span v-else>Save</span>
                                    </button>
                                </div>
                            </form>
                        </discount-edit>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
