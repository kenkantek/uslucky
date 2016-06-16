<template>
	<loading v-if="$loadingAsyncData"></loading>

	<div v-else>
		<div class="form-group">
		    <div class="input-group w-p-100">
		        <input type="text" class="form-control" placeholder="Search category..." v-model="category" @keypress.enter.stop.prevent>
		    </div>
		</div>
		<div class="category-list-autocomplete list-group">
			<a href="#"
				v-for="category in categories | filterBy category in 'name' "
				class="list-group-item"
				v-text="category.name" 
				@click.prevent="choose(category)"
			>
			</a>
		</div>
	</div>
	
</template>
<script>
	import laroute from '../../../../laroute';
	import COMMON from '../../../../common';

	export default {
		props: {
			data: {
				type: Object,
				required: true
			},
			current: {
				type: Object
			}
		},

		data() {
			return {
				category: '',
				categories: []
			}
		},

		asyncData(resolve, reject) {
			this.$http.get(laroute.route('ecommerce.category.api.autocomplete'), {
				data: this.data, 
				id: this.current ? this.current.id : this.current
			}).then(({ data }) => {
				resolve({
					categories: data
				});
			}, err => COMMON.alertError());
		},

		methods: {
			choose(category) {
				this.$dispatch('callback-choose', category);
			}
		}
	}

</script>