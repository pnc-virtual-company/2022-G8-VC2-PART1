<template>
    <div class="list_card">
        <li>
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
                    <tr v-for="list  in filterData" :key="list">
                        <td scope="row">{{list.created_at}}</td>
                        <td scope="row"> {{list.start_date}}</td>
                        <td scope="row">{{list.end_date}}</td>
                        <td scope="row" style="max-width:200px">{{list.reason}}</td>
                        <td scope="row">{{list.duration}}</td>
                        <td scope="row" :class="list.status.toLowerCase()">{{list.status}}</td>
                        <td scope="row">{{list.leave_type}}</td>
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
        </li>
    </div>

</template>

<script>
export default {
    inject: ['list_all_leaves'],
    props: ['filterData'],

}
</script>

<style scoped>




.list_card {
    background: #ffff;
    width: 100%;

}
table {
    width: 1200px;
    box-sizing: border-box;
}

table,
tr,
th {
    border: 2px solid black;
    border-collapse: collapse;
    padding: 15px;
    text-align: center;

}
td{
    padding: 5px;
}
li {
    list-style: none;
}
.padding,.pending {
    color:orange;
    font-weight: bold;
    font-size: 1.2rem;
}

.approve{
    color:rgb(0, 255, 0);
    font-weight: bold;
    font-size: 1.2rem;
}
.cancelled{
    color:#000;
    font-size: 1.2rem;
    font-weight: bold;
}
.reject {
    font-weight: bold;
    color:red;
    font-size: 1.2rem;
}
</style>