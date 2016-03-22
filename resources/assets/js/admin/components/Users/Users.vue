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
                <img class="user-pic" src=""> </td>
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
            <td><a href="" style="color: #f60000"><i class="fa fa-trash"></i></a></td>
        </tr>
        <tr>
            <td class="fit">
                <img class="user-pic" src=""> </td>
            <td>
                <a href="javascript:;" class="primary-link">Nick</a>
            </td>
            <td> 5 </td>
            <td> $560 </td>
            <td> 12 </td>
            <td> 24 </td>
            <td>
                <span class="bold theme-font">67%</span>
            </td>
            <td><a href="" style="color: #f60000"><i class="fa fa-trash"></i></a></td>
        </tr>
        <tr>
            <td class="fit">
                <img class="user-pic" src=""> </td>
            <td>
                <a href="javascript:;" class="primary-link">Tim</a>
            </td>
            <td> 5 </td>
            <td> $1,345 </td>
            <td> 450 </td>
            <td> 46 </td>
            <td>
                <span class="bold theme-font">98%</span>
            </td>
            <td><a href="" style="color: #f60000"><i class="fa fa-trash"></i></a></td>
        </tr>
        <tr>
            <td class="fit">
                <img class="user-pic" src=""> </td>
            <td>
                <a href="javascript:;" class="primary-link">Tom</a>
            </td>
            <td> 5 </td>
            <td> $645 </td>
            <td> 50 </td>
            <td> 89 </td>
            <td>
                <span class="bold theme-font">58%</span>
            </td>
            <td><a href="" style="color: #f60000"><i class="fa fa-trash"></i></a></td>
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