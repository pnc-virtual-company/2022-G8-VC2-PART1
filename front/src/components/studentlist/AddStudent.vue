<template>
    <div class="container">
        <button type="button" class="btn btn-primary btn-add  mt-4" data-bs-toggle="modal"
            data-bs-target="#myModal">+Add Student</button>
        <div class="modal " id="myModal">
            <div class="modal-dialog">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title text-light ">ADD STUDENT</h5>
                        <button type="button" class="btn-close btn-close-light" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="addStudent">
                            <div class="mb-2">
                                <label class="form-label required">Username</label>
                                <div class="input d-flex justify-content-between">
                                    <input type="text" class="form-control " placeholder="firstname"
                                        v-model="first_name">
                                    <input type="text" class="form-control " placeholder="lastname" v-model="last_name">
                                </div>
                            </div>
                            <div class="mb-1">
                                <div class="input d-flex justify-content-between">
                                    <div class="gender">
                                        <label class="form-label required">Gender</label>
                                        <select class="form-select form-select-md  mb-3"
                                            aria-label=".form-select-lg example" v-model="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="batch">
                                        <label class="form-label required">Batch</label>
                                        <select class="form-select form-select-md  mb-3"
                                            aria-label=".form-select-lg example" v-model="batch">
                                            <option value="batch2022">Batch 2022</option>
                                            <option value="batch2023">Batch 2023</option>
                                            <option value="batch2024">Batch 2024</option>
                                            <option value="batch2025">Batch 2025</option>
                                            <option value="batch2026">Batch 2026</option>
                                            <option value="batch2027">Batch 2027</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" placeholder="email" v-model="email">
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Phone number</label>
                                <input type="text" class="form-control " placeholder="phone number"
                                    v-model="phonenumber">
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Password</label>
                                <input type="password" class="form-control " placeholder="password" v-model="password">
                            </div>
                            <div class="mb-1">
                                <label class="form-label required">Profile</label>
                                <input type="file" class="form-control " placeholder="profile">
                            </div>
                            <div class="modal-footer d-flex justify-content-center align-items-center">
                                <input type="submit" class="btn btn-primary p-2 w-25" value="Submit" ref="myFiles"
                                    @change="previewFiles">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "../../axios-http.js"
export default {
    data() {
        return {
            first_name: null,
            last_name: null,
            gender: null,
            batch: null,
            email: null,
            phonenumber: null,
            password: null,
            images:""
        }
    },
    methods: {
        previewFiles() {
            this.images = this.files = this.$refs.myFiles.files;
        },
        
        addStudent() {
            console.log(this.images);
            let object = {
                first_name: this.first_name,
                last_name: this.last_name,
                gender: this.gender,
                batch: this.batch.toUpperCase(),
                image: this.images,
                email: this.email,
                password: this.password,
                phone: this.phonenumber,

            }
            if (this.first_name != null && this.last_name != null && this.gender != null && this.batch != null && this.email != null && this.phonenumber != null && this.password != null) {
                axios.post("/social_affairs/students",object).then(() => { 
                    this.$router.push({ name: "studentlist" });
                })
                
            } else {
                console.log("add error")
            }
        }
    }
}
</script>

<style scoped>



.modal-header{
    background: #63BFE7;
}

.btn-add{
    margin-left: 85%;
    position: fixed;
    z-index: 999;
}
.modal{
    margin-top: 3.4%;
}
.input .form-control{
    width: 48%;

}
.gender, .batch {
    width: 48%;
}
.form-label{
    font-weight: bold;
}
</style>