<template>
  <div class="home">
    <leave_view></leave_view>
  </div>
</template>

<script>
// @ is an alias to /src
import LeaveView from "@/components/list_all_leave/ListAllLeaveView.vue";
import axios from "../../axios-http.js";
export default {
  name: 'HomeView',
  components: {
    "leave_view":LeaveView
  },
  data() {
    return {
      list_all_leaves: [
        { created_at: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Padding", leave_type: "Family's event" },
        { created_at: "08-Feb-2022", start_date: "08-Feb-2022", end_date: "09-Feb-2022", reason: "Headache", duration: "1", status: "Approve", leave_type: "Wedding" },
      ]
    }
  },
  methods: {
    getData() {
      axios.get("/students/leaves").then((response) =>
      {
        for (let k = 0; k < response.data.length; k++) { 
          this.list_all_leaves.push(response.data[k])
        }
      }
      )
    }
  },
  provide() {
    return {
      list_all_leaves: this.list_all_leaves
    }
  },
  mounted() {
    this.getData();
  }
 
}
</script>
<style scoped>
.home {
  width: 75%;
  margin-left: 12.5%;
  margin-top:8%;
  background: #fff;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 7px;
  padding: 30px;
  box-sizing: border-box;
  display: flex;
  justify-content: center;
  align-items: center;
}

</style>