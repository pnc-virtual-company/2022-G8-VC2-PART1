<template>
  <Newrequest/>
</template>
<script>
import Newrequest from '@/components/Newrequest/Newrequest.vue';
export default {
  name:"About-view",
  components:{
    Newrequest,
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