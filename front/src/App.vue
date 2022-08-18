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
<style>



@import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&family=Roboto:wght@100;300&display=swap');
* {
  padding: 0;
  margin: 0;
  font-family: 'Roboto Slab', serif;
}
#app{
  /* background: #ccc; */
  box-sizing: border-box;
}

</style>
