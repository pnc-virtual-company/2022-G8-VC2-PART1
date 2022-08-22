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
      list_all_leaves: [],
    }
  },
  methods: {
    getData() {
      axios.get("/leaves").then((response) =>
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
      list_all_leaves: this.list_all_leaves,
      request:this.request
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