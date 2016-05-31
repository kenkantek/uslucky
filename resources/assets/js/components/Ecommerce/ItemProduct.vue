<script>
	export default {
		props: {
			product: {
				coerce: function (val) {
		        	return JSON.parse(val);
		      	}
			}
		},

		methods: {
			addToCart() {
				this.$dispatch('add-cart', this.product);
				toastr.success(`You have added ${this.product.name} to your shopping cart!`);
			}
		}
	}	
</script>