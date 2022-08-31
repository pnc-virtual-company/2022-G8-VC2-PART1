<template>
   
    <div class="container">
        <div class="user_profile">
            <div class="profile">
                <div class="circle">
                    <img class="profile-img" :src="student.image != undefined ? 'http://127.0.0.1:8000/api/students/image/' + student.image : ''">
                </div>
                <div>
                    <label class="label-file-upload" for="upload-profile">Change Profile</label>
                    <input id="upload-profile" class="file-upload" type="file" @change="onChangeProfile" />
                </div>
            </div>
            
            <div class="user_information">
                <p>First Name : <span style="margin-left:10px">{{student.first_name}}</span> </p>
                <p>Last Name : <span style="margin-left:15px">{{student.last_name}}</span> </p>
                <p>Gender : <span style="margin-left:52px"> {{student.gender}}</span> </p>
                <p>Email : <span style="margin-left:65px">{{student.email}}</span></p>
                <div class="btn_reset">
                    <button>RESET</button>
                </div>
            </div>
        </div>

        <div v-if="isFileUploaded" class="image-preview-container">
            <div class="image-preview">
                
                <img :src="uploadedImage" width="250px" height="200px" alt="">
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

// import BaseCard from "@/components/UI/BaseCard.vue";
export default {
    data(){
        return {
            user_id: null,
            student: {},
            image: null,
            isFileUploaded: false,
            uploadedImage: null,
            allowExtension: ['jpg', 'png', 'jpeg'],
        }
    },
    components: {
        // 'base_card': BaseCard
    },

    methods:{
        onChangeProfile(event) {
            let fileExtension = event.target.files[0].name.split('.').pop();
            if (this.allowExtension.includes(fileExtension.toLowerCase())) {
                this.image = event.target.files[0];
                
                let reader = new FileReader();
                reader.readAsDataURL(this.image);
                reader.onload = e => {
                    this.uploadedImage = e.target.result;
                }

                this.isFileUploaded = true;
            }
        },

        saveChange() {
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('image', this.image);

            this.closePreview();

            axios.post('/students/profile/' + this.user_id, formData).then( res => {
                if (res) {
                    this.getData();
                }
            });
        },

        closePreview() {
            this.isFileUploaded = false;
            this.image = null;
            this.uploadedImage = null;
        },

        getData() {
            axios.get('social_affairs/students/'+this.user_id).then(res => {
                this.student = res.data;
            })
        }
    },

    created() {
        this.user_id = JSON.parse(localStorage.getItem('userId'));
        this.getData();
    }
}

</script>

<style scoped>

body {
    background-color: #efefef;
}

.container {
    width: 100%;
    display: flex;
    /* flex-direction: column; */
    align-content: center;
}

.user_profile{
   
    margin: auto;
    width: 50%;
    padding: 20px;
    margin-top: 10%;
    background: rgb(187, 186, 186);
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    border-radius: 7px;
    display: flex;
    justify-content: space-between;
    align-items: center ;
}

.profile-img {
    width: 128px;
    height: 128px;
    display: block;
} 
.profile{
    width: 40%;
}
.user_information{
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
    height: 350px;
    background: #ccc;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-content: center;
    margin-top: 100px;
}
.image-preview img {
    margin: auto;
    margin-top:10px ;
    height: 90%;
    width: 90%;
}
.image-preview button {
    width: 100%;
    background: #63BFE7;
    cursor: pointer;
}
.label-file-upload{
    background: #63BFE7;
    font-weight: bold;
    margin-top: 85px;
    padding: 10px;
    border-radius: 7px;
    cursor: pointer;
}

.user_profile p{
    font-size: 1.4rem;
    color:#000;
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


</style>