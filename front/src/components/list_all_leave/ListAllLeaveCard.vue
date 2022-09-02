<template>
  <div class="list_card">
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
          <tr v-for="list in filterData.slice().reverse()" :key="list">
            <td scope="row">{{ list.created_at }}</td>
            <td scope="row">{{ list.start_date }}</td>
            <td scope="row">{{ list.end_date }}</td>
            <td scope="row" style="max-width: 200px">{{ list.reason }}</td>
            <td scope="row">{{ list.duration }}</td>
            <td scope="row" :class="list.status.toLowerCase()">
              {{ list.status }}
            </td>
            <td scope="row">{{ list.leave_type }}</td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr>
            <td style="border: none"></td>
            <td style="border: none"></td>
            <td style="border: none"></td>
            <td
              style="
                border: none;
                color: red;
                font-size: 1.5rem;
                font-weight: bold;
              "
            >
              No leave found!
            </td>
            <td style="border: none"></td>
            <td style="border: none"></td>
            <td style="border: none"></td>
          </tr>
        </tbody>
      </table>
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
  width: 100%;
  margin-top: 2%;
  /* margin-left: 2.5%; */
}
table {
  width: 100%;
  box-sizing: border-box;
}

table,
tr,
th {
  border: 2px solid black;
  border-collapse: collapse;
  padding: 10px;
  text-align: center;
}
td {
  padding: 5px;
}
.padding,
.pending {
  color: orange;
  font-weight: bold;
  border-radius: 14px;
  font-size: 0.9rem;
}

.approved {
  color: rgb(0, 255, 0, 0.5);
  border-radius: 14px;
  font-weight: bold;
  font-size: 0.9rem;
}
.cancelled {
  color: #0000;
  font-weight: bold;
  border-radius: 14px;
  font-size: 0.9rem;
}
.reject {
  font-weight: bold;
  border-radius: 14px;
  color: red;
  font-size: 0.9rem;
}
</style>