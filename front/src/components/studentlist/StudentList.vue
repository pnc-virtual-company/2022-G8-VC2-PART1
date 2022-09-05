<template>
  <div class="student_list">
    <div
      class="header d-flex justify-content-between align-items-center"
    >
      <div class="filter_by_name m-2">
        <label class="form-label required" for="filter_by_name"></label>
        <input
          class="form-control p-2"
          type="text"
          id="filter_by_name"
          placeholder="Filter by name"
          v-model="filter_by_name"
        />
      </div>
      <div class="filter_by_batch m-2">
        <label class="form-label required" for="filter_by_name"></label>
        <input
          class="form-control p-2"
          type="text"
          id="filter_by_name"
          placeholder="Filter by batch   "
          v-model="filter_by_batch"
        />
      </div>
      <div class="btn d-flex justify-content-between align-items-center ">
        <router-link to="/addstudent" class="btn_add">
          Add Student
        </router-link>
      </div>
    </div>
      <student_item
        @isHideFilter="isHideFilter = !isHideFilter"
        :students="students"
        :filterData="filterData"
      >
      </student_item>
  </div>
</template>

<script>
  import StudentItem from "@/components/studentlist/StudentItem.vue";
  export default {
    props: { students: Object },
    inject: ["students"],
    components: {
      student_item: StudentItem,
    },
    data() {
      return {
        // isHideFilter: false,
        filter_by_name: "",
        filter_by_batch: "",
      };
    },
    computed: {
      filterData() {
        let data_filter = this.students;
        if (this.filter_by_name != "" && this.filter_by_batch != "") {
          data_filter = this.students.filter(
            (student) =>
              (student.first_name.toLowerCase() ===
                this.filter_by_name.toLowerCase() ||
                student.last_name.toLowerCase() ===
                  this.filter_by_name.toLowerCase()) &&
              student.batch.toLowerCase() == this.filter_by_batch.toLowerCase()
          );
        }
        else if (this.filter_by_name != "" && this.filter_by_batch == "") {
          data_filter = this.students.filter(
            (student) =>
              student.first_name.toLowerCase() ===
                this.filter_by_name.toLowerCase() ||
              student.last_name.toLowerCase() ===
                this.filter_by_name.toLowerCase() ||
              student.first_name.toLowerCase() +
                " " +
                student.last_name.toLowerCase() ===
                this.filter_by_name.toLowerCase()
          );
        }
        else if (this.filter_by_batch != "") {
          data_filter = this.students.filter(
            (student) => student.batch === this.filter_by_batch
          );
        }
        return data_filter;
      },
    },
  };
</script>

<style scoped>
.student_list {
  margin-top: 3%;
  box-sizing: border-box;
}

.header {
  width: 90%;
  border-radius: 7px;
  margin-left: 4.5%;
  display: flex;
  position: fixed;
  right: 0;
  left: 0;
}

.filter_by_name {
  width: 40%;
}

.filter_by_batch {
  width: 40%;
}

.header button {
  background: none;
  border: none;
}

.btn {
  box-sizing: border-box;
  background: #63bfe7;
  margin-top: 2.2%;
}

.btn a {
  box-sizing: border-box;
  text-decoration: none;
  padding: 2.2px;
  color: #fff;
}
</style>