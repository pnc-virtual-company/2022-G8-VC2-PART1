<template>
  <div class="filter_banner">
    <p class="wait" v-if="wait">Wait....</p>
    <div class="filter_bar">
      <div class="filter_status">
        <p>Filter By Status</p>
        <select name="status" v-model="filterStatus" @change="getLeaveFilter">
          <option value="Show all">Show all</option>
          <option value="Padding">Padding</option>
          <option value="Approved">Approve</option>
          <option value="Rejected">Reject</option>
        </select>
      </div>
      <div class="filter_type">
        <p>Filter By Leave Types</p>
        <select
          name="leave_type"
          v-model="filterLeaveType"
          @change="getLeaveFilter"
        >
          <option value="Show all">Show all</option>
          <option value="Sick Leave">Sick leave</option>
          <option value="Wedding">Wedding</option>
          <option value="Family's event">Family-event</option>
          <option value="Brother's and Sister's event">
            Brother's and Sister's event
          </option>
          <option value="Other Event">Other</option>
        </select>
      </div>
    </div>
    <div class="all_card" v-if="leaves.length != 0">
      <table>
        <thead>
          <tr>
            <th scope="col">Request Date</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Duration</th>
            <th scope="col">Leave type</th>
            <th scope="col" style="width: 250px">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody v-if="leaves.length != 0">
          <tr v-for="(leave, index) in leaves" :key="index">
            <td>{{ leave.created_at }}</td>
            <td>{{ leave.start_date }}</td>
            <td>{{ leave.end_date }}</td>
            <td>{{ leave.duration }}</td>
            <td>{{ leave.leave_type }}</td>
            <td>{{ leave.student.email }}</td>
            <td>
              <div class="btn_action" v-if="leave.status === 'Padding'">
                <button
                  class="approve"
                  @click="
                    replyBack(leave.id, {
                      user_id: leave.user_id,
                      leave_type: leave.leave_type,
                      start_date: leave.start_date,
                      end_date: leave.end_date,
                      duration: leave.duration,
                      student_id: leave.student_id,
                      reason: leave.reason,
                      status: 'Approved',
                    })
                  "
                >
                  Approve
                </button>
                <button
                  class="reject"
                  @click="
                    replyBack(leave.id, {
                      user_id: leave.user_id,
                      leave_type: leave.leave_type,
                      start_date: leave.start_date,
                      end_date: leave.end_date,
                      duration: leave.duration,
                      student_id: leave.student_id,
                      reason: leave.reason,
                      status: 'Rejected',
                    })
                  "
                >
                  Reject
                </button>
              </div>
              <div v-else class="leave_status">
                <p class="re_approve" v-if="leave.status == 'Approved'">
                  {{ leave.status }}
                </p>
                <p class="re_reject" v-if="leave.status == 'Rejected'">
                  {{ leave.status }}
                </p>
              </div>
            </td>
          </tr>
        </tbody>
        <tbody v-else>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td class="text-danger fs-1">Don't have student</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div
      v-else
      class="no_leave d-flex justify-content-center align-items-center"
      style="margin-top: 25%"
    >
      <span class="no_leave text-danger" style="font-size: 2rem"
        >No Leave found!!</span
      >
    </div>
  </div>
</template>

<script>
import axios from "../../api/api.js";

export default {
  data() {
    return {
      leaves: [],
      filterStatus: "Show all",
      filterLeaveType: "Show all",
      wait: false,
    };
  },
  mounted() {
    this.getAllLeave();
  },
  methods: {
    replyBack(indexId, message) {
      this.wait = true;
      axios
        .put("social_affairs/update_leave_status/" + indexId, message)
        .then((res) => {
          console.log(res.data);
          setTimeout(() => {
            this.wait = false;
          }, 500);
          this.getAllLeave();
        });
    },
    getAllLeave() {
      axios.get("social_affairs/leaves/").then((res) => {
        this.leaves = res.data;
        console.log(this.leaves);
      });
    },
    getLeaveFilter() {
      if (
        this.filterStatus != "Show all" &&
        this.filterLeaveType != "Show all"
      ) {
        axios.get("social_affairs/leaves/").then((res) => {
          this.leaves = res.data.filter(
            (leave) =>
              leave.status == this.filterStatus &&
              leave.leave_type == this.filterLeaveType
          );
        });
      } else if (
        this.filterStatus == "Show all" &&
        this.filterLeaveType != "Show all"
      ) {
        axios.get("social_affairs/leaves/").then((res) => {
          this.leaves = res.data.filter(
            (leave) => leave.leave_type == this.filterLeaveType
          );
        });
      } else if (
        this.filterLeaveType == "Show all" &&
        this.filterStatus != "Show all"
      ) {
        axios.get("social_affairs/leaves/").then((res) => {
          this.leaves = res.data.filter(
            (leave) => leave.status == this.filterStatus
          );
        });
      } else {
        this.getAllLeave();
      }
    },
  },
};
</script>

<style scoped>
h4 {
  text-align: end;
  margin-right: 5px;
}
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
select {
  width: 100%;
  margin: 5px 0px;
  padding: 8px;
}
.filter_banner {
  margin-top: 15%;
}
.filter_bar {
  border-radius: 7px;
  padding: 15px;
  background: #fff;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px,
    rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
  width: 60%;
  margin: auto;
  display: flex;
  position: fixed;
  top: 10%;
  right: 0;
  left: 0;
}
.re_approve {
  color: green;
}
.re_reject {
  color: red;
}
.wait {
  text-align: center;
  background: #08a3e6;
  padding: 15px;
  position: absolute;
  top: 45vh;
  left: 35vw;
  width: 30%;
  box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
  color: white;
  font-size: 1.5rem;
  border-radius: 7px;
  animation-name: example;
  animation-duration: 4s;
}

@keyframes example {
  from {
    background-color: #028dc8;
  }
  to {
    background-color: #8bd5f5;
  }
}
.profile {
  width: 30%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.profile img {
  width: 35%;
}
span {
  text-align: center;
  font-size: 2rem;
  color: gray;
}
.no_leave {
  text-align: center;
}
select:focus {
  outline: none;
}

.filter_status,
.filter_type {
  width: 48%;
  margin: 5px;
}

button {
  width: 80px;
  padding: 5px;
  cursor: pointer;
  margin:3px;
  border: none;
  font-size: 15px;
  color: white;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
  border-radius: 7px;
}

.approve {
  background: rgb(1, 146, 203);
}
.reject {
  background: red;
}
img {
  width: 10%;
}
.status {
  text-align: end;
}
.card_leave {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.card_leave {
  padding: 10px;
  border-left: 7px solid #63bfe7;
  border-right: 7px solid #63bfe7;
  margin: 5px;
  display: flex;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px,
    rgb(209, 213, 219) 0px 0px 0px 1px inset;
}
.leave_info {
  width: 40%;
}
.all_card {
  width: 100%;
  margin: auto;
  margin-top: 10rem;
  padding: 10px;
  overflow: scroll;
  height: 67vh;
}
</style>