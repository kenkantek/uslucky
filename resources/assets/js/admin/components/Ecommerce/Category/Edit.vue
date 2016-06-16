<template>
	<loading v-if="$loadingAsyncData"></loading>
	<form
		v-else
		:action="urlSubmit"
		v-submit="formInputs"
	    :submiting='onSubmiting'
	    :complete='onComplete'
	    :error='onError'
	>
		<input name="_method" type="hidden" value="PUT">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" :class="{'has-error': formErrors.name}">
				    <label class="control-label" for="inputName">Category Name</label>
				    <input type="text" class="form-control" id="inputName" placeholder="Category Name" autocomplete="off" v-autofocus v-model="formInputs.name">
				    <span class="help-block" v-show="formErrors.name" v-text="formErrors.name"></span>
				</div>
				<div class="form-group" :class="{'has-error': formErrors.position}">
				    <label class="control-label" for="inputSortOrder">Sort Order</label>
				    <input type="number" step="1" min="1" class="form-control" id="inputSortOrder" autocomplete="off" v-model="formInputs.position">
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
		            	<i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Update
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
	import laroute from '../../../../laroute';
	import COMMON from '../../../../common';

	export default {
		props: {
			id: {
				type: [String, Number],
				required: true
			}
		},

		data() {
			return {
				formInputs: {
					relationship: {
						key: null
					}
				},
				formErrors: {},
				submiting: false
			}
		},

		computed: {
			urlSubmit() {
				return laroute.route('ecommerce.admin.ecommerce.category.update', { category: this.id });
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

		asyncData(resolve, reject) {
			this.$http.get(laroute.route('ecommerce.admin.ecommerce.category.show', {
				category: this.id
			})).then(({ data }) => {
				resolve({
					formInputs: {...this.formInputs, ...data}
				});
			}).catch(res => {
				COMMON.alertError();
			});
		},
	
		methods: {
			onSubmiting(data) {
			    this.submiting = true;
                this.formErrors = {};
			},
			onComplete({ redirect, message }) {
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