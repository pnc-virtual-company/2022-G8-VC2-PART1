<template>
  <div class="container">
    <div class="user_profile">
      <div class="profile w-25">
        <div >
          <div class="circle">
            <!-- <img
              class="profile-img"
              :src="
                student.image != undefined
                  ? 'http://127.0.0.1:8000/api/image/' + student.image
                  : ''
              "
            /> -->
          </div>
          <div class="btn_change">
            <label class="label-file-upload text-light text-center" for="upload-profile"
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
          <button @click="openResetPs">Reset password </button>
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

    <div class="modal-mask" v-if="showResetPs">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="reset_info" >
            <div class="group_item">
              <h1>Reset Password</h1>
            </div>
            <div class="group_item">
              <div class="item">
                  <input type="password" placeholder="Your old password" v-model="old_password">
              </div>
              <div class="item">
                  <input type="password" placeholder="new password" v-model="new_password">
              </div>
              <div class="item">
                  <input type="password" placeholder="New password confirm" v-model="newconfirm_password">
              </div>
            </div>
            <div class="group_item footer">
              <button @click="resetPassword">Reset</button>
              <button id="cancle_btn" @click="cancleReset">Cancle</button>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
</template>
<script>
import axios from "../../axios-http.js";
import Swal from "sweetalert2";
export default {
  data() {
    return {
      user_id: null,
      showResetPs:false,
      student: {},
      image: null,
      isFileUploaded: false,
      uploadedImage: null,
      old_password:null,
      new_password:null,
      newconfirm_password:null,
      allowExtension: ["jpg", "png", "jpeg", "gif", "webp"],
    };
  },

  methods: {
    resetPassword(){
      let body = {confirm_current_password:this.old_password,new_password:this.new_password,newpassword_confirm:this.newconfirm_password}
      axios.put('http://127.0.0.1:8000/api/students/reset_password/'+this.user_id,body).then((response)=>{
         if (response.data.sms=="studen password have been change!"){
          Swal.fire({
            position:'center',
            icon:"success",
            title:"Password is updated",
            showConfirmButton:false,
            timer:950,
          });
         }else if (response.data.sms=="current password is not correct!"){
          Swal.fire({
            position:'center',
            icon:"error",
            title:"Your current password is not correct!",
            showConfirmButton:false,
            timer:1500,
          });
         }else if (response.data.sms=="new password and new password is not equal"){
          Swal.fire({
            position:'center',
            icon:"error",
            title:"New password and Confirm new password is not equal",
            showConfirmButton:false,
            timer:1500,
          });
         }
      })
      this.old_password = null;
      this.new_password = null;
      this.newconfirm_password = null;
      this.showResetPs = !this.showResetPs;
    },
    openResetPs(){
      this.showResetPs = !this.showResetPs;
    },
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
          this.$emit('update-nav');
        }
      });
    },
    cancleReset(){
      this.showResetPs = !this.showResetPs;
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
  width: 100%;
  display: flex;
  flex-direction: column;
  align-content: center;
}
.user_profile {
  width: 90%;
  margin: auto;
  padding: 20px;
  margin-top: 10%;
  background: #ffff;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  border-radius: 7px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.circle {
  margin-top:1%;
  width: 200px;
  height: 200px;
  position: absolute;
  /* top: 53px; */
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
.image-preview  button {
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
.user_profile p {
  font-size: 1.1rem;
  color: #000;
}
.btn_change label {
  width: 150px;
  margin-top: 220px;
}
.btn_reset {
  margin-top:3%;
  margin-left: 40%;
}
.btn_reset button{
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
.modal-mask {
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
.modal-container {
    width: 35%;
    height: auto;
    margin: 0px auto;
    padding: 15px 28px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    font-family: Helvetica, Arial, sans-serif;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}
.modal-enter-from, .modal-leave-to {
    opacity: 0;
}

.modal-enter-active .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
};
.reset_info {
    width: 50%;
    display: flex;
    flex-wrap: wrap;
    margin: 100px auto;
    background-color: #ccc;
    border-radius: 20px;
}
.reset_info .group_item {
    width: 90%;
    margin: 10px auto;
    text-align: center;
}
.reset_info .group_item input {
    width: 95%;
    margin: 10px auto;
    padding: 10px;
    border: none;
    outline:1px solid #63BFE7;
}
button {
    padding: 10px;
    border: none;
    background-color: orange;
    cursor: pointer;
    border-radius:10px ;
    margin-left: 20px;
}
#cancle_btn {
    background-color: rgb(55, 189, 241);
}
</style>