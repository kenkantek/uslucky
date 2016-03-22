<template>
    <div class="portlet-title">
        <slot name="header"></slot>
        <div class="actions">
            <div class="btn-group">
                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-share"></i>
                    <span class="hidden-xs"> Tools </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right" id="datatable_ajax_tools">
                    <li>
                        <a href="javascript:;" data-action="0" class="tool-action">
                            <i class="icon-printer"></i> Print
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>