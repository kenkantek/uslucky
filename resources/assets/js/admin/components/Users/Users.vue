<template>	
    <table class="table table-hover table-light">
        <thead>
            <tr class="uppercase">
                <th colspan="2"> MEMBER </th>
                <th colspan="2"> Ticket total bought </th>
                <th> DEPOSIT Total </th>
                <th> WITHDRAW/CLAIM Total </th>
                <th> Blance </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="fit">
                    <img class="user-pic" src="{{asset('tadmin/assets/layouts/layout/img/avatar10.jpg')}}"> </td>
                <td>
                    <a href="javascript:;" class="primary-link">Brain</a>
                </td>
                <td> 5 </td>
                <td> $345 </td>
                <td> 45 </td>
                <td> 124 </td>
                <td>
                    <span class="bold theme-font">80%</span>
                </td>
                <td><a href="#" class="text-danger"><i class="fa fa-trash"></i></a></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
	import laroute from "../../../laroute";
	import COMMON from "../../../common";
	import deferred from 'deferred';

	export default{
		data() {
			return {
				users: [],
			}
		},	
	}
</script>