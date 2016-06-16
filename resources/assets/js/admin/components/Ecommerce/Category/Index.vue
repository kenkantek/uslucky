<script>
	import laroute from '../../../../laroute';
	import COMMON from '../../../../common';
	import FileterParent from '../../../filters/category-parent';

	export default {
		data() {
			return {
				categories: []
			}
		},

		asyncData(resolve, reject) {
			this.$http.get(laroute.route('ecommerce.category.api.index')).then(({ data }) => {
				resolve({
					categories: data
				});
			}, err => COMMON.alertError());
		},

		methods: {
			deleteCategory(category) {
				swal({
				    title: "Are you sure delete category?",
				    type: "info",
				    closeOnConfirm: false,
				    showLoaderOnConfirm: true,
				    showCancelButton: true,
				    closeOnConfirm: false,
				    showLoaderOnConfirm: true
				}, (isConfirm) => {
				    if(isConfirm) {

			    	    this.$http.delete(laroute.route('ecommerce.admin.ecommerce.category.destroy', { category: category.id }))
		    	    	.then(({ data: { message } }) => {
			    	    	swal.close();
			    			message && toastr.success(message);
			    			this.categories.$remove(category);
			    	    }, err => COMMON.alertError());

				    } else {
				        swal.close();
				    }
				});
			}
		},

		filters: {
			parent: FileterParent,
			linkEdit({ id }) {
				return laroute.route('ecommerce.admin.ecommerce.category.edit', { category: id });
			}
		}
		
	}

</script>