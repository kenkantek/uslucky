@extends('admin.layouts.master')

@section('title') All Users @stop

@section('content')
 <h3 class="page-title"> Manage Users
        <small>All Users</small>
    </h3>
    {!! Breadcrumbs::render('user') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                            <users-list>
                                <div class="caption" slot="header">
                                    <i class="icon-user font-dark"></i>
                                    <span class="caption-subject font-dark sbold uppercase">All Users</span>
                                </div>
                            </users-list>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
