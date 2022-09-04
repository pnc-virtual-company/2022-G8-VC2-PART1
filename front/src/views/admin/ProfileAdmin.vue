<template>
  <div class="container">
    <div class="user_profile">
      <div class="profile">
        <input hidden
          id="upload-profile"
          class="file-upload"
          type="file"
          @change="onChangeProfile"
        />
        
        <label 
          class="label-file-upload" for="upload-profile">
            <img src="./../../assets/white_camera.png" style="width: 100%; " alt="">
        </label>
        <div class="circle">
          <img v-if="isLoadingProfile" style="position: absolute; width: 40px;" src="./../../assets/loading_circle.gif">
          <img
            class="profile-img" :src="user.image != undefined
                ? 'http://127.0.0.1:8000/api/image/' + user.image : ''
            "
          />
        </div>
      </div>

      <div style="display: flex; font-weight: bold;">
        <p style="font-size: x-large;">{{ user.first_name }}</p>
        <p style="font-size: x-large;">{{ user.last_name }}</p>
      </div>

      <div class="user_information mt-3">
        <div class="info-container">
          <div
            class="main_card d-flex justify-content-between align-items-center">
            <div class="side_left w-50">
              <div class="d-flex w-100">
                <p class="title">First Name</p>
                <p class="content">{{ user.first_name }}</p>
              </div>
              
              <div class="d-flex w-100">
                <p class="title">Gender</p>
                <p class="content">{{ user.gender }}</p>
              </div>
            </div>
            <div class="side_right w-50">
              <div class="d-flex w-100">
                <p class="title">Last Name</p>
                <p class="content">{{ user.last_name }}</p>
              </div>
              
              <div class="d-flex w-100">
                <p class="title item">Position</p>
                <p class="content">{{ user.position }}</p>
              </div>
            </div>
          </div>
          <div class="d-flex w-100">
            <p style="width: 17.5%; margin: 0; font-weight: 550;">Email</p>
            <p style="width: 80%; margin: 0;">{{ user.email }}</p>
          </div>
        </div>
        <div class="btn_reset">
          <button>Reset password</button>
        </div>
      </div>
    </div>

    <div v-if="isFileUploaded" class="image-preview-container">
      <div class="image-preview">
        <img :src="uploadedImage" style="width: 300px; height: 300px" alt="" />
        <div class="btn">
          <button @click="closePreview">Cancle</button>
          <button @click="saveChange">Change</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "../../axios-http.js";

export default {
  data() {
    return {
      user_id: null,
      user: {},
      image: null,
      isFileUploaded: false,
      uploadedImage: null,
      allowExtension: ["jpg", "png", "jpeg", "gif", "webp"],
      isLoadingProfile: false,
    };
  },

  methods: {
    onChangeProfile(event) {
      let fileExtension = event.target.files[0].name.split(".").pop();
      if (this.allowExtension.includes(fileExtension.toLowerCase())) {
        this.image = event.target.files[0];

        let reader = new FileReader();
        reader.readAsDataURL(this.image);
        reader.onload = (e) => {
          this.uploadedImage = e.target.result;
        };

        this.isFileUploaded = true;
      }
    },

    saveChange() {
      let formData = new FormData();
      formData.append("_method", "PUT");
      formData.append("image", this.image);
      this.closePreview();
      this.isLoadingProfile = true;
      axios.post("/social_affairs/profile/" + this.user_id, formData).then((res) => {
        if (res) {
          this.getData();
          this.$emit('update-profile');
          this.$emit('update-nav');
        }
      });
    },

    closePreview() {
      this.isFileUploaded = false;
      this.image = null;
      this.uploadedImage = null;
    },

    getData() {
      axios
        .get("social_affairs/" + this.user_id)
        .then((res) => {
          this.user = res.data;
          this.isLoadingProfile = false;
        });
    },
  },

  created() {
    this.user_id = JSON.parse(localStorage.getItem("userId"));
    this.getData();
  },
};
</script>

<style scoped>
.info-container {
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
  padding: 15px;
  border-radius: 10px;
}
.title {
  width: 35%;
  margin: 0;
  font-weight: 550;
}
.content {
  width: 65%;
  margin: 0;
  text-transform: capitalize;
}

.profile {
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
}
.container {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.user_profile {
  width: 90%;
  margin: auto;
  padding: 20px;
  margin-top: 100px;
  background: #ffff;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 7px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.circle {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  border: 2px solid rgba(183, 183, 183, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
}
.profile-img {
  border-radius: 50%;
  width: 100%;
  height: 100%;
}

.user_information {
  width: 85%;
}
.image-preview-container {
  width: 100%;
  height: 100%;
  background: rgba(119, 119, 119, 0.473);
  position: fixed;
  top: 0;
  left: 0;
  z-index: 10000;
  display: flex;
  justify-content: center;
  align-content: center;
}
.image-preview {
  width: 400px;
  height: 400px;
  margin-top: 10%;
  background: #ccc;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-content: center;
}
.image-preview img {
  margin: auto;
}
.image-preview button {
  width: 200px;
  background: #63bfe7;
  cursor: pointer;
  border: none;
  margin: 5px;
  color: #ffff;
  border-radius: 7px;
  padding: 5px;
}
.label-file-upload {
  margin: auto;
  padding: 10px;
  border-radius: 7px;
  cursor: pointer;
  margin: auto; 
  width: 40px; 
  height: 40px; 
  border-radius: 50%; 
  display: flex; 
  justify-content: center; 
  align-items: center; 
  position: absolute; 
  color: white; 
  background: #63bfe7; 
  margin-bottom: 5px; 
  margin-right: 20px;
}
.user_profile p {
  font-size: 1.1rem;
  color: #000;
}
.btn_reset {
  margin: auto;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.btn_reset button {
  margin-top: 10px;
  background: #63bfe7;
  cursor: pointer;
  border: none;
  color: #ffff;
  padding: 10px;
  border-radius: 7px;
}
.file-upload {
  display: none;
}
p {
  /* border: 2px solid #ccc; */
  padding: 5px;
  margin: 2px;
}

</style>