<template>
  <div class="form_filter">
    <div class="search_bar">
      <div class="filter_by_status">
        <span>Filter By Status</span>
        <select name="cars" id="cars" v-model="status">
          <option value="Show all" selected>Show all</option>
          <option value="Padding">Padding</option>
          <option value="Approve">Approve</option>
          <option value="Cancelled">Cancelled</option>
          <option value="Reject">Reject</option>
        </select>
      </div>
      <div class="filter_by_leave_types">
        <span>Filter By Leave Types</span>
        <select name="cars" id="cars" v-model="leave_type">
          <option value="Show all" selected>Show all</option>
          <option value="Sick Leave">Sick Leave</option>
          <option value="Wedding">Wedding</option>
          <option value="Family's event">Family's event</option>
          <option value="Brother's and Sister's event">
            Brother's and Sister's event
          </option>
        </select>
      </div>
    </div>

    <ul>
      <list_card :filterData="filterData"></list_card>
    </ul>
  </div>
</template>

<script>
import ListCard from "@/components/list_all_leave/ListAllLeaveCard.vue";

export default {
  inject: ["list_all_leaves"],
  data() {
    return {
      status: "Show all",
      leave_type: "Show all",
      list_all_leave: [],
    };
  },
  components: {
    list_card: ListCard,
  },
  computed: {
    filterData() {
      let all_data = this.list_all_leaves;
      if (this.status !== "Show all" && this.leave_type !== "Show all") {
        all_data = this.list_all_leaves.filter((students) => {
          students.status.toLowerCase() == this.status.toLowerCase() &&
            students.leave_type.toLowerCase() == this.leave_type.toLowerCase;
        });
      }
      if (this.status.toLowerCase() !== "Show all") {
        all_data = this.list_all_leaves.filter(
          (students) =>
            students.status.toLowerCase() == this.status.toLowerCase()
        );
      }
      if (this.leave_type.toLowerCase() !== "Show all") {
        all_data = this.list_all_leaves.filter(
          (students) =>
            students.leave_type.toLowerCase() == this.leave_type.toLowerCase()
        );
      }
      if (all_data.length > 0 && this.status === "Show all") {
        all_data = this.list_all_leaves.filter(
          (students) =>
            students.status.toLowerCase() == this.status.toLowerCase()
        );
      }
      if (all_data.length > 0) {
        return all_data;
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
ul {
  margin-top: 2%;
}
</style>
