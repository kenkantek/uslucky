<script>
	import _ from 'lodash';
	import FormModal from './Checkout/FormModal.vue';

	export default {
		data() {
			return {
				submiting: false,
				carts_tmp: JSON.parse(localStorage.carts)
			}
		},

		computed: {
			carts() {
				return _
					.chain(this.carts_tmp)
					.groupBy('id')
					.mapValues(cart => {
						return {
							'id': cart[0].id,
							'count': cart.length,
							'data': cart[0]
						};
					})
					.toArray()
					.value();
			},
			total() {
				return this.carts.reduce((prev, cart) => {
					return prev + this.calcPrice(cart);
				}, 0);
			}
		},

		methods: {
			calcPrice(cart) {
				return parseInt(cart.count) *  parseFloat(cart.data.price)
			},

			deleteCart({ id }) {
				this.carts_tmp = this.carts_tmp.filter(cart => cart.id != id);
				this._updateCartLocalStoage(this.carts_tmp);
			},

			_updateCartLocalStoage(carts_tmp) {
				this.$dispatch('update-cart', carts_tmp);
			},

			updateCountCart(cart, e) {
				const value = Math.max(parseInt(e.target.value), 0);
				if(value && value <= 999) {
					//remove all
					const carts = this.carts_tmp.filter(c => c.id != cart.id);

					//add
					for (let i = 0; i < value; i++ ) {
						carts.push(cart);
					}
					this.carts_tmp = carts;

					this._updateCartLocalStoage(carts);
				} else {
					toastr.warning('Pleas enter number must be between 1 to 999');
					return false;
				}
			},

			openModal() {
				this.submiting = true;
			}
		},

		components: { FormModal }
	}
</script>