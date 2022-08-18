<template>
    <div class="list_card">
        <base_card>
            <table>
                <tr>
                    <th>Request Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reason</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Leave Type</th>
                </tr>
                <tr v-for="list in filterData" :key="list">
                    <td>{{list.created_at}}</td>
                    <td>{{list.start_date}}</td>
                    <td>{{list.end_date}}</td>
                    <td>{{list.reason}}</td>
                    <td>{{list.duration}}</td>
                    <td :class="list.status.toLowerCase()">{{list.status}}</td>
                    <td style="width:120px">{{list.leave_type}}</td>
                </tr>
            </table>
        </base_card>
    </div>

</template>

<script>
import BaseCard from "@/components/UI/BaseCard.vue"
export default {
    // props: ['request_date', 'start_date', 'end_date', 'reason', 'duration', 'status', 'leave_type'],
    inject: ['list_all_leaves'],
    props: ['filterData'],
    components: {
        "base_card":BaseCard,
    }
}
</script>

<style scoped>




.list_card {
    background: #ffff;
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
.padding{
    color:gold;
    font-size: 1.2rem;
}
.approve{
    color:rgb(0, 255, 0);
    font-size: 1.2rem;
}
.cancelled{
    color:#000;
    font-size: 1.2rem;
}
.rejected {
    color:red;
    font-size: 1.2rem;
}
</style>