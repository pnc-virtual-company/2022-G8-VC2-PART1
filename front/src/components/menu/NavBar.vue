<template>
    <div class="container">
        <nav>
            <div class="left_side_bar">
                <div class="logo_display">
                    <img src="../../assets/pn-logo.png" alt="">
                    <p>SLMS</p>
                </div>
            </div>
                <div class="router">
                    <router-link to="/" v-if="userRole=='student'">List All Leaves</router-link> 
                    <router-link to="/new_request" v-if="userRole=='student'">New Request</router-link>
                    <router-link to="/studentlist" v-if="userRole=='admin'">Student list</router-link>
                    <router-link to="/checkleave" v-if="userRole=='admin'">Check Leave</router-link>
                </div>
            <div class="user_name">
                <div class="user_profile">
                    <router-link to="/profile_student" v-if="userRole=='student'">Phearun Chhun</router-link>
                    <router-link to="/profile_admin" v-if="userRole=='admin'">Phearun Chhun</router-link>
                </div>
                <div class="btn_sign_out">
                    <button @click="$emit('request-logout')">
                        <img src="../../assets/logout.png" alt="" style="width:30px;height:30px;color:#fff;">
                    </button>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    emits:['request-logout'],
    props:['userRole'],
}
</script>

<style scoped>




* {
    padding: 0;
    margin: 0;
    font-family: 'Roboto Slab', serif;
}
nav {
    background: #63BFE7;
    box-shadow: rgba(60, 64, 67, 1) 0px 1px 2px 0px, rgba(60, 64, 67, 0.1) 0px 2px 6px 2px;
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
    font-size: 1.2rem;
}
nav .router a.router-link-exact-active {
    color:#fff;
    background: orange;
    border-radius: 7px;
    padding: 12px;
}
nav .user_name a.router-link-exact-active {
    color:#63BFE7;
    padding: 12px;
    background: #fff;
    border-radius: 7px;
}
.logo_display {
    display: flex;
    align-items: center;
}
.logo_display img{
    width: 60px;
    height: 60px;
    margin-left: 10%;
}
.logo_display p{
    color:#ffff;
    margin-left: 10%;
    font-size: 1.5rem;
}
.router {
    display: flex;
    justify-content: center;
    align-items: center;
}
.user_name {
    width: 20%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.user_name .btn_sign_out {
    margin: 10px;
}
.user_profile button{
    background: none;
    border: none;
    cursor: pointer;
}
.btn_sign_out button{
    background: none; 
    border:none;
    /* padding: 12px; */
    cursor: pointer;
    color:#ffff; 
    font-size: 1.2rem;  
}
.btn_sign_out bottom img{
    display: flex;
    justify-content: center;
    align-items: center;
    background: none;
}
</style>