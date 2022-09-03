<template>
  <div class="container">
    <div class="user_profile">
      <div class="profile w-25">
        <div>
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
          <div class="btn_change">
            <label
              class="label-file-upload text-light text-center"
              for="upload-profile"
              >Change Profile</label
            >
            <input
              id="upload-profile"
              class="file-upload"
              type="file"
              @change="onChangeProfile"
            />
          </div>
        </div>
      </div>
      <div class="user_information w-75 mt-3">
        <div
          class="main_card d-flex justify-content-between align-items-center"
        >
          <div class="side_left w-50">
            <p>
              First Name <span style="margin-left: 20px">:</span>
              <span style="margin-left: 10px">{{ student.first_name }}</span>
            </p>
            <p>
              Batch <span style="margin-left: 61px">:</span>
              <span style="margin-left: 10px">{{ student.batch }}</span>
            </p>
            <p>
              Gender <span style="margin-left: 45px">:</span>
              <span style="margin-left: 10px">{{ student.gender }}</span>
            </p>
          </div>
          <div class="side_right w-50">
            <p>
              Last Name <span style="margin-left: 10px">:</span>
              <span style="margin-left: 15px">{{ student.last_name }}</span>
            </p>
            <p>
              Class <span style="margin-left: 61px">:</span>
              <span style="margin-left: 15px">{{ student.class }}</span>
            </p>
            <p>
              Phone <span style="margin-left: 49px">:</span>
              <span style="margin-left: 15px">{{ student.phone }}</span>
            </p>
          </div>
        </div>
        <p>
          Email <span style="margin-left: 58px">:</span>
          <span style="margin-left: 13px">{{ student.email }}</span>
        </p>
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
          <button @click="saveChange">Save Change</button>
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
      student: {},
      image: null,
      isFileUploaded: false,
      uploadedImage: null,
      allowExtension: ["jpg", "png", "jpeg", "gif", "webp"],
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

      axios.post("/students/profile/" + this.user_id, formData).then((res) => {
        if (res) {
          this.getData();
          this.$emit("update-nav");
        }
      });
    },

    closePreview() {
      this.isFileUploaded = false;
      this.image = null;
      this.uploadedImage = null;
    },
    getData() {
      axios.get("social_affairs/students/" + this.user_id).then((res) => {
        this.student = res.data;
      });
    },
  },

  created() {
    this.user_id = JSON.parse(localStorage.getItem("studentID"));
    this.getData();
  },
};
</script>

<style scoped>
.container {
  margin-top: 7%;
}
.user_profile {
  width: 90%;
  margin: auto;
  padding: 20px;
  background: #ffff;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 7px;
}
.circle {
  margin-top: 1%;
  width: 200px;
  height: 200px;
  position: absolute;
  border-radius: 50%;
  border: 2px solid rgba(183, 183, 183, 0.7);
  overflow: hidden;
}
.profile-img {
  display: flex;
  margin: auto;
  display: inline;
  justify-content: center;
  align-items: center;
  height: 200px;
  width: auto;
}

.card-body {
  display: flex;
  justify-content: center;
  align-items: center;
}
.user_information {
  width: 60%;
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
  width: 50%;
  margin-left: 10%;
  margin-top: 80%;
  background: #63bfe7;
  padding: 10px;
  border-radius: 7px;
  cursor: pointer;
}
.user_profile {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.user_profile p {
  font-size: 1.1rem;
  color: #000;
}
.btn_change label {
  width: 150px;
  margin-top: 220px;
}
.btn_reset {
  margin-top: 3%;
  margin-left: 40%;
}
.btn_reset button {
  margin-left: 70%;
  background: #63bfe7;
  cursor: pointer;
  border: none;
  margin: 5px;
  color: #ffff;
  padding: 10px;
  border-radius: 7px;
}
.file-upload {
  display: none;
}
p {
  border: 2px solid #ccc;
  padding: 5px;
  margin: 2px;
}
</style>