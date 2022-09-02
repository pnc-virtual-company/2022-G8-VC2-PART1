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
  inject: ["list_all_leaves"],
  props: ["filterData"],
};
</script>

<style scoped>
.list_card {
  background: #ffff;
  width: 90%;
  margin-left: 2.5%;
}
table {
  /* width: 1000px; */
  width: 100%;
  box-sizing: border-box;
}

table,
tr,
th {
  border: 2px solid black;
  border-collapse: collapse;
  padding: 15px;
  text-align: center;
  padding: 5px;
}
td {
  padding: 5px;
}
li {
  list-style: none;
}
.padding,
.pending {
  color: orange;
  font-weight: bold;
  border-radius: 14px;
  /* background: orange; */
  font-size: 0.9rem;
}

.approved {
  color: rgb(0, 255, 0, 0.5);
  border-radius: 14px;
  font-weight: bold;
  /* background: rgb(0, 255, 0, 0.5); */
  font-size: 0.9rem;
}
.cancelled {
  color: #0000;
  font-weight: bold;
  border-radius: 14px;
  /* background: #0000; */
  font-size: 0.9rem;
}
.reject {
  font-weight: bold;
  border-radius: 14px;
  color: red;
  /* background: red; */
  font-size: 0.9rem;
}
</style>