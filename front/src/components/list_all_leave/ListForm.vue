<template>
  <div class="form_filter">
    <div class="search_bar">
      <div class="filter_by_status">
        <span>Filter By Status</span>
        <select name="cars" id="cars" v-model="filter_status">
          <option value="Show all" selected>Show all</option>
          <option value="Pending">Pending</option>
          <option value="Approved">Approved</option>
          <option value="Rejected">Rejected</option>
        </select>
      </div>
      <div class="filter_by_leave_types">
        <span>Filter By Leave Types</span>
        <select name="cars" id="cars" v-model="filter_leave_type">
          <option value="Show all" selected>Show all</option>
          <option value="Sick Leave">Sick Leave</option>
          <option value="Wedding">Wedding</option>
          <option value="Family's event">Family's event</option>
          <option value="Brother's and Sister's event">
            Brother's and Sister's event
          </option>
          <option value="Other Event">
            Other Event
          </option>
        </select>
      </div>
    </div>
    <list_card :filterData="filterData"></list_card>
  </div>
</template>

<script>
import ListCard from "@/components/list_all_leave/ListAllLeaveCard.vue";

export default {
  inject: ["list_all_leaves"],
  data() {
    return {
      filter_status: "Show all",
      filter_leave_type: "Show all",
      list_all_leave: [],
    };
  },
  components: {
    list_card: ListCard,
  },
  computed: {
    filterData() {
      // let all_data = this.list_all_leaves;
      if (this.filter_status != "Show all" && this.filter_leave_type == "Show all") {
        return  this.list_all_leaves.filter(students => 
          students.status.toLowerCase() == this.filter_status.toLowerCase() 
        );
      }else if (this.filter_status == "Show all" && this.filter_leave_type != "Show all") {
        return  this.list_all_leaves.filter(students => 
          students.leave_type.toLowerCase() == this.filter_leave_type.toLowerCase() 
        );
      }
      else if (this.filter_status != "Show all" && this.filter_leave_type != "Show all") {
        return  this.list_all_leaves.filter(students => 
          students.status.toLowerCase() == this.filter_status.toLowerCase() &&
          students.leave_type.toLowerCase() == this.filter_leave_type.toLowerCase()
        );
      } else {
        return this.list_all_leaves;
      }
    },
  },
};
</script>

<style scoped>
.search_bar {
  width: 80%;
  margin-left: 10%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.form_filter {
  width: 90%;
  margin: auto;
}

.filter_by_status {
  width: 45%;
}
.filter_by_leave_types {
  width: 45%;
}

.filter_by_status select {
  width: 100%;
  padding: 10px;
  font-size: rem;
  border-radius: 7px;
  outline: none;
}
.filter_by_leave_types select {
  width: 100%;
  padding: 10px;
  border-radius: 7px;
  outline: none;
}

.filter_by_status span {
  padding: 10px;
  font-size: 1rem;
  border-radius: 7px;
}

.filter_by_leave_types span {
  padding: 10px;
  font-size: 1rem;
  border-radius: 7px;
}
</style>