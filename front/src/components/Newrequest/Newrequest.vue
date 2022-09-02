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
                  <option value="Brother's and Sister's event">Brother's and Sister's event</option>
                  <option value="Other Event">Other Event</option>
                </select>
                <div class="error">
                  <p v-if="is_select_leave_type">Please select leave tpye!</p>
                </div>
              </div>
            </div>
            <div class="date">
              <div class="start_date_start_time">
                <span>Start Date:</span>
                <div class="select_end_date_end_time">
                  <div class="select_start_date">
                    <input type="date" v-model="start_date" :min="getCurrentDate"
                      @change="is_select_start_date = false">
                    <div class="error">
                      <p v-if="is_select_start_date">Please select start date</p>
                    </div>
                  </div>
                  <div class="select_start_time">
                    <select name="" class="express_time" v-model="express_time_start"
                      @change="is_select_expression_time_start = false">
                      <option value="morning"> Morning</option>
                      <option value="afternoon">Afternoon</option>
                    </select>
                    <div class="error">
                      <p v-if="is_select_expression_time_start">Please select start time</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="end_date_end_time">
                <span>End Date:</span>
                <div class="select_end_date_end_time">
                  <div class="select_end_date">
                    <input type="date" v-model="end_date" :min="start_date" @change="is_select_end_date = false">
                    <div class="error">
                      <p v-if="is_select_end_date"> Please choose end date</p>
                    </div>
                  </div>
                  <div class="select_end_time">
                    <select name="" class="express_time" v-model="express_time_end"
                      @change="is_select_expression_time_end = false">
                      <option value="morning"> Morning</option>
                      <option value="afternoon">Afternoon</option>
                    </select>
                    <div class="error">
                      <p v-if="is_select_expression_time_end"> Please choose end time</p>
                    </div>
                  </div>
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
                  @change="is_reason_not_complete = false"></textarea>
                <div class="error">
                  <p v-if="is_reason_not_complete"> Please write your reason!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="btn">
          <div class="btn_cancel">
            <router-link to="/" class="btn btn-md btn_cancel ">
              CANCEL
            </router-link>
          </div>
          <div class="btn_submit">
            <button :disabled="disableButton" class="btn btn-md">SUBMIT</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import moment from "moment";
import axios from "../../api/api.js"
import Swal from "sweetalert2";
export default {
  name:'new-request',
  data() {
    return {
      leave_type: "",
      start_date: "",
      end_date: "",
      reason: "",
      express_time_start: "",
      express_time_end: "",
      status: "Padding",
      student_id: "",
      user_id: 1,
      is_select_leave_type: false,
      is_select_expression_time_start: false,
      is_select_expression_time_end: false,
      is_select_start_date: false,
      is_select_end_date: false,
      is_reason_not_complete: false,
      is_already_complete: false,
    }
  },
  methods: {

    addRequest() {
      this.checkValidation();
      let object = { leave_type: this.leave_type, start_date: this.start_date, 
        end_date: this.end_date, reason: this.reason, duration: this.changeDuration, 
        status: this.status, user_id: this.user_id, student_id: localStorage.getItem('studentID'), }
        
      if (this.start_date != "" &&
        this.end_date != "" &&
        this.express_time_start != "" &&
        this.express_time_end != "" &&
        this.leave_type != "" &&
        this.reason != "" &&
        this.status != "") {
        axios.post("/students/leaves", object).then((res) => {
          console.log(res);
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
      if (this.leave_type == "") {
        this.is_select_leave_type = true;
      }
      if (this.start_date == "") {
        this.is_select_start_date = true;
      }
      if (this.express_time_start == "") {
        this.is_select_expression_time_start = true;
      }
      if (this.express_time_end == "") {
        this.is_select_expression_time_end = true;
      }
      if (this.end_date == "") {
        this.is_select_end_date = true;
      }
      if (this.reason == "") {
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
            (express_time_start == "morning" && express_time_end == "afternoon")
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
    disableButton() {
      let btn_disabled = true;
      if (this.leave_type || this.start_date || this.end_date || this.reasons
        || this.express_time_start || this.express_time_end) {
        btn_disabled = false;
      }
      return btn_disabled
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
  font-size: 1.3rem;
  font-weight: bold;
}

.body {
  border-radius: 0 0 7px 7px;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px, rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
}

.body span {
  font-size: 1.1rem;
}

.body .leave_type,
.start_date_start_time,
.end_date_end_time,
.duration,
.header_reason,
.input {
  padding: 5px;
  font-weight: bold;
}

.body .leave_type select {
  width: 100%;
  padding: 5px;
  font-size: 1rem;
  outline: none;
}

.body .leave_type select option {
  font-size: 1rem;
}

.main_container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.main_container .side_left,
.side_right {
  width: 49%;
  margin: auto;
}

.side_right {
  margin-top: 1%;
}

.select_start_date_start_time {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.select_start_date {
  width: 49%;
}

.select_start_date input {
  width: 90%;
  padding: 7px;
  font-size: 1rem;
}

.select_start_time {
  width: 49%;
}

.select_start_time select {
  width: 90%;
  padding: 9px;
  font-size: 1rem;
  outline: none;
}

.select_end_date_end_time {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.select_end_date {
  width: 49%;
}

.select_end_date input {
  width: 90%;
  padding: 7px;
  font-size: 1rem;
}

.select_end_time {
  width: 49%;
}

.select_end_time select {
  width: 90%;
  padding: 9px;
  font-size: 1rem;
  outline: none;
}

.reason textarea {
  width: 96%;
  padding: 5px;
  resize: none;
  font-size: 1rem;
  background-color: #fff;
}

.btn {
  display: flex;
  justify-content: end;
  align-items: center;
}

.btn_submit {
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn_submit button {
  width: 120px;
  padding: 5px;
  margin: 10px;
  font-size: 1rem;
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

.btn_cancel a {
  display: flex;
  justify-content: center;
  align-items: center;
}

.btn_cancel a {
  width: 120px;
  padding: 5px;
  margin: 10px;
  font-size: 1rem;
  text-decoration: none;
  cursor: pointer;
  background: none;
  border: none;
  background: red;
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
  font-size: 1.2rem;
  text-decoration: none;
}

.error {
  color: red;
  font-weight: normal;
}
</style>