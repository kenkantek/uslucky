<template>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="dataTables_length">
                <label>Show
                    <select class="form-control input-sm input-xsmall input-inline">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="0">200</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="pull-right">
                <label>Search:
                    <input type="search" class="form-control input-sm input-small input-inline" placeholder="keyword ...">
                </label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>