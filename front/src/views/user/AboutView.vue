<template>
  <new_request @new_request="addRequest">
  </new_request>
</template>
<script>
import Newrequest from '@/components/Newrequest/Newrequest.vue';
// import axios from "../../axios-http"
export default {
  name:"About-view",
  components:{
    "new_request":Newrequest,
  },
  mehtods: {
    // getData() {
    //   axios.get("/leaves").then((response) => {
    //    console.log(response.data);
    //   }

    //   )
    // },  
  //   addRequest(body) {
  //     console.log(body);
  //     axios.post("/leaves", body)
  //     // this.getData()
  //   }
    // }
  }
}
</script>
<style scoped>

.about {
  box-sizing: border-box;
  margin-top: 4.5%;
  display: flex;
  justify-content: center;
  align-items: center;
  /* background: #cccc; */
}
</style>