<template>
    <div class="form_login">
        <form >
            <div class="header">
                <header>Student Leave Management System</header>
            </div>
            <div class="form_body">
                <div class="logo">
                    <img src="../../assets/pn-logo.png" alt="" style="width: 150px; height: 150px">
                </div>
                <div class="form">
                    <div class="selection">
                        <select name="" id="" v-model="select_role">
                            <option value="admin">Admin</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div class="input">
                        <!-- <input type="text" placeholder="username" v-model="username"> -->
                        <input type="email" placeholder="email" v-model="email">
                        <input type="password" placeholder="password" v-model="password">
                    </div>
                </div>
            </div>
            <div class="btn_login">
                <button @click="Login">
                    <span>Login</span>
                    <img src="../../assets/next-button.png" alt="">
                </button>

            </div>
        </form>
    </div>
</template>

<script>
// import axios from "../../axios-http.js"
export default {
    data() {
        return {
            select_role: null,
            email: null,
            password: null
        }
    },
    methods: {
        login() {
            console.log(this.select_role)
            console.log(this.email)
            console.log(this.password)
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