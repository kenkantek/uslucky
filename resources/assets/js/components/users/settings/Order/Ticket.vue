<template>
    <table style="margin:0" class="table table-bordered table-hover trans">
        <thead>
            <tr>
                <th>#</th>
                <th>Buy date</th>
                <th>Your number</th>
                <th>Price</th>
                <th>Status</th>
                <th>Draw date</th>
                <th>Reward</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2016-03-17 10:47:43</td>
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
                <td>$2</td>
                <td>Win</td>
                <td>16-3-2016</td>
                <td>$1.600.000.000</td>
            </tr>
        </tbody>
    </table>
</template>


<script>
import laroute from '../../../../laroute';
import BOX from '../../../../common';
import deferred from 'deferred';

export default {
    data() {
            return {
                tickets: [],
                total: null,
                numberMore: 10,
                loading: false,
                totalHistories: null,
                nextPageUrl: null
            }
        },
}
</script>
