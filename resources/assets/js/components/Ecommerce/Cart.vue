<template>
	
	<span class="cart">
		{{ carts.length }}
	</span>

</template>>
<script>
	
	export default {
		data() {
			const carts = localStorage.carts ? JSON.parse(localStorage.carts) : [];

			carts.length || (localStorage.carts = JSON.stringify(carts));

			return {
				carts
			}
		},

		watch: {
			carts: {
				deep: true,
				handler(carts) {
					localStorage.carts = JSON.stringify(carts);
				}
			}
		},

		events: {
			'add-cart'(product) {
				this.carts.push(product);
			},
			'update-cart'(carts) {
				this.carts = carts;
				localStorage.carts = JSON.stringify(carts);
			}
		}
	}

</script>