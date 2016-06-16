@extends('admin.layouts.master')

@section('title') All Categories @stop

@section('content')
    <h3 class="page-title"> Manage Categories
        <small>Categories</small>
    </h3>

    {!! Breadcrumbs::render('ecommerce.category.index') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="actions">
                            <a href="{{ route('ecommerce.admin.ecommerce.category.create') }}" class="btn btn-circle btn-default">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <ecommerce-category-list inline-template>
                            <loading v-if="$loadingAsyncData"></loading>
                            <div v-else class="example table-responsive">
                                <table class="table-striped table-checkable table table-hover table-bordered admin">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Category Name</th>
                                            <th>Parent Name</th>
                                            <th>Display</th>
                                            <th>Position</th>
                                            <th>Updated At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="category in categories">
                                            <td v-text="category.id"></td>
                                            <td v-text="category.name">Name</td>
                                            <td v-html="category.parent_id | parent categories">Parent ID</td>
                                            <td>
                                                <span class="label"
                                                    :class="{
                                                        'label-default': category.display == 0,
                                                        'label-info': category.display == 1
                                                    }"
                                                >
                                                    @{{ category.display ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td v-text="category.position">Position</td>
                                            <td v-text="category.updated_at">Updated At</td>
                                            <td class="text-center">
                                                <a class="label label-default" :href="category | linkEdit" title="Edit">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="label label-danger" href="#" @click.prevent="deleteCategory(category)" title="Delete">
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr v-if="!categories.length">
                                            <td colspan="7" class="text-center text-danger"> No have category</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </ecommerce-category-list>

                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
