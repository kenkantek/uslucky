<template>
	<div class="portlet light ">
	    <slot slot="header" name="header"></slot>
	    <div class="portlet-body">
	        <form>
	        	<div class="form-group" v-for="powerball in games">
	        		<label class="form-label" v-text="powerball.key"></label>
	        		<input @change.prevent="onChange(powerball.id)" class="form-control" type="text" v-model="powerball.value" placeholder="1">
	        	</div>
	        </form>
	    </div>
	</div>
</template>

<script>
	import laroute from '../../../laroute.js';
	import COMMON from '../../../common.js';

	export default{
		data(){
			return {
				games: {},
				formErrors: {}
			}
		},

		asyncData(resolve, reject){
            this.$http.get(laroute.route('admin.get.powerball')).then(res => {
                const games = res.data;

                resolve({
                    games
                });

            }, (res) => {
                COMMON.alertError();
            });
        },

        methods:{
        	onChange(id){
        		for(const game in this.games)
        		{
        			if(this.games[game].id == id)
        			{
        				const value = this.games[game];
        				this.$http.put(laroute.route('admin.games.powerball.update', {'powerball':id} ),value);
        				toastr.success('Game setting was changed!');
        			}	
        		}	
        	}
        }
	}
</script>