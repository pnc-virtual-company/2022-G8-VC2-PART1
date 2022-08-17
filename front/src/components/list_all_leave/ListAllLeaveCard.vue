<template>
    <div class="list_card">
        <table>
            <tr>
                <th>Reauest Date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Leave Type</th>
            </tr>
            <tr v-for="list in filterData" :key="list">
                <td>{{list.request_date}}</td>
                <td>{{list.start_date}}</td>
                <td>{{list.end_date}}</td>
                <td>{{list.reason}}</td>
                <td>{{list.duration}}</td>
                <td>{{list.status}}</td>
                <td>{{list.leave_type}}</td>
            </tr>
        </table>
    </div>

</template>

<script>
export default {
    // props: ['request_date', 'start_date', 'end_date', 'reason', 'duration', 'status', 'leave_type'],
    inject: ['list_all_leaves'],
    props:['filterData']
}
</script>

<style scoped>





.list_card {
    background: #ffff;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 1px, rgb(51, 51, 51) 0px 0px 0px 1px;
}
table,
tr,
th,td {

    border: 1px solid black;
    border-collapse: collapse;
    padding: 10px;

}
th {
    background: #63BFE7;
    color:#fff;
}
</style>