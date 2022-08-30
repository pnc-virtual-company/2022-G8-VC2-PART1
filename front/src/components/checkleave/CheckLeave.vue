<template>
  <div class="filter_banner">
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
        <select name="leave_type" v-model="filterLeaveType" @change="getLeaveFilter">
          <option value="Show all">Show all</option>
          <option value="Sick Leave">Sick leave</option>
          <option value="WIDDING">Wedding</option>
          <option value="Family's event">Family-event</option>
          <option value="OTHER">Other</option>
        </select>
      </div>
    </div>
  </div>
  <div class="all_card" v-if="leaves.length != 0">
    <div class="card_leave" v-for="(leave,index) in leaves" :key="index">
      <div class="leave_info">
        <p>Leave Type: <strong>{{leave.leave_type}}</strong></p>
        <p>Date Start: <strong>{{leave.start_date}}</strong></p>
        <p>Date End: <strong>{{leave.end_date}}</strong></p>
        <p>Duration: <strong>{{leave.duration}} days</strong></p>
      </div>
      <div class="btn">
        <div class="btn_action" v-if="leave.status === null">
          <button class="approve"
            @click="replyBack(leave.id,{leave_type: leave.leave_type,start_date: leave.start_date,end_date: leave.end_date,duration: leave.duration,student_id: leave.student_id,reason: leave.reason,status: 'Approved'})">Approve</button>
          <button class="reject"
            @click="replyBack(leave.id,{leave_type: leave.leave_type,start_date: leave.start_date,end_date: leave.end_date,duration: leave.duration,student_id: leave.student_id,reason: leave.reason,status: 'Rejected'})">Reject</button>
        </div>
        <p v-else class="status">{{leave.status}}</p>
      </div>
    </div>
  </div>
  <span v-else class="no_leave">No Leave</span>
</template>

<script>
import axios from "../../api/api.js";

export default {
  data() {
    return {
      leaves: [],
      filterStatus: 'Show all',
      filterLeaveType: 'Show all',
    }
  },
  mounted() {
    this.getAllLeave();
  },
  methods: {
    replyBack(indexId,message) {
      console.log(indexId,message);
      axios.put('social_affairs/leaves/' + indexId,message).then(res => {
        console.log(res.data);
        window.location.reload();
      });
    },
    getAllLeave() {
      axios.get('social_affairs/leaves/').then(res =>{
        this.leaves = res.data;
        console.log(this.leaves);
      });
    },
    getLeaveFilter() {
      if ((this.filterStatus != 'Show all') && (this.filterLeaveType != 'Show all')) {
        axios.get('social_affairs/leaves/').then(res =>{
          
          this.leaves = res.data.filter(leave => (leave.status == this.filterStatus) && (leave.leave_type == this.filterLeaveType));
        });
      }
      else if ((this.filterStatus == 'Show all') && (this.filterLeaveType != 'Show all')) {
        axios.get('social_affairs/leaves/').then(res =>{
          
          this.leaves = res.data.filter(leave => leave.leave_type == this.filterLeaveType);
        });
      }
      else if ((this.filterLeaveType == 'Show all') && ((this.filterStatus != 'Show all'))) {
        axios.get('social_affairs/leaves/').then(res =>{
  
          this.leaves = res.data.filter(leave => leave.status == this.filterStatus);
        });
      }
      else{
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

select{
  width: 100%;
  margin: 5px 0px;
  padding: 8px;
}
.filter_banner{
  margin-top: 15%;
}
.filter_bar {
  border-radius: 10px;
  padding: 15px;
  margin-top:90px ;
  background: #fff;
  box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
  width: 60%;
  margin: auto;
  display: flex;
  position: fixed;
  top: 12%;
  right: 0;
  left: 0;
  z-index: 9999;
}
span{
  text-align: center;
  font-size: 2rem;
  color: gray;
}
.no_leave {
  text-align: center;
}
select:focus{
  outline: none;
}

.filter_status,.filter_type{
  width: 48%;
  margin: 5px;
}

button{
  padding: 10px;
  margin: 10px;
  cursor: pointer;
  border: none;
  font-size: 15px;
  color: white;
  box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
  border-radius: 5px;
}

.approve{
  background: rgb(1, 146, 203);
}
.reject{
  background: rgb(222, 145, 2);
}

.detail{
  background: green;
}

img{
  width: 10%;
}

.status{
  text-align: end;
}

.card_leave{
  display: flex;
  justify-content: space-around;
  align-items: center;
}

.card_leave{
  padding: 10px;
  border-left: 5px solid #63bfe7;
  margin: 10px;
  display: flex;
  border-radius: 10px;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px, rgb(209, 213, 219) 0px 0px 0px 1px inset;
}
.all_card{
  width: 90%;
  margin: auto;
  padding: 10px;
}

</style>