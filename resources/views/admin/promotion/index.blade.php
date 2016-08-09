@extends('admin.layouts.master')

@section('css')
    <link href="{{asset('tadmin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
    {!! HTML::style('js/libs/summernote/summernote.css') !!}
@stop
@section('content')

    {!! Breadcrumbs::render('contact') !!}

    <div class="app-ticket app-ticket-list">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light " style="float: left; width: 100%">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase">Promotion Manage</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="col-md-9">
                            <promotion inline-template>
                                <form @submit.prevent="onSubmit" novalidate>
                                    <div class="form-group">
                                        <label for="name">Title</label>
                                        <input type="text" v-model="inputs.name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Minimum value $</label>
                                        <input type="number" v-model="inputs.amount" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label for="status">Status: </label>
                                        	<label style="margin-left: 40px">
                                        		<input @change.prevent="onCheck" type="checkbox"  v-model="inputs.status" style="position: inherit; margin: 0">
                                        		<span v-text="status"></span>
                                        	</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Contents</label><br>
                                        <div v-editor="inputs.contents">{!! $promotion->contents !!}</div>
                                    </div>
                                    <div class="form-group">
                                        <button :disabled="submitting" type="submit" class="btn green">Update</button>
                                        <button type="reset" class="btn red">Reset</button>
                                    </div>
                                </form>
                            </promotion>
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