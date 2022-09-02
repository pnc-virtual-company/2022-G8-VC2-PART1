<template>
  <div class="card_1">
    <div class="card-header d-flex justify-content-between align-center">
      <div></div>
      <h2 class="fs-4 text-center">
        Detail information of {{ student.first_name }} {{ student.last_name }}
      </h2>
      <div>
        <router-link to="/studentlist" class="btn btn-close btn-close-danger"></router-link>
      </div>
    </div>
    <div class="card-body d-flex justify-content-between align-items-center">
      <div class="side-lefttext-center">
        <img
          class="profile-img"
          :src="
            student.image != undefined
              ? 'http://127.0.0.1:8000/api/students/image/' + student.image
              : ''
          "
          style="width: 165px; height: 165px; border: 2px solid #ccc"
        />
      </div>
      <div class="side-right">
        <div class="firstname">
          Firstname <span style="margin-left: 5px">:</span>
          <strong style="font-weight: normal; margin-left: 10px">{{
            student.first_name
          }}</strong>
          <span style="font-weight: normal; margin-left: 40px">
            Student ID <span style="margin-left: 7px">:</span>
            <strong style="font-weight: normal; margin-left: 10px">{{
              student.studentID
            }}</strong>
          </span>
        </div>
        <div class="lastname">
          Lastname <span style="margin-left: 6px">:</span>
          <strong style="font-weight: normal; margin-left: 10px">{{
            student.last_name
          }}</strong>
        </div>
        <div class="gender">
          Gender <span style="margin-left: 27px">:</span>
          <strong style="font-weight: normal; margin-left: 10px">{{
            student.gender
          }}</strong>
        </div>
        <div class="batch">
          Batch <span style="margin-left: 42px">:</span>
          <strong style="font-weight: normal; margin-left: 10px">{{
            student.batch
          }}</strong>
        </div>
        <div class="email">
          Email <span style="margin-left: 43px">:</span>
          <strong style="font-weight: normal; margin-left: 10px">{{
            student.email
          }}</strong>
        </div>
        <div class="phone">
          Phone <span style="margin-left: 35px">:</span>
          <strong style="font-weight: normal; margin-left: 10px">
            {{ student.phone }}</strong
          >
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="leave_data">
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
          <tbody v-if="countLeaves > 0">
            <tr v-for="leave of student.leaves.slice().reverse()" :key="leave">
              <td scope="row">{{ leave.created_at }}</td>
              <td scope="row">{{ leave.start_date }}</td>
              <td scope="row">{{ leave.end_date }}</td>
              <td scope="row" style="max-width: 200px">{{ leave.reason }}</td>
              <td scope="row">{{ leave.duration }}</td>
              <td scope="row" :class="leave.status.toLowerCase()">
                {{ leave.status }}
              </td>
              <td scope="row">{{ leave.leave_type }}</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td scope="row"></td>
              <td scope="row"></td>
              <td scope="row"></td>
              <td
                style="
                  border: none;
                  color: red;
                  font-size: 1.5rem;
                  font-weight: bold;
                "
              >
                No leave request!
              </td>
              <td scope="row"></td>
              <td scope="row"></td>
              <td scope="row"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="btn d-flex justify-content-center align-items-center">
        <router-link class="btn text-center bg-danger" to="/studentlist"
          >Back</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "student",
    "leaves",
    "countApproved",
    "countRejected",
    "countPending",
    "countLeaves",
  ],
};
</script>
<style scoped>
table {
  width: 100%;
  box-sizing: border-box;
}

table,
tr,
th {
  border: 1px solid #ccc;
  border-collapse: collapse;
  padding: 5px;
  text-align: center;
}
thead {
  background: #63bfe7;
  color: #fff;
}
td {
  padding: 5px;
  font-size: 0.9rem;
}
.side-left{
  width: 25%;
  font-size: 1.1rem;
}
.side-right{
  width: 75%;
  font-size: 1.1rem;
}
.card_1 {
  margin-top: 6%;
  width: 70%;
  margin-left: 15%;
  border-radius: 7px;
  background: #fff;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
}
.card-header {
  background: #63bfe7;
  border-radius: 8px 8px 0 0;
  text-align: center;
  color: white;
}
.card-footer {
  background: none;
  border: none;
}
.btn a {
  width: 15%;
  font-size: 1rem;
  color: #fff;
  margin-top: 2%;
}
.padding,
.pending {
  color: orange;
  font-size: 1rem;
}

.approved {
  color: rgb(0, 255, 0);
  font-size: 1rem;
}

.cancelled {
  color: #000;
  font-size: 1rem;
}

.rejected {
  color: red;
  font-size: 1rem;
}
</style>