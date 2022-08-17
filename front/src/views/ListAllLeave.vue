<template>
  <div class="home">
    <leave_view >
    </leave_view>
  </div>
</template>

<script>
// @ is an alias to /src
import LeaveView from "@/components/list_all_leave/ListAllLeaveView.vue"
export default {
  name: 'HomeView',
  components: {
    "leave_view":LeaveView
  },
  data() {
    return {
      list_all_leaves: [
        { request_date: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Padding", leave_type: "Family's event" },
        { request_date: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Approve", leave_type: "Wedding" },
        { request_date: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Cancelled", leave_type: "Family's event" },       
        { request_date: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Padding", leave_type: "Sick Leave" },       
        { request_date: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Padding", leave_type: "Sick Leave" },       
      ]
    }
  },
  provide() {
    return {
      list_all_leaves: this.list_all_leaves
    }
  },
 
}
</script>
<style scoped>

* {
  padding: 0;
  margin: 0;
}

.home {
  box-sizing: border-box;
  margin-top: 4%;
  display: flex;
  justify-content: center;
  align-items: center;
  /* background: #cccc; */
}

</style>