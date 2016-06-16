<template>
	
	<form
	    method="post"
	    :action="urlSubmit"
	    v-submit="formInputs"
	    :submiting='onSubmiting'
	    :complete='onComplete'
	    :error='onError'
	>

	    <div class="row">
	        <div class="col-sm-6">
	            <div class="form-group" :class="{'has-error': formErrors.name}">
	                <label class="control-label" for="inputName">Category Name</label>
	                <input type="text" class="form-control" id="inputName" placeholder="Category Name" autocomplete="off" v-autofocus v-model="formInputs.name">
	                <span class="help-block" v-show="formErrors.name" v-text="formErrors.name"></span>
	            </div>
	            <div class="form-group" :class="{'has-error': formErrors.position}">
	                <label class="control-label" for="inputSortOrder">Sort Order</label>
	                <input type="number" step="1" min="1" class="form-control" id="inputSortOrder" value="1" autocomplete="off" v-model="formInputs.position">
	                <span class="help-block" v-show="formErrors.position" v-text="formErrors.position"></span>
	            </div>
	            <div class="form-group" :class="{'has-error': formErrors.display}">
	                <div class="checkbox-custom checkbox-default">
	                    <input type="checkbox" id="inputDisplay" v-model="formInputs.display" value="1">
	                    <label for="inputDisplay">Display</label>
	                    <span class="help-block" v-show="formErrors.display" v-text="formErrors.display"></span>
	                </div>
	            </div>

	            <div class="form-group">
	                <button type="submit" class="btn btn-primary" :disabled="submiting">
	                    <i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Save
	                </button>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="form-group">
	                <label class="control-label">Relationship</label>
	                <div>
	                    <div class="radio-custom radio-default radio-inline">
	                        <input type="radio" id="inputNone" v-model="formInputs.relationship.key" value="0">
	                        <label for="inputNone">None</label>
	                    </div>
	                    <div class="radio-custom radio-default radio-inline">
	                        <input type="radio" id="inputParent" v-model="formInputs.relationship.key" value="1">
	                        <label for="inputParent">Parent</label>
	                    </div>
	                </div>
	                <relationship-parent
	                    v-if="formInputs.relationship.dirty.parent"
	                    v-show="formInputs.relationship.key == 1"
	                    :relationship-value.sync="formInputs.relationship.value"
	                ></relationship-parent>
	            </div>
	        </div>
	    </div>
	</form>

</template>

<script>
	import RelationshipParent from './Relationship/Parent.vue';

	import COMMON from '../../../../common';
	import laroute from '../../../../laroute';

	export default {
		data() {
			return {
				urlSubmit: laroute.route('ecommerce.admin.ecommerce.category.store'),
				formInputs: {
					display: true,
					relationship: {
						key: 0,
						value: null,
						dirty: {
							parent: false,
							children: false
						}
					}
				},
				formErrors: {},
				submiting: false
			}
		},
	
		watch: {
			'formInputs.relationship.key'(val) {
				switch(val) {
					case '1':
						this.formInputs.relationship.dirty.parent = true;
						break;
					case '2':
						this.formInputs.relationship.dirty.children = true;
						break;
					default:
						break;
				}
			}
		},
	
		methods: {
			onSubmiting(data) {
			    this.submiting = true;
                this.formErrors = {};
			},
			onComplete({ redirect, message }) {
			    message && toastr.success(message);
			    redirect && (window.location = redirect);
			    this.submiting = false;
			},
			onError(data, status) {
			    this.submiting = false;
			    if(status === 422) {
                    this.formErrors = data;
                    toastr.error(this.$l('message.check_field'));
                } else { //500
                    COMMON.alertError();
                }
			},
        },

        components: { RelationshipParent }
		
	}

</script>