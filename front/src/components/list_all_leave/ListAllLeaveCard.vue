<template>
    <div class="list_card">
        <base_card>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Request Date</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Status</th>
                        <th scope="col">Leave Type</th>
                    </tr>
                </thead>
                <tbody v-if="filterData.length > 0">
                    <tr v-for="list in filterData" :key="list">
                        <td>{{list.created_at}}</td>
                        <td> {{list.start_date}}</td>
                        <td>{{list.end_date}}</td>
                        <td style="max-width:200px">{{list.reason}}</td>
                        <td>{{list.duration}}</td>
                        <td :class="list.status.toLowerCase()">{{list.status}}</td>
                        <td>{{list.leave_type}}</td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;color:red;font-size:2rem;font-weight:bold;">No leave found!</td>
                        <td style="border:none"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                    </tr>
                </tbody>
            </table>
        </base_card>
    </div>

</template>

<script>
import BaseCard from "@/components/UI/BaseCard.vue"
export default {
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
table{
    width:1200px;
    box-sizing: border-box;
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

.padding,.pending {
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
.reject {
    color:red;
    font-size: 1.2rem;
}
</style>