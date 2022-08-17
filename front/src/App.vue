<template>
  <nav-bar></nav-bar>
  <router-view />
</template>
<script>
import NavBar from "@/components/menu/NavBar.vue"
export default {
  components: {
    "nav-bar": NavBar
  }
}

</script>
<style >


* {
  padding: 0;
  margin: 0;
  font-family: Avenir, Helvetica, Arial, sans-serif;
}
#app{
  background: #ccc;
  height: 100vh;
  box-sizing: border-box;
}

</style>
