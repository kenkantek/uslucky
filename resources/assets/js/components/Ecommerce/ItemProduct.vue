<script>
	export default {
		props: {
			product: {
				coerce: function (val) {
		        	return JSON.parse(val);
		      	}
			}
		},

		data() {
			return {
				qty: 1
			}
		},

		methods: {
			addToCart() {
				for(var i = 1; i <= this.qty; i++) {
					this.$dispatch('add-cart', this.product);
				}
				toastr.success(`You have added ${this.product.name} to your shopping cart!`);
			},

			updateCountCart(cart, e) {
				const value = Math.max(parseInt(e.target.value), 0);
				if(value && value <= 999) {
					return true;
				} else {
					this.qty = 1;
					toastr.warning('Pleas enter number must be between 1 to 999');
					return false;
				}
			},
		}
	}	
</script>