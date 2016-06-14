<template>
	<div class="portlet light ">
	    <slot slot="header" name="header"></slot>
        <loading v-if="$loadingAsyncData"></loading> 
	    <div v-else class="portlet-body">
	        <form>
	        	<div class="form-group" v-for="setting in settings">
	        		<label class="form-label text-capitalize" v-text="setting.key | rmUnderscore"></label>
	        		<input @change="onChange(setting.id) | debounce 300" class="form-control" type="number" v-model="setting.value" min="1" step="1">
	        	</div>
	        </form>
	    </div>
	</div>
</template>

<script>
	import laroute from '../../../laroute';
	import COMMON from '../../../common';

	export default{
        props: ['id'],
		data() {
			return {
				settings: [],
				formErrors: {}
			}
		},

		asyncData(resolve, reject) {
            this.$http.get(laroute.route('admin.get.managegame',{ id: this.id })).then(res => {
                const settings = res.data;
                resolve({
                    settings
                });
            }, (res) => {
                COMMON.alertError();
            });
        },

        methods: {
        	onChange(id) {
        		for(let setting in this.settings)
        		{
        			if(this.settings[setting].id == id) {
        				const value = this.settings[setting];
        				this.$http.put(laroute.route('admin.games.update', { games: id} ), value).then(res => {
                            toastr.success('Game setting was changed!');
                        }, res => {
                            if(res.status === 500) {
                                COMMON.alertError();
                            } else {
                                toastr.error(res.data.value);
                            }
                        });
        				
        			}	
        		}	
        	}
        },

        filters: {
            rmUnderscore(val) {
                return val.replace(/\_/g, ' ');
            }
        }
	}
</script>