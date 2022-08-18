<template>
  <div class="about">
    <form @submit.prevent="reQuest" class="leave_request">
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
            <option value="busy">Busy</option>
            <option value="sick">Sick</option>
          </select>
        </div>
      </div>
      <div class="content">
        <div class="title">
          <h5>Date start</h5>
        </div>
        <div class="box">
          <input type="date" v-model="start_date"/>
          <select v-model="start_date_status">
            <option value="am">AM</option>
            <option value="pm">PM</option>
          </select>
        </div>
      </div>
      <div class="content">
        <div class="title">
          <h5>Date end</h5>
        </div>
        <div class="box">
          <input type="date" v-model="end_date">
          <select v-model="end_date_status">
            <option value="am">AM</option>
            <option value="pm">PM</option>
          </select>
        </div>
      </div>
      <div class="duration">
        <h5>Duration: {{getDuration()}}  days</h5>
      </div>
      <div class="content2">
        <div class="title">
          <h5>Cause (Reason):</h5>
        </div>
        <div class="box">
          <textarea  id="reason" v-model="reason" cols="40" rows="5" placeholder=" you must have reason..."></textarea>
        </div>
      </div>
      <div class="footer">
        <button @click="cancleR" id="cancle">Cancle</button>
        <button @click="submitR" id="submit">Submit</button>
      </div>
  </form>
  </div>
</template>

<script>
export default {
  name:"Newrequest_Form",
  emits:['new-request'],
  data(){
    return {
      leave_type:[],
      start_date:null,
      start_date_status:'',
      end_date:null,
      end_date_status:'',
      reason:'',
      duration:null,
    }
  },
  methods:{
    cancleR(){
      this.clearForm();
    },
    submitR(){
      if (
        this.leave_type != [] &&
        this.start_date != '' &&
        this.start_date_status != ''&&
        this.end_date != '' && 
        this.end_date_status != '' && 
        this.reason != ''
      ){
        this.$emit('new-request',{
          leave_type:this.leave_type,
          startDate:this.start_date,
          startDateStatus:this.start_date_status,
          endDate:this.end_date,
          endDateStatus:this.end_date_status,
          reason:this.reason
        });
        this.clearForm();
      }else {
        alert('You missing some field please check again!');
      }
    },
    clearForm(){
      this.leave_type = [];
      this.start_date='';
      this.start_date_status = '';
      this.end_date = '';
      this.end_date_status = '';
      this.reason = '';
    },
    findDuration(){
      if(
        this.start_date != null &&
        this.end_date != null && 
        this.start_date_status != '' &&
        this.end_date_status !=''
      ){
        if (this.start_date != this.end_date && this.end_date_status == this.start_date_status){
          this.duration = (new Date(this.end_date).getTime()-new Date(this.start_date).getTime())/(1000*3600*24)
          console.log(this.duration)
        }
      }
        
      return this.duration;
    }
  },
  computed:{
    getDuration(){
      return this.findDuration;
    }
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
    background-color: rgb(255, 255, 255);
    font-family:sans-serif;
    border-radius: 20px;
    margin-top:100px;
    height: 75vh;
  }
  .heading_form {
    width: 100%;
    border-radius: 20px;
    background-color: rgb(13, 163, 232);
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
  .support_heading {
    width: 100%;
    background-color: rgb(13, 163, 232);
    padding: 1px;
    margin-top: -17px;
  }
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
  .box {
    width: 67%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
  }
  #leave_type {
    width:95% ;
  }
  .box input, .box select {
    width: 45%;
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
    border-radius: 10px;
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