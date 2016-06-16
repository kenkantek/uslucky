<template>
        <div class="v-autocomplete clearfix">
        	<div class="list-group bg-blue-grey-100 bg-inherit">
        		<a v-if="relationshipValue" class="list-group-item blue-grey-500" href="#" @click.prevent="editCategory">
        			{{ relationshipValue.name }} <i class="pull-right fa fa-pencil fa-2x"></i>
        		</a>
        	</div>
    		<category-box 
    			v-if="statusOpen || !relationshipValue"
				:data="query"
				:current="relationshipValue"
    		>
    		</category-box>
        </div>
</template>

<script>
	import CategoryBox from '../../Autocomplete/Category.vue';

	export default {

		props: {
			relationshipValue: {
				type: [Array, Object],
				default: null
			}
		},

		data() {
			return {
				statusOpen: false,
				query: {
					parent_id: 0
				}
			}
		},

		methods: {
			editCategory() {
				this.statusOpen = !this.statusOpen;
			}
		},

		components: { CategoryBox },

		events: {
			'callback-choose'(category) {
				this.relationshipValue = category;
				this.statusOpen = false;
			}
		}
	}

</script>