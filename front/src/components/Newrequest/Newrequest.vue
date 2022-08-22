<template>
  <div class="form_request">
    <form @submit.prevent="addRequest">
      <div class="header">
        <div class=""></div>
        <span>Form Leave Request</span>
        <div class="btn_close">
          <router-link to="/">&#10060;</router-link>
        </div>
      </div>
      <div class="body">
        <div class="main_container">
          <div class="side_left">
            <div class="leave_type">
              <span>Leave Type:</span>
              <div class="option_type">
                <select name="" id="" v-model="leave_type" @change="is_select_leave_type = false">

                  <option value="Sick Leave"> Sick Leave </option>
                  <option value="Family's event">Family's event</option>
                  <option value="Wedding">Wedding</option>
                  <option value="Brother's or Sister's event">Brother's or Sister's event</option>
                  <option value="Other Event">Other Event</option>
                </select>
                <div class="error">
                  <p v-if="is_select_leave_type">Please select leave tpye!</p>
                </div>
              </div>
            </div>
            <div class="date">
              <div class="start_date">
                <span>Start Date:</span>
                <div class="select_date">
                  <input type="date" v-model="start_date" :min="getCurrentDate" @change="is_select_start_date=false">
                  <select name="" class="express_time" v-model="express_time_start"
                    @change="is_select_expression_time_start=false">
                    <option value="morning"> Morning</option>
                    <option value="afternoon">Afternoon</option>
                  </select>
                </div>
                <div class="error">
                  <p v-if="is_select_start_date || is_select_expression_time_start">Please choose and select start date
                    and
                    start time!</p>
                </div>
              </div>
              <div class="end_date">
                <span>End Date:</span>
                <div class="select_date">
                  <input type="date" v-model="end_date" :min=" start_date " @change="is_select_end_date=false">
                  <select name="" class="express_time" v-model="express_time_end"
                    @change="is_select_expression_time_end=false">
                    <option value="morning"> Morning</option>
                    <option value="afternoon">Afternoon</option>
                  </select>
                </div>
                <div class="error">
                  <p v-if="is_select_end_date || is_select_expression_time_end"> Please choose and select end date and
                    end
                    time!</p>
                </div>
              </div>
            </div>
          </div>
          <div class="side_right">
            <div class="duration">
              <span v-if="changeDuration <= 1">Duration: <strong style="color:red">{{ changeDuration }}
                  day</strong></span>
              <span v-else>Duration: <strong style="color:red">{{ changeDuration }} days</strong></span>
            </div>
            <div class="reason">
              <div class="header_reason">
                <span>Cause(reason):</span>
              </div>
              <div class="input">
                <textarea id="reason" v-model="reason" rows="6" placeholder=" you must have reason..."
                  @change="is_reason_not_complete =false"></textarea>
                <div class="error">
                  <p v-if="is_reason_not_complete"> Please write your reason!</p>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="btn_submit">
          <button >SUBMIT</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import moment from "moment";
import axios from "../../axios-http.js"
import Swal from "sweetalert2";
export default {
  data() {
    return {
      leave_type: null,
      start_date: null,
      end_date: null,
      reason: null,
      express_time_start: null,
      express_time_end: null,
      status: "Padding",
      student_id: 1,
      user_id: 1,
      is_select_leave_type: false,
      is_select_expression_time_start:false,
      is_select_expression_time_end: false,
      is_select_start_date:false,
      is_select_end_date: false,
      is_reason_not_complete: false,
      is_already_complete:false
    }
  },
  methods: {
    
    addRequest() {
      this.checkValidation()
      let object = { leave_type: this.leave_type, start_date: this.start_date, end_date: this.end_date, reason: this.reason, duration: this.changeDuration, status: this.status,user_id:this.user_id,student_id:this.student_id, }
      if (this.start_date != null &&
        this.end_date != null &&
        this.express_time_start != null &&
        this.express_time_end != null &&
        this.leave_type != null &&
        this.reason != null &&
        this.status != null) {
        axios.post("leaves", object).then(() =>
        {
          return this.$router.push({ name: "list_all_leave" });
        }
        )
        this.clearForm();
      }
        
    },
    clearForm() {
      this.start_date = '';
      this.end_date = '';
      this.leave_type = '';
      this.express_time_start = '';
      this.express_time_end = '';
      this.reason = '';
    },
    // validation form request
    checkValidation() {
      this.is_select_leave_type = false
      this.is_select_start_date = false;
      this.is_select_end_date = false;
      this.is_select_expression_time_start = false;
      this.is_select_expression_time_end = false;
      this.is_reason_not_complete = false;
      if (this.leave_type == null) {
        this.is_select_leave_type = true;
      }
      if (this.start_date == null) {
        this.is_select_start_date = true;
      }
      if (this.express_time_start == null) {
        this.is_select_expression_time_start = true;
      } 
      if (this.express_time_end == null) {
        this.is_select_expression_time_end = true;
      }
      if (this.end_date == null) { 
        this.is_select_end_date = true;
      }
      if (this.reason == null) {
        this.is_reason_not_complete = true
      }
    },
    submitSave() {
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 2000
      })
    },

   
    
  },
  computed: {
    
    changeDuration() {
      let start = moment(this.start_date);
      let end = moment(this.end_date);
      let express_time_start = this.express_time_start;
      let express_time_end = this.express_time_end;
      let result = 0;
      if (this.end_date >= this.start_date) {
        if (!isNaN(end.diff(start, "days"))) {
          result += end.diff(start, "days");
          if (
            (express_time_start == "morning" && express_time_end == "morning") || (express_time_start == "afternoon" && express_time_end == "afternoon")
          ) {
            result += 0.5;
          }

          if (
            (express_time_start == "morning" && express_time_end == "afternoon") || (express_time_start == "afternoon" && express_time_end == "morning")
          ) {
            result += 1;
          }
        }
      } 
        return result;
    },
    getCurrentDate() {
      var date = new Date();
      var tday = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getUTCFullYear();
      if (tday < 10) {
        tday = "0" + tday
      }
      if (month < 10) {
        month = "0" + month
      }
      return year + "-" + month + "-" + tday
    },
  }
}
</script>

<style scoped>
.form_request {
  width: 60%;
  margin-left: 20%;
  margin-top: 9%;
}
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px, rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
  border-radius: 7px 7px 0 0;
  color: #63BFE7;
  padding: 10px;
}
.header span {
  font-size: 1.5rem;
  font-weight: bold;
}
.body {
  border-radius: 0 0 7px 7px;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px, rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
}
.body span {
  font-size: 1.2rem;
}
.body .leave_type,
.start_date,
.end_date,
.duration,
.header_reason,
.input {
  padding: 10px;
  font-weight: bold;
}
.body .leave_type select {
  width: 100%;
  padding: 5px;
  font-size: 1.1rem;
  outline: none;
}
.body .leave_type select option {
  font-size: 1.1rem;
}

.main_container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.main_container .side_left,
.side_right {
  width: 49.5%;
  margin: auto;
}

.side_right {
  margin-top: 1%;
}

.select_date {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.select_date input {
  width: 45%;
  padding: 7px;
  font-size: 1.1rem;
}

.select_date select {
  width: 45%;
  padding: 10px;
  font-size: 1.1rem;
  outline: none;
}

.reason textarea {
  width: 96%;
  padding: 5px;
  resize: none;
  font-size: 1.2rem;
  background-color: #fff;
}
.btn_submit {
  display: flex;
  justify-content: center;
  align-items: center;
}
.btn_submit button {
  width: 170px;
  padding: 10px;
  margin: 10px;
  font-size: 1.2rem;
  text-decoration: none;
  cursor: pointer;
  background: none;
  border: none;
  background: #63BFE7;
  color: #ffff;
  border-radius: 7px;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}

.btn_close button {
  background: none;
  border: none;
  cursor: pointer;
}
.btn_close a {
  font-size: 1.6rem;
  text-decoration: none;
}
.error{
  color:red;
  padding: 5px;
}
</style>