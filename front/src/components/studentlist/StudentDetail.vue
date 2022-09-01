<template>
  <div class="card_1">
    <div class="card-header d-flex justify-content-between align-center">
      <div></div>
      <h2 class="fs-4 text-center">
        Detail information of {{student.first_name}} {{student.last_name}}
      </h2>
      <div>
        <router-link to="/studentlist" class="btn btn-close fs-5 "></router-link>
      </div>
    </div>
    <div class="card-body d-flex justify-content-between  align-items-center">
      <div class="side-left w-50  text-center">
        <img src="../../assets/boy.png" style="width:150px; height:150px" alt="">
      </div>
      <div class="side-right w-50  fs-5 ">
        <div class="firstname">
          Firstname <span style="margin-left:5px">:</span> <strong
            style="font-weight:bold">{{student.first_name}}</strong>
          <span style="font-weight:normal; margin-left:40px">
            Student ID <span style="margin-left:7px">:</span> <strong
              style="font-weight:bold;">{{student.studentID}}</strong>
          </span>
        </div>
        <div class="lastname ">
          Lastname <span style="margin-left:10px">:</span> <strong
            style="font-weight:bold;">{{student.last_name}}</strong>
        </div>
        <div class="gender ">
          Gender <span style="margin-left:36px">:</span> <strong style="font-weight:bold;">{{student.gender}}</strong>
        </div>
        <div class="batch ">
          Batch <span style="margin-left:50px">:</span> <strong style="font-weight:bold;">{{student.batch}}</strong>
        </div>
        <div class="email ">
          Email <span style="margin-left:48px">:</span> <strong style="font-weight:bold;">{{student.email}}</strong>
        </div>
        <div class="phone">
          Phone <span style="margin-left:44px">:</span> <strong style="font-weight:bold"> 0{{student.phone}}</strong>
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
          <tbody v-if="countLeaves>0">
            <tr v-for="leave of student.leaves.slice().reverse()" :key="leave">
              <td scope="row">{{leave.created_at}}</td>
              <td scope="row">{{leave.start_date}} </td>
              <td scope="row">{{leave.end_date}}</td>
              <td scope="row" style="max-width:200px"> {{ leave.reason}}</td>
              <td scope="row">{{leave.duration}}</td>
              <td scope="row" :class="leave.status.toLowerCase()">{{leave.status}}</td>
              <td scope="row">{{leave.leave_type}}</td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td scope="row"></td>
              <td scope="row"> </td>
              <td scope="row"></td>
              <td style="border:none;color:red;font-size:2rem;font-weight:bold;">No leave request!</td>
              <td scope="row"></td>
              <td scope="row"></td>
              <td scope="row"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="btn d-flex justify-content-center align-items-center">
        <router-link class="btn  text-center bg-danger" to="/studentlist">Back</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['student','leaves', 'countApproved', 'countRejected', 'countPending', 'countLeaves'],
  components: {
  },
}
</script>
<style scoped>


 table {
   width: 100%;
   box-sizing: border-box;
 }

 table,
 tr,
 th {
   border: 2px solid black;
   border-collapse: collapse;
   padding: 5px;
   text-align: center;

 }
thead {
  background: #63BFE7;
  color:#fff;
}
 td {
   padding: 5px;
 }
.card_1 {
  margin-top: 6%;
  width: 70%;
  margin-left: 15%;
  border-radius: 8px;
  background: #fff;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
  
}
.card-header {
  background: #63BFE7;
  border-radius: 8px 8px 0 0;
  text-align: center;
  color: white
}
.card-footer{
  background: none;
  border:none;
}
.btn a{
  width: 15%;
  font-size: 1.2rem;
  color:#fff;
  margin-top: 2%;
}
.padding,
.pending {
  color: orange;
  font-weight: bold;
  font-size: 1.2rem;
}

.approve {
  color: rgb(0, 255, 0);
  font-weight: bold;
  font-size: 1.2rem;
}

.cancelled {
  color: #000;
  font-size: 1.2rem;
  font-weight: bold;
}

.reject {
  font-weight: bold;
  color: red;
  font-size: 1.2rem;
}
</style>