<template>
  <nav-bar v-if="isLogin" @request-logout="logout" :userRole="userRole"></nav-bar>
  <router-view  @request-login="login"/>
</template>
<script>
import axiosApi from './api/api';
import NavBar from "@/components/menu/NavBar.vue"
export default {
  name:'App',
  components: {
    "nav-bar": NavBar,
  },
  data() {
    return {
      isLogin: false,
      user:null,
      userRole:null,
    }
  },
  methods: {
   login(userInfo){
      if (userInfo.email.search('admin') != -1){
        this.adminLogin(userInfo);
    }else if (userInfo.email.search('student') != -1){
      this.studentLogin(userInfo);
    }
   },
   adminLogin(userInfo){
      axiosApi.post('http://127.0.0.1:8000/api/social_affairs/login',userInfo).then((response)=>{
      this.user = response.data.user;
      localStorage.setItem('token',response.data.token);
      localStorage.setItem('userId',this.user.id)
      localStorage.setItem('userRole',"admin");
      this.$router.push('/studentlist')
      this.userRole = "admin";
      this.isLogin = true;
    })
   },
   studentLogin(userInfo){
    axiosApi.post('http://127.0.0.1:8000/api/students/login',userInfo).then((resoponse)=>{
      this.user = resoponse.data.student;
      localStorage.setItem('token',resoponse.data.token);
      localStorage.setItem('userId',resoponse.data.student.id)
      console.log(resoponse.data)
      localStorage.setItem('userRole',"student");
      this.$router.push('/');
      this.userRole = "student";
      this.isLogin = true;
    })
   },
   logout(){
    axiosApi.delete('http://127.0.0.1:8000/api/social_affairs/logout').then((response)=>{
      this.user = null,
      localStorage.removeItem('token');
      localStorage.removeItem('userId');
      localStorage.removeItem('userRole');
      this.$router.push('/login')
      console.log(response.data)
      this.isLogin = false;
      this.userRole = null;
    })
   },
   getUserRole(){
    this.userRole = localStorage.getItem('userRole');
   }
  },
  computed:{
    checklogin(){
      return localStorage.getItem('token')
    },
  },
  mounted(){
    if (localStorage.getItem('token')!=null){
      this.isLogin = true;
    }else {
      this.isLogin = false;
    }
    this.getUserRole()
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
