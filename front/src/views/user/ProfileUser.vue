<template>
  <div class="user_profile">
    <div class="profile">
      <div class="circle">
        <img class="profile-pic" src="../../assets/pn-logo.png" />
      </div>
      <div class="p-image">
        <i class="fa fa-camera upload-button"></i>
        <input class="file-upload" type="file" accept="image/*" />
      </div>
    </div>
    <div class="user_information">
      <p>
        First Name :
        <span style="margin-left: 10px">{{ student_first_name }}</span>
      </p>
      <p>Last Name : <span style="margin-left: 15px">{{student_last_name}}</span></p>
      <p>Gender : <span style="margin-left: 52px"> {{student_gender }}</span></p>
      <p>Email : <span style="margin-left: 65px">{{student_email}}</span></p>
      <p>Email : <span style="margin-left: 65px">{{student_class}}</span></p>
      <p>Email : <span style="margin-left: 65px">{{student_batch}}</span></p>
      <p>Email : <span style="margin-left: 65px">{{student_phone}}</span></p>
      <div class="btn_reset">
        <button>RESET</button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "../../api/api.js";
export default {
  data() {
    return {
      student_first_name: null,
      student_last_name: null,
      student_email: null,
      student_phone: null,
      student_batch: null,
      student_gender: null,
      student_class: null,
    };
  },
  methods: {
    getStudent() {
      axios.get("/social_affairs/students").then((response) => {
        for (let k of response.data) {
          if (localStorage.getItem("studentID") == k.id) {
            this.student_first_name = k.first_name;
            this.student_last_name = k.last_name;
            this.student_gender = k.gender;
            this.student_batch = k.batch;
            this.student_class = k.class;
            this.student_phone = k.phone;
            this.student_email = k.email;
          }
        }
      });
    },
  },
  mounted() {
    this.getStudent();
  },
};
</script>

<style scoped>
.user_profile {
  width: 40%;
  padding: 20px;
  margin-top: 10%;
  margin-left: 30%;
  background: #ccc;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 7px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.user_profile p {
  font-size: 1.4rem;
  color: #000;
}
.btn_edit button {
  background: #63bfe7;
  color: #fff;
  border: none;
  padding: 10px;
}

body {
  background-color: #efefef;
}

.profile-pic {
  width: 128px;
  height: 128px;
  display: block;
}

.file-upload {
  display: none;
}

.circle {
  margin-top: 6%;
  border-radius: 1000px !important;
  overflow: hidden;
  width: 128px;
  height: 128px;
  border: 8px solid rgba(255, 255, 255, 0.7);
  position: absolute;
  top: 72px;
}

img {
  max-width: 100%;
  height: auto;
}

.p-image {
  position: absolute;
  top: 167px;
  right: 30px;
  color: #666666;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.p-image:hover {
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.upload-button {
  font-size: 1.2em;
}

.upload-button:hover {
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  color: #999;
}
</style>