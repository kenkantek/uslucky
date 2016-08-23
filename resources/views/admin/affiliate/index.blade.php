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
                            <member-list inline-template>
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
                                                    <th>
                                                        <input type="checkbox" v-model="checkAll">
                                                    </th>
                                                    <th colspan="2"> MEMBER </th>
                                                    <th colspan="2"> Ticket total bought </th>
                                                    <th> DEPOSIT Total </th>
                                                    <th> WITHDRAW/CLAIM Total </th>
                                                    <th> Blance </th>
                                                    <th>Actived</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="user in data.data" :class="[$index % 2 == 0 ? 'odd' : 'even']">
                                                    <td>
                                                        <input type="checkbox" v-model="ids" :value="user.id">
                                                    </td>
                                                    <td class="fit">
                                                        <img class="user-pic" :src="user.image" width="30px"> </td>
                                                    <td>
                                                        <a :href="user.id | linkShow" class="primary-link">@{{user.fullname}}</a>
                                                    </td>
                                                    <td> @{{user.ticket_total}} </td>
                                                    <td> @{{user.price_total | currency}} </td>
                                                    <td class="font-blue-madison"> +@{{user.deposit_total | currency}} </td>
                                                    <td class="font-red-mint"> -@{{user.withdraw_total | currency}} </td>
                                                    <td>
                                                        <span class="bold theme-font">@{{user.balance | currency}}</span>
                                                    </td>
                                                    <td>
                                                        <a v-if="user.active == 0" class="label label-danger" href="#" @click.prevent="onActive(user.id)" title="Active user">Active</a>
                                                        <span v-else class="label label-success">Actived</span>
                                                    </td>
                                                    <td>
                                                        <a class="label label-danger" href="" @click.prevent="onDelete(user.id)" title="Delete user"><i class="fa fa-remove"></i></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </member-list>
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