<template>
  <div class="container">
    <nav>
      <div class="left_side_bar">
        <div class="logo_display">
          <img src="../../assets/pn-logo.png" alt="" />
          <p>SLMS</p>
        </div>
      </div>
      <div class="router">
        <router-link to="/" v-if="userRole == 'student'"
          >List All Leaves</router-link
        >
        <router-link to="/new_request" v-if="userRole == 'student'"
          >New Request</router-link
        >
        <router-link to="/studentlist" v-if="userRole == 'admin'"
          >Student list</router-link
        >
        <router-link to="/checkleave" v-if="userRole == 'admin'"
          >Check Leave</router-link
        >
      </div>
      <div class="user_name">
        <div class="circle">
          <img
            class="profile-img"
            :src="
              student.image != undefined
                ? 'http://127.0.0.1:8000/api/image/' + student.image
                : ''
            "
          />
        </div>
        <div class="user_profile">
          <router-link to="/profile_student" v-if="userRole == 'student'"
            >{{ firstname }}{{ " " }}{{ lastname }}</router-link
          >
          <router-link to="/profile_admin" v-if="userRole == 'admin'"
            >{{ firstname }}{{ " " }}{{ lastname }}</router-link
          >
        </div>
        <div class="btn_sign_out ">
          <button @click="$emit('request-logout')" >
            <img src="../../assets/logout.png" style="width:25px;height:25px;">
          </button>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
import axios from "../../api/api.js";
export default {
  emits: ["request-logout"],
  props: ["userRole"],
  data() {
    return {
      first_name: "",
      last_name: "",
      student: {},
      role: "",
    };
  },
  methods: {
    getData() {
      if (localStorage.getItem("userRole") == "student") {
        axios
          .get(
            "social_affairs/students/" +
              JSON.parse(localStorage.getItem("studentID"))
          )
          .then((res) => {
            this.student = res.data;
          });
      } else if (localStorage.getItem("userRole") == "admin") {
        axios
          .get("social_affairs/" + JSON.parse(localStorage.getItem("userId")))
          .then((res) => {
            this.student = res.data;
          });
      }
    },
  },
  computed: {
    firstname() {
      // this.first_name
      return localStorage.getItem("first_name");
    },
    lastname() {
      // this.last_name =
      return localStorage.getItem("last_name");
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style scoped>
* {
  /* font-family: "Roboto Slab", serif; */
  padding: 0;
  margin: 0;
  font-family: Avenir, Helvetica, Arial, sans-serif;
}
nav {
  background: #63bfe7;
  box-shadow: rgba(60, 64, 67, 1) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.1) 0px 2px 6px 2px;
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 9999;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

nav a {
  text-decoration: none;
  color: #ffff;
  display: flex;
  margin: 10px;
  justify-content: center;
  align-items: center;
  font-size: 1.1rem;
}
nav .router a.router-link-exact-active {
  color: #fff;
  background: orange;
  border-radius: 7px;
  padding: 7px;
}
nav .user_name a.router-link-exact-active {
  color: #fff;
  background: orange;
  border-radius: 7px;
  padding: 7px;
}
.logo_display {
  display: flex;
  align-items: center;
}
.logo_display img {
  width: 55px;
  height: 55px;
  margin-left: 10%;
}
.logo_display p {
  color: #ffff;
  margin-left: 10%;
  font-size: 1.5rem;
}
.router {
  display: flex;
  justify-content: center;
  align-items: center;
}
.user_name {
  width: 23%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.user_name .btn_sign_out {
  margin: 10px;
}
.user_profile {
  margin-left: 30%;
}
.user_profile button {
  background: none;
  border: none;
  cursor: pointer;
}
.btn_sign_out button {
  background: none;
  border: none;
  cursor: pointer;
  color: #ffff;
  font-size: 1.1rem;
}
.btn_sign_out botton img {
  display: flex;
  justify-content: center;
  align-items: center;
}
.profile-img {
  display: flex;
  margin: auto;
  display: inline;
  justify-content: center;
  align-items: center;
  height: 55px;
  width: auto;
}
.circle {
  width: 55px;
  height: 55px;
  margin-left: 2%;
  position: absolute;
  border-radius: 50%;
  border: 2px solid rgba(183, 183, 183, 0.7);
  overflow: hidden;
}
</style>