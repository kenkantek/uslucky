<template>
	<table class="table table-striped table-bordered table-hover table-checkable order-column">
        <thead>
            <tr>        
                <th> ID # </th>
                <th> Cust. Name </th>
                <th> Cust. Email </th>
                <th> Date/Time </th>
                <th> Status </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="contact in contacts" track-by="$index">
              <td>
                    <a :href="contact.url">{{contact.id}}</a>
                </td>
                <td> <a :href="contact.url">{{contact.name}} </a></td>
                <td>
                    <a href="mailto:{{contact.email}}"> {{contact.email}} </a>
                </td>
                <td class="center"> {{contact.created_at}}</td>
                <td>
                    <span class="label label-sm label-warning"> {{contact.status}} </span>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
	import laroute from '../../../laroute';
	 import COMMON from '../../../common';

	export default{
		data(){
			return{
				contacts : [],
			}
		},

		asyncData(resolve, reject){
            this.$http.get(laroute.route('admin.get.contacts')).then(res => {
                const { data } = res;
                resolve({
                    contacts: data.data
                });
            }, (res) => {
                COMMON.alertError();
            });
        },

	}

</script>