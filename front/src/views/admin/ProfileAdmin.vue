<template>
  <div class="container">
    <div class="user_profile">
      <div class="profile w-25">
        <div class="">
          <div class="circle">
            <!-- <img
              class="profile-img"
              :src="
                user.image != undefined
                  ? 'http://127.0.0.1:8000/api/image/' + user.image : ''
              "
            /> -->
          </div>
          <div class="btn_change">
            <label class="label-file-upload text-light" for="upload-profile"
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
              First Name <span style="margin-left: 10px">:</span>
              <span style="margin-left: 10px">{{ user.first_name }}</span>
            </p>
            
            <p>
              Gender <span style="margin-left: 45px">:</span>
              <span style="margin-left: 10px">{{ user.gender }}</span>
            </p>
          </div>
          <div class="side_right w-50">
            <p>
              Last Name <span style="margin-left: 10px">:</span>
              <span style="margin-left: 15px">{{ user.last_name }}</span>
            </p>
            
            <p>
              Position <span style="margin-left: 49px">:</span>
              <span style="margin-left: 15px">{{ user.position }}</span>
            </p>
          </div>
        </div>
        <p>
          Email <span style="margin-left: 58px">:</span>
          <span style="margin-left: 13px">{{ user.email }}</span>
        </p>
        <div class="btn_reset">
          <button @click="openResetpassword">Reset password </button>
          <button @click="resetAdminInfo">Reset Admin info</button>
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
              <button id="cancle_btn" @click="cancleResetPassadmin">Cancle</button>
            </div>
          </div>
        </div>
      </div>
    </div>

     <div class="modal-mask resetadmin" v-if="showResetAdmininfo">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="reset_info" >
            <div class="group_item">
              <h1>Reset Admin info</h1>
            </div>
            <div class="group_item">
              <div class="item">
                  <input type="text" placeholder="Firt Name" v-model="first_name">
              </div>
              <div class="item">
                  <input type="text" placeholder="Last Name" v-model="last_name">
              </div>
              <div class="item">
                  <input type="text" placeholder="Gender" v-model="gender">
              </div>
              <div class="item">
                <input type="text" placeholder="Position" v-model="position">
              </div>
              <div class="item">
                <input type="text" placeholder="Email" v-model="email">
              </div>
            </div>
            <div class="group_item footer">
              <button @click="updateInfoadmin">Update</button>
              <button id="cancle_btn" @click="cancleResetAdmininfo">Cancle</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  
</template>
<script>
import axios from "../../api/api.js";
import Swal from "sweetalert2";
export default {
  data() {
    return {
      first_name:null,
      last_name:null,
      gender:null,
      position:null,
      email:null,
      showResetAdmininfo:false,
      showResetPs:false,
      old_password:null,
      new_password:null,
      newconfirm_password:null,
      user_id: null,
      user: {},
      image: null,
      isFileUploaded: false,
      uploadedImage: null,
      allowExtension: ["jpg", "png", "jpeg", "gif", "webp"],
    };
  },

  methods: {
     resetPassword(){
      let body = {current_password:this.old_password,new_password:this.new_password,confirmnew_password:this.newconfirm_password}
      axios.put('http://127.0.0.1:8000/api/social_affairs/resetPassword/'+this.user_id,body).then((response)=>{
          if (response.data.sms=="Admin password have been change!"){
          Swal.fire({
            position:'center',
            icon:"success",
            title:"Password is updated",
            showConfirmButton:false,
            timer:950,
          });
         }else if (response.data.sms=="old password is not correct"){
          Swal.fire({
            position:'center',
            icon:"error",
            title:"Your current password is not correct!",
            showConfirmButton:false,
            timer:1500,
          });
         }else if (response.data.sms=="New password and New password confirm are not equal"){
          Swal.fire({
            position:'center',
            icon:"error",
            title:"Please check your new and new confirm passowrd again!",
            showConfirmButton:false,
            timer:1500,
          });
         }
      })
      this.old_password = null;
      this.new_password = null;
      this.newconfirm_password = null;
      this.showResetPs = !this.showResetPs;
      console.log('admin reset password')
    },
    openResetpassword(){
      this.showResetPs = !this.showResetPs;
    },
    cancleResetPassadmin(){
      this.showResetPs = !this.showResetPs;
    },
    resetAdminInfo(){
      this.showResetAdmininfo = !this.showResetAdmininfo;
    },

    updateInfoadmin(){
      let body = {
        first_name:this.first_name,
        last_name:this.last_name,
        gender:this.gender,
        email:this.email,
        position:this.position
      }
      axios.put('social_affairs/'+this.user_id,body).then((response)=>{
        if (response.data.sms=="social affair is updated"){
          Swal.fire({
            position:'center',
            icon:"success",
            title:"Social affair info is updated",
            showConfirmButton:false,
            timer:950,
          });
        }
      })
      this.first_name = null;
      this.last_name = null;
      this.gender = null;
      this.email = null;
      this.position = null;
      this.showResetAdmininfo = !this.showResetAdmininfo;
    },
    
    cancleResetAdmininfo(){
      this.showResetAdmininfo = !this.showResetAdmininfo;
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
      axios.post("/social_affairs/profile/" + this.user_id, formData).then((res) => {
        if (res) {
          this.getData();
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
  margin-top: 1%;
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
.resetadmin {
  margin-top: 33px;
}
</style>