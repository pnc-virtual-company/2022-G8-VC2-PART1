<template>
    <div class="form_login">
        <form @submit.prevent="login">
            <div class="header">
                <header>Student Leave Management System</header>
            </div>
            <div class="form_body">
                <div class="logo">
                    <img src="../assets/pn-logo.png" alt="" style="width: 150px; height: 150px">
                </div>
                <div class="form">
                    <div class="input">
                        <!-- <input type="text" placeholder="username" v-model="username"> -->
                        <input type="email" placeholder="email" v-model="email">
                        <span v-if="forgotEmail">Please put your email!</span>
                        <input type="password" placeholder="password" v-model="password">
                        <span v-if="forgotPassword">Please put your password!</span>
                    </div>
                </div>
            </div>
            <div class="btn_login">
                <button type="submit">
                    <span>Login</span>
                    <img src="../assets/next-button.png" alt="">
                </button>

            </div>
        </form>
    </div>
</template>

<script>
// import axios from "../../axios-http.js"
export default {
    emits:['request-login'],
    data() {
        return {
            email: null,
            password: null,

            forgotEmail: false,
            forgotPassword: false,
        }
    },
    methods: {
        login() {
           this.validation(); 
        },
        validation() {
            if (this.email == null) {
                this.forgotEmail = true;
            }
            else if (this.password == null) {
                this.forgotEmail = false;
                this.forgotPassword = true;
            }
            else{
                this.forgotPassword = false;
                let userInfo = {
                    email:this.email,
                    password:this.password,
                }
                this.$emit('request-login',userInfo);
            }
        }

    }
}
</script>

<style scoped>
.form_login{
    width: 40%;
    margin-top: 10%;
    margin-left: 30%;
    background: #fff;
    border-radius: 7px ;
box-shadow: rgba(0, 0, 0, 0.7) 0px 0px 5px 0px, rgba(0, 0, 0, 0.4) 0px 0px 1px 0px;
    box-sizing: border-box;
}
.header {
    background: #63BFE7;
    border-radius: 7px 7px 0 0;

}
.header header {
    text-align: center;
    padding: 10px;
    color: #fff;
    font-size: 1.3rem;
    font-weight: bold;
}
.form_body {
    display: flex;
    justify-content: space-between;
    align-items:center;
    padding: 10px;
    margin: 10px;
}
.form{
    margin-left: 3%;
}
 select,input{
    width: 140px;
    padding: 3px;
    font-size: 1rem;
    margin: 2px;
}
.input input {
    box-sizing: border-box;
    width: 100%;
    border: none;
    padding: 10px;
    margin: 5px 0;
    border-bottom: 1px solid rgb(189, 189, 189);
}
input:focus {
    outline: none;
    border-bottom: 1px solid #63BFE7;
}

.input span{
    color: red;
    font-size: 13px;
}
.btn_login{ 
    display: flex;
    justify-content: center;
    align-items: center;
}
.btn_login button{
    width: 150px;
    padding: 10px;
    margin-bottom: 20px;
    cursor: pointer;
    background: none;
    border: none;
    background: orange;
    color: #ffff;
    border-radius: 7px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}
.btn_login button:hover {
    background: rgb(251, 185, 62);
}
.btn_login button img{
    width: 25px;
    height: 25px;
    margin-left: 5%;
    /* margin-top: 10%; */
}
.btn_login button span{
    font-size: 1.2rem;
}
</style>