<template>
  <div class="form_add_student">
    <form @submit.prevent="addStudent">
      <div class="form_header d-flex justify-content-center align-center">
        <span class="text-center">Add Student</span>
      </div>
      <div class="form_body">
        <div class="side_left p-2">
          <div class="username d-flex">
            <div class="first_name">
              <label class="form-label required" for="first_name">First Name</label>
              <input class="form-control " type="text" id="first_name" placeholder="firstname" v-model="first_name"
                @change="is_first_name_valid =false">
              <div class="error">
                <p v-if="is_first_name_valid">Please enter firstname</p>
              </div>
            </div>
            <div class="last_name">
              <label class="form-label required" for="last_name">Last Name</label>
              <input class="form-control " type="text" id="last_name" placeholder="lastname" v-model="last_name"
                @change="is_last_name_valid =false">
              <div class="error">
                <p v-if="is_last_name_valid">Please enter lastname</p>
              </div>
            </div>
          </div>
          <div class="gender_batch d-flex justify-content-between align-items-center">
            <div class="gender mb-3">
              <label class="form-label required" for="gender">Gender</label>
              <select class="form-select  form-select-md  " aria-label=".form-select-lg example" v-model="gender"
                @change="is_gender_valid=false">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
              <div class="error">
                <p v-if="is_gender_valid">Please select gender</p>
              </div>
            </div>
            <div class="batch ">
              <label class="form-label required" for="batch">Batch</label>
              <input class="form-control " type="text" id="batch" placeholder="batch" v-model="batch"
                @change="is_batch_valid=false">
              <div class="error">
                <p v-if="is_batch_valid">Please enter student batch</p>
              </div>
            </div>
          </div>
          <div class="student_class_id  mb-3">
            <div class="student_class ">
              <label class="form-label required" for="student_class">Class</label>
              <select class="form-select  form-select-md  " aria-label=".form-select-lg example" v-model="student_class"
                @change="is_class_valid=false">
                <option value="SNA">SAN</option>
                <option value="WEB A">WEB A</option>
                <option value="WEB B">WEB B</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
              </select>
              <div class="error">
                <p v-if="is_class_valid">Please select class</p>
              </div>
            </div>
            <div class="student_id ">
              <label class="form-label required" for="student_id">Student ID</label>
              <input class="form-control " type="number" min="0" id="student_id" placeholder="Student ID" v-model="student_id"
                @change="is_student_id_valid = false">
              <div class="error">
                <p v-if="is_student_id_valid ">Please enter student ID</p>
              </div>
            </div>
          </div>
        </div>
        <div class="side_right p-2  mb-3">
          <div class="email mb-3">
            <label class="form-label required" for="email">Email</label>
            <input class="form-control w-100" type="email" id="email" placeholder="email" v-model="email"
              @change="is_email_valid = false">
            <div class="error">
              <p v-if="is_email_valid ">Please enter student's email</p>
            </div>
          </div>
          <div class="password ">
            <label class="form-label required" for="password">Password</label>
            <div class="psw d-flex">
              <input v-if="showPassword" class="form-control w-100 psw" type="text" id="password" placeholder="password"
                v-model="password" @change="is_password_valid =false">
              <input v-else class="form-control w-100 psw" type="password" id="password" placeholder="password"
                v-model="password" @change="is_password_valid =false">
              <div class="btn_show_psw">
                <button @click="toggleShow">
                  <span class="material-symbols-outlined" v-if="showPassword">
                    visibility
                  </span>
                  <span class="material-symbols-outlined" v-else>
                    visibility_off
                  </span>
                </button>
              </div>
            </div>
            <div class="error">
              <p v-if="is_password_valid">Please enter student's password</p>
            </div>
          </div>
          <div class="phonenumber mt-3">
            <label class="form-label required" for="phonenumber">Phone</label>
            <input class="form-control w-100" type="text" name="" id="phonenumber" placeholder="phone number"
              v-model="phone" @change="is_phone_valid =false">
            <div class="error">
              <p v-if="is_phone_valid">Please enter student's phone number</p>
            </div>
          </div>
          <!-- <div class="profile mt-3">
            <label class="form-label required" for="profile">Profile</label>
            <input class="form-control w-100" type="file" name="profile" id="profile" placeholder="profile file"
              @change="previewFiles" />
          </div> -->
        </div>
      </div>
      <div class="form_footer btn d-flex justify-content-end align-items-center">
        <router-link to="studentlist" class="btn btn-danger btn-md m-1">
          Cancel
        </router-link>
        <button type="submit" class="btn btn_register  btn-md m-1" :disabled="disableButtonSubmit">
          Register
        </button>
      </div>
    </form>
  </div>

</template>

<script>
import axios from "../../api/api";
import Swal from "sweetalert2";

export default {
  data() {
    return {
      first_name: "",
      last_name: "",
      gender: "",
      batch: "",
      email: "",
      password: "12345678",
      phone: "",
      images: "",
      student_class: '',
      student_id:"",
      is_first_name_valid: false,
      is_last_name_valid: false,
      is_email_valid: false,
      is_phone_valid: false,
      is_password_valid: false,
      is_gender_valid: false,
      is_batch_valid: false,
      is_wrong_email: false,
      showPassword: false,
      is_class_valid: false,
      is_email_exists:false,
      is_student_id_valid:false,
    }
  },
  methods: {
    clearForm() {
      this.first_name = "";
      this.last_name = "";
      this.gender = "";
      this.phone = "";
      this.student_class = "";
      // this.password = "";
      this.email = "";
      this.batch = "";
      this.image = "";
      this.student_id = "";
    },
    addStudent() {
      this.validateForm();
      let object = {
        user_id: 1,
        first_name: this.first_name,
        last_name: this.last_name,
        gender: this.gender,
        batch: this.batch,
        password: this.password,
        phone: this.phone,
        // image: this.image.name,
        email: this.email,
        studentID:this.student_id,
        class:this.student_class
      } 
      if (this.first_name  && this.last_name  && this.gender  && this.batch  && this.password && this.phone  || this.image && this.email && this.student_id) {
        axios.post("/social_affairs/students", object).then(() => {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1000
          })
            return this.$router.push({ name: "studentlist" });
        })
        this.clearForm();
      }
    },
    previewFiles(event) {
      this.image = event.target.files[0];
    },
    validateForm() {
      this.is_first_name_valid = false;
      this.is_last_name_valid = false;
      this.is_gender_valid = false;
      this.is_batch_valid = false;
      this.is_email_valid = false;
      this.is_password_valid = false;
      this.is_phone_valid = false;
      this.is_student_id_valid = false;
      this.is_class_valid = false;
      if (this.first_name == "") {
        this.is_first_name_valid = true;
      }
      if (this.last_name == "") {
        this.is_last_name_valid = true;
      }
      if (this.gender == "") {
        this.is_gender_valid = true;
      }
      if (this.batch == "") {
        this.is_batch_valid = true;
      }
      if (this.email == "") {
        this.is_email_valid = true;
      }
      if (this.password == "") {
        this.is_password_valid = true;
      }
      if (this.phone == "") {
        this.is_phone_valid = true;
      }
      if (this.student_class == "") { 
        this.is_class_valid = true;
      }
      if (this.student_id == "") { 
        this.is_student_id_valid = true;
      }
    },
    toggleShow() {
      this.showPassword = !this.showPassword;
    }
  },
  computed: {
    disableButtonSubmit() {
      let disableSubmit = true;
      if (this.first_name || this.last_name || this.gender || this.batch || this.email || this.student_class || this.phone) {
        disableSubmit = false; //
      } 
      return disableSubmit;
    },
    // emailExist() {
    //   if()
    // }
  }
}

</script >

<style scoped>


.form_add_student {
  width: 60%;
  margin-left: 20%;
  margin-top: 5%;
  border-radius: 0 0 7px 7px;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px, rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
}

.form_header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px, rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
  border-radius: 7px 7px 0 0;
  color: #63BFE7;
  padding: 10px;
}

.form_header span {
  font-size: 1.5rem;
  font-weight: bold;
}

.form_body {

  display: flex;
  justify-content: space-between;
  align-items: center;
}

.form_body span {
  font-size: 1.2rem;
}

.side_left {
  width: 49%;
}

.side_right {
  width: 49%;
}

.form-label {
  font-weight: bold;
  font-size: 1.2rem;
}

.first_name .form-control {
  width: 99%;
}

.last_name .form-control {
  width: 99%;
}
.gender_batch{
  width: 100%;
}
.gender  {
  width: 57%;
  margin-top: 17px;
}
.gender .form-select {
  margin-right: 20px;
}
.batch .form-control {
  width: 99%;
  margin-left: 0.7%;
}
.student_class_id {
  display: flex;
  justify-content: space-between;
  align-items:center;
}
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
.student_id, .student_class{
  width: 49.8%;
}

.form_footer a {
  width: 130px;
  font-size: 1.1rem;
}

.btn_register {
  width: 130px;
  font-size: 1.1rem;
  background: #63BFE7;
  color: #fff;
}

.error{
  color:red;
}
.psw{
  border-right: none;
}
.psw button{
  background: none;
  border:none;
}
.psw input{
  border-radius: 7px 0px 0px 7px;
}
.btn_show_psw{
  width: 10%;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #ccc;
  border-radius: 0 7px 7px 0;
}
</style>