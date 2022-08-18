<template>
  <div class="about">
    <form @submit.prevent="submitR" class="leave_request">
      <div class="heading_form">
        <h1>Request Leave Form</h1>
      </div>
      <div class="support_heading"></div>
      <div class="content">
        <div class="title">
          <h5>Leave type :</h5>
        </div>
        <div class="box">
          <select v-model="leave_type" id="leave_type">
            <option value="Sick Leave">Sick Leave</option>
            <option value="Family's event">Family's event</option>
            <option value="Brother's or Sister's event">Brother's or Sister's event</option>
            <option value="Other Event">Other Event</option>
          </select>
        </div>
      </div>
      <div class="content">
        <div class="title">
          <h5>Date start</h5>
        </div>
        <div class="box">
          <input type="date" v-model="start_date" />
          <select v-model="start_time">
            <option value="morning" selected>Morning</option>
            <option value="afternoon">Afternoon</option>
          </select>
        </div>
      </div>
      <div class="content">
        <div class="title">
          <h5>Date end</h5>
        </div>
        <div class="box">
          <input type="date" v-model="end_date">
          <select v-model="end_time">
            <option value="morning" selected>Morning</option>
            <option value="afternoon">Afternoon</option>
          </select>
        </div>
      </div>
      <div class="duration">
        <h5 v-if="duration == 0 || duration == 0.5|| duration == 1">Duration: <span> {{ count_duration }} day</span> </h5>
        <h5 v-else>Duration: <span>{{ count_duration }} days</span> </h5>
      </div>
      <div class="content2">
        <div class="title">
          <h5>Cause (Reason):</h5>
        </div>
        <div class="box">
          <textarea id="reason" v-model="reason" cols="40" rows="5" placeholder=" you must have reason..."></textarea>
        </div>
      </div>
      <div class="footer">
        <button @click="cancleR" id="cancle">Cancle</button>
        <button id="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
import moment from "moment";
import axios from "../../axios-http.js"
export default {
  name:"Newrequest_Form",
  emits:['new_request'],
  data(){
    return {
      leave_type:'',
      start_date:'',
      start_time:'',
      end_date:'',
      end_time:'',
      reason: '',
      status:'Padding',
    }
  },
  methods:{
    cancleR(){
      this.clearForm();
    },
    submitR() {
      console.log(this.status)
      let object = { leave_type: this.leave_type, start_date: this.start_date, end_date: this.end_date, reason: this.reason, duration: this.count_duration,status:this.status, }
      if (
        this.leave_type != ''&&
        this.start_date != '' &&
        this.start_time != ''&&
        this.end_date != '' && 
        this.end_time != '' && 
        this.reason != ''
      ){
        // this.$emit('new_request',object);
        axios.post("/leaves", object).then((response) =>
          console.log(response.data)
        )
        this.clearForm();
      }else {
        alert('You missing some field please check again!');
      }
    },
    clearForm(){
      this.start_date='';
      this.start_time = '';
      this.leave_type = '';
      this.end_date = '';
      this.end_time = '';
      this.reason = '';
    },
  },
  computed:{
    count_duration() {
      let start = moment(this.start_date);
      let end = moment(this.end_date);
      let start_time = this.start_time;
      let end_time = this.end_time;
      let result = 0;
      if (!isNaN(end.diff(start, "days"))) {
        result += end.diff(start, "days");
        if (
          (start_time == "morning" && end_time == "morning") || (start_time == "afternoon" && end_time == "afternoon")
        ) {
          result += 0.5;
        }

        if (
          (start_time == "morning" && end_time == "afternoon") || (start_time == "afternoon" && end_time == "morning")
        ) {
          result += 1;
        }
      }
      return result;
    },
  }
  
}
</script>

<style scoped>



  .about {
    width: 100%;
    display: flex;
  }

  .leave_request {
    width: 35%;
    display: flex;
    flex-wrap: wrap;
    margin:auto;
    background-color: #ccc;
    font-family:sans-serif;
    border-radius: 7px;
    height: 75vh;
    margin-top: 3%;
  }
  .heading_form {
    width: 100%;
    border-radius: 7px;
    background-color: #63BFE7;
    text-align: center;
    align-items: center;
  }
  .heading_form h1 {
    font-size: 25px;
    color: white;
  }
  .heading_form h1 {
    margin-top: 25px;
  }
  /* .support_heading {
    width: 100%;
    background-color: #63BFE7;
    padding: 1px;
    margin-top: -17px;
  } */
  .content, .content2 {
    width: 90%;
    display: flex;
    flex-wrap: wrap;
    margin:5px auto;
  }
  .title {
    width: 30%;
    text-align: start;
    margin: auto;
    
  }
  .duration {
    width:88%;
    text-align: start;
    margin: auto;
  }
  .duration span {
    color:red;
    font-size: 1.2rem;
  }
  .box {
    width: 67%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }
  #leave_type {
    width:95% ;
    padding: 5px;
  }
  select{
    padding:5px;
  }
  .box input{
    padding: 5px;
  }
  .box input, .box select {
    width: 40%;
    margin-left: 10px;
    
  }
  .content2 .box {
    width: 90%;
    margin: 5px auto;
  }
  .content2 .title {
    width: 97%;
    margin: auto;
  }
  .content2 .box {
    width: 98%;
  }
  .content2 .title {
    text-align: start;
  }
  .content2 .box textarea {
    width: 100%;
    resize: none;
    background-color: rgb(163, 163, 163);
  }
  .footer {
    width: 93%;
    margin: 10px auto;
    text-align: end;
  }
  .footer button {
    padding: 8px;
    margin: 2px;
    border: none;
    border-radius: 7px;
    color:white;
    cursor: pointer;
  }
  #cancle {
    background-color: orange;
  }
  #submit {
    background-color: rgb(13, 163, 232) ;
  }
</style>