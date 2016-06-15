<style scoped>
	.input-group {
		position: relative;
	}

	.autocomplete {
		position: absolute;
		width: 100%;
		top: 34px;
		left: 0px;
	}
</style>
<template>
	
	<div class="input-group">
	    <span class="input-group-addon">
	        <i class="fa fa-puzzle-piece"></i>
	    </span>
	    <input type="text" class="form-control" placeholder="Search discount name" v-model="keyword" @keyup="searchDiscount | debounce 300" @focus="searching = true">
		<div class="autocomplete" @mouseleave="searching = false | debounce 500" v-show="searching">
			<ul class="list-group">
				<a href="#" class="list-group-item" 
					v-for="discount in discounts" 
					@click.prevent="addDiscount(discount)"
				>
					{{ discount.name }}
					<span class="badge">
						{{ discount.value }}% - {{ discount.status }}
					</span>
				</a>
			</ul>
		</div>
	</div>

	<div class="table-scrollable">
	    <table class="table table-hover">
	        <thead>
	            <tr>
	                <th>Name</th>
	                <th>Code</th>
	                <th class="text-center">Discount</th>
	                <th>Begin at</th>
	                <th>End at</th>
	                <th>Status</th>
	                <th class="text-center">Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<tr v-for="discount in game.discounts">
	        	    <td v-text="discount.name"></td>
	        	    <td v-text="discount.code"></td>
	        	    <td class="text-center">{{ discount.value }}%</td>
	        	    <td v-text="discount.begin_at"></td>
	        	    <td v-text="discount.end_at"></td>
	        	    <td>
	        	    	<span class="label label-sm" 
		        	        :class="[discount.status === 'expired' || discount.status === 'disabled' ? 'label-danger' : 'label-success']"
		        	        v-text="discount.status"
	        	        >
	        	        </span>
	        	    </td>
	        	    <td class="text-center">
	        	    	<a class="label label-danger" href="#" @click.prevent="remove(discount)">
	        	    		<i class="fa fa-remove"></i> remove 
	        	    	</a>
	        	    </td>
	        	</tr>

	        	<tr v-if="!game.discounts.length">
	                <td colspan="6" class="text-center text-danger">No discount.</td>
	            </tr>
	        </tbody>
	    </table>
	</div>


</template>

<script>
	import laroute from '../../../laroute';
	import COMMON from '../../../common';
	import _ from 'lodash';

	export default {
		props: {
			game: {
				type: Object,
				required: true
			}
		},

		data: () => ({
			searching: false,
			discounts: [],
			keyword: ''
		}),

		methods: {
			searchDiscount() {
				this.$http.get(laroute.route('admin.api.discounts.autocomplete'), {
					keyword: this.keyword
				}).then(({ data }) => {
					this.discounts = data;
					this.searching = true;
				}, err => COMMON.alertError());
			},
			remove(discount) {
				this.$http.delete(laroute.route('admin.api.game.discount.delete', {
					discount: discount.id,
					game: this.game.id
				})).then(res => {
					this.game.discounts.$remove(discount);
				}, err => COMMON.alertError());
			},
			addDiscount(discount) {
				const d = _.chain(this.game.discounts)
					.find({ id: discount.id })
					.value();

				if(d) {
					return toastr.warning('Discount exists');
				}
				this.$http.post(laroute.route('admin.api.game.discount.delete', {
					discount: discount.id,
					game: this.game.id
				})).then(({ data }) => {
					this.searching = false;
					this.game.discounts.unshift(data);
				}, err => COMMON.alertError());
			}
		}
	}


</script>