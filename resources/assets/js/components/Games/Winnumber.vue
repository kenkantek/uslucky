<template>
	<table class="table">
	    <tbody>
	        <tr>
	            <th colspan="2">Results</th>
	            <th>Date</th>
	            <th>PowerPlay</th>
	            <th>Estimated Jackpot</th>
	        </tr>
	        <tr>
	            <td class="c1">1</td>
	            <td>
	                <ul class="list">
	                    <li>19</li>
	                    <li>24</li>
	                    <li>45</li>
	                    <li>18</li>
	                    <li>36</li>
	                    <li class="powerball">5</li>
	                </ul>
	            </td>
	            <td>
	                <time datetime="2014-01-01">25/
	                    <br>06/
	                    <br>2014</time>
	            </td>
	            <td class="c1"><a href="#">3</a></td>
	            <td class="c1">$116,000,000.00</td>
	        </tr>  
	    </tbody>
	</table>
</template>

<script>
	import laroute from '../../laroute.js';
    import COMMON from '../../common';

    export default {
        data() {
            return {
                data: {},
                result: [],
            }
        },
        
    }
</script>