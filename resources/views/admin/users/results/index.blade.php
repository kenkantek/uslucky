@extends('admin.layouts.master')

@section('title') All Winners @stop

@section('content')
 <h3 class="page-title"> Manage Users
        <small>All Winners</small>
    </h3>
    {!! Breadcrumbs::render('winner') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <winner-list>
                    <div class="caption" slot="header">
                        <i class="icon-user font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">All Winners</span>
                    </div>
                </winner-list>
            </div>
        </div>
    </div>
    <!-- END PORTLET -->
    </div>
</div>
</div>
@stop
