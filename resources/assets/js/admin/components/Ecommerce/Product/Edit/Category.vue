<style scoped>
	.sub {
		margin-left: 20px;
	}
	h3 {
		margin-top: 0px;
	}
</style>

<template>
	<h3>Select categories</h3>
	<div class="col-md-12">
		<div class="checkbox" v-for="category in categories">
	        <input type="checkbox" id="category-{{ category.id }}" value="1" v-model="categoriesSelected[category.id]">
	        <label for="category-{{ category.id }}" v-text="category.name"></label>
	
			<div class="checkbox sub" v-for="cate in category.childrens">
	            <input type="checkbox" id="category-{{ cate.id }}" value="1" v-model="categoriesSelected[cate.id]">
	            <label for="category-{{ cate.id }}" v-text="cate.name"></label>
	      	</div>
	  	</div>
	</div>
</template>

<script>
	export default {
		props: {
			categories: {
				type: Array,
				required: true
			},
			categoriesSelected: {
				type: [Array, Object],
				required: true
			}
		}
	}

</script>