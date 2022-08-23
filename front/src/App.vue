<template>
  <!-- <login></login> -->
  <nav-bar ></nav-bar>
  <router-view />
</template>
<script>
// import Login from "@/components/formlogin/FormLogin.vue"
import NavBar from "@/components/menu/NavBar.vue"
export default {
  components: {
    "nav-bar": NavBar,
    // "login":Login
  },
  data() {
    return {
      isLogin: false,
    }
  },
  methods: {
    showMeu(loginn) {
      this.isLogin = loginn;
      this.$router.push("/new_request");
    },
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
