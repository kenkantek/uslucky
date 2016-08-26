@extends('admin.layouts.master')

@section('css')
    <link href="{{asset('tadmin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    {!! HTML::style('js/libs/summernote/summernote.css') !!}
@stop
@section('content')

    {!! Breadcrumbs::render('affiliate') !!}

    <div class="app-ticket app-ticket-list">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light " style="float: left; width: 100%">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Member not approved yet for Affiliate</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="col-md-12">
                            <non-approved inline-template>
                                <div class="portlet light ">
                                    <div class="portlet-body">
                                        <filter-tools :data.sync="data" :keyword.sync="keyword">
                                        </filter-tools>
                                        <div class="table-scrollable table-scrollable-borderless">
                                            <div v-if="$loadingAsyncData" class="move-top-10">
                                                <loading></loading>
                                            </div>
                                            <table v-else class="table-striped table-checkable table table-hover table-bordered admin">
                                                <thead>
                                                <tr class="uppercase">
                                                    {{--<th>--}}
                                                        {{--<input type="checkbox" v-model="checkAll">--}}
                                                    {{--</th>--}}
                                                    <th colspan="2"> MEMBER </th>
                                                    <th> Affiliate Type </th>
                                                    <th> Value (% or $) </th>
                                                    <th> Code </th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="user in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                                                    {{--<td>--}}
                                                        {{--<input type="checkbox" v-model="ids" :value="user.id">--}}
                                                    {{--</td>--}}
                                                    <td class="fit">
                                                        <img class="user-pic" :src="user.image" width="30px"> </td>
                                                    <td>
                                                        <a :href="user.id | linkShow" class="primary-link">@{{user.fullname}}</a>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <input type="radio" v-model="user.affiliate.type" :value="0" @change.prevent="onChange(user.id,$index)">
                                                            Non-approved
                                                        </label>&nbsp;&nbsp;
                                                        <label>
                                                            <input type="radio" v-model="user.affiliate.type" :value="1" @change.prevent="onChange(user.id,$index)">
                                                            Percent
                                                        </label>&nbsp;&nbsp;
                                                        <label>
                                                            <input type="radio" v-model="user.affiliate.type" :value="2" @change.prevent="onChange(user.id,$index)">
                                                            Cash
                                                        </label>
                                                    </td>
                                                    <td><input type="text" v-model="user.affiliate.avalue" class="form-control" placeholder="value" @keyup="onChange(user.id,$index) | debounce 500 "> </td>
                                                    <td class="font-blue-madison"> @{{user.affiliate.code}} </td>
                                                    <td>
                                                        <a class="label label-danger" href="" @click.prevent="onDelete(user.id)" title="Delete user"><i class="fa fa-remove"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </non-approved>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script src="{{asset('tadmin/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('tadmin/assets/pages/scripts/components-bootstrap-switch.min.js')}}" type="text/javascript"></script>
    {!! HTML::script('js/libs/summernote/summernote.min.js') !!}
@stop