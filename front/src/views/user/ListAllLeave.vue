<template>
  <div class="home">
    <list_form></list_form>
  </div>
</template>

<script>
// @ is an alias to /src
import LeaveForm from "@/components/list_all_leave/ListForm.vue";
import axios from "../../api/api.js";
export default {
  name: 'HomeView',
  components: {
    "list_form": LeaveForm
  },
  data() {
    return {
      list_all_leaves: []
    }
  },
  methods: {
    getData() {
      axios.get("/students/leaves").then((response) =>
      {
        for (let k = 0; k < response.data.length; k++) { 
          if (localStorage.getItem("studentID") == response.data[k].student_id) {
            this.list_all_leaves.push(response.data[k])
          }
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
  width: 100%;
  margin-top:6%;
  border-radius: 7px;
  padding: 30px;
  box-sizing: border-box;
}

</style>