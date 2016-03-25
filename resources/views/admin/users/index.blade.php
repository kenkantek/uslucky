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
                            <users-list></users-list>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
        </div>
    </div>
@stop
