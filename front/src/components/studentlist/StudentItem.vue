<template>
  <!--======== delete pop up =========-->
  <li>
    <div class="pop_up" v-if="showPopup">
      <div class="background">
        <div class="text text-center">
          <p class="fs-2">Are you sure to delete?</p>
          <span class="question_mark material-symbols-outlined"> help </span>
        </div>

        <div class="btn btn_cancel_delete d-flex justify-content-between align-items-center">
          <button class="btn btn-cancel btn-danger" @click="showPopup = false">
            Cancel
          </button>
          <button class="btn btn-delete" @click="deleteStudent(index, students_id)">
            Delete
          </button>
        </div>
      </div>
    </div>
    <!-- ===== student card ===== -->
    <div class="form_add_student" v-if="showEditPopup">
      <form class="edit_student" @submit.prevent="
  editStudent(id);
$emit('isHideFilter');
      ">
        <div class="form_header d-flex justify-content-center align-center">
          <span class="text-center">Update Student Information</span>
        </div>
        <div class="form_body">
          <div class="side_left p-2">
            <div class="username d-flex">
              <div class="first_name">
                <label class="form-label required" for="first_name">First Name</label>
                <input class="form-control" type="text" id="first_name" placeholder="firstname" v-model="first_name"
                  @change="is_first_name_valid = false" required />
              </div>
              <div class="last_name">
                <label class="form-label required" for="last_name">Last Name</label>
                <input class="form-control" type="text" id="last_name" placeholder="lastname" v-model="last_name"
                  @change="is_last_name_valid = false" required />
              </div>
            </div>
            <div class="gender_batch d-flex justify-content-between align-items-center">
              <div class="gender mb-3">
                <label class="form-label required" for="gender">Gender</label>
                <select class="form-select form-select-md" aria-label=".form-select-lg example" v-model="gender"
                  @change="is_gender_valid = false" required>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="batch">
                <label class="form-label required" for="batch">Batch</label>
                <input class="form-control" type="text" id="batch" placeholder="batch" v-model="batch"
                  @change="is_batch_valid = false" required />
              </div>
            </div>
            <div class="student_class_id mb-3">
              <div class="student_class">
                <label class="form-label required" for="student_class">Class</label>
                <select class="form-select form-select-md" aria-label=".form-select-lg example" v-model="student_class"
                  @change="is_class_valid = false" required>
                  <option value="SNA">SNA</option>
                  <option value="WEB A">WEB A</option>
                  <option value="WEB B">WEB B</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
              </div>
              <div class="student_id">
                <label class="form-label required" for="student_id">Student ID</label>
                <input class="form-control" type="number" min="0" id="student_id" placeholder="Student ID"
                  v-model="student_id" @change="is_student_id_valid = false" required />
              </div>
            </div>
          </div>
          <div class="side_right p-2 mb-3">
            <div class="email mb-3">
              <label class="form-label required" for="email">Email</label>
              <input class="form-control w-100" type="email" id="email" placeholder="email" v-model="email"
                @change="is_email_valid = false" required />
            </div>
            <div class="password">
              <label class="form-label required" for="password">Password</label>
              <div class="psw d-flex">
                <input v-if="showPassword" class="form-control w-100 psw" type="text" id="password"
                  placeholder="password" v-model="password" @change="is_password_valid = false" required />
                <input v-else class="form-control w-100 psw" type="password" id="password" placeholder="password"
                  v-model="password" @change="is_password_valid = false" />
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
            </div>
            <div class="phonenumber mt-3">
              <label class="form-label required" for="phonenumber">Phone</label>
              <input class="form-control w-100" type="text" name="" id="phonenumber" placeholder="phone number"
                v-model="phone" @change="is_phone_valid = false" required />
            </div>
          </div>
        </div>
        <div class="form_footer btn d-flex justify-content-end align-items-center">
          <router-link to="studentlist" @click="
  showEditPopup = false;
$emit('isHideFilter');
          " class="btn btn-danger btn-md m-1">
            Cancel
          </router-link>
          <button type="submit" class="btn btn_register btn-md m-1">
            Update
          </button>
        </div>
      </form>
    </div>
    <div class="main_card" v-else>
      <table>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">STUDENT</th>
            <th scope="col" style="width: 250px">EMAIL</th>
            <th scope="col">CLASS</th>
            <th scope="col">BATCH</th>
            <th scope="col">INFO</th>
            <th scope="col">ACTIVE</th>
          </tr>
        </thead>
        <tbody v-if="filterData.length > 0">
          <tr v-for="(student, index) of filterData" :key="student" :index="index">
            <th scope="row">{{ student.studentID }}</th>
            <td>{{ student.first_name }}{{ " " }}{{ student.last_name }}</td>
            <td style="width: 190px">{{ student.email }}</td>
            <td>{{ student.class }}</td>
            <td>{{ student.batch.toUpperCase() }}</td>

            <td>
              <router-link :to="/student_details/ + student.id" class="btn btn_detail text-decoration-none text-light">
                DETAILS
              </router-link>
            </td>
            <td class="btn_edit_delete">
              <button class="btn btn_delete bg-danger text-center text-light" @click="onDelete(index, student.id)">
                DELETE
              </button>
              <button class="btn btn_edit text-decoration-none text-light m-1" @click="
  onEdit(index, student.id);
$emit('isHideFilter');
              ">
                EDIT
              </button>
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
  </li>
</template>

<script>
import axios from "../../api/api.js";
export default {
  props: ["filterData"],
  inject: ["students"],
  data() {
    return {
      showPopup: false,
      showEditPopup: false,
      students_id: null,
      index: null,

      id: null,
      first_name: "",
      last_name: "",
      gender: "",
      batch: "",
      email: "",
      password: "12345678",
      phone: "",
      images: "",
      student_class: "",
      student_id: null,
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
      is_email_exists: false,
      is_student_id_valid: false,
      isTrue: true,
    };
  },
  methods: {
    getData() {
      this.students;
    },
    deleteStudent(index, id) {
      console.log(index, id);
      axios.delete("social_affiars/students/" + id).then((res) => {
        console.log("This is delete data " + res);
      });
      this.students.splice(index, 1);
      this.showPopup = false;
    },
    editStudent(id) {
      id = this.students_id;
      let object = {
        user_id: 1,
        first_name: this.first_name,
        last_name: this.last_name,
        gender: this.gender,
        batch: this.batch,
        password: this.password,
        phone: this.phone,
        email: this.email,
        studentID: this.student_id,
        class: this.student_class,
      };
      if (
        this.first_name !== "" &&
        this.last_name !== "" &&
        this.gender !== "" &&
        this.batch !== "" &&
        this.password !== "" &&
        this.phone !== "" &&
        this.email !== "" &&
        this.student_id !== ""
      ) {
        axios.put("social_affairs/students/" + id, object).then(() => {
          console.log("Edit Successfully" + id);
        });
      }
      console.log(this.first_name);
      console.log(this.last_name);
      console.log("the id : " + id);
      this.showEditPopup = false;
      this.isTrue = false;
    },
    onDelete(index, id) {
      this.showPopup = true;
      this.students_id = id;
      this.index = index;
    },
    onEdit(index, id) {
      this.showEditPopup = true;
      this.students_id = id;
      this.index = index;
      axios.get("social_affairs/students/" + id).then((res) => {
        let datas = res.data;
        console.log(datas);
        this.first_name = datas.first_name;
        this.last_name = datas.last_name;
        this.email = datas.email;
        this.gender = datas.gender;
        this.batch = datas.batch;
        this.student_class = datas.class;
        this.student_id = datas.studentID;
        this.phone = datas.phone;

      });
    },
  },
};
</script>

<style scoped>


.form_add_student {
  position: absolute;
  top: center;
  right: 0;
  left: 0;
  inset: 0;
  background: rgba(0, 0, 0, 0.2);


}

.form_header {
  align-items: center;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.7) 0px 1px 3px -1px;
  border-radius: 7px 7px 0 0;
  color: #63bfe7;
  padding: 10px;
}

.edit_student {
  margin-top: 10%;
  background: #fff;
  width: 60%;
  margin-left: 20%;
  border-radius:7px;
  box-shadow: rgba(50, 50, 93, 0.4) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
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

.gender_batch {
  width: 100%;
}

.gender {
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
  align-items: center;
}

input[type="number"]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

.student_id,
.student_class {
  width: 49.8%;
}

.form_footer a {
  width: 130px;
  font-size: 1.1rem;
}

.btn_register {
  width: 130px;
  font-size: 1.1rem;
  background: #63bfe7;
  color: #fff;
}

.error {
  color: red;
}

.psw {
  border-right: none;
}

.psw button {
  background: none;
  border: none;
}

.psw input {
  border-radius: 7px 0px 0px 7px;
}

.btn_show_psw {
  width: 10%;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #ccc;
  border-radius: 0 7px 7px 0;
}

li {
  padding: 7px;
  list-style-type: none;
}

.main_card {
  width: 90%;
  margin-left: 5%;
  margin-bottom: 1%;
  box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px,
    rgba(6, 24, 44, 0) 0px 4px 6px -1px,
    rgba(255, 255, 255, 0) 0px 1px 0px inset;
  font-size: 1.1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

table {
  width: 1300px;
  box-sizing: border-box;
}

table,
tr,
th {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 10px;
  text-align: center;
}

.btn_detail {
  width: 70%;
  font-size: 0.9rem;
  background: orange;
  margin: auto;
}

.btn_edit_delete .btn_delete,
.btn_edit {
  width: 40%;
  font-size: 0.9rem;
}

.btn_edit {
  background: #63bfe7;
}

.btn-cancel,
.btn-delete {
  width: 80px;
}

.btn-delete {
  background: #63bfe7;
  color: #fff;
}

.background {
  width: 35%;
  margin: auto;
  padding: 20px;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px,
    rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}

.btn_cancel_delete {
  width: 50%;
  margin: auto;
}

.pop_up {
  margin: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  top: center;
  right: 0;
  left: 0;
  inset: 0;
  background: rgba(0, 0, 0, 0.7);
}

/* .pop_up_detail {
  margin: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  top: center;
  right: 0;
  left: 0;
  inset: 0;
  background: rgba(0, 0, 0, 0.7);
}

.pop_up_detail .background {
  width: 80%;
  margin: auto;
  padding: 20px;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px,
    rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}

.pop_up_detail .header {
  background: blue;
  color: #fff;
} */

.question_mark {
  font-size: 7rem;
  color: red;
}
</style>
