<template>
  <li>
    <!--======== delete pop up =========-->
    <div class="pop_up  " v-if="showPopup">
      <div class="background">
        <div class="text text-center">
          <p class="fs-2">Are you sure to delete?</p>
          <span class="question_mark material-symbols-outlined">
            help
          </span>
        </div>
        <div class="btn btn_cancel_delete d-flex justify-content-between align-items-center">
          <button class="btn btn-cancel btn-danger" @click="showPopup =false">Cancel</button>
          <button class="btn btn-delete " @click="deleteStudent(index,students_id)">Delete</button>
        </div>
      </div>
    </div>
    <!-- ===== student card ===== -->
    <div class="main_card">
      <table>
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">STUDENT</th>
            <th scope="col" style="width:250px">EMAIL</th>
            <th scope="col">CLASS</th>
            <th scope="col">BATCH</th>
            <th scope="col">INFO</th>
            <th scope="col">ACTIVE</th>
          </tr>
        </thead>
        <tbody v-if="filterData.length > 0">
          <tr v-for="(student,index) of filterData" :key="student" :index="index" :first_name="student.first_name"
            :last_name="student.last_name">
            <th scope="row">{{student.studentID}}</th>
            <td>{{student.first_name}}{{" "}}{{student.last_name}}</td>
            <td style="width:190px">{{student.email}}</td>
            <td>{{student.class}}</td>
            <td>{{student.batch.toUpperCase()}}</td>
            <td>
              <router-link :to="/student_details/ + student.id" class="btn btn_detail text-decoration-none text-light">
                DETAILS
              </router-link>
              
            </td>
            <td class="btn_edit_delete">
              <button class="btn btn_delete bg-danger text-center text-light"
                @click="onDelete(index,student.id)">DELETE</button>
              <router-link to="/new_request" class="btn btn_edit text-decoration-none  text-light m-1">EDIT
              </router-link>
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
import axios from "../../api/api.js"
export default {
  props: ['filterData',],
  inject: ['students'],
  data() {
    return {
      showPopup: false,
      students_id: null,
      index: null
    }
  },
  methods:{
    deleteStudent(index, id) {
      console.log(index, id);
      axios.delete("social_affiars/students/" + id).then((res) => {
        console.log(res)
      })
      this.students.splice(index, 1)
      this.showPopup = false
    },
    onDelete(index, id) {
      console.log(index,id)
      this.showPopup = true;
      this.students_id = id;
      this.index = index;
    },

  }
};
</script>

<style scoped>



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
.btn_detail{
  width: 70%;
  font-size: 0.9rem;
  background: orange;
  margin: auto;
}
.btn_edit_delete .btn_delete, .btn_edit{
  width: 40%;
  font-size: 0.9rem;
}
 .btn_edit{
  background: #63BFE7;
}
.btn-cancel, .btn-delete{
  width: 80px;
}
.btn-delete{
  background: #63BFE7;
  color:#fff;
}
.background{
  width: 35%;
  margin: auto;
  padding: 20px;
  background: #fff;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
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
  background: rgba(0, 0, 0, 0.7) ;
}
.pop_up_detail {
  margin: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  top: center;
  right: 0;
  left: 0;
  inset: 0;
  background: rgba(0, 0, 0, 0.7) ;
}
.pop_up_detail .background{
  width: 80%;
    margin: auto;
    padding: 20px;
    background: #fff;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}
.pop_up_detail .header{
  background: blue;
  color:#fff;
}
.question_mark{
  font-size: 7rem;
  color:red;
}
</style>
