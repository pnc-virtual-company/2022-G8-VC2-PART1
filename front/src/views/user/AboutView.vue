<template>
  <new_request></new_request>
</template>
<script>
import NewRequest from '@/components/Newrequest/New/Request.vue';
// import axios from "../../axios-http"
export default {
  name:"About-view",
  components:{
    "new_request":NewRequest,
  },
  mehtods: {
   
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